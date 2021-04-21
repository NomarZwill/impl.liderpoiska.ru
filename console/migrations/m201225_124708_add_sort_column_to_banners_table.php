<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%banners}}`.
 */
class m201225_124708_add_sort_column_to_banners_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%banners}}', 'sort', $this->integer(3)->defaultValue(500));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%banners}}', 'sort');
    }
}
