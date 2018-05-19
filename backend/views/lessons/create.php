<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Lessons */

$this->title = 'Добавить урок';
$this->params['breadcrumbs'][] = ['label' => 'Курс', 'url' => ['courses/view', 'id' => Yii::$app->request->get('courseId')]];
$this->params['breadcrumbs'][] = ['label' => 'Разделы', 'url' => ['sections/index', 'courseId' => Yii::$app->request->get('courseId')]];
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['index', 'courseId' => Yii::$app->request->get('courseId'), 'sectionId' => Yii::$app->request->get('sectionId')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lessons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
