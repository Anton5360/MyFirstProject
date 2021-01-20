<?php

namespace app\controllers;

use app\components\traits\GetLanguageComponentTrait;
use app\models\forms\ChangeLanguageForm;
use app\models\forms\RegistrationForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;

class SiteController extends Controller
{
    use GetLanguageComponentTrait;


    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
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
        $this->view->title = 'Login';
        $this->layout = 'guest';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load($this->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegistration()
    {
        $this->view->title = 'Registration';
        $this->layout = 'guest';

        $model = new RegistrationForm();

        if($model->load($this->request->post()) && $model->save()){
            return $this->redirect(['/site/login']);
        }

        $model->password = '';
        $model->repeatPassword = '';
        return $this->render('registration', ['model' => $model]);
    }


    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->redirect('login');
    }



    public function actionSetLanguage(): Response
    {
        $model = new ChangeLanguageForm();

        $post = Yii::$app->request->post();

        if(!$model->load($post) || !$model->validate())
        {
            return $this->goBack();
        }

        $languageComponent = $this->getComponent('language');

        $languageComponent->setLanguage($model->language);

        return $this->redirect($post['ChangeLanguageForm']['currentUrl']);
    }


}
