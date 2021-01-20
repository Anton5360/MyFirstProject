<?php

use app\models\entities\UsersEntity;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var UsersEntity $model
 */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-entity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
