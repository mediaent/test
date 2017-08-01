<?php
namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_at
 *
 * @property FilesTags[] $filesTags
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $update_at;
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['create_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя файла',
            'create_at' => 'Дата создания',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
                'value' => new Expression('NOW()'),
            ],

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilesTags()
    {
        return $this->hasMany(FilesTags::className(), ['file_id' => 'id']);
    }
}
