<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%special}}".
 *
 * @property integer $id
 * @property string $titile
 * @property string $content
 * @property integer $starttime
 * @property integer $endtime
 * @property integer $image_id
 * @property integer $is_del
 * @property integer $is_open
 * @property integer $created_at
 * @property integer $updated_at
 */
class Special extends \common\core\backend\BackendActiveRecord
{

    const DELETE_TRUE = 10;
    const DELETE_FALSE = 0;

    const OPEN_TRUE = 10;
    const OPEN_FALSE = 0;

    public $status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%special}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['starttime', 'endtime', 'title'], 'required'],
            [['content'], 'string'],
            [['image_id', 'is_del', 'is_open', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 64],
            ['status', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '名称',
            'content' => '内容',
            'starttime' => '开始时间',
            'endtime' => '结束时间',
            'image_id' => '图片',
            'is_del' => 'Is Del',
            'is_open' => 'Is Open',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['id' => 'gid'])
            ->viaTable('{{%special_goods}}', ['sid' => 'id']);
    }

    /** 获取专题状态
     * @param $starttime
     * @param $endtime
     * @return string
     * @author wuqi
     */
    public function getStatus($starttime, $endtime)
    {
        $now = time();
        return $starttime > $now ? '未开始' : ($endtime < $now ? '已结束' : '展示中');
    }


    public function getRelationGoodsData()
    {
        $id = Yii::$app->request->get('id');
        if($id && !$this->isNewRecord){
            $query = Goods::find()->joinWith('special');
            $query->andWhere([self::tableName() . '.id' => $id, ]);
            $query->andWhere(['{{%goods}}.is_del' => Goods::DELETE_FALSE]);
            $dataProvider = new ActiveDataProvider(['query' => $query]);
            return $dataProvider;
        }
    }
}
