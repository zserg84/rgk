<?php

use yii\db\Schema;
use yii\db\Migration;

class m150827_081650_authors extends Migration
{
    public function up()
    {
        $this->createTable('authors', [
           'id' => $this->primaryKey(),
            'firstname' => $this->string(64)->notNull(),
            'lastname' => $this->string(64)->notNull(),
        ]);

        $authors = [
            [
                'Иван', 'Бунин'
            ],
            [
                'Лев', 'Толстой'
            ],
            [
                'Александр', 'Пушкин'
            ],
        ];
        foreach($authors as $author){
            $this->insert('authors', [
                'username' => $author[0],
                'lastname' => $author[1],
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('authors');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
