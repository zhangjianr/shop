<?php

namespace backend\controllers;

use backend\models\SpecialGoods;
use Yii;
use backend\models\Goods;
use backend\models\searchs\GoodsSearch;
use backend\models\Special;
use backend\models\searchs\SpecialSearch;
use common\core\backend\BackendController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UploadForm;

/**
 * SpecialController implements the CRUD actions for Special model.
 */
class SpecialController extends BackendController
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
     * Lists all Special models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Special model.
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
     * Creates a new Special model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Special();

        if ($model->load(Yii::$app->request->post()) && $this->upload($model) && $model->save()) {
            $ids = Yii::$app->request->post('selection', '');
            if (!empty($ids)) {
                foreach ($ids as $k => $v) {
                    $specialGoods = new SpecialGoods();
                    $specialGoods->sid = $model->id;
                    $specialGoods->gid = $v;
                    $specialGoods->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('create', ['model' => $model,]);
        }
    }

    /**
     * Updates an existing Special model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $this->upload($model) && $model->save()) {
            SpecialGoods::deleteAll(['sid' => $id]);
            $ids = Yii::$app->request->post('selection', '');
            if (!empty($ids)) {
                foreach ($ids as $k => $v) {
                    $specialGoods = new SpecialGoods();
                    $specialGoods->sid = $model->id;
                    $specialGoods->gid = $v;
                    $specialGoods->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('update', ['model' => $model,]);
        }
    }

    /**
     * Deletes an existing Special model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $res = Yii::$app->db->createCommand()->update(Special::tableName(),
                ['is_del' => Special::DELETE_TRUE],
                ['id' => $id]
            )->execute();
            Yii::$app->response->format = 'json';
            return $res ? ['status' => 1] : ['status' => 0];
        }
    }

    /**
     * Finds the Special model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Special the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Special::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /** 图片上传
     * @param $model
     * @author wuqi
     */
    protected function upload($model)
    {

        $uploadForm = new UploadForm();
        $uploadForm->upload($model, 'image_id', 'special');
        return true;
    }


    public function actionGoods()
    {
        if (Yii::$app->request->isAjax) {
            $map = $res = [];
            $post = Yii::$app->request->post();

            $query = Goods::find()->where(['is_del' => Goods::DELETE_FALSE]);

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            $query->andFilterWhere(['like', 'service_name', $post['service_name']]);


            foreach ($dataProvider->getModels() as $value) {
                $res[] = ['id' => $value->id, 'title' => $value->service_name];
            }
            //ajax 获取关联视频
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            Yii::$app->response->data = $res;
        }
    }
}
