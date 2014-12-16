<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Video */
/* @var $form yii\widgets\ActiveForm */

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
      

      var formats = JSON.parse(JSON.stringify(myVideo.formats.qvga));
      console.log(formats);

      var thumbnail_url = JSON.parse(JSON.stringify(formats.thumbnail_url));
      console.log(thumbnail_url);
      
      var small_thumbnail_url = myVideo.formats.qvga.small_thumbnail_url;
      console.log(small_thumbnail_url);
      
      var video_url = formats.video_url;
      console.log(myVideo.video_url);
      



      j_noConflict('#thumbnail-video').val(myVideo.formats.thumbnail_url);
      j_noConflict('#smallThumbnail-video').val(myVideo.formats.small_thumbnail_url);
      j_noConflict('#url-video').val(myVideo.formats.video_url);      

      //j_noConflict('#save-video').click();
    
  }); 

});

");
?>


<script src='//cameratag.com/api/v4/js/cameratag.js' type='text/javascript'></script>
<camera id='cameraRecordForm' data-app-id='a-4ff84af0-66c9-0132-142f-22000a8c0328'></camera>


<div class="video-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'Uuid')->textInput(['id' => 'id-video']) ?>

  <?= $form->field($model, 'Thumbnail')->textInput(['id' => 'thumbnail-video', 'maxlength' => 2083]) ?>

  <?= $form->field($model, 'SmallThumbnail')->textInput(['id' => 'smallThumbnail-video', 'maxlength' => 2083]) ?>

  <?= $form->field($model, 'Url')->textInput(['id' => 'url-video', 'maxlength' => 2083]) ?>

  <?= $form->field($model, 'Timestamp')->textInput(['id' => 'timestamp-video']) ?>

  <div class="form-group">
  <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['id' => 'save-video', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>
