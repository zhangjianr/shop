<?php

namespace backend\controllers;

use Yii;
use backend\models\Feedback;
use backend\models\searchs\FeedbackSearch;
use common\core\backend\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FeedbackController implements the CRUD actions for Feedback model.
 */
class FeedbackController extends BackendController
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
     * Lists all Feedback models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FeedbackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 用户反馈列表
     * @return string
     * @author wuqi
     */
    public function actionUindex()
    {
        $searchModel = new FeedbackSearch();
        $dataProvider = $searchModel->usearch(Yii::$app->request->queryParams);

        return $this->render('uindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Feedback model.
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
     * 用户反馈详情
     * @param $id
     * @return string
     * @author wuqi
     * @throws NotFoundHttpException
     */
    public function actionUview($id)
    {
        return $this->render('uview', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Feedback model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        if (Yii::$app->request->isAjax) {
            $content = Yii::$app->request->post('content');
            $res = Yii::$app->db->createCommand()->update(Feedback::tableName(),
                ['reply_content' => $content, 'status' => Feedback::STATUS_TRUE], ['id' => Yii::$app->request->post('id')])
                ->execute();
            $status = $res ? 1 : 0;
            Yii::$app->response->format = 'json';
            return ['status' => $status, 'url' => Yii::$app->request->referrer];
        }

    }

    /**
     * Deletes an existing Feedback model.
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
     * Finds the Feedback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Feedback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feedback::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
