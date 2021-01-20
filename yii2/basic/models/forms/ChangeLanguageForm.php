<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;


class ChangeLanguageForm extends Model
{
    public string $language = '';
    public string $currentUrl = '';

    public function rules()
    {
        return [
            ['language', 'required'],
            ['language', 'in', 'range' => array_keys(Yii::$app->params['languages'])],
            ['currentUrl', 'safe'],
        ];
    }

}
