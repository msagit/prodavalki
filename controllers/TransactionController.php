<?php

namespace app\controllers;

use Yii;
use app\models\Transaction;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionManage()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Transaction::find()->andWhere(['=','status',Transaction::STATUS_DRAFT])->andWhere(['=','purpose_type',Transaction::PURPOSE_TYPE_TOPUP])->orderBy(['id'=>SORT_DESC]),
        ]);

        return $this->render('manage', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Transaction::find()->andwhere(['=','user_id',Yii::$app->user->id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transaction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTopup($account_id=0)
    {
        $model = new Transaction();
        /*if (Yii::$app->user->isClient()) {
           $model->user_id=Yii::$app->user->id; 
           $model->account_id=Yii::$app->user->getAccountId(); 
	} else {
           //$model->user_id=Yii::$app->user->getAccountId(); 
           $model->account_id=$account_id; 
	}
            yii::$app->session->setFlash('error',  'Account : '.$model->account_id);
            return $this->redirect(yii::$app->request->referrer);
        */
        if ($model->load(Yii::$app->request->post()) && $model->registertopup()) {	
               return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('topup', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Approve a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        if ($model->status==Transaction::STATUS_DRAFT) {
        if ($model->load(Yii::$app->request->post()) && $model->approve()) {	
               //return $this->redirect(['view', 'id' => $model->id]);
               yii::$app->session->setFlash('success',  'Transation #'.$model->id.' approved');
               return $this->redirect(['transaction/manage']);//$this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('approve', [
                'model' => $model,
            ]);
        }
	}else {
            yii::$app->session->setFlash('error',  'Transation is not new. Current status is: '.$model->status);
            return $this->redirect(yii::$app->request->referrer);
	}
	
    }

    /**
     * Approve a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionReject($id)
    {
        $model = $this->findModel($id);
        if ($model->status==Transaction::STATUS_DRAFT) {
        if ($model->load(Yii::$app->request->post()) && $model->reject()) {	
               yii::$app->session->setFlash('success',  'Transation #'.$model->id.' rejected');
               return $this->redirect(['transaction/manage']);//$this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('reject', [
                'model' => $model,
            ]);
        }
	}else {
            yii::$app->session->setFlash('error',  'Transation is not new. Current status is: '.$model->status);
            return $this->redirect(yii::$app->request->referrer);
	}
	
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
