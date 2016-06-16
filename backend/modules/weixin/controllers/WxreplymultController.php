<?php

namespace backend\modules\weixin\controllers;

use Yii;
use backend\models\WxReplyMult;
use backend\models\searchs\WxReplyMultSearch;
use common\core\backend\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Wxreply;
use yii\data\Pagination;
use backend\models\Keyword;
use yii\data\ActiveDataProvider;
use backend\models\Image;



/**
 * WxreplymultController implements the CRUD actions for WxReplyMult model.
 */
class WxreplymultController extends BackendController
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
     * Lists all WxReplyMult models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WxReplyMultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WxReplyMult model.
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
     * Creates a new WxReplyMult model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WxReplyMult();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $keyword = Keyword::findOne(['keyword' => $model->keyword]);
            if(empty($keyword)){
                $keyword = new Keyword();
            }
            $keyword->status = 3;
            $keyword->keyword = $model->keyword;
            $keyword->rid = $model->id;
            $keyword->save();

            Yii::$app->session->setFlash('createmultid',$model->id);
            return $this->redirect(['/weixin/wxreplymult/index']);
        } else {
            $query = Wxreply::find();
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 5
                ]
            ]);
            
            return $this->render('create', [
                'model' => $model,
                'dataProvider'   => $dataProvider  //分页对象
            ]);
        }
    }

    /**
     * Updates an existing WxReplyMult model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(empty($keyword)){
                $keyword = new Keyword();
            }
            $keyword->status = 3;
            $keyword->keyword = $model->keyword;
            $keyword->rid = $model->id;
            $keyword->save();

            Yii::$app->session->setFlash('updatemultid',$model->id);
            return $this->redirect(['/weixin/wxreplymult/index']);
        } else {
            $query = Wxreply::find();
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 5
                ]
            ]);

            return $this->render('update', [
                'model' => $model,
                'dataProvider' => $dataProvider,  //分页对象
            ]);
        }
    }

    /**
     * Deletes an existing WxReplyMult model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $request = Yii::$app->request;
        if($request->isAjax) {
            $id = $request->post('id');
            $model = WxReplyMult::findOne($id);
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($model->delete()){
                return ['status' => true];
            }
        }
    }

    /**
     * Finds the WxReplyMult model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WxReplyMult the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WxReplyMult::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
