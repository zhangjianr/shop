<?php
/**
 * Created by PhpStorm.
 * User: wuqi
 * Date: 16/4/21
 * Time: 上午12:31
 */
namespace backend\components\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class Menu extends Widget
{


    public function run()
    {
        $menudata = (new \yii\db\Query())
            ->select('*')
            ->from('{{%menu}}')
            ->where(['is_show' => 1])
            ->orderBy("order asc")
            ->all();
        $node = $this->nodeChild($menudata);
        $list = $this->auth($node);
        $strHtml = '';

        foreach ($list as $val) {
            $val['route'] = (isset($val['route']) && $val['route']) ? $val['route'] : '#';
            $strHtml .= '<li class="treeview"><a id="' . $this->urlFormat(Url::toRoute($val['route'])) . '" href="' . Url::toRoute($val['route']) . '"><i class="' . $val['icon'] . '"></i> <span>' . $val['name'] . '</span> <i class="fa fa-angle-left pull-right"></i></a>';

            if (isset($val['child'])) {
                $strHtml .= '<ul class="treeview-menu">';
                foreach ($val['child'] as $v) {
                    $route = isset($v['route']) ? $v['route'] : '';
                    $strHtml .= '<li><a id="' . $this->urlFormat(Url::toRoute($route)) . '"  href="' . Url::toRoute($route) . '"><i class="' . $v['icon'] . '"></i>' . $v['name'] . '</a></li>';
                }
                $strHtml .= '</ul >';
            }

            $strHtml .= "</li > ";

        }
        return $strHtml;
    }

    //删除没有child列表
    public function auth($list)
    {
        $newlist = [];
        foreach ($list as $v) {
            if (!empty($v['route']) || isset($v['child'])) {
                $newlist[] = $v;
            }
        }
        return $newlist;
    }

    public function nodeChild($data, $pid = '')
    {
        $arr = [];
        foreach ($data as $val) {
            if ($val['parent'] == $pid) {
                $res = ['id' => $val['id'], 'name' => $val['name'], 'route' => $val['route'], 'icon' => $val['icon']];
                foreach ($data as $v) {
                    $res['child'] = $this->nodeChild($data, $val['id']);
                    break;
                }
                if (!$res['child']) {
                    unset($res['child']);
                }
                if (isset($val['route']) && !empty($val['route'])) {
                    //权限判断  超级用户不做判断
                    if (!Yii::$app->user->can($val['route']) && Yii::$app->user->id != 1) {
                        unset($res);
                    } else {
                        $arr[] = $res;
                    }
                } else {
                    $arr[] = $res;
                }
            }
        }
        return $arr;
    }


    //高亮id生成
    public function urlFormat($route)
    {
        if (isset($route)) { // /shop/backend/web/index.php?r=auth-index
            return str_replace('%2F', '-',  preg_replace('/.*\/index.php\?r\=/', '', $route));
        }
        return '';
    }

}