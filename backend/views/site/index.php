<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Панель администратора</h2>
    </div>

    <div class="admin-menu">
        <div class="row">
            <div class="col-xs-12 col-lg-2">
                <a href="<?=  Url::to(['users/index']); ?>">Ученики</a>
                <a href="<?=  Url::to(['mentors/index']); ?>">Наставники</a>
            </div>
            <div class="col-xs-12 col-lg-2">
                <a href="<?=  Url::to(['users/create']); ?>">Добавить ученика</a>
                <a href="<?=  Url::to(['mentors/create']); ?>">Добавить наставника</a>
            </div>
            <div class="col-xs-12 col-lg-2">
                <a href="<?=  Url::to(['courses/index']); ?>">Курсы</a>
                <a href="<?=  Url::to(['courses/create']); ?>">Добавить курс</a>
            </div>
        </div>
    </div>
</div>
