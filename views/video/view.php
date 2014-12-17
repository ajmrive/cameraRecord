<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Video */

$this->title = $model->Uuid;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('//cameratag.com/api/v4/js/cameratag.js');
?>
<div class="video-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <!--<script src='//cameratag.com/api/v4/js/cameratag.js' type='text/javascript'></script>-->
    <video id='<?= Yii::$app->params['CAMERA_ID_1_CAMERATAG'] ?>' data-uuid='<?= $model->Uuid ?>'></video>
    <br>
    
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'Uuid',
            'Thumbnail',
            'SmallThumbnail',
            'Url:url',
            'Timestamp',
        ],
    ]) ?>

</div>
