<?php

namespace backend\controllers;

use backend\models\CouponsNumber;
use common\core\lib\Helper;
use Yii;
use backend\models\Coupons;
use backend\models\searchs\CouponsSearch;
use common\core\backend\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CouponsController implements the CRUD actions for Coupons model.
 */
class CouponsController extends BackendController
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
     * Lists all Coupons models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CouponsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Coupons model.
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
     * Creates a new Coupons model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Coupons();
        if ($model->load(Yii::$app->request->post())) {
            $model->starttime = strtotime(Yii::$app->request->post('Coupons')['starttime']);
            $model->endtime = strtotime(Yii::$app->request->post('Coupons')['endtime']);
            if ($model->save()) {
                for ($i = 0; $i < $model->number; $i++) {
                    $cnumber = new CouponsNumber();
                    $cnumber->number = Helper::orderNum();
                    $cnumber->cid = $model->id;
                    $cnumber->save();
                }
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Coupons model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldNumber = $model->number;
        if ($model->load(Yii::$app->request->post())) {
            $model->starttime = strtotime(Yii::$app->request->post('Coupons')['starttime']);
            $model->endtime = strtotime(Yii::$app->request->post('Coupons')['endtime']);
            if ($model->save()) {
                if($model->number - $oldNumber > 0){
                    for ($i = 0; $i < $model->number - $oldNumber; $i++) {
                        $cnumber = new CouponsNumber();
                        $cnumber->number = Helper::orderNum();
                        $cnumber->cid = $model->id;
                        $cnumber->save();
                    }
                }
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Coupons model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /** 券号列表
     * @author wuqi
     */
    public function actionList()
    {
        $searchModel = new CouponsSearch();
        $dataProvider = $searchModel->listSearch(Yii::$app->request->queryParams);
        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Coupons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Coupons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Coupons::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
