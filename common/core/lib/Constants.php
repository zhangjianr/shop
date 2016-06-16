<?php
/**
 * Created by PhpStorm.
 * User: wuqi
 * Date: 16/6/1
 * Time: 下午4:23
 * @author wuqi
 */


namespace common\core\lib;

use backend\models\Order;

class Constants
{

    public static $audits = ['审核中', '审核通过', '审核未通过', '修改再审核中'];

    //0-未审核  1-审核通过 2-审核未通过 3-修改再审核中
    /** 供应商
     * @param $index
     * @return mixed
     * @author wuqi
     */
    public static function getAudit($index)
    {
        return self::$audits[$index];
    }


    /** 订单状态
     * @return array
     * @author wuqi
     */
    public static function getOrderStatus()
    {
        //0-处理中 1-处理成功 2-处理失败
        return [Order::STATUS_WAIT => "处理中", Order::STATUS_OK => "处理成功", Order::STATUS_FAIL => "处理失败"];
    }


    /**
     * 属性状态
     * 1-时间选择器 2-单行文本  3－单选框  4-复选框  5-下拉框
     */
    private static $attriType = [1 => "时间选择器", 2 => "单行文本", 3 => "单选框", 4 => "复选框", 5 => "下拉框"];

    public static function getAttriType($index = null)
    {
        if ($index === null) {
            return self::$attriType;
        } else {
            return array_key_exists($index, self::$attriType) ? self::$attriType[$index] : '(未设置)';
        }
    }


    /**
     * 商品状态
     *
     * 0-下架  10-上架
     */
    private static $shelves = [0 => '下架', 10 => '上架'];

    public static function getGoodsStatus($index = null)
    {
        if ($index === null) {
            return self::$shelves;
        } else {
            return array_key_exists($index, self::$shelves) ? self::$shelves[$index] : '(未设置)';
        }
    }
}