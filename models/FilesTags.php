<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files_tags".
 *
 * @property integer $id
 * @property string $tag_name
 * @property integer $count
 * @property integer $file_id
 *
 * @property Files $file
 */
class FilesTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_name', 'file_id'], 'required'],
            [['count', 'file_id'], 'integer'],
            [['tag_name'], 'string', 'max' => 255],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_name' => 'Название тега',
            'count' => 'Количество',
            'file_id' => 'File ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }
}
