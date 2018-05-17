<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model{

    public $avatar;
    public function rules()
    {
        return [
            [['avatar'], 'required'],
            [['avatar'], 'file', 'extensions' => 'jpg,png']
        ];
    }
    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->avatar = $file;
        if($this->validate())
        {
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage();
        }
    }
    private function getFolder()
    {
        return Yii::getAlias('@frontend') . '/web/uploads/';
    }
    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->avatar->baseName)) . '.' . $this->avatar->extension);
    }
    public function deleteCurrentImage($currentImage)
    {
        if($this->fileExists($currentImage))
        {
            unlink($this->getFolder() . $currentImage);
        }
    }
    public function fileExists($currentImage)
    {
        if(!empty($currentImage) && $currentImage != null)
        {
            return file_exists($this->getFolder() . $currentImage);
        }
    }
    public function saveImage()
    {
        $filename = $this->generateFilename();
        $this->avatar->saveAs($this->getFolder() . $filename);
        return $filename;
    }
}