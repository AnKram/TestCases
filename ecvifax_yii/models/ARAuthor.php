<?php

namespace app\models;

use yii\db\ActiveRecord;

class ARAuthor extends ActiveRecord
{
    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * @return array|string[]
     */
    public static function primaryKey()
    {
        return ['id'];
    }
}