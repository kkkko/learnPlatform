<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LessonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Уроки';
$this->params['breadcrumbs'][] = ['label' => 'Раздел', 'url' => ['sections/view', 'id' => Yii::$app->request->get('sectionId') ,'courseId' => Yii::$app->request->get('courseId')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lessons-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать урок', ['create', 'sectionId' => Yii::$app->request->get('sectionId'), 'courseId' => Yii::$app->request->get('courseId')], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
            'content',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model['id'], 'sectionId' => Yii::$app->request->get('sectionId'), 'courseId' => Yii::$app->request->get('courseId')], ['title' => 'Просмотр']);
                    },
                    'update' => function ($url,$model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model['id'], 'sectionId' => Yii::$app->request->get('sectionId'), 'courseId' => Yii::$app->request->get('courseId')], ['title' => 'Редактировать']);
                    },
                    'delete' => function ($url,$model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model['id'], 'sectionId' => Yii::$app->request->get('sectionId'), 'courseId' => Yii::$app->request->get('courseId')], ['title' => 'Удалить']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
