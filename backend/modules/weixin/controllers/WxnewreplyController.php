<?php

namespace backend\modules\weixin\controllers;

use backend\models\Keyword;
use Yii;
use backend\models\Wxnewreply;
use common\core\backend\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * WxnewreplyController implements the CRUD actions for Wxnewreply model.
 */
class WxnewreplyController extends BackendController
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
     * Lists all Wxnewreply models.
     * @return mixed
     */
    public function actionIndex()
    {
        //调用模型
        $query = Wxnewreply::find();
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
     * Displays a single Wxnewreply model.
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
     * Creates a new Wxnewreply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wxnewreply();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $keyword = Keyword::findOne(['keyword' => $model->keyword]);
            if(empty($keyword)){
                $keyword = new Keyword();
            }
            $keyword->status = 1;
            $keyword->keyword = $model->keyword;
            $keyword->rid = $model->id;
            $keyword->save();
            
            Yii::$app->session->setFlash('keynewcreateid',$model->id);
            return $this->redirect(['/weixin/wxnewreply/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Wxnewreply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $keyword = Keyword::findOne(['keyword' => $model->keyword]);
            if(empty($keyword)){
                $keyword = new Keyword();
            }
            $keyword->status = 1;
            $keyword->keyword = $model->keyword;
            $keyword->rid = $model->id;
            $keyword->save();

            Yii::$app->session->setFlash('keynewupdateid',$model->id);
            return $this->redirect(['/weixin/wxnewreply/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Wxnewreply model.
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
     * Finds the Wxnewreply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wxnewreply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wxnewreply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 删除文本回复
     * @author zhangjian
     */
    public function actionDelnewreply()
    {
        $request = Yii::$app->request;
        if($request->isAjax) {
            $id = $request->post('id');
            $model = Wxnewreply::findOne($id);
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($model->delete()){
                return ['status' => true];
            }
        }
    }
}
