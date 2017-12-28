<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parcel".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $parcel_status
 * @property integer $price
 * @property integer $parcel_payment_id
 * @property integer $address_id
 * @property string $comment
 *
 * @property Address $address
 * @property User $user
 * @property Transaction $parcelPayment
 * @property Transaction[] $transactions
 */
class Parcel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parcel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'parcel_status', 'price', 'parcel_payment_id', 'address_id', 'comment'], 'required'],
            [['user_id', 'price', 'parcel_payment_id', 'address_id'], 'integer'],
            [['parcel_status'], 'string'],
            [['comment'], 'string', 'max' => 2000],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['parcel_payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['parcel_payment_id' => 'id']],
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
            'parcel_status' => 'Parcel Status',
            'price' => 'Price',
            'parcel_payment_id' => 'Parcel Payment ID',
            'address_id' => 'Address ID',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParcelPayment()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'parcel_payment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['linked_parcel_id' => 'id']);
    }
}
