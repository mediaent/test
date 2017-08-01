<?php

use yii\db\Migration;

class m170801_115427_add_filesxml extends Migration
{
    public function safeUp()
    {
        $this->createTable('files', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'create_at' => $this->timestamp()->defaultValue(null),
        ]);

        $this->createTable('files_tags', [
            'id' => $this->primaryKey(),
            'tag_name' => $this->string(255)->notNull(),
            'count' =>  $this->integer(),
            'file_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-files_tags_file_id-files-id',
            'files_tags',
            'file_id',
            'files',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m170801_115427_add_filesxml cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170801_115427_add_filesxml cannot be reverted.\n";

        return false;
    }
    */
}
