<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = 'main';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['register'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['test'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

//        $_browser = "";
//        if (strpos($_SERVER['HTTP_USER_AGENT'], 'iphone') || strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strpos($_SERVER['HTTP_USER_AGENT'], 'ipod') || strpos($_SERVER['HTTP_USER_AGENT'], 'ipad')) {
//            $_browser = 'iphone';
//        } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'android') || strpos($_SERVER['HTTP_USER_AGENT'], 'Android')) {
//            $_browser = 'android';
//        }

//        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
//            header("location:http://wap.dchcn.com/");
//        }
        echo 'a';die;
        return $this->redirect('/bookcenter');
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $user_info = $model->login();
            if (!empty($user_info)) {
                $user_info['expire'] = time();
                Yii::$app->session->set('userInfo', $user_info);
                return $this->redirect('/index');
                \Yii::$app->end();
            }
            echo '用户名/密码不正确。';
            die;
        } else {
            $model->password = '';
        }
		return $this->render('login', [
                'model' => $model,
            ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->session->remove('userInfo');
        return $this->goHome();
    }


    public function actionRegister()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {
            return $model->register();
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionNew()
    {

        $this->layout = 'layui';
        return $this->render('layui');
    }


}
