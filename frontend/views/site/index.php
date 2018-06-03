<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Личный кабинет';
?>
<div class="lessons-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
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

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['account/update', 'id' => $model['id']], ['title' => 'Просмотр']);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
