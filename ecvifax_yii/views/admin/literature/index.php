<?php
use yii\helpers\Html;

$this->title = 'Aдминистративная часть';
?>
<div class="site-admin">
	<h1><?= Html::encode($this->title) ?></h1>
	<div class="">
		<?php foreach ($books as $book) { ?>
			<div class="row book" style="padding: 3px 0">
				<?= Html::tag('div', Html::tag('b', $book['book_name']), ['class' => 'col-lg-2 book_name']); ?>
                <?= Html::tag('div', Html::tag('b', $book['author_name']), ['class' => 'col-lg-2 book_author']); ?>
				<div class="col-lg-8 btns">
					<?= Html::a(
						'Удалить книгу',
						['admin/literature/delete', 'book_id' => $book['book_id']],
						['class' => 'btn btn-primary']
					) ?>
                	<?= Html::a(
                		'Редактировать книгу',
                        ['admin/literature/update-book', 'book_id' => $book['book_id']],
						['class' => 'btn btn-primary']
					) ?>
					<?= Html::a(
                		'Редактировать автора',
                        ['admin/literature/update-author', 'author_id' => $book['author_id']],
						['class' => 'btn btn-primary']
					) ?>

					<?= Html::a(
                		'Удалить автора и все его книги',
                        ['admin/literature/delete', 'author_id' => $book['author_id']],
						['class' => 'btn btn-primary']
					) ?>
				</div>
			</div>
		<?php } ?>
        <?= Html::a(
            'Добавить книгу',
            ['admin/literature/add-book'],
            ['class' => 'btn btn-primary']
        ) ?>
        <?= Html::a(
            'Добавить автора',
            ['admin/literature/add-author'],
            ['class' => 'btn btn-primary']
        ) ?>
	</div>
</div>