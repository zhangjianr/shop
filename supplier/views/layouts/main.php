<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
use supplier\assets\AppAsset;
use common\core\lib\Constants;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" /-->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <header class="main-header">
        <a href="#" class="logo">
            <span class="logo-mini"><b>A</b>LT</span>
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <?= Html::beginForm(['/site/logout'], 'post',['class'=>'dropdown-toggle','style'=>'margin-top:1rem']) ?>
                        <img style="margin-left:2rem;" src="adminlte/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <?php if(Yii::$app->user->identity){ ?>
                        <?= Html::submitButton(
                            '退出 (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn ','style'=>'color:white;padding:0px;background:#3C8DBC;']
                        ) ?><?php } ?>
                        <?= Html::endForm() ?>
                    </li>
                    <li>
                        <a></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php if(Yii::$app->user->identity){
                            echo Yii::$app->user->identity->username;
                        } ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="<?= Url::toRoute(['/ordercompany/index'])?>"><i class="fa fa-search-plus text-aqua"></i> 订单列表</a></li>
                <li><a href="<?= Url::toRoute(['/customorder/index'])?>"><i class="fa fa-search-plus text-aqua"></i> 定制订单列表</a></li>
<!--                <li><a href="--><?//= Url::toRoute(['/site/index'])?><!--"><i class="fa fa-search-plus text-aqua"></i> 首页</a></li>-->
                <li><a href="<?= Url::toRoute(['/site/uppass'])?>"><i class="fa fa-search-plus text-aqua"></i> 修改密码</a></li>
                <li><a href="<?= Url::toRoute(['/site/upsignup'])?>"><i class="fa fa-search-plus text-aqua"></i> 修改资料</a></li>
<!--                <li><a href="--><?//= Url::toRoute(['/person/cindex'])?><!--"><i class="fa fa-search-plus text-aqua"></i> 客服业务</a></li>-->
<!--                <li><a href="--><?//= Url::toRoute(['/feedback/index'])?><!--"><i class="fa fa-search-plus text-aqua"></i> 给大平台留言</a></li>-->
<!--                <li><a href="--><?//= Url::toRoute(['/reply/index'])?><!--"><i class="fa fa-search-plus text-aqua"></i> 评论管理</a></li>-->
            </ul>

        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <?= Html::encode($this->title) ?>
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active"><?= Html::encode($this->title) ?></li>
            </ol>
        </section>
        <section class="content">
            <?php if(Yii::$app->user->identity->status != 1): ?>
                <div class="alert alert-danger" role="alert">当前企业号<?= Constants::getAudit(Yii::$app->user->identity->status) ?></div>
            <?php endif; ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </section>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>

            </div>

            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>

            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </aside>

    <div class="control-sidebar-bg"></div>
</div>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

