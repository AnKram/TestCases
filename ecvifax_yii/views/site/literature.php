<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Публичная часть';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <?= Html::tag('h1', Html::encode($this->title)); ?>
    <?= Html::tag('h2', 'Список книг'); ?>
	<div class="row book" style="padding: 5px 0">
        <?= Html::tag('div', Html::tag('b', 'название книги'), ['class' => 'col-lg-3 book_name']); ?>
        <?= Html::tag('div', Html::tag('b', 'имя автора'), ['class' => 'col-lg-3 book_author']); ?>
	</div>
	<?php foreach ($books as $book) { ?>
        <div class="row book" style="padding: 5px 0">
            <?= Html::tag('div', $book['book_name'], ['class' => 'col-lg-3 book_name']); ?>
            <?= Html::tag('div', $book['author_name'], ['class' => 'col-lg-3 book_author']); ?>
        </div>
    <?php } ?>

    <?= Html::tag('h2', 'Список авторов'); ?>
	<div class="row book" style="padding: 5px 0">
        <?= Html::tag('div', Html::tag('b', 'имя автора'), ['class' => 'col-lg-3 book_name']); ?>
        <?= Html::tag('div', Html::tag('b', 'количество книг'), ['class' => 'col-lg-3 book_author']); ?>
	</div>
	<?php foreach ($authors as $author) { ?>
		<div class="row book" style="padding: 5px 0">
            <?= Html::tag('div', $author['author_name'], ['class' => 'col-lg-3 book_name']); ?>
            <?= Html::tag('div', $author['quantity'], ['class' => 'col-lg-3 book_author']); ?>
		</div>
    <?php } ?>

</div>
