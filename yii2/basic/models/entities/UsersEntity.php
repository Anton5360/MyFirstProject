<?php

namespace app\models\entities;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $login
 * @property string $password
 * @property int $is_active
 * @property string $created_at
 */
class UsersEntity extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'users';
    }


    public function rules(): array
    {
        return [
            [['username', 'login', 'password'], 'required'],
            [['is_active'], 'boolean'],
            [['created_at'], 'safe'],
            [['password'], 'string', 'min' => 5, 'max' => 255],
            [['login'], 'unique'],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Name'),
            'login' => Yii::t('app', 'Login'),
            'password' => Yii::t('app', 'Password'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
