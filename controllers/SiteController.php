<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleForm;
use app\models\Category;
use app\models\RegistrationForm;
use app\models\Users;
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

    public function actionDiary($check1 = null, $check2 = null, $check3 = null, $check4 = null, $check5 = null)
    {
        $model_add = new Article();
        $search_model = new DiaryForm();
        $tasks = [];
        $user_type = 0;
        if(Yii::$app->user->identity){
            $user_type = Yii::$app->user->identity->UType;
        }
        if ($model_add->load(Yii::$app->request->post())) {
            $model_add->save();
        }

        if($check1 || $check2 || $check3 || $check4 || $check5){
            $search_model->checkOne = $check1 ? true : false;
            $search_model->checkTwo = $check2 ? true : false;
            $search_model->checkThree = $check3 ? true : false;
            $search_model->checkFour = $check4 ? true : false;
            $search_model->checkFive = $check5 ? true : false;
            $articles = Article::findAll([
                'idCat' => [$check1, $check2, $check3, $check4, $check5],
            ]);
        }else{
            $articles = Article::find()->asArray()->all();
        }
        foreach ($articles as $article) {
            $tasks[] = array(
                'id' => $article['idArticle'],
                'title' => date_format(date_create_from_format('Y-m-d', $article['ACreateDate']), 'Y-m-d') . ' ' . $article['AName'],
                'start' => date_format(date_create_from_format('Y-m-d', $article['ACreateDate']), 'Y-m-d')
            );
        }
        return $this->render('diary', [
            'search_model' => $search_model,
            'events' => $tasks,
            'model_add' => $model_add,
            'user_type' => $user_type
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
    public function actionArticle($date, $text, $title, $smile, $imgUrl)
    {
        $date = trim($date);
        $model = Article::findOne(['ACreateDate' => $date]);
        $cat_model = Category::findOne(['idCategory' => $model->idCat]);
        $user_type = 0;
        if(Yii::$app->user->identity){
            $user_type = Yii::$app->user->identity->UType;
        }
        if($user_type == 1) {
            if ($text || $title || $smile || $imgUrl) {
                $model->AText = $text;
                $model->AName = $title;
                $model->idCat = $smile;
                $model->APic = $imgUrl;
                $model->save();
                $cat_model = Category::findOne(['idCategory' => $model->idCat]);
            }
        }

        return $this->render('article', [
            'model' => $model,
            'cat_model' => $cat_model,
            'user_type' => $user_type
        ]);
    }
}
