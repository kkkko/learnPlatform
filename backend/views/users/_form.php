<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Lessons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::img($model->getImage(), ['width' => 100, 'height' => 100]); ?>

    <?= $form->field($model, 'avatar')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sur_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birth_date')->widget(DatePicker::classname(), [
        'name' => 'User[birth_date]',
        'value' => date('d-m-Y'),
        'language' => 'ru',
        'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'startDate' => '-120y',
            'endDate' => '-10y'
        ],
        'options' => [
            'placeholder' => ''
        ]
    ]);
    ?>

    <?= $form->field($model, 'male')->dropDownList(['Муж.' => 'Муж.', 'Жен.' => 'Жен.']) ?>

    <?= $form->field($model, 'about')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'vk_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fb_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->widget(MaskedInput::className(), [
        'name' => 'User[phone_number]',
        'attribute' => 'User[phone_number]',
        'clientOptions' => ['alias' => '+9 999 999 99 99']
    ]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
