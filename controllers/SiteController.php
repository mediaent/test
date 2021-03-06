<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Files;
use app\models\FilesTags;
use app\forms\UploadForm;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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

    /**
     * @inheritdoc
     */
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

    /**
     * Displays homepage with uplads and list.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new UploadForm();
        $dataProvider = new ActiveDataProvider([
            'query' => Files::find(),
            'sort'=> ['defaultOrder' => ['create_at'=>SORT_ASC]]
        ]);

        if (Yii::$app->request->post() != null) {
            $model->XMLfiles = UploadedFile::getInstances($model, 'XMLfiles');

            if ($model->XMLfiles != null) {
                if ($model->upload()) {
                    return $this->redirect(['index']);
                }
            }
        } else {
            return $this->render('index', compact('model', 'dataProvider'));
        }
    }


    /**
     * Displays FileDetails.
     *
     * @return string
     */
    public function actionView($id)
    {
        $model = Files::findOne($id);
        if ($model !== null) {
                $dataProvider = new ActiveDataProvider([
            'query' => $model->getFilesTags(),
            'sort'=> ['defaultOrder' => ['tag_name'=>SORT_ASC]]
                ]);
            return $this->render('view', compact('model', 'dataProvider'));
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
