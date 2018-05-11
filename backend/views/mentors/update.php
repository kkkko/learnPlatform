<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Изменение данных:' .$model->first_name .' ' .$model->sur_name;
$this->params['breadcrumbs'][] = ['label' => 'Наставники', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->first_name .' ' .$model->sur_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="article-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>