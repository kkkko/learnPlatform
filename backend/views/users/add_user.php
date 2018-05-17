<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Добавить ученика';
?>
<div class="site-index">
    <? $form = ActiveForm::begin([
        'id' => 'create-user-form',
        'options' => ['class' => 'form-horizontal'],
    ]) ?>
    <?= $form->field($model, 'first_name')->label('Имя') ?>
    <?= $form->field($model, 'sur_name')->label('Фамилия') ?>
    <?= $form->field($model, 'email')->label('Email') ?>

    <div class="form-group">
        <div class="col-xs-12" style="padding: 0;">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>
