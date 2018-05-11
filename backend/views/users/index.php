<?php

use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'Пользователи';
?>
<div class="row">
    <div class="col-xs-12">
        <h3>Список пользователей</h3>
    </div>
</div>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'first_name',
            'sur_name',
            'email',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

