<?php

namespace app\controllers;

use Yii;
use app\models\PlantConfigs;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\Pots;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlantConfigsController implements the CRUD actions for PlantConfigs model.
 */
class PlantConfigsController extends Controller
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
     * Lists all PlantConfigs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PlantConfigs::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlantConfigs model.
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
     * Creates a new PlantConfigs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PlantConfigs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $session = Yii::$app->session;
            $pot_id_from_session = $session->get('selected_pot_id');
            $selected_pot = Pots::findIdentity($pot_id_from_session);
            $selected_pot->plant_config_id=$model->id;
            $selected_pot->save();
            return Yii::$app->getResponse()->redirect('index.php?r=site%2Fpotdata');
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PlantConfigs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /*
        $session = Yii::$app->session;
        $pot_id_from_session = $session->get('selected_pot_id');
        $pot = Pots::findIdentity($pot_id_from_session);
        $model = PlantConfigs::findIdentity($pot->plant_config_id);*/
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return Yii::$app->getResponse()->redirect('index.php?r=site%2Fpotdata');
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PlantConfigs model.
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
     * Finds the PlantConfigs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlantConfigs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlantConfigs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
