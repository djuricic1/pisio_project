<?php

namespace app\models;

use Yii;
use \app\models\base\Transfer as BaseTransfer;

/**
 * This is the model class for table "transfer".
 */
class Transfer extends BaseTransfer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['dateCreated', 'fixed_assets_id'], 'required'],
            [['dateCreated'], 'safe'],
            [['fixed_assets_id', 'personIdFrom', 'personIdTo', 'roomIdFrom', 'roomIdTo'], 'integer']
        ]);
    }
	
}
