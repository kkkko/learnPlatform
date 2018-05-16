<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Lessons */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['index', 'sectionId' => Yii::$app->request->get('sectionId')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lessons-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id, 'sectionId' => Yii::$app->request->get('sectionId')], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данный урок?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            'content',
        ],
    ]) ?>

</div>
