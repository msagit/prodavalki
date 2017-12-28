<?php

namespace app\models;

use Yii;
use yii\base\Model;

class OrderForm extends Model
{
    public $url;
    public $amount;
    public $comment;

    public function rules()
    {
        return [
            [['url', 'amount'], 'required'],
            ['url', 'url', 'defaultScheme' => 'http'],
            ['amount', 'number'],
            ['comment', 'trim'],
            ['comment', 'string', 'length'=>[0,250]],
        ];
    }
}