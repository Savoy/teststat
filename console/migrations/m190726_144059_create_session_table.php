<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session}}`.
 */
class m190726_144059_create_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%session}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'ip' => $this->bigInteger(),
            'user_agent' => $this->text(),
            'created_at' => $this->dateTime(),
        ]);

        $this->createIndex('client_id', '{{%session}}', 'client_id');

        $this->addForeignKey(
            'session-ibfk-client',
            '{{%session}}',
            'client_id',
            '{{%client}}',
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
        $this->dropForeignKey('session-ibfk-client', '{{%session}}');
        $this->dropTable('{{%session}}');
    }
}
