<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Наставники';
$this->params['breadcrumbs'][] = 'Наставники';
?>
<div class="row">
    <div class="col-xs-12">
        <h3 style="display: inline; margin-right: 20px;">Список наставников</h3>
        <?= Html::a('Добавить наставника', ['mentors/create'], ['class' => 'btn btn-primary']) ?>
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
