<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FixedAssets]].
 *
 * @see FixedAssets
 */
class FixedAssetsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return FixedAssets[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FixedAssets|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
