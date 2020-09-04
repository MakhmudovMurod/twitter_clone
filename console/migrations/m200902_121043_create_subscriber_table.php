<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscriber}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m200902_121043_create_subscriber_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscriber}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'surname' => $this->string(),
            'birthday' => $this->date(),
            'profile_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);

        // creates index for column `profile_id`
        $this->createIndex(
            '{{%idx-subscriber-profile_id}}',
            '{{%subscriber}}',
            'profile_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-subscriber-profile_id}}',
            '{{%subscriber}}',
            'profile_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-subscriber-user_id}}',
            '{{%subscriber}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-subscriber-user_id}}',
            '{{%subscriber}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-subscriber-profile_id}}',
            '{{%subscriber}}'
        );

        // drops index for column `profile_id`
        $this->dropIndex(
            '{{%idx-subscriber-profile_id}}',
            '{{%subscriber}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-subscriber-user_id}}',
            '{{%subscriber}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-subscriber-user_id}}',
            '{{%subscriber}}'
        );

        $this->dropTable('{{%subscriber}}');
    }
}
