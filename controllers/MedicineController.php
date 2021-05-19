<?php

namespace app\controllers;

use Yii;
use app\models\Medicine;
use app\models\MedicineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Query5;
/**
 * MedicineController implements the CRUD actions for Medicine model.
 */
class MedicineController extends Controller
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
     * Lists all Medicine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedicineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //
    public function actionOused()
    {
        $model = new Medicine;

        $sql = "SELECT medicine.name, COUNT(medicine.name) as 'counter'
        FROM medicine, order_list
        WHERE order_list.medicine_id = medicine.id
        GROUP BY medicine.name
        order BY COUNT(medicine.name) desc
        LIMIT 10;";

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && !empty($model->find_category)){
                $query = Yii::$app->db->createCommand(
                "SELECT medicine.name, COUNT(medicine.name) as 'counter'
                FROM medicine, order_list
                WHERE order_list.medicine_id = medicine.id
                AND medicine.category_id LIKE '$model->find_category'
                GROUP BY medicine.name
                order BY COUNT(medicine.name) desc
                LIMIT 10;")->queryAll();
            } else {
                $query = Yii::$app->db->createCommand($sql)->queryAll();
            }
        } else {
            $query = Yii::$app->db->createCommand($sql)->queryAll();
        }


        return $this->render('oused', [
            'model' => $model,
            'query' => $query,
        ]);
    }

    //Query 6
    public function actionCritical()
    {
        $model = new Medicine;

        $sql = "SELECT medicine.name, type.name AS 'type'
        FROM medicine, type
        WHERE medicine.type_id = type.id
        AND medicine.in_stock <= medicine.critical_norm        
        ";

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && !empty($model->find_type)){
                $query = Yii::$app->db->createCommand($sql . "AND medicine.type_id like '$model->find_type'")->queryAll();
            } else {
                $query = Yii::$app->db->createCommand($sql)->queryAll();
            }
        } else {
            $query = Yii::$app->db->createCommand($sql)->queryAll();
        }


        return $this->render('critical', [
            'model' => $model,
            'query' => $query,
            //'res' => $model->find_type,
        ]);
    }

    //Query 7
    public function actionMinimum()
    {
        $model = new Medicine;

        $sql = "SELECT *
        FROM medicine
        WHERE medicine.in_stock BETWEEN medicine.critical_norm AND (medicine.critical_norm + medicine.critical_norm / 2)
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


        return $this->render('minimum', [
            'model' => $model,
            'query' => $query,
            //'res' => $model->find_type,
        ]);
    }

    //Query 4
    public function actionSubstances()
    {
        $model = new Query5;

        $sql1 = "SELECT component.name, SUM(medicine_list.amount * order_list.amount) AS 'amount'
        FROM sem6.`order`, order_list, medicine, medicine_list, component
        WHERE order.id = order_list.order_id
        AND medicine.id = order_list.medicine_id
        AND medicine.id = medicine_list.medicine_id
        AND component.id = medicine_list.component_id
        ";

        $sql2 = "GROUP BY component.name
        order BY SUM(medicine_list.amount * order_list.amount) desc
        ";

        $query = Yii::$app->db->createCommand($sql1 . $sql2)->queryAll();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->validate() && !empty($model->find_id)){
                $query = Yii::$app->db->createCommand($sql1 . 
                "AND order.order_accep_date BETWEEN '$model->date_start' AND ('$model->date_end' + INTERVAL 1 DAY)
                 AND component.id like '$model->find_id'" . $sql2)->queryAll();
            } else if ($model->load(Yii::$app->request->post()) && $model->validate()){
                $query = Yii::$app->db->createCommand($sql1 . "AND order.order_accep_date BETWEEN '$model->date_start' AND ('$model->date_end' + INTERVAL 1 DAY)" . $sql2)->queryAll();
            } else {
                $query = Yii::$app->db->createCommand($sql1 . $sql2)->queryAll();
            }
        } else {
            $query = Yii::$app->db->createCommand($sql1 . $sql2)->queryAll();
        }
        return $this->render('substances', [
            'model' => $model,
            'query' => $query,
            // 'res' => $model->find_type,
        ]);
    }

    //Query 5
    public function actionOrder()
    {
        $model = new Query5;

        $sql = "SELECT distinct customer.*
        FROM customer, sem6.`order`, medicine, order_list
        WHERE order.customer_id = customer.id
        AND order.id = order_list.order_id
        AND order_list.medicine_id = medicine.id
        ";

        $query = Yii::$app->db->createCommand($sql)->queryAll();

        if (Yii::$app->request->isPost) {
            //&& !empty($model->find_type)
            if ($model->load(Yii::$app->request->post()) && $model->validate() && !empty($model->find_id)){
                $query = Yii::$app->db->createCommand($sql . 
                "AND order.order_accep_date BETWEEN '$model->date_start' AND ('$model->date_end' + INTERVAL 1 DAY)
                 AND medicine.id like '$model->find_id'")->queryAll();
            } else if ($model->load(Yii::$app->request->post()) && $model->validate() && !empty($model->find_type)){
                $query = Yii::$app->db->createCommand($sql . 
                "AND order.order_accep_date BETWEEN '$model->date_start' AND ('$model->date_end' + INTERVAL 1 DAY)
                 AND medicine.type_id like '$model->find_type'")->queryAll();
            } else if ($model->load(Yii::$app->request->post()) && $model->validate()){
                $query = Yii::$app->db->createCommand($sql . "AND order.order_accep_date BETWEEN '$model->date_start' AND ('$model->date_end' + INTERVAL 1 DAY)")->queryAll();
            } else {
                $query = Yii::$app->db->createCommand($sql)->queryAll();
            }
        } else {
            $query = Yii::$app->db->createCommand($sql)->queryAll();
        }


        return $this->render('order', [
            'model' => $model,
            'query' => $query,
            // 'res' => $model->find_type,
        ]);
    }

    //Query 12
    public function actionOften()
    {
        $model = new Medicine;

        $sql1 = "SELECT customer.name, customer.patronymic, customer.surname, customer.age, customer.phone_num, customer.address, COUNT(sem6.`order`.id) AS 'counter'
        FROM customer, sem6.`order`, medicine, order_list
        WHERE customer.id = sem6.`order`.customer_id
        AND order_list.order_id = sem6.`order`.id
        AND order_list.medicine_id = medicine.id
        ";

        $sql2 = "
        GROUP BY customer.name, customer.patronymic, customer.surname, customer.age, customer.phone_num, customer.address
        order BY COUNT(sem6.`order`.id) desc
        LIMIT 5;";

        $query = Yii::$app->db->createCommand($sql1 . $sql2)->queryAll();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && !empty($model->find_id)){
                $query = Yii::$app->db->createCommand($sql1 . "AND medicine.id like '$model->find_id'" . $sql2)->queryAll();
            } else if ($model->load(Yii::$app->request->post()) && !empty($model->find_type)){
                $query = Yii::$app->db->createCommand($sql1 . "AND medicine.type_id like '$model->find_type'" . $sql2)->queryAll();
            } else {
                $query = Yii::$app->db->createCommand($sql1 . $sql2)->queryAll();
            }
        } else {
            $query = Yii::$app->db->createCommand($sql1 . $sql2)->queryAll();
        }


        return $this->render('often', [
            'model' => $model,
            'query' => $query,
            // 'res' => $model->find_type,
        ]);
    }

    //Query 13
    public function actionInfo()
    {
        $model = new Medicine;

        $sql = "SELECT medicine.name, medicine.price, medicine.in_stock, medicine.prod_tech, sem6.`type`.name AS 'type', component.name AS 'c_name', component.price AS 'c_price', component.in_stock AS 'c_stock'
        FROM medicine, medicine_list, sem6.`type`, component
        WHERE medicine.id = medicine_list.medicine_id
        AND medicine_list.component_id = component.id
        AND medicine.type_id = type.id
        ";

        $query = Yii::$app->db->createCommand($sql)->queryAll();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && !empty($model->find_id)){
                $query = Yii::$app->db->createCommand($sql . "AND medicine.id like '$model->find_id'")->queryAll();
            } else {
                $query = Yii::$app->db->createCommand($sql . "AND medicine.id like '1'")->queryAll();
            }
        } else {
            $query = Yii::$app->db->createCommand($sql . "AND medicine.id like '1'")->queryAll();
        }


        return $this->render('info', [
            'model' => $model,
            'query' => $query,
            // 'res' => $model->find_type,
        ]);
    }


    //Query 10
    public function actionProduction()
    {
        $model = new Medicine;

        $sql = "SELECT distinct medicine.name, medicine.prod_tech
        FROM medicine, sem6.`order`, order_list
        WHERE medicine.id = order_list.medicine_id
        AND order.id = order_list.order_id
        AND order.status_id = 3
        ";

        $query = Yii::$app->db->createCommand($sql)->queryAll();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && !empty($model->find_id)){
                $query = Yii::$app->db->createCommand($sql . "AND medicine.id like '$model->find_id'")->queryAll();
            } else if ($model->load(Yii::$app->request->post()) && !empty($model->find_type)){
                $query = Yii::$app->db->createCommand($sql . "AND medicine.type_id like '$model->find_type'")->queryAll();
            } else {
                $query = Yii::$app->db->createCommand($sql)->queryAll();
            }
        } else {
            $query = Yii::$app->db->createCommand($sql)->queryAll();
        }


        return $this->render('production', [
            'model' => $model,
            'query' => $query,
            // 'res' => $model->find_type,
        ]);
    }

    //Query 11
    public function actionComponent()
    {
        $model = new Medicine;

        $sql = "SELECT medicine.name, medicine.price, component.name AS 'c_name', component.price AS 'c_price', medicine_list.amount
        FROM medicine, medicine_list, component
        WHERE medicine.id = medicine_list.medicine_id
        AND medicine_list.component_id = component.id
        ";

        $query = Yii::$app->db->createCommand($sql)->queryAll();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && !empty($model->find_id)){
                $query = Yii::$app->db->createCommand($sql . "AND medicine.id like '$model->find_id'")->queryAll();
            } else {
                $query = Yii::$app->db->createCommand($sql . "AND medicine.id like '1'")->queryAll();
            }
        } else {
            $query = Yii::$app->db->createCommand($sql . "AND medicine.id like '1'")->queryAll();
        }


        return $this->render('component', [
            'model' => $model,
            'query' => $query,
            // 'res' => $model->find_type,
        ]);
    }

    /**
     * Displays a single Medicine model.
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
     * Creates a new Medicine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Medicine();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Medicine model.
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
     * Deletes an existing Medicine model.
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
     * Finds the Medicine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Medicine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Medicine::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
