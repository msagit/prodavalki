<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $account_id
 * @property string $type
 * @property string $purpose_type
 * @property number $amount
 * @property string $status
 * @property string $last_updated
 * @property string $created_time
 * @property string $status_time
 * @property integer $linked_order_id
 * @property integer $linked_parcel_id
 * @property string $comment
 *
 * @property Order[] $orders
 * @property Order[] $orders0
 * @property Parcel[] $parcels
 * @property Parcel $linkedParcel
 * @property Account $account
 * @property Order $linkedOrder
 */
class Transaction extends \yii\db\ActiveRecord
{
    const STATUS_APPROVED = 'approved';
    const STATUS_DRAFT = 'draft';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CANCELED = 'canceled';

    const TYPE_CREDIT = 'credit';
    const TYPE_DEBIT = 'debit';

    const PURPOSE_TYPE_TOPUP = 'topup';
    const PURPOSE_TYPE_RETURN = 'return';
    const PURPOSE_TYPE_ORDER = 'order';
    const PURPOSE_TYPE_DELIVERY = 'delivery';
    const PURPOSE_TYPE_PARCEL = 'parcel';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'purpose_type', 'amount'], 'required'],
            [['account_id', 'linked_order_id', 'linked_parcel_id'], 'integer'],
            [['amount'], 'number'],
            [['type', 'purpose_type', 'status'], 'string'],
            [['last_updated', 'created_at', 'updated_at', 'status_time'], 'safe'],
            [['comment'], 'string', 'max' => 2000],
            [['admin_comment'], 'string', 'max' => 2000],
            [['linked_parcel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parcel::className(), 'targetAttribute' => ['linked_parcel_id' => 'id']],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['linked_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['linked_order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_id' => 'Account ID',
            'type' => 'Type',
            'purpose_type' => 'Purpose Type',
            'amount' => 'Amount',
            'status' => 'Status',
            'last_updated' => 'Last Updated',
            'created_at' => 'Created Time',
            'updated_at' => 'Updated Time',
            'status_time' => 'Status Time',
            'linked_order_id' => 'Linked Order ID',
            'linked_parcel_id' => 'Linked Parcel ID',
            'comment' => 'Comment',
            'admin_comment' => 'Admin Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['delivery_payment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(Order::className(), ['payment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParcels()
    {
        return $this->hasMany(Parcel::className(), ['parcel_payment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkedParcel()
    {
        return $this->hasOne(Parcel::className(), ['id' => 'linked_parcel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkedOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'linked_order_id']);
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function registerTopup()
    {
        $this->user_id=Yii::$app->user->id;
        $this->account_id=Account::findOne(['user_id'=>$this->user_id])->id;
	$this->type=self::TYPE_DEBIT;
        $this->purpose_type=self::PURPOSE_TYPE_TOPUP;
	$this->status=self::STATUS_DRAFT;
	$this->save();
        return $this->id;
    }

    public function registerReturn()
    {
        $this->user_id=Yii::$app->user->id;
        $this->account_id=Account::findOne(['user_id'=>$this->user_id])->id;
	$this->type=self::TYPE_CREDIT;
        $this->purpose_type=self::PURPOSE_TYPE_RETURN;
	$this->status=self::STATUS_DRAFT;
	$this->save();
        return $this->id;
    }

    public function approve()
    {
        //$this->user_id=Yii::$app->user->id;
        //$this->account_id=1;
	//$this->type=self::TYPE_DEBIT;
        //$this->purpose_type=self::PURPOSE_TYPE_TOPUP;
	$this->status=self::STATUS_APPROVED;
	$this->save();
        //$account = Account::findOne($this->account_id);
	$account = $this->getAccount()->one();
        $account->registerTransaction($this->id,$this->amount);
	//$this->getAccount()->registerTransaction($this->id,$this->amount);
        return $this->id;
    }

    public function reject()
    {
	$this->status=self::STATUS_REJECTED;
	//$account = $this->getAccount()->one();
        //$account->registerTransaction($this->id,$this->amount);
	//$this->getAccount()->registerTransaction($this->id,$this->amount);
        return $this->save();
    }

    public function cancel()
    {
	$this->status=self::STATUS_CANCELED;
        return $this->save();
    }

    public function getClientName()
    {
        return $this->getAccount()->one()->getClientname();
    }
}
