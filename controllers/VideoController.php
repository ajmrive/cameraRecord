<?php

namespace app\controllers;

use Yii;
use app\models\Video;
use app\models\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use linslin\yii2\curl;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller
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
        ];
    }

    /**
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Video model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Video model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Video();

        if ($model->load(Yii::$app->request->post())){ 
            
            self::videoDataIncomplete($model);  
        
            if ($model->save()){
              return $this->redirect(['view', 'id' => $model->Id]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Video model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {      
        $model = $this->findModel($id); 
        
        if ($model->load(Yii::$app->request->post())){ 
            
            self::videoDataIncomplete($model);   
        
            if ($model->save()){
              return $this->redirect(['view', 'id' => $model->Id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Video model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
      
        //Init curl
        $curl = new curl\Curl();
        $curl->delete('http://cameratag.com/api/v4/videos/'.$model->Uuid.'.json?api_key='.Yii::$app->params['REST_API_KEY_CAMERATAG']);
      
        $this->findModel($id)->delete();
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
   /**
     * 
     * @param type $model
     * @return type
     */
    protected static function loadVideoExternalData($model){
        //Init curl
        $curl = new curl\Curl();

        //get http://example.com/
        $response = $curl->get(
           'http://cameratag.com/api/v4/videos/'.$model->Uuid.'.json?api_key='.Yii::$app->params['REST_API_KEY_CAMERATAG']
        );

        return json_decode($response);
    }
    
    /**
     * 
     * @param type $model
     */
    protected  static function videoDataIncomplete(&$model){
       
      if ((!empty($model->Uuid)) && (empty($model->SmallThumbnail) || empty($model->Thumbnail) || empty($model->Url))){

        $response = self::loadVideoExternalData($model);

        var_dump($response->formats[0]);
        
        if (isset($response->formats[0])){
          $model->Thumbnail = $response->formats[0]->thumbnail_url;
          $model->SmallThumbnail = $response->formats[0]->small_thumbnail_url;
          $model->Url = $response->formats[0]->video_url;
        }
        elseif(isset($response->formats)){
          $model->Thumbnail = $response->formats[0]->thumbnail_url;
          $model->SmallThumbnail = $response->formats[0]->small_thumbnail_url;
          $model->Url = $response->formats[0]->video_url;
        }
        
        
              
      }  
    }
}
