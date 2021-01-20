<?php

use app\models\forms\RegistrationForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

/**
 * @var RegistrationForm $model
 * @var View $this
 */
?>

<h1 class="text-center"><?= $this->title ?></h1>

<?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['class' => 'form-login']]) ?>
    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'login')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'repeatPassword')->passwordInput() ?>
    <?= Html::submitButton('Registration', ['class' => 'btn btn-success']) ?>
    <span> or </span>
    <?= Html::a('Login', ['login']) ?>
<?php ActiveForm::end();
