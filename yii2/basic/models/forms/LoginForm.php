<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    private const REMEMBER_ME_TIME = 3600 * 24 * 30;

    public string $username = '';
    public string $password = '';
    public bool $rememberMe = true;

    private $user = null;


    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }


    public function validatePassword(string $attribute, ?array $params)
    {
        if ($this->hasErrors()) {
            return false;
        }
        $user = $this->getUser();

        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, Yii::t('app', 'Incorrect username or password.'));
            return false;
        }

        return true;
    }


    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? self::REMEMBER_ME_TIME : 0);
        }
        return false;
    }


    public function getUser()
    {
        if (!$this->user) {
            $this->user = User::findByUsername($this->username);
        }

        return $this->user;
    }
}
