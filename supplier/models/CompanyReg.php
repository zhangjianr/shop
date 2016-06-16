<?php

namespace supplier\models;

use Yii;

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
 * @property string $credit
 * @property string $organization
 * @property string $tax
 * @property string $license
 */
class CompanyReg extends \common\core\supplier\SupplierActiveRecord
{
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
            [['introduct'], 'string'],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['company_name', 'contact_name', 'industry'], 'string', 'max' => 64],
            [['company_tel', 'phone', 'credit', 'organization', 'tax', 'license'], 'string', 'max' => 45],
            [['company_address', 'username', 'password_hash'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['organization_num','tax_num','license_num'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'company_tel' => 'Company Tel',
            'company_address' => 'Company Address',
            'contact_name' => 'Contact Name',
            'phone' => 'Phone',
            'industry' => 'Industry',
            'introduct' => 'Introduct',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'organization' => 'Organization',
            'tax' => 'Tax',
            'license' => 'License',
        ];
    }
}
