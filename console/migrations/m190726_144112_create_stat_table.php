<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stat}}`.
 */
class m190726_144112_create_stat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stat}}', [
            'id' => $this->primaryKey(),
            'session_id' => $this->integer()->notNull(),
            'motion' => $this->string(255),
            'light' => $this->double(),
            'battery' => $this->integer(),
            'created_at' => $this->dateTime(),
        ]);

        $this->createIndex('session_id', '{{%stat}}', 'session_id');

        $this->addForeignKey(
            'stat-ibfk-session',
            '{{%stat}}',
            'session_id',
            '{{%session}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('stat-ibfk-session', '{{%stat}}');
        $this->dropTable('{{%stat}}');
    }
}
