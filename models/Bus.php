<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use app\models\Driver;
use app\models\DriverBus;
use yii\helpers\ArrayHelper;
use app\models\DriverSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "bus".
 *
 * @property integer $id
 * @property string $model
 * @property integer $capacity
 */
class Bus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['capacity'], 'integer'],
            [['model'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model' => 'Model',
            'capacity' => 'Capacity',
        ];
    }
    
    
    public function getDrivers() {
        return $this->hasMany(Driver::className(), ['id' =>'driver_id'])
                ->viaTable('driver_bus', ['bus_id' => 'id']);
    }
}
