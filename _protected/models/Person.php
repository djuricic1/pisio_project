<?php

namespace app\models;

use Yii;
use \app\models\base\Person as BasePerson;

/**
 * This is the model class for table "person".
 */
class Person extends BasePerson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'jmbg'], 'required'],
            [['name', 'title', 'contact', 'employment', 'role_name'], 'string', 'max' => 255],
            [['jmbg'], 'string', 'max' => 13]
        ]);
    }
	
}
