<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Uuid')->textInput() ?>

    <?= $form->field($model, 'Thumbnail')->textInput(['maxlength' => 2083]) ?>

    <?= $form->field($model, 'SmallThumbnail')->textInput(['maxlength' => 2083]) ?>

    <?= $form->field($model, 'Url')->textInput(['maxlength' => 2083]) ?>

    <?= $form->field($model, 'Timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
