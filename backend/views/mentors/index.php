<?php

use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'Наставники';
$this->params['breadcrumbs'][] = 'Наставники';
?>
<div class="row">
    <div class="col-xs-12">
        <h3>Список наставников</h3>
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
