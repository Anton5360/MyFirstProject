<?php

namespace app\models;

use app\models\entities\UsersEntity;
use Yii;
use yii\web\IdentityInterface;

class User extends UsersEntity implements IdentityInterface
{

    /**
     * @param int|string $id
     * @return static|null
     */
    public static function findIdentity($id): ?self
    {
        return self::findOne($id);
    }


    /**
     * @param string $username
     * @return static|null
     */
    public static function findByUsername(string $username): ?self
    {
        return self::findOne(['login' => $username]);
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password): bool
    {
        try{
            return Yii::$app->security->validatePassword($password, $this->password);
        } catch (\yii\base\InvalidArgumentException $exception){
          return false;
        }
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {
    }
}
