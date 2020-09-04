<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_like}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%post}}`
 * - `{{%user}}`
 */
class m200901_180800_create_post_like_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_like}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'type' => $this->integer(1),
            'created_at' => $this->integer(11),
        ]);

        // creates index for column `post_id`
        $this->createIndex(
            '{{%idx-post_like-post_id}}',
            '{{%post_like}}',
            'post_id'
        );

        // add foreign key for table `{{%post}}`
        $this->addForeignKey(
            '{{%fk-post_like-post_id}}',
            '{{%post_like}}',
            'post_id',
            '{{%post}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-post_like-user_id}}',
            '{{%post_like}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-post_like-user_id}}',
            '{{%post_like}}',
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
        // drops foreign key for table `{{%post}}`
        $this->dropForeignKey(
            '{{%fk-post_like-post_id}}',
            '{{%post_like}}'
        );

        // drops index for column `post_id`
        $this->dropIndex(
            '{{%idx-post_like-post_id}}',
            '{{%post_like}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-post_like-user_id}}',
            '{{%post_like}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-post_like-user_id}}',
            '{{%post_like}}'
        );

        $this->dropTable('{{%post_like}}');
    }
}
