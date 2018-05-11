<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Панель администратора</h2>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-xs-12 col-lg-2">
                <a href="<?=  Url::to(['users/index']); ?>">Список пользователей</a>
                <a href="<?=  Url::to(['mentors/index']); ?>">Список наставников</a>
            </div>
            <div class="col-xs-12 col-lg-2">
                <a href="<?=  Url::to(['users/create']); ?>">Добавить пользователя</a>
                <a href="<?=  Url::to(['mentors/create']); ?>">Добавить наставника</a>
            </div>
        </div>
    </div>
</div>
