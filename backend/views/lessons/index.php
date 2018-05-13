<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LessonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Уроки';
$this->params['breadcrumbs'][] = ['label' => 'Раздел', 'url' => ['sections/view', 'id' => Yii::$app->request->get('sectionId')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lessons-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать урок', ['create','sectionId' => Yii::$app->request->get('sectionId')], ['class' => 'btn btn-success']) ?>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
