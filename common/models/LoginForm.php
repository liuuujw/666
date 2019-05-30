<?php

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $name;
    public $phone;
    public $age;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
//            ['password', 'validatePassword'],
            ['password', 'default'],
            ['name', 'default'],
            ['phone', 'default'],
            ['age', 'default'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $params = [
                ':username' => $this->username,
                ':password' => md5(md5($this->password))
            ];
            $res = Yii::$app->db->createCommand("SELECT `id`, `username`, `name`, `age`, `phone`, `token` FROM `user` WHERE `username` = :username AND `password` = :password;", $params)
                ->queryOne();
            return $res;
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {

//            $this->_user = User::findByUsername($this->username,$this->password);
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    public function register()
    {
        $values = [
            'id' => md5(uniqid(1)),
            'username' => $this->username,
            'password' => md5(md5($this->password)),
            'name' => $this->name,
            'phone' => $this->phone,
            'age' => $this->age,
            'login_time' => date('Y-m-d H:i:s'),
            'created_time' => date('Y-m-d H:i:s'),
        ];

        $res = Yii::$app->db->createCommand()
            ->insert('user', $values)
            ->execute();
		return $res;

    }

}
