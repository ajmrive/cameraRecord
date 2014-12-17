<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Video */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('//cameratag.com/api/v4/js/cameratag.js');

$this->registerJs("
  var j_noConflict = jQuery.noConflict();
  j_noConflict(document).ready(function () {
  
    CameraTag.observe('cameraRecordForm', 'published', function() {
      var myCamera = CameraTag.cameras['cameraRecordForm'];
      var myVideo2 = myCamera.getVideo();
      console.log(myVideo);
      var myVideo = JSON.parse(JSON.stringify(myVideo2));
      var uuid = myVideo.uuid;
      console.log(uuid);
      j_noConflict('#id-video').val(myVideo.uuid);
      
      var created_at = myVideo.created_at;
      console.log(myVideo.created_at);
      j_noConflict('#timestamp-video').val(myVideo.created_at);
      
//
//      var formats = JSON.parse(JSON.stringify(myVideo.formats.qvga.thumbnail_url));
//      console.log(formats);
//
//      var thumbnail_url = formats['thumbnail_url'];
//      console.log(thumbnail_url);
//      
//      var small_thumbnail_url = myVideo.formats.qvga.small_thumbnail_url;
//      console.log(small_thumbnail_url);
//      
//      var video_url = formats.video_url;
//      console.log(myVideo.video_url);
//      
//
//
//
//      j_noConflict('#thumbnail-video').val(myVideo.formats.thumbnail_url);
//      j_noConflict('#smallThumbnail-video').val(myVideo.formats.small_thumbnail_url);
//      j_noConflict('#url-video').val(myVideo.formats.video_url);      

      j_noConflict('#save-video').click();
    
  }); 

});

");
?>


<!--<script src='//cameratag.com/api/v4/js/cameratag.js' type='text/javascript'></script>-->
<camera id='<?= Yii::$app->params['CAMERA_ID_1_CAMERATAG'] ?>' data-app-id='<?= Yii::$app->params['APP_UID_CAMERATAG'] ?>'></camera>


<div class="video-form" style="display:none;">

<?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'Uuid')->textInput(['id' => 'id-video','required' => 'required']) ?>

  <?= $form->field($model, 'Thumbnail')->textInput(['id' => 'thumbnail-video', 'maxlength' => 2083]) ?>

  <?= $form->field($model, 'SmallThumbnail')->textInput(['id' => 'smallThumbnail-video', 'maxlength' => 2083]) ?>

  <?= $form->field($model, 'Url')->textInput(['id' => 'url-video', 'maxlength' => 2083]) ?>

  <?= $form->field($model, 'Timestamp')->textInput(['id' => 'timestamp-video']) ?>

  <div class="form-group">
  <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['id' => 'save-video', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>
