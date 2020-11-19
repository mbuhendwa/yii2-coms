<?php

namespace app\controllers;
namespace backend\controllers;

use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

use app\models\Product;
use common\models\User;
use mPDF;
use kartik\mpdf\Pdf;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays an order delivery note 
     * */
    public function actionNote($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        return $this->renderAjax('delivery_note', [
            'model' => $this->findModel($id),
        ]);
    }

    /** Displays a single orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionGenPdf($id)
    {
        return $this->renderPartial('view_pdf', [
            'model' => $this->findModel($id),
            
        ]);
            $mpdf= new \mPDF();
            $mpdf-> WriteHTML($pdf_content);
            $mpdf -> output();
            exit;
        }
    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $model = new Orders();

        if ($model->load(Yii::$app->request->post())){
            $model->subtotal = Product::findOne($model->product_id)->price * $model->quantity;
            $model->total = $model->subtotal;
            $model->amount_due = $model->subtotal;
            $model->ship_to = User::findOne($model->user_id)->shipping_address;

            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save() && $model->status){
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * makes a payment
     * */
    public static function pay($amount, $to)
    {
        $model = Orders::findOne($to);
        $model->amount_due = $model->amount_due - $amount;
        if($model->amount_due == 0) $model->status = Orders::IN_TRANSITION;
        else $model->status = Orders::PAYMENT_STARTED;
        $model->save();
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionAjax()
    {
        return Json::encode(ArrayHelper::map(Orders::findAll(['user_id' => Yii::$app->request->post('userid')]), 'id', 'amount_due'));
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
