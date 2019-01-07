<?php

namespace app\controllers;

use app\models\RegistrationForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\DiaryForm;
use app\models\MyEvent;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAbout()
    {
        $search_model = new DiaryForm();
        $tasks = [];
        $event = new MyEvent();
        if (isset($_POST["search_button"])){
            //проверить какой чек установлен и выбрать не все записи
            //я хуй знает почему, но мне всегда приходят false чеки
        }else{
            //выбрать все записи
        }
        //перебрать в масиве артиклы и закинуть в tasks по алгоритму внизу
        $event->id = 1;//вписать ид-ху артикла
        $event->title = 'Testing';//наверно тайтл артикла
        $event->start = '01.07.2019';//дату артикла
        $event->category = "ctvf";//категорию артикла
        $event->picture = "ctvf";//картинку артикла
        $event->description = "ctvf";//текст артикла
        $tasks[] = $event;

        return $this->render('about', [
            'search_model' => $search_model,
            'events' => $tasks
        ]);
    }

    public function actionRegistration()
    {
        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            $model->save();
            return $this->goBack();
        }
        return $this->render('registration', [
            'model' => $model
        ]);
    }
}
