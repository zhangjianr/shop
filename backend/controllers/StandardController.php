<?php

namespace backend\controllers;

use backend\models\forms\OrderStatus;
use backend\models\OrderCompany;
use backend\models\CompanyReg;
use Yii;
use backend\models\Order;
use backend\models\searchs\OrderSearch;
use common\core\backend\BackendController;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * StandardController implements the CRUD actions for Order model.
 */
class StandardController extends BackendController
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $statusModel = new OrderStatus();
        $bindModel = new OrderCompany();
        $bindProvider = new ActiveDataProvider([
            'query' => OrderCompany::find(),
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'statusModel' => $statusModel,
            'bindModel' => $bindModel,
            'dataProvider' => $dataProvider,
            'bindProvider' => $bindProvider
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $query = OrderCompany::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /** 修改订单状态
     * @return array
     * @author wuqi
     */
    public function actionStatus()
    {
        $model = new OrderStatus();
        if($model->load(Yii::$app->request->post()) && $model->setStatus()) {
            Yii::$app->session->setFlash('success', '状态修改成功');
            return  $this->redirect(Yii::$app->request->referrer);
        }
        Yii::$app->session->setFlash('error', '状态修改失败');
        return  $this->redirect(Yii::$app->request->referrer);
    }


    /** 获取分类下的供应商
     * @author wuqi
     */
    public function actionChildlist()
    {
        $post = Yii::$app->request->post();
        $res = CompanyReg::findAll(['status' => CompanyReg::AUDIT_TRUE, 'cate_id' => $post['id']]);

        echo "<option>请选择</option>";
        if (count(ArrayHelper::toArray($res)) > 0) {
            foreach ($res as $v) {
                echo "<option value = '" . $v->id . "'>" . $v->company_name . " </option>";
            }
        }
    }
}
