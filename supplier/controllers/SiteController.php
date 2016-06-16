<?php
namespace supplier\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\CompanyForm;
use supplier\models\PasswordResetRequestForm;
use supplier\models\ResetPasswordForm;
use supplier\models\SignupForm;
use supplier\models\Uppass;
use supplier\models\ContactForm;
use common\models\UploadForm;
use common\models\CompanyReg;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
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
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'signup'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'general','uppass','upsignup'],
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
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new CompanyForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['ordercompany/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout = 'login';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($this->upload($model) && $model->signup()) {
                return $this->redirect(['ordercompany/index']);
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

        public function actionUpsignup(){
        $model = CompanyReg::findOne(Yii::$app->user->identity->id);
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            if($arr = CompanyReg::findOne(['username' => $data['CompanyReg']['username']])){
                if($arr->id != $model->id){
                    Yii::$app->session->setFlash('upusername', 1);
                    return $this->render('upsignup', [
                        'model' => $model,
                    ]);
                }
            }

            if ($this->upload($model) && $model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->render('upsignup', [
            'model' => $model,
        ]);
    }

    public function actionUppass(){
        $model = new Uppass();
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->upsignup(Yii::$app->request->post())) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }
        return $this->render('uppass', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /** 图片上传
     * @param $model
     * @author wuqi
     */
    protected function upload($model)
    {
        $uploadForm = new UploadForm;
        $arr = ['organization','tax','license'];
        for ($i=0;$i<3;$i++){
            $uploadForm->upload($model, $arr[$i], 'supplier');
        }
        return true;
    }
}
