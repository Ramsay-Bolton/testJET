<?php

use yii\db\Migration;

/**
 * Handles the creation of table `driver_bus`.
 */
class m170704_093953_create_driver_bus_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('driver_bus', [
            'id' => $this->primaryKey(),
            'driver_id' => $this->integer(),
            'bus_id' => $this->integer()
        ]);
        
        $this->createIndex(
                'idx-driver_id', 
                'driver_bus', 
                'driver_id');
        
        $this->addForeignKey(
                'fk-driver_id', 
                'driver_bus', 
                'driver_id', 
                'driver', 
                'id',
                'CASCADE');
        
        $this->createIndex(
                'idx-bus_id', 
                'driver_bus', 
                'bus_id');
        
        $this->addForeignKey(
                'fk-bus_id', 
                'driver_bus', 
                'bus_id', 
                'bus', 
                'id',
                'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('driver_bus');
    }
}
