<?php

use yii\db\Migration;

/**
 * Конструктор блоков
 */
class m200506_083854_html_constructor extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * Common entity
         */
        $this->createTable('{{%hc_object}}', [
            'id' => $this->primaryKey(),
            'table_name' => $this->string(),
            'row_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-unique-hc_object',
            'hc_object',
            ['table_name', 'row_id'],
            true
        );
        /**
         * Файлы
         */
        $this->createTable('{{%hc_file}}', [
            'id' => $this->primaryKey(),
            'file' => $this->string(),
            'file_ext' => $this->string(),
            'folder' => $this->string(),
        ]);

        $this->createTable('{{%hc_object_file_target}}', [
            'id' => $this->primaryKey(),
            'hc_object_id' => $this->integer(),
            'type' => $this->string(),
            'index' => $this->integer(),
        ]);
        $this->createIndex(
            '{{%idx-hc_object_file_target-hc_object_id}}',
            '{{%hc_object_file_target}}',
            'hc_object_id'
        );
        $this->addForeignKey(
            '{{%fk-hc_object_file_target-hc_object_id}}',
            '{{%hc_object_file_target}}',
            'hc_object_id',
            '{{%hc_object}}',
            'id',
            'CASCADE'
        );

        $this->createTable('{{%hc_object_file}}', [
            'id' => $this->primaryKey(),
            'file_target_id' => $this->integer(),
            'file_id' => $this->integer(),
            'description' => $this->string(),
            'sort' => $this->integer(),
        ]);
        $this->createIndex(
            '{{%idx-hc_object_file-file_id}}',
            '{{%hc_object_file}}',
            'file_id'
        );
        $this->addForeignKey(
            '{{%fk-hc_object_file-file_id}}',
            '{{%hc_object_file}}',
            'file_id',
            '{{%hc_file}}',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            '{{%idx-hc_object_file_target_id}}',
            '{{%hc_object_file}}',
            'file_target_id'
        );
        $this->addForeignKey(
            '{{%fk-hc_object_file_target_id}}',
            '{{%hc_object_file}}',
            'file_target_id',
            '{{%hc_object_file_target}}',
            'id',
            'CASCADE'
        );
        /**
         * Seo
         */
        $this->createTable('{{%hc_object_seo}}', [
            'id' => $this->primaryKey(),
            'hc_object_id' => $this->integer(),
            'active' => $this->tinyInteger()->defaultValue(0),
            'heading' => $this->string(),
            'title' => $this->text(),
            'description' => $this->text(),
            'keywords' => $this->string(),
            'text1' => $this->text(),
            'text2' => $this->text(),
            'text3' => $this->text(),
            'pagination_title' => $this->text(),
            'pagination_description' => $this->text(),
            'pagination_keywords' => $this->string(),
            'pagination_heading' => $this->text(),
            'img_alt' => $this->string(),
        ]);
        $this->createIndex(
            '{{%idx-hc_object_seo-hc_object_id}}',
            '{{%hc_object_seo}}',
            'hc_object_id'
        );
        $this->addForeignKey(
            '{{%fk-hc_object_seo-hc_object_id}}',
            '{{%hc_object_seo}}',
            'hc_object_id',
            '{{%hc_object}}',
            'id',
            'CASCADE'
        );

        /**
         * Draft
         */
        $this->createTable('{{%hc_draft}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'alias' => $this->string()->notNull(),
            'intro' => $this->text(),
            'short_intro' => $this->text(),
            'html' => $this->text(),
            'featured' => $this->tinyInteger()->defaultValue(0),
            'published' => $this->tinyInteger()->defaultValue(0),
            'published_at' => $this->timestamp()->defaultValue(null),
            'sort' => $this->integer(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'created_by' => $this->integer(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->createIndex(
            '{{%idx-hc_draft-created_by}}',
            '{{%hc_draft}}',
            'created_by'
        );
        $this->addForeignKey(
            '{{%fk-hc_draft-created_by}}',
            '{{%hc_draft}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            '{{%idx-hc_draft-updated_by}}',
            '{{%hc_draft}}',
            'updated_by'
        );
        $this->addForeignKey(
            '{{%fk-hc_draft-updated_by}}',
            '{{%hc_draft}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-hc_draft-alias',
            'hc_draft',
            'alias',
            true
        );

        /**
         * tag
         */
        $this->createTable('{{%hc_tag}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'alias' => $this->string()->notNull(),
            'parent_id' => $this->integer(),
            'sort' => $this->integer(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'created_by' => $this->integer(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->createIndex(
            '{{%idx-hc_tag-created_by}}',
            '{{%hc_tag}}',
            'created_by'
        );
        $this->addForeignKey(
            '{{%fk-hc_tag-created_by}}',
            '{{%hc_tag}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            '{{%idx-hc_tag-updated_by}}',
            '{{%hc_tag}}',
            'updated_by'
        );
        $this->addForeignKey(
            '{{%fk-hc_tag-updated_by}}',
            '{{%hc_tag}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        /**
         * Draft block
         */
        $this->createTable('{{%hc_block}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'alias' => $this->string()->notNull(),
            'template' => $this->text(),
            'inputs' => $this->text(),
            'type' => $this->string(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'created_by' => $this->integer(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->createIndex(
            '{{%idx-hc_block-created_by}}',
            '{{%hc_block}}',
            'created_by'
        );
        $this->addForeignKey(
            '{{%fk-hc_block-created_by}}',
            '{{%hc_block}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            '{{%idx-hc_block-updated_by}}',
            '{{%hc_block}}',
            'updated_by'
        );
        $this->addForeignKey(
            '{{%fk-hc_block-updated_by}}',
            '{{%hc_block}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        /**
         * Draft tag
         */
        $this->createTable('{{%hc_draft_tag}}', [
            'hc_draft_id' => $this->integer(),
            'hc_tag_id' => $this->integer(),
            'sort' => $this->integer(),
        ]);
        $this->createIndex(
            '{{%idx-hc_draft_id-hc_tag_id}}',
            '{{%hc_draft_tag}}',
            ['hc_draft_id', 'hc_tag_id'],
            true
        );
        $this->addForeignKey(
            '{{%fk-hc_draft_tag-hc_draft_id}}',
            '{{%hc_draft_tag}}',
            'hc_draft_id',
            '{{%hc_draft}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%fk-hc_draft_tag-hc_tag_id}}',
            '{{%hc_draft_tag}}',
            'hc_tag_id',
            '{{%hc_tag}}',
            'id',
            'CASCADE'
        );

        /**
         * Draft block
         */
        $this->createTable('{{%hc_draft_block}}', [
            'id' => $this->primaryKey(),
            'hc_draft_id' => $this->integer(),
            'hc_block_id' => $this->integer(),
            'content' => $this->text(),
            'sort' => $this->integer(),
        ]);
        $this->createIndex(
            '{{%idx-hc_draft_block-hc_draft_id}}',
            '{{%hc_draft_block}}',
            'hc_draft_id'
        );
        $this->addForeignKey(
            '{{%fk-hc_draft_block-hc_draft_id}}',
            '{{%hc_draft_block}}',
            'hc_draft_id',
            '{{%hc_draft}}',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            '{{%idx-hc_draft_block-hc_block_id}}',
            '{{%hc_draft_block}}',
            'hc_block_id'
        );
        $this->addForeignKey(
            '{{%fk-hc_draft_block-hc_block_id}}',
            '{{%hc_draft_block}}',
            'hc_block_id',
            '{{%hc_block}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-hc_draft_block-hc_draft_id}}',
            '{{%hc_draft_block}}'
        );
        $this->dropIndex(
            '{{%idx-hc_draft_block-hc_draft_id}}',
            '{{%hc_draft_block}}'
        );
        $this->dropForeignKey(
            '{{%fk-hc_draft_block-hc_block_id}}',
            '{{%hc_draft_block}}'
        );
        $this->dropIndex(
            '{{%idx-hc_draft_block-hc_block_id}}',
            '{{%hc_draft_block}}'
        );
        $this->dropTable('{{%hc_draft_block}}');

        $this->dropForeignKey(
            '{{%fk-hc_draft_tag-hc_draft_id}}',
            '{{%hc_draft_tag}}'
        );
        $this->dropIndex(
            '{{%idx-hc_draft_id-hc_tag_id}}',
            '{{%hc_draft_tag}}'
        );
        $this->dropForeignKey(
            '{{%fk-hc_draft_tag-hc_tag_id}}',
            '{{%hc_draft_tag}}'
        );
        $this->dropTable('{{%hc_draft_tag}}');

        $this->dropForeignKey(
            '{{%fk-hc_block-created_by}}',
            '{{%hc_block}}'
        );
        $this->dropIndex(
            '{{%idx-hc_block-created_by}}',
            '{{%hc_block}}'
        );
        $this->dropForeignKey(
            '{{%fk-hc_block-updated_by}}',
            '{{%hc_block}}'
        );
        $this->dropIndex(
            '{{%idx-hc_block-updated_by}}',
            '{{%hc_block}}'
        );
        $this->dropTable('{{%hc_block}}');

        $this->dropForeignKey(
            '{{%fk-hc_tag-created_by}}',
            '{{%hc_tag}}'
        );
        $this->dropIndex(
            '{{%idx-hc_tag-created_by}}',
            '{{%hc_tag}}'
        );
        $this->dropForeignKey(
            '{{%fk-hc_tag-updated_by}}',
            '{{%hc_tag}}'
        );
        $this->dropIndex(
            '{{%idx-hc_tag-updated_by}}',
            '{{%hc_tag}}'
        );
        $this->dropTable('{{%hc_tag}}');

        $this->dropForeignKey(
            '{{%fk-hc_draft-created_by}}',
            '{{%hc_draft}}'
        );
        $this->dropIndex(
            '{{%idx-hc_draft-created_by}}',
            '{{%hc_draft}}'
        );
        $this->dropForeignKey(
            '{{%fk-hc_draft-updated_by}}',
            '{{%hc_draft}}'
        );
        $this->dropIndex(
            '{{%idx-hc_draft-updated_by}}',
            '{{%hc_draft}}'
        );
        $this->dropIndex(
            'idx-hc_draft-alias',
            'hc_draft'
        );
        $this->dropTable('{{%hc_draft}}');

        $this->dropForeignKey(
            '{{%fk-hc_object_seo-hc_object_id}}',
            '{{%hc_object_seo}}'
        );
        $this->dropIndex(
            '{{%idx-hc_object_seo-hc_object_id}}',
            '{{%hc_object_seo}}'
        );
        $this->dropTable('{{%hc_object_seo}}');

        $this->dropForeignKey(
            '{{%fk-hc_object_file-file_id}}',
            '{{%hc_object_file}}'
        );
        $this->dropIndex(
            '{{%idx-hc_object_file-file_id}}',
            '{{%hc_object_file}}'
        );
        $this->dropForeignKey(
            '{{%fk-hc_object_file_target_id}}',
            '{{%hc_object_file}}'
        );
        $this->dropIndex(
            '{{%idx-hc_object_file_target_id}}',
            '{{%hc_object_file}}'
        );
        $this->dropTable('{{%hc_object_file}}');

        $this->dropForeignKey(
            '{{%fk-hc_object_file_target-hc_object_id}}',
            '{{%hc_object_file_target}}'
        );
        $this->dropIndex(
            '{{%idx-hc_object_file_target-hc_object_id}}',
            '{{%hc_object_file_target}}'
        );
        $this->dropTable('{{%hc_object_file_target}}');

        $this->dropTable('{{%hc_file}}');

        $this->dropIndex('idx-unique-hc_object', 'hc_object');

        $this->dropTable('{{%hc_object}}');
       
    }
}
