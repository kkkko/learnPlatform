<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SectionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Разделы';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['courses/index']];
$this->params['breadcrumbs'][] = ['label' => $this->context->getCourseName(Yii::$app->request->get('courseId')), 'url' => ['courses/view', 'id' => Yii::$app->request->get('courseId')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sections-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить раздел', ['create', 'courseId' => Yii::$app->request->get('courseId')], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model['id'], 'courseId' => Yii::$app->request->get('courseId')], ['title' => 'Просмотр']);
                    },
                    'update' => function ($url,$model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model['id'], 'courseId' => Yii::$app->request->get('courseId')], ['title' => 'Редактировать']);
                    },
                    'delete' => function ($url,$model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model['id'], 'courseId' => Yii::$app->request->get('courseId')], ['title' => 'Удалить']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
