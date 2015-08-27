<?php
/**
 * Created by PhpStorm.
 * User: sz
 * Date: 27.08.15
 * Time: 13:37
 */

namespace app\models\search;

use app\models\Books;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

class BooksSearch extends Books
{

    private $_authorName;
    public $date_from;
    public $date_to;

    public function rules(){
        return [
            [['author_id', 'date_from', 'date_to', 'name'], 'safe'],
        ];
    }

    public function attributeLabels(){
        return array_merge(parent::attributeLabels(), [
            'authorName' => 'Автор',
        ]);
    }

    public function search($params = []){
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->innerJoinWith(['author']);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'date',
                'date_create',
                'authorName' => [
                    'asc' => ['authors.firstname' => SORT_ASC, 'authors.lastname' => SORT_ASC],
                    'desc' => ['authors.firstname' => SORT_DESC, 'authors.lastname' => SORT_DESC],
                    'default' => SORT_ASC
                ],
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'books.name', $this->name]);
        $query->andFilterWhere(['=', 'authors.id', $this->author_id]);
        $query->andFilterWhere(['<=', 'books.date', $this->date_to]);
        $query->andFilterWhere(['>=', 'books.date', $this->date_from]);

        return $dataProvider;
    }

    public function getAuthorName(){
        if($this->_authorName)
            return $this->_authorName;
        return $this->author->getFullName();
    }

    public function setAuthorName($value){
        $this->_authorName = $value;
    }
} 