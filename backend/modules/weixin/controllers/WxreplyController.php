<?php

namespace backend\modules\weixin\controllers;

use Yii;
use backend\models\Wxreply;
use backend\models\search\WxreplySearch;
use common\core\backend\BackendController;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WxreplyController implements the CRUD actions for Wxreply model.
 */
class WxreplyController extends BackendController
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
            'upload' => ['class' => 'common\core\components\UploadAction'],
        ];
    }    /**
     * Lists all Wxreply models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $searchModel = new WxreplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //调用模型
        $query = Wxreply::find();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);

        $data = $query->limit($pagination->limit)
            ->offset($pagination->offset)
            ->orderBy('kid')
            ->all();

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'data' 		   => $data ,		//当前页数据
            'pagination'   => $pagination  //分页对象
        ]);
    }

    /**
     * Displays a single Wxreply model.
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
     * Creates a new Wxreply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wxreply();
        $num = $model->find()->where(['kid' => Yii::$app->request->post('Wxreply')['kid']])->count();

        if($num > 6){
            Yii::$app->session->setFlash('sortnum',1);
            return $this->render('create', [
                'model' => $model,
            ]);
        }elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('keycreateid',$model->id);
            return $this->redirect(['/weixin/wxreply/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Wxreply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $Wxreply = new Wxreply();
        $num = $Wxreply->find()->where(['kid' => Yii::$app->request->post('Wxreply')['kid']])->count();
        $model = $this->findModel($id);
        if($num > 6){
            Yii::$app->session->setFlash('sortnum',1);
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        $model = $this->findModel($id);

        if(Yii::$app->request->post('Wxreply')['picurl'] != $model->picurl && Yii::$app->request->post('Wxreply')['picurl']){
            unlink(Yii::$app->params['uploadPath'].$model->picurl);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('keyupdateid',$model->id);
            return $this->redirect(['/weixin/wxreply/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Wxreply model.
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
     * Finds the Wxreply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wxreply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wxreply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 删除图文回复
     * @author zhangjian
     */
    public function actionDelreply()
    {
        $request = Yii::$app->request;
        if($request->isAjax) {
            $id = $request->post('id');
            $model = Wxreply::findOne($id);
            unlink(Yii::$app->params['uploadPath'].$model->picurl);
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($model->delete()){
                return ['status' => true];
            }
        }
    }
    
    /**
     * 排序图文回复
     * @author zhangjian
     */
    public function actionOrdreply()
    {
        $request = Yii::$app->request;
        if($request->isAjax) {
            $array = explode(',',$request->post('data'));
            array_pop($array);
            $count = count($array);
            $num = $count/2;
            $n = 0;
            for ($i=0; $i < $num; $i++) {
                $ord = $array[$n];
                $n++;
                $id = $array[$n];
                $model = Wxreply::findOne($id);
                $model->sort = $ord;
                $model->save();
                $n++;
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['status' => true];
        }

    }
}
