<?php


namespace app\modules\models\forms;


use yii\base\Model;

class AddProductToCardForm extends Model
{
    public ?int $productID = null;
    public ?int $count = null;

    public function rules(): array
    {
        return [
            [['count', 'productID'], 'required'],
            [['count', 'productID'], 'integer'],
            [['count'], 'integer', 'min' => 1, 'max' => 100],
        ];
    }

}