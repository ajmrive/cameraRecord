<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property string $Id
 * @property integer $Uuid
 * @property string $Thumbnail
 * @property string $SmallThumbnail
 * @property string $Url
 * @property string $Timestamp
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Uuid'], 'required'],
            [['Timestamp'], 'safe'],
            [['Uuid','Thumbnail', 'SmallThumbnail', 'Url'], 'string', 'max' => 2083],
            [['Uuid'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Uuid' => 'Uuid',
            'Thumbnail' => 'Thumbnail',
            'SmallThumbnail' => 'Small Thumbnail',
            'Url' => 'Url',
            'Timestamp' => 'Timestamp',
        ];
    }
}
