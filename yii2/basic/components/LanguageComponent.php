<?php


namespace app\components;


use Yii;
use yii\base\Component;

class LanguageComponent extends Component
{
    private const SESSION_LANGUAGE_KEY = 'currentLanguage';

    public string $sessionKey = '';

    public function init(): void
    {
        Yii::$app->language = Yii::$app->session->get(self::SESSION_LANGUAGE_KEY, Yii::$app->language);
    }

    public function setLanguage(string $language): void
    {
        Yii::$app->session->set(self::SESSION_LANGUAGE_KEY, $language);
    }

    public function setSessionKey(string $sessionKey): void
    {
        $this->sessionKey = $sessionKey;
    }

    public function getSessionKey(): string
    {
        return $this->sessionKey;
    }

}