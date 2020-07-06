<?php

namespace app\controllers\admin;

use app\models\Author;
use Throwable;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;
use app\models\Book;

class LiteratureController extends Controller
{
    public function actionIndex()
    {
        $book_model = new Book();
        $books = $book_model->getList();

        return $this->render(
            'index',
            ['books' => $books]
        );
    }

    public function actionAddBook()
    {
        $request = Yii::$app->request;
        $model = new Book();

        if ($model->load($request->post()) && $model->validate()) {
            $model->addBook(['name' => $model->name, 'author_id' => $model->author_id]);
            return $this->redirect(['admin/literature/index']);
        } else {
            return $this->render(
                'book-form',
                [
                    'model' => $model,
                    'title' => 'Новая книга'
                ]
            );
        }
    }

    public function actionAddAuthor()
    {
        $request = Yii::$app->request;
        $model = new Author();

        if ($model->load($request->post()) && $model->validate()) {
            $model->addAuthor($model->name);
            return $this->redirect(['admin/literature/index']);
        } else {
            return $this->render(
                'author-form',
                [
                    'model' => $model,
                    'title' => 'Новый автор'
                ]
            );
        }
    }

    /**
     * @return string
     */
    public function actionUpdateBook()
    {
        $request = Yii::$app->request;
        $model = new Book();

        if ($model->load($request->post()) && $model->validate() && !empty($request->get('book_id'))) {
            try {
                $model->updateBook(
                    $request->get('book_id'),
                    ['name' => $model->name, 'author_id' => $model->author_id]
                );
            } catch (StaleObjectException $e) {
                echo $e->getMessage();
            } catch (Throwable $e) {
                echo $e->getMessage();
            }

            return $this->redirect(['admin/literature/index']);
        } elseif (!empty($request->get('book_id'))) {
            $model->setBookFields($request->get('book_id'));
            return $this->render(
                'book-form',
                [
                    'model' => $model,
                    'title' => 'Редактировать книгу',
                ]
            );
        } else {
            return $this->render(
                'book-form',
                [
                    'model' => $model,
                    'title' => 'Редактировать автора',
                ]
            );
        }
    }

    /**
     * @return string
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionUpdateAuthor()
    {
        $request = Yii::$app->request;
        $model = new Author();

        if ($model->load($request->post()) && $model->validate() && !empty($request->get('author_id'))) {
            $model->updateAuthor($request->get('author_id'), $model->name);
            return $this->redirect(['admin/literature/index']);
        } elseif (!empty($request->get('author_id'))) {
            $model->setAuthorFields($request->get('author_id'));
            return $this->render(
                'author-form',
                [
                    'model' => $model,
                    'title' => 'Редактировать автора',
                ]
            );
        } else {
            return $this->render(
                'author-form',
                [
                    'model' => $model,
                    'title' => 'Редактировать автора',
                ]
            );
        }
    }

    /**
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(): void
    {
        $request = Yii::$app->request;

        if (!empty($request->get('book_id'))) {
            $model = new Book();
            $model->delBook($request->get('book_id'));

            $this->redirect(['admin/literature/index']);
        }

        if (!empty($request->get('author_id'))) {
            $model = new Author();
            $model->delAuthor($request->get('author_id'));

            $this->redirect(['admin/literature/index']);
        }
    }
}
