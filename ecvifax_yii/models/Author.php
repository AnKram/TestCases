<?php

namespace app\models;

use yii\base\Model;
use yii\db\Query;
use yii\db\StaleObjectException;

/**
 * ContactForm is the model behind the contact form.
 */
class Author extends Model
{
    public $id;
    public $name;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            // name is both required
            [['name'], 'required'],
        ];
    }

    /**
     * @param int $id
     */
    public function setAuthorFields(int $id): void
    {
        $book = $this->getAuthorById($id);
        $this->id = $id;
        $this->name = $book['author_name'];
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return (new Query())
            ->select(['a.`id` AS author_id', 'a.`name` AS author_name', 'COUNT(b.`id`) AS quantity'])
            ->from('authors AS a')
            ->leftJoin('books AS b', 'a.id = b.author_id')
            ->groupBy('a.`id`')
            ->all();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getAuthorById(int $id): array
    {
        return (new Query())
            ->select(['a.`id` AS author_id', 'a.`name` AS author_name', 'COUNT(b.`id`) AS quantity'])
            ->from('authors AS a')
            ->leftJoin('books AS b', 'a.id = b.author_id')
            ->where(['a.`id`' => $id])
            ->groupBy('a.`id`')
            ->one();
    }

    /**
     * @param int $id
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function delAuthor(int $id): void
    {
        ARBook::deleteAll('author_id = ' . $id);

        $author = ARAuthor::find()->where(['id' => $id])->one();
        $author->delete();
    }

    /**
     * @param int $id
     * @param string $name
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function updateAuthor(int $id, string $name): void
    {
        $author = ARAuthor::findOne($id);
        $author->name = $name;
        $author->update();
    }

    /**
     * @param string $name
     */
    public function addAuthor(string $name): void
    {
        $author = new ARAuthor();
        $author->name = $name;
        $author->save();
    }
}
