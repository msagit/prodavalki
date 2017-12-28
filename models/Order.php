<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $create_date
 * @property string $item_url
 * @property integer $amount
 * @property string $comment
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_url', 'amount'], 'required'],
            [['user_id', 'amount'], 'integer'],
            [['create_date'], 'safe'],
            ['item_url', 'url', 'defaultScheme' => 'http'],
            [['comment'], 'string', 'length' => [0,250]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'create_date' => 'Create Date',
            'item_url' => 'Item Url',
            'amount' => 'Amount',
            'comment' => 'Comment',
        ];
    }

    public function beforeSave($insert)
    {
        //if(empty($this->create_date)) {
        //    $this->create_date =date('Y-m-d H:i:s');// time();
        //}
        //if(empty($this->user_id)) {
        //    $this->user_id =1;
        //}
        
        
        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    public function getClientName()
    {
        return $this->getAccount()->one()->getClientname();
    }
}
