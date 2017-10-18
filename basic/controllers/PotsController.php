<?php

namespace app\controllers;

use Yii;
use app\models\Pots;
use app\models\Command;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\QueryBuilder;
use yii\db\Query;
use app\models\PiPot;

/**
 * PotsController implements the CRUD actions for Pots model.
 */
class PotsController extends Controller
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
     * Lists all Pots models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pots::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pots model.
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
     * Creates a new Pots model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pots();

        if ($model->load(Yii::$app->request->post())) {
            if(!is_null(Pots::findIdentity($model->id))){
                        return $this->render('/site/customError', ['errorMessage' => "Failed to create pot! Pot already exist!"]);
            } else {
                if($model->save()){
                    $session = Yii::$app->session;
                    $piId = $session->get('pi_id');

                    $piPot = new PiPot();
                    $piPot->pi_id = $piId;
                    $piPot->pot_id = $model->id;
                    if($piPot->save()){
                        $plant_config_command = new Command();
                        $plant_config_command->pot_id = 1;
                        $plant_config_command->task = 'P_ADDED';
                        $plant_config_command->parameter = $model->id;
                        $plant_config_command->deleted = 0;
                        $plant_config_command->save(false);
                        return Yii::$app->getResponse()->redirect('index.php');
                    } else {
                        return $this->render('/site/customError', ['errorMessage' => "Failed to create pot! Did you give valid parameters?"]);
                    }
                    //return $this->redirect(['index']);
                } else {
                        return $this->render('/site/customError', ['errorMessage' => "Failed to create pot! Database error! Did you give valid parameters?"]);
                }
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pots model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $session = Yii::$app->session;
            $potId = $session->get('selected_pot_id');
            
            $plant_config_command = new Command();
            $plant_config_command->pot_id = $model->id;
            $plant_config_command->task = 'C_CHNG';
            $plant_config_command->parameter = $model->plant_config_id;
            $plant_config_command->deleted = 0;
            $plant_config_command->save(false);
            return $this->render('/site/potdata', ['potId' => $potId]);
            //return Yii::$app->getResponse()->redirect('index.php?r=site%2Fpotdata');
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pots model.
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
     * Finds the Pots model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pots the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pots::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
