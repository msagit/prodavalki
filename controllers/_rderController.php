<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Order;

class OrderController extends Controller
{
    public function actionIndex()
    {
        $query = Order::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('create_date')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'orders' => $countries,
            'pagination' => $pagination,
        ]);
    }
}