<?php


namespace app\models\forms;


use app\models\entities\UsersEntity;
use Yii;
use yii\base\Exception;


class RegistrationForm extends UsersEntity
{
    public string $repeatPassword = '';

    public function rules(): array
    {
        return array_merge(parent::rules(),
            [
                ['username', 'string', 'min' => 3, 'max' => 20],
                ['login', 'string', 'min' => 5, 'max' => 20],
                ['repeatPassword', 'required'],
                ['repeatPassword', 'compare', 'compareAttribute' => 'password'],
            ]);
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws Exception
     */
    public function beforeSave($insert): bool
    {
        $parentIsOk = parent::beforeSave($insert);

        if($parentIsOk){
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }

        return $parentIsOk;
    }

}
