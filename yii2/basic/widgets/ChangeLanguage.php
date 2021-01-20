<?php
namespace app\widgets;


use app\models\forms\ChangeLanguageForm;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Widget;


class ChangeLanguage extends Widget
{


    public function run()
    {
        $model = new ChangeLanguageForm();
        $model->language = Yii::$app->language;

        $form = ActiveForm::begin(['method' => 'post', 'action' => ['/site/set-language']]);

        echo $form->field($model, 'currentUrl')->hiddenInput(['value' => $_SERVER['REQUEST_URI']])->label(false);

        echo $form->field($model, 'language')
            ->dropDownList(Yii::$app->params['languages'], ['onchange' => 'this.form.submit();'])
            ->label(false);

        ActiveForm::end();
    }
}
