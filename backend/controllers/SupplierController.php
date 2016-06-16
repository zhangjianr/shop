<?php

namespace backend\controllers;

use backend\models\forms\SupplierForm;
use Yii;
use backend\models\CompanyReg;
use backend\models\searchs\CompanyRegSearch;
use common\core\backend\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;

/**
 * CompanyController implements the CRUD actions for CompanyReg model.
 */
class SupplierController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'status' => [
                'class' => 'backend\components\StatusAction',
            ],
        ];
    }

    /**
     * Lists all CompanyReg models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyRegSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** 待审核列表
     * @return string
     * @author wuqi
     */
    public function actionAudit()
    {
        $searchModel = new CompanyRegSearch();
        $dataProvider = $searchModel->searchAudit(Yii::$app->request->queryParams);

        return $this->render('audit', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyReg model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /** 待审核详情页
     * @param $id
     * @return string
     * @author wuqi
     * @throws NotFoundHttpException
     */
    public function actionAview($id)
    {
        return $this->render('aview', [
            'model' => $this->findModel($id),
        ]);
    }

    /** 修改密码
     * @return \yii\web\Response
     * @author wuqi
     */
    public function actionUpdatepass()
    {
        $model = new SupplierForm();
        if ($model->load(Yii::$app->request->post(), 'SupplierForm') && $model->updatePass()) {
            Yii::$app->session->setFlash('success', '修改成功');
        } else {
            Yii::$app->session->setFlash('error', '修改失败');
        }
        return $this->redirect(Yii::$app->request->referrer);

    }

    /** 拒绝理由
     * @return \yii\web\Response
     * @author wuqi
     */
    public function actionDenyinfo()
    {
        $model = $this->findModel(Yii::$app->request->post('CompanyReg')['id']);
        $model->setScenario('deny');
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '操作成功');
        } else {
            Yii::$app->session->setFlash('error', '操作失败');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Deletes an existing CompanyReg model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $res = Yii::$app->db->createCommand()->update(CompanyReg::tableName(),
                ['status' => CompanyReg::DELETE_TRUE],
                ['id' => $id]
            )->execute();
            Yii::$app->response->format = 'json';
            return $res ? ['status' => 1] : ['status' => 0];
        }
    }

    /**
     * Finds the CompanyReg model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyReg the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyReg::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
