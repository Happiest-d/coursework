<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%docmigrate}}`.
 */
class m210601_192347_drop_age_column_from_docmigrate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%docmigrate}}', 'age');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%docmigrate}}', 'age', $this->integer(3));
    }
}
