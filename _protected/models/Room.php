<?php

namespace app\models;

use Yii;
use \app\models\base\Room as BaseRoom;

/**
 * This is the model class for table "room".
 */
class Room extends BaseRoom
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['number', 'name', 'building_id'], 'required'],
            [['building_id'], 'integer'],
            [['number', 'name'], 'string', 'max' => 255]
        ]);
    }
	
}
