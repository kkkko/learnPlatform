<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Courses */

$this->title = 'Добавить курс';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'mentors' => $mentors,
        'selectedMentor' => $selectedMentor
    ]) ?>

</div>
