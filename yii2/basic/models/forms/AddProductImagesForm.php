<?php

namespace app\models\forms;

use app\models\entities\ProductsImagesEntity;
use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class AddProductImagesForm extends Model
{

    public ?int $productID = null;
    /**
     * @var UploadedFile[]
     */
    public array $imageFiles = [];

    public function rules(): array
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 3],
        ];
    }

    public function upload(): bool
    {
        if (!$this->validate()) {
            return false;
        }
        $storagePath = Yii::getAlias('@storage');

        $fullPath = "{$storagePath}/products/{$this->productID}";

        FileHelper::createDirectory($fullPath);
        foreach ($this->imageFiles as $file) {
            $fileBaseName = md5($file->baseName) . '_' . mt_rand() . '_'  . $this->productID;
            $file->saveAs("{$fullPath}/{$fileBaseName}.{$file->extension}");

            $image = new ProductsImagesEntity();
            $image->product_id = $this->productID;
            $image->url = "products/{$this->productID}/{$fileBaseName}.{$file->extension}";
            $image->save();
        }
        return true;
    }
}