<?php

use app\models\entities\UsersEntity;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var UsersEntity $model
 * @var ActiveForm $form
 */

?>

<div class="users-entity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord) : ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true]) ?>

    <?php endif; ?>

    <?= $form->field($model, 'is_active')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
