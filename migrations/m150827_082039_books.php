<?php

use yii\db\Schema;
use yii\db\Migration;

class m150827_082039_books extends Migration
{
    public function up()
    {
        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'date_create' => $this->integer()->notNull(),
            'date_update' => $this->integer()->notNull(),
            'preview' => $this->string(255),
            'date' => $this->date(),
            'author_id' => $this->integer()->notNull(),
        ]);

        $books = [
            [
                'name' => 'Руслан и Людмила',
                'preview' => 'http://android-ebook.ru/uploads/posts/2013-11/1385212268_aleksandr-pushkin-ruslan-i-lyudmila.jpg',
                'date' => '2015-08-25',
                'author_id' => 3
            ],
            [
                'name' => 'Война и мир',
                'preview' => 'https://upload.wikimedia.org/wikipedia/ru/archive/f/f3/20100702190326%21%D0%92%D0%BE%D0%B9%D0%BD%D0%B0_%D0%B8_%D0%BC%D0%B8%D1%80_1965.jpg',
                'date' => '2015-08-29',
                'author_id' => 2
            ],
        ];

        foreach ($books as $book) {
            $bookModel = new \app\models\Books();
            $bookModel->setAttributes($book);
            $bookModel->save();
        }

        $this->addForeignKey('fk_books_author_id__author_id', 'books', 'author_id', 'authors', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('books');
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
