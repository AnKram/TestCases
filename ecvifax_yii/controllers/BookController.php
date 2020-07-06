<?php

namespace app\controllers;

use app\models\Book;
use yii\rest\ActiveController;

class BookController extends ActiveController
{
    public $modelClass = 'app\models\ARBook';

    /**
     * @return array
     */
    public function actions(): array
    {
        $actions = parent::actions();
        unset($actions['view']);
        unset($actions['index']);
        return $actions;
    }

    /**
     * @return array
     */
    public function actionIndex(): array
    {
        $model = new Book();
        return $model->getList();
    }

    /**
     * @param $id
     * @return array
     */
    public function actionView(int $id): array
    {
        $model = new Book();
        return $model->getBookById($id);
    }
}
