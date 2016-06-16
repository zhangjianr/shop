<?php

namespace backend\controllers;

use backend\models\System;
use common\models\UploadForm;
use Yii;
use backend\models\IntegralGoods;
use backend\models\searchs\IntegralGoodsSearch;
use common\core\backend\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IgoodsController implements the CRUD actions for IntegralGoods model.
 */
class IgoodsController extends BackendController
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
            'Kupload' => [
                'class' => 'cliff363825\kindeditor\KindEditorUploadAction',
            ],
        ];
    }

    /**
     * Lists all IntegralGoods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IntegralGoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IntegralGoods model.
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
     * Creates a new IntegralGoods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IntegralGoods();

        if ($model->load(Yii::$app->request->post()) && $this->upload($model) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing IntegralGoods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $this->upload($model) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing IntegralGoods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $res = Yii::$app->db->createCommand()->update(IntegralGoods::tableName(),
                ['is_del' => IntegralGoods::DELETE_TRUE],
                ['id' => $id]
            )->execute();
            Yii::$app->response->format = 'json';
            return $res ? ['status' => 1] : ['status' => 0];
        }
    }

    /**
     * Finds the IntegralGoods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IntegralGoods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IntegralGoods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /** 积分规则
     * @author wuqi
     */
    public function actionRule()
    {
        $model = System::findOne(1);
        $model->setScenario('rule');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '添加成功');
        }
        return $this->render('rule', ['model' => $model]);
    }


    /** 图片上传
     * @param $model
     * @author wuqi
     */
    protected function upload($model)
    {

        $uploadForm = new UploadForm();
        $uploadForm->upload($model, 'image_id', 'igoods');
        return true;
    }

}
