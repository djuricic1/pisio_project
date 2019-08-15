<?php

namespace app\models;

use Yii;
use \app\models\base\Category as BaseCategory;

/**
 * This is the model class for table "category".
 */
class Category extends BaseCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ]);
    }
	
}
