<?php

namespace backend\controllers;

use common\models\UploadForm;
use Yii;
use backend\models\Goods;
use backend\models\searchs\GoodsSearch;
use common\core\backend\BackendController;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\Attribute;
use yii\helpers\ArrayHelper;

/**
 * BrandController implements the CRUD actions for Brand model.
 */
class GoodsController extends BackendController
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
            'childlist' => [
                'class' => 'backend\components\ServiceTypeAction'
            ],
        ];
    }

    /**
     * Lists all Brand models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brand model.
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
     * Creates a new Brand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        if ($model->load(Yii::$app->request->post()) && $this->upload($model) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Brand model.
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
     * Deletes an existing Brand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $res = Yii::$app->db->createCommand()->update(Goods::tableName(),
                ['is_del' => Goods::DELETE_TRUE],
                ['id' => $id]
            )->execute();
            Yii::$app->response->format = 'json';
            return $res ? ['status' => 1] : ['status' => 0];
        }
    }

    /**
     * Finds the Brand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
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

        $uploadForm = new UploadForm;
        $uploadForm->upload($model, 'image_id', 'goods');
        return true;
    }

    public function actionAttr()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $typeid = $request->post('id');
            $data = Attribute::find()->where(['type_id' => $typeid])->orderBy("sort asc")->all();
            if (count(ArrayHelper::toArray($data)) > 0) {
                echo "<tr><th>ID</th><th>属性名</th><th>属性值</th><th>操作</th></tr>";
                foreach ($data as $v) {
                    echo "<tr><td>" . $v->id . "</td><td>" . $v->name . "</td><td>" . $v->value . "</td><td>" . Html::a('设置属性', Url::toRoute(['/attribute/update', 'id' => $v->id]), ['target' => '_blank']) . "</td></tr>";
                }
            } else {
                echo '<tr><td colspan="4" align="center">暂无属性</td></tr>';
            }
        }
    }
}
