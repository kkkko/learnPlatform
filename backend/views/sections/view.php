<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Sections */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $this->context->getCourseName(Yii::$app->request->get('courseId')), 'url' => ['courses/view', 'id' => Yii::$app->request->get('courseId')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sections-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Уроки', ['lessons/index', 'sectionId' => $model->id, 'courseId' => Yii::$app->request->get('courseId')], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id, 'courseId' => Yii::$app->request->get('courseId')], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id, 'courseId' => Yii::$app->request->get('courseId')], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот раздел?',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
        ],
    ]) ?>

</div>
