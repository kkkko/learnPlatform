<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Courses */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Разделы', ['sections/index', 'courseId' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Изменить наставника', ['set-mentor', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы дейтсвительно хотите удалить данный курс?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            [
                'label' => 'Наставник',
                'value' => function ($data) {
                    if ($data->mentor) {
                        return $data->mentor->first_name . ' ' . $data->mentor->sur_name;
                    } else {
                        return 'Не назначен';
                    }
                }
            ]
        ],
    ]) ?>

</div>
