<?php

namespace backend\modules\weixin\controllers;

use backend\models\Wxreply;
use Yii;
use backend\models\Wxmenu;
use backend\models\search\WxmenuSearch;
use common\core\backend\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * WxmenuController implements the CRUD actions for Wxmenu model.
 */
class WxmenuController extends BackendController
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
     * Lists all Wxmenu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WxmenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = Wxmenu::find();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);

        $data = $query->limit($pagination->limit)
            ->offset($pagination->offset)
            ->orderBy('superior')
            ->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' 		   => $data ,		//当前页数据
            'pagination'   => $pagination  //分页对象
        ]);
    }

    /**
     * Displays a single Wxmenu model.
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
     * Creates a new Wxmenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wxmenu();
        $num = 0;
        $enum = 0;
        if(Yii::$app->request->post('Wxmenu')['superior'] == 0 && isset(Yii::$app->request->post('Wxmenu')['superior'])){
            $num = $model->find()->where(['superior' => 0])->count();
        }else{
            $enum = $model->find()->where(['superior' => Yii::$app->request->post('Wxmenu')['superior']])->count();
        }

        //判断一级菜单不能超过3个
        if($num > 2){
            Yii::$app->session->setFlash('yijinum',1);
            return $this->render('create', [
                'model' => $model,
            ]);
        }elseif ($enum >4){//判断每个一级菜单的二级菜单不能超过五个
            Yii::$app->session->setFlash('erjinum',1);
            return $this->render('create', [
                'model' => $model,
            ]);
        }elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('menuid',$model->id);
            return $this->redirect(['/weixin/wxmenu/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Wxmenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $Wxmenu = new Wxmenu();
        $model = $this->findModel($id);
        $num = 0;
        $enum = 0;
        if(Yii::$app->request->post('Wxmenu')['superior'] == 0 && isset(Yii::$app->request->post('Wxmenu')['superior'])){
            $num = $Wxmenu->find()->where(['superior' => 0])->count();
        }else{
            $enum = $Wxmenu->find()->where(['superior' => Yii::$app->request->post('Wxmenu')['superior']])->count();
        }
        if($num > 3){
            Yii::$app->session->setFlash('yijinum',1);
            return $this->render('update', [
                'model' => $model,
            ]);
        }elseif ($enum >5){
            Yii::$app->session->setFlash('erjinum',1);
            return $this->render('update', [
                'model' => $model,
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('menuupid',$model->id);
            return $this->redirect(['/weixin/wxmenu/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Wxmenu model.
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
     * Finds the Wxmenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wxmenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wxmenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 删除自定义菜单
     * @author zhangjian
     */
    public function actionDelmenu()
    {
        $request = Yii::$app->request;
        if($request->isAjax) {
            $id = $request->post('id');
            $model = Wxmenu::findOne($id);
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($model->delete()){
                return ['status' => true];
            }
        }
    }

    /**
     * 排序
     * @return array
     * @author zhangjian
     */
    public function actionOrdmenu()
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
                $model = Wxmenu::findOne($id);
                $model->sort = $ord;
                $model->save();
                $n++;
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['status' => true];
        }
    }
}
