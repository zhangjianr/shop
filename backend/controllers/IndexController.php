<?php
namespace backend\controllers;

use common\core\backend\BackendController;


class IndexController extends BackendController
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {


        return $this->render();
    }


}