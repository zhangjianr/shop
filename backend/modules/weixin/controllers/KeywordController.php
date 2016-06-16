<?php

namespace backend\modules\weixin\controllers;

use Yii;
use backend\models\Keyword;
use backend\models\searchs\KeywordSearch;
use common\core\backend\BackendController;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KeywordController implements the CRUD actions for Keyword model.
 */
class KeywordController extends BackendController
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
     * Lists all Keyword models.
     * @return mixed
     */
    public function actionIndex()
    {
        //调用模型
        $query = Keyword::find();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);
        $data = $query->limit($pagination->limit)
            ->offset($pagination->offset)
            ->all();

        return $this->render('index', [
            'data' 		   => $data ,		//当前页数据
            'pagination'   => $pagination  //分页对象
        ]);
    }

    /**
     * Displays a single Keyword model.
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
     * Creates a new Keyword model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Keyword();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('keycreateid',$model->id);
            return $this->redirect(['/weixin/keyword/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Keyword model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('keyupdateid',$model->id);
            return $this->redirect(['/weixin/keyword/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Keyword model.
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
     * Finds the Keyword model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Keyword the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Keyword::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 设置关键字回复
     * @author zhangjian
     */
    public function actionUpreply()
    {
        $request = Yii::$app->request;
        if($request->isAjax) {
            $id = $request->post('id');
            $status = $request->post('data');
            $model = Keyword::findOne($id);
            $model->status = $status;
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($model->save()){
                return ['status' => $status];
            }else{
                return ['status' => false];
            }
        }
    }

    /**
     * 删除关键字
     * @author zhangjian
     */
    public function actionDelreply()
    {
        $request = Yii::$app->request;
        if($request->isAjax) {
            $id = $request->post('id');
            $model = Keyword::findOne($id);
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($model->delete()){
                return ['status' => true];
            }
        }
    }

}





