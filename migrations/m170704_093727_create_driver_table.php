<?php

use yii\db\Migration;

/**
 * Handles the creation of table `driver`.
 */
class m170704_093727_create_driver_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('driver', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'last_name' => $this->string(),
            'phone' => $this->text(),
            'birthday' => $this->date(),
            'is_available' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('driver');
    }
}
