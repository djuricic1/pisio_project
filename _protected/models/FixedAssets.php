<?php

namespace app\models;

use Yii;
use \app\models\base\FixedAssets as BaseFixedAssets;

/**
 * This is the model class for table "fixed_assets".
 */
class FixedAssets extends BaseFixedAssets
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['number', 'status', 'description', 'purchaseDate', 'initialPrice', 'amortization', 'category_id'], 'required'],
            [['number', 'amortization', 'person_id', 'category_id', 'room_id'], 'integer'],
            [['purchaseDate'], 'safe'],
            [['initialPrice'], 'number'],
            [['status'], 'string', 'max' => 1],
            [['description'], 'string', 'max' => 1024]
        ]);
    }
	
}
