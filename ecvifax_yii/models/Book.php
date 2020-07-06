<?php

namespace app\models;

use Throwable;
use yii\base\Model;
use yii\db\Query;
use yii\db\StaleObjectException;

/**
 * ContactForm is the model behind the contact form.
 */
class Book extends Model
{
    public $id;
    public $name;
    public $author_id;
    public $author_name;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'author_id'], 'required'],
            // rememberMe must be a boolean value
            ['author_id', 'integer'],
        ];
    }

    /**
     * @param int $id
     */
    public function setBookFields(int $id): void
    {
        $book = $this->getBookById($id);
        $this->id = $id;
        $this->name = $book['book_name'];
        $this->author_id = $book['author_id'];
        $this->author_name = $book['author_name'];
    }


    /**
     * @return array
     */
    public function getList(): array
    {
        return (new Query())
            ->select(['b.`id` AS book_id', 'a.`id` AS author_id', 'b.`name` AS book_name', 'a.`name` AS author_name'])
            ->from('books AS b')
            ->leftJoin('authors AS a', 'a.id = b.author_id')
            ->all();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getBookById(int $id): array
    {
        return (new Query())
            ->select(['b.`id` AS book_id', 'a.`id` AS author_id', 'b.`name` AS book_name', 'a.`name` AS author_name'])
            ->from('books AS b')
            ->leftJoin('authors AS a', 'a.id = b.author_id')
            ->where(['b.`id`' => $id])
            ->one();
    }

    /**
     * @param int $id
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function delBook(int $id): void
    {
        $book = ARBook::find()->where(['id' => $id])->one();
        $book->delete();
    }

    /**
     * @param int $id
     * @param array $data
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function updateBook(int $id, array $data): void
    {
        $book = ARBook::findOne($id);
        if (!empty($data['name'])) {
            $book->name = $data['name'];
        }
        if (!empty($data['author_id'])) {
            $book->author_id = $data['author_id'];
        }
        $book->update();
    }

    /**
     * @param array $data
     */
    public function addBook(array $data): void
    {
        $book = new ARBook();
        $book->name = $data['name'];
        $book->author_id = $data['author_id'];
        $book->save();
    }
}
