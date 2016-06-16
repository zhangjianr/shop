<?php

namespace backend\models;

use Yii;
use common\core\backend\BackendActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%company_reg}}".
 *
 * @property integer $id
 * @property string $company_name
 * @property string $company_tel
 * @property string $company_address
 * @property string $contact_name
 * @property string $phone
 * @property string $industry
 * @property string $introduct
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property string $organization
 * @property string $tax
 * @property string $license
 */
class CompanyReg extends BackendActiveRecord

{
    //0-未审核  1-审核通过 2-审核未通过 3-修改再审核中
    const AUDIT_FALSE = 0;
    const AUDIT_TRUE = 1;
    const AUDIT_NOPASS = 2;
    const AUDIT_AGAIN = 3;


    const DELETE_TRUE = 10;
    const DELETE_FALSE = 0;

    const LOCK_TRUE = 10;
    const LOCK_FALSE = 0;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company_reg}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deny_info'], 'required', 'on'=>'deny'],
            [['introduct'], 'string'],
            [['created_at', 'updated_at', 'login_at', 'status'], 'integer'],
            [['company_name', 'contact_name', 'industry'], 'string', 'max' => 64],
            [['company_tel', 'phone'], 'string', 'max' => 45],
            [['company_address', 'username', 'password_hash', 'deny_info'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            ['status', 'safe'],
        ];
    }


    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['deny'] = ['deny_info'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => '公司名',
            'company_tel' => '联系电话',
            'company_address' => '办公地址',
            'contact_name' => '联系人',
            'phone' => '手机号',
            'industry' => '所属行业',
            'introduct' => '业务介绍',
            'username' => '账号',
            'password_hash' => '密码',
            'organization' => '组织机构照片',
            'tax' => '税务登记号照片',
            'license' => '营业执照照片',
            'organization_num' => '组织机构代码',
            'tax_num' => '税务登记号',
            'license_num' => '营业执照',
            'auth_key' => 'Auth Key',
            'created_at' => '申请时间',
            'pass_at' => '通过时间',
            'updated_at' => '更新时间',
            'login_at' => '最后登录时间',
            'status' => '状态',
            'deny_info' => '拒绝原因',
        ];
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }



    public function getFeedback()
    {
        return $this->hasMany(Feedback::className(), ['uid' => 'id']);
    }
}
