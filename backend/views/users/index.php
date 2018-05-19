<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Ученики';
$this->params['breadcrumbs'][] = 'Ученики';
?>
<div class="row">
    <div class="col-xs-12">
        <h3 style="display: inline; margin-right: 20px;">Список учеников</h3>
        <?= Html::a('Добавить ученика', ['users/create'], ['class' => 'btn btn-primary']) ?>
    </div>
</div>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'format' => 'html',
                'label' => 'Аватар',
                'value' => function ($data) {
                    return Html::img($data->getImage(), ['width' => 100, 'height' => 100]);
                },
            ],
            'email',
            'first_name',
            'sur_name',
            'birth_date',
            'male',
            'about',
            'vk_link',
            'fb_link',
            'phone_number',
            'country',
            'city',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

