<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lessons */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Смена пароля';
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'old_pass')->passwordInput(['maxlength' => true, 'value' => ''])->label('Старый пароль') ?>

    <?= $form->field($model, 'new_pass')->passwordInput(['maxlength' => true, 'value' => ''])->label('Новый пароль') ?>

    <?= $form->field($model, 'repeat_pass')->passwordInput(['maxlength' => true, 'value' => ''])->label('Потдверждение пароля') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
