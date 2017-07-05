<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use app\models\Bus;
use app\models\DriverBus;
use yii\helpers\ArrayHelper;
use app\models\BusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "driver".
 *
 * @property integer $id
 * @property string $name
 * @property string $last_name
 * @property integer $phone
 * @property string $birthday
 * @property integer $is_available
 */
class Driver extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'driver';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['phone', 'is_available'], 'integer'],
            [['birthday'], 'safe'],
            [['name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'last_name' => 'Last Name',
            'phone' => 'Phone',
            'birthday' => 'Birthday',
//            'is_available' => 'Is Available',
        ];
    }

    public static function getAll($pageSize = 1) {
        $query = Driver::find()->orderBy('name', 'last_name');
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $drivers = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        $data['pages'] = $pages;
        $data['drivers'] = $drivers;

        return $data;
    }

    public static function getStatusText($status) {

        switch ($status) {
            case '1' : return 'checked="checked"';
                break;
            case '0' : return '';
                break;
        }
    }
    
    

    function getAge($birthday) {
        $birthday_timestamp = strtotime($birthday);
        $age = date('Y') - date('Y', $birthday_timestamp);
        if (date('md', $birthday_timestamp) > date('md')) {
            $age--;
        }
        return $age;
    }

    public function getBuses() {
        return $this->hasMany(Bus::className(), ['id' => 'bus_id'])
                        ->viaTable('driver_bus', ['driver_id' => 'id']);
    }

    public function getSelectedBuses() {
        $selectedIds = $this->getBuses()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedIds, 'id');
    }

    public function saveBuses($buses) {
//            var_dump($tags);die;
        if (is_array($buses)) {
            DriverBus::deleteAll(['driver_id' => $this->id]);

            foreach ($buses as $bus_id) {
                $bus = Bus::findOne($bus_id);
                $this->link('buses', $bus);
            }
        }
    }

//    public static function setAvailableStatus($id) {
//        $driver = Driver::findOne($id);
//        $status = $driver->is_available;
//        switch ($status) {
//            case '1' : $driver->is_available = '0';
//                break;
//            case '0' : $driver->is_available = '1';
//                break;
//        }
//        return $model->update();
//    }

}
