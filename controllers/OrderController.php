<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\db\Query;
use yii\data\Pagination;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStatus()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('status', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWaiting()
    {
        $model = new Order();
        $sql = "SELECT DISTINCT customer.*
        FROM sem6.`order`, medicine, order_list, customer, sem6.`status`, category
        WHERE order.id = order_list.order_id
        AND order.customer_id = customer.id
        AND order_list.medicine_id = medicine.id
        AND order.status_id = 2
        ";

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && !empty($model->find_category)){
                $query = Yii::$app->db->createCommand($sql . "AND medicine.category_id like '$model->find_category'")->queryAll();
            } else {
                $query = Yii::$app->db->createCommand($sql)->queryAll();
            }
        } else {
            $query = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $this->render('waiting', [
            'query' => $query,
            'model' => $model,
        ]);
    }

    //Query 9
    public function actionPorder()
    {
        $model = new Order;

        $sql = "SELECT distinct medicine.*
        FROM sem6.`order`, medicine, order_list
        WHERE order_list.order_id = order.id
        AND order_list.medicine_id = medicine.id
        ";

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && !empty($model->find_status)){
                $query = Yii::$app->db->createCommand($sql . "AND order.status_id like '$model->find_status'")->queryAll();
            } else {
                $query = Yii::$app->db->createCommand($sql)->queryAll();
            }
        } else {
            $query = Yii::$app->db->createCommand($sql)->queryAll();
        }


        return $this->render('porder', [
            'model' => $model,
            'query' => $query,
            'res' => $model->find_status,
        ]);
    }

    
    public function actionProduction()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('production', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
