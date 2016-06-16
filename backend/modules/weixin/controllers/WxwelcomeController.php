<?php

namespace backend\modules\weixin\controllers;

use backend\models\Wxnewreply;
use backend\models\Wxreply;
use backend\models\WxReplyMult;
use Yii;
use backend\models\WxWelcome;
use backend\models\searchs\WxWelcomeSearch;
use common\core\backend\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WxwelcomeController implements the CRUD actions for WxWelcome model.
 */
class WxwelcomeController extends BackendController
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
     * Lists all WxWelcome models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WxWelcomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WxWelcome model.
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
     * Creates a new WxWelcome model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WxWelcome();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing WxWelcome model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = WxWelcome::findOne(1);
        if(!$model){
            $model = new WxWelcome();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WxWelcome model.
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
     * Finds the WxWelcome model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WxWelcome the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WxWelcome::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @author zhangjian
     * 关键词
     */
    public function actionKeyword()
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            if($request->post('id') == 3){
                $data = WxReplyMult::find()->all();

            }else if($request->post('id') == 2){
                $data = Wxreply::find()->all();
            }else{
                $data = Wxnewreply::find()->all();
            }
            $option = '';
            foreach ($data as $val){
                $option .= '<option value="'.$val->id.'">'.$val->keyword.'</option>';
            }
            echo $option;

        }
    }
}
