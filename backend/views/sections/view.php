<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Sections */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Разделы', 'url' => ['sections/index', 'courseId' => Yii::$app->request->get('courseId')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sections-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Уроки', ['lessons/index', 'sectionId' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы дуйствительно хотите удалить этот раздел?',
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
        ],
    ]) ?>

</div>
