<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Страница ученика';
$this->params['breadcrumbs'][] = ['label' => 'Ученики', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->first_name . ' ' . $model->sur_name, 'url' => ['view', 'id' => $model->id]];
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'sur_name',
            'birth_date',
            'male',
            'country',
            'city',
            'email',
            'phone_number',
            'vk_link',
            'fb_link',
            'about'

        ],
    ]) ?>

</div>
