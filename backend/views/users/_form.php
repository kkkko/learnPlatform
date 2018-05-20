<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\Lessons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::img($model->getImage(), ['width' => 100, 'height' => 100]); ?>

    <?= Html::a('Изменить аватар', ['set-avatar', 'id' => $model->id], ['class' => 'btn btn-default']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sur_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birth_date')->widget(MaskedInput::className(), [
        'name' => 'User[birth_date]',
        'attribute' => 'User[birth_date]',
        'clientOptions' => ['alias' => 'dd.mm.yyyy']
    ]) ?>

    <?= $form->field($model, 'male')->dropDownList(['Муж.' => 'Муж.', 'Жен.' => 'Жен.']) ?>

    <?= $form->field($model, 'about')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'vk_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fb_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
