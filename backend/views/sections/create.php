<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Sections */

$this->title = 'Добавить раздел';
$this->params['breadcrumbs'][] = ['label' => 'Курс', 'url' => ['courses/view', 'id' => Yii::$app->request->get('courseId')]];
$this->params['breadcrumbs'][] = ['label' => 'Разделы', 'url' => ['sections/index', 'courseId' => Yii::$app->request->get('courseId')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sections-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'courseId' => $courseId
    ]) ?>

</div>
