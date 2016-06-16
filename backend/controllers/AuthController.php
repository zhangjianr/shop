<?php

namespace backend\controllers;

use Yii;
use backend\models\forms\AuthForm;
use backend\models\Admin;
use backend\models\searchs\AdminSearch;
use common\core\backend\BackendController;
use yii\base\ErrorException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IndexController implements the CRUD actions for Admin model.
 */
class AuthController extends BackendController
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
            'status' => [
                'class' => 'backend\components\StatusAction',
            ],
        ];
    }

    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //获取用户所拥有的权限
        $id = Yii::$app->request->get('id');
        $data = Admin::findOne($id);
        $per = Yii::$app->authManager->getPermissionsByRole($data['username']);
        $permission = $per ? $per : [];
        $menudata = (new \yii\db\Query())
            ->select('*')
            ->from('{{%menu}}')
            ->orderBy("order asc")
            ->all();
        //获取系统所有控制菜单
        $nodeList = $this->nodeChild($menudata);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'nodeList' => $nodeList,
            'permission' => $permission
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthForm();

        if ($model->load(Yii::$app->request->post()) && $admin = $model->signup()) {
            return $this->redirect(['view', 'id' => $admin->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }




    /** 递归获取权限选择列表
     * @param $data
     * @param string $pid
     * @return array
     * @author wuqi
     */
    private function nodeChild($data, $pid = '')
    {
        $arr = [];
        foreach ($data as $val) {
            if ($val['parent'] == $pid) {
                $res = ['id' => $val['id'], 'name' => $val['name'], 'route' => $val['route']];
                foreach ($data as $v) {
                    $res['child'] = $this->nodeChild($data, $val['id']);
                    break;
                }
                if (!$res['child']) {
                    unset($res['child']);
                }
                $arr[] = $res;
            }
        }
        return $arr;
    }


    /** 权限提交
     * @return array
     * @author wuqi
     */
    public function actionPermission()
    {
        $post = Yii::$app->request->post();
        $uid = $post['id'];
        $data = $post['data'];
        try{
            //获取当前帐号名等于角色
            $username = Admin::findOne($uid)['username'];
            $auth = Yii::$app->authManager;
            $userRole = $auth->getRole($username);
            $auth->removeChildren($userRole);

            //遍历添加角色下的权限
            foreach ($data as $value) {
                $per = $auth->createPermission($value);
                $auth->addChild($userRole, $per);
            }

            $status = 1;

        }catch(ErrorException $e){
            $status = 0;
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['status' => $status];
    }


    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /** 操作日志列表
     * @return string
     * @author wuqi
     */
    public function actionList()
    {
        return $this->render('list');
    }
}
