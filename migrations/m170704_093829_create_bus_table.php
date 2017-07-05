<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bus`.
 */
class m170704_093829_create_bus_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('bus', [
            'id' => $this->primaryKey(),
            'model' => $this->string(),
            'capacity' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('bus');
    }
}
