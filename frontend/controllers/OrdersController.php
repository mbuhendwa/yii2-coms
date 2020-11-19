<?php

namespace app\controllers;
namespace frontend\controllers;

use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Product;

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
     * 
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
     * Action to confirm order has been received
     */
    public function actionShip($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $model = $this->findModel($id);
        $model->status = Orders::IN_TRANSITION;
        if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Action to confirm order has been received
     */
    public function actionReceive($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $model = $this->findModel($id);
        $model->status = Orders::COMPLETED;
        if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        return $this->render('view', [
            'model' => $model,
        ]);
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
            $model->ship_to = Yii::$app->user->identity['shipping_address'];
            $model->total = $model->subtotal;
            $model->amount_due = $model->total;
            
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
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
    /**
     * Action can be performed only by the user who placed the order
     * and if payment has not started.
     */
    public function actionCancel($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        } 
        $model = $this->findModel($id);
        if ($model->user_id == Yii::$app->user->identity->id && $model->status < Orders::PAYMENT_STARTED){
            $model->status = Orders::CANCELLED;
            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
            else throw new \yii\web\ForbiddenHttpException('Could not cancel the order (Order #'.$model->id.')!');
        }
        else throw new \yii\web\ForbiddenHttpException('You either do not have the rights to cancel this order or this order does not exist');
    }
}
