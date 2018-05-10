<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Панель администратора</h1>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-xs-12 col-lg-2">
                <a href="<?=  Url::to(['users/create']); ?>">Добавить пользователя</a>
                <a href="<?=  Url::to(['mentors/create']); ?>">Добавить наставника</a>
            </div>
        </div>
    </div>
</div>
