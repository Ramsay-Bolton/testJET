<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "driver_bus".
 *
 * @property integer $id
 * @property integer $driver_id
 * @property integer $bus_id
 */
class DriverBus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'driver_bus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'bus_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'driver_id' => 'Driver ID',
            'bus_id' => 'Bus ID',
        ];
    }
}
