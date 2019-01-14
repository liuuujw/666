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
        $this->redirect('/bookcenter');
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
            if(!empty($user_info)){
                $user_info['expire'] = time();
                Yii::$app->session->set('userInfo',$user_info);
                $this->redirect('/index');
                \Yii::$app->end();
            }
            echo '用户名/密码不正确。';die;
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
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

        if($model->load(Yii::$app->request->post())){
            return $model->register();
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionTest(){
        echo $this->test();
    }

    public function test(){
        $str = 'http://weixin-10013420.file.myqcloud.com/propertyPicture/ImageMaterial/HYHJ009021/12389/d645483c68989ccba866de512b25b873.jpg';
        return str_replace('file','picsh',$str);
    }


}
