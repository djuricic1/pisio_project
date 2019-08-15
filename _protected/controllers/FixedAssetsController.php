<?php

namespace app\controllers;

use Yii;
use app\models\FixedAssets;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Transfer;


/**
 * FixedAssetsController implements the CRUD actions for FixedAssets model.
 */
class FixedAssetsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'actions' => ['index'],
					],
					[
						'allow' => true,
						'actions' => ['view', 'pdf'],
						'roles' => ['@']
					],
					[
						'allow' => true,
						'actions' => ['create', 'save-as-new', 'update', 'delete', 'add-fixed-assets' ],
						'roles' => ['employee']
					],					
					[
						'allow' => false
					]
					
				]
			]
        ];
    }

    /**
     * Lists all FixedAssets models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FixedAssets::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FixedAssets model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerTransfer = new \yii\data\ArrayDataProvider([
            'allModels' => $model->transfers,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerTransfer' => $providerTransfer,
        ]);
    }

    /**
     * Creates a new FixedAssets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FixedAssets();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FixedAssets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $personIdFrom = 0;
        $roomIdFrom = 0;

        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new FixedAssets();
        }else{
            $model = $this->findModel($id);
            $personIdFrom = $model->person_id;
            $roomIdFrom = $model->room_id;
        }

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            if (Yii::$app->request->post('_asnew') != '1') {
                $this->createTransfer($model, $personIdFrom, $roomIdFrom);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
		
    
    }

    private function createTransfer($model, $personIdFrom, $roomIdFrom) 
    {
        if($personIdFrom == $model->person_id && $roomIdFrom == $model->room_id)
            return;
        
        $transfer = new Transfer();
        $transfer->dateCreated = date('Y-m-d');
        $transfer->fixed_assets_id = $model->id;
        $transfer->personIdFrom = $personIdFrom;
        $transfer->roomIdFrom = $roomIdFrom;
        $transfer->personIdTo = $model->person_id;
        $transfer->roomIdTo = $model->room_id;
        
        $transfer->save();

    }



    /**
     * Deletes an existing FixedAssets model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * Export FixedAssets information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerTransfer = new \yii\data\ArrayDataProvider([
            'allModels' => $model->transfers,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerTransfer' => $providerTransfer,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
    * Creates a new FixedAssets model by another data,
    * so user don't need to input all field from scratch.
    * If creation is successful, the browser will be redirected to the 'view' page.
    *
    * @param mixed $id
    * @return mixed
    */
    public function actionSaveAsNew($id) {
        $model = new FixedAssets();

        if (Yii::$app->request->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }
    
        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Finds the FixedAssets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FixedAssets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FixedAssets::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Transfer
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddTransfer()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Transfer');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formTransfer', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
