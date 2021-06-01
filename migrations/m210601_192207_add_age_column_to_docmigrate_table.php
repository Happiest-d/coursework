<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%docmigrate}}`.
 */
class m210601_192207_add_age_column_to_docmigrate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%docmigrate}}', 'age', $this->integer(3));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%docmigrate}}', 'age');
    }
}
