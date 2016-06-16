<?php

namespace backend\controllers;

use Yii;
use backend\models\ServiceType;
use backend\models\searchs\ServiceTypeSearch;
use common\core\backend\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;

/**
 * TypeController implements the CRUD actions for ServiceType model.
 */
class TypeController extends BackendController
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

    /**
     * Lists all ServiceType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ServiceType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServiceType();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '添加成功');
        } else {
            Yii::$app->session->setFlash('error', '添加失败');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Updates an existing ServiceType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = $this->findModel(Yii::$app->request->post('ServiceType')['id']);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '修改成功');
        } else {
            Yii::$app->session->setFlash('error', '修改失败');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Deletes an existing ServiceType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $res = Yii::$app->db->createCommand()->update(ServiceType::tableName(),
                ['status' => ServiceType::STATUS_DELETED],
                ['id' => $id]
            )->execute();
            Yii::$app->response->format = 'json';
            return $res ? ['status' => 1] : ['status' => 0];
        }
    }

    /**
     * Finds the ServiceType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
