<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Lessons */

$this->title = 'Изменить урок: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['index', 'sectionId' => Yii::$app->request->get('sectionId')]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id, 'sectionId' => Yii::$app->request->get('sectionId')]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="lessons-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
