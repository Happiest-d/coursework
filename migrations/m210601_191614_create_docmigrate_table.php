<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%docmigrate}}`.
 */
class m210601_191614_create_docmigrate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%docmigrate}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'patronymic' => $this->string(50)->notNull(),
            'surname' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%docmigrate}}');
    }
}
