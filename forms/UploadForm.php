<?php

namespace app\forms;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\mimeTypes;
use yii\helpers\BaseInflector;
use app\models\Files;
use app\models\FilesTags;

class UploadForm extends Model
{


    public $XMLfiles;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['XMLfiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'xml', 'maxFiles' => 1],
        ];
    }


    public function checkIsXML()
    {
        $xml = new \DOMDocument();

        if (@$xml->load($this->XMLfiles)) {
            return true;
        } else {
            $this->addError('XMLfiles', 'Файл не является XML');
        }
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'XMLfiles' => 'Загрузть XML файл',
        ];
    }


    public function upload()
    {
        $xml = new \DOMDocument();
        if ($this->XMLfiles != null) {
            foreach ($this->XMLfiles as $data) {
                $fileModel = new Files();
                $fileModel->name = $data->name;
                $fileModel->save();
                if (@$xml->load($data->tempName)) {
                    $root = $xml->documentElement;
                    $xpath = new \DOMXpath($xml);
                    $nodes = $xpath->query('//*');
                    $nodeNames = [];
                    foreach ($nodes as $node) {
                        if (!array_key_exists($node->nodeName, $nodeNames)) {
                            $tagsModel = new FilesTags();
                            $tagsModel->tag_name = $node->nodeName;
                            $tagsModel->count = 1;
                            $tagsModel->file_id = $fileModel->id;
                            $tagsModel->save();
                            $nodeNames[$node->nodeName] = 1;
                        } else {
                            $tagsModel = FilesTags::find()->where(['file_id'=>$fileModel->id])->andWhere(['tag_name' => $node->nodeName])->one();
                            if ($tagsModel != null) {
                                $tagsModel->updateCounters(['count' => 1]);
                            }
                        
                            $nodeNames[$node->nodeName] ++ ;
                        }
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }
}
