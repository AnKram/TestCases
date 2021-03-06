<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Book */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\ARAuthor;

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
<h1><?= Html::encode($this->title) ?></h1>

<?php
$form = ActiveForm::begin([
    'id' => 'book-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
]);

echo $form->field($model, 'name')->textInput(['autofocus' => true])->label('Название книги');

echo $form->field($model, 'author_id')->dropdownList(
	ARAuthor::find()->select(['name', 'id'])->indexBy('id')->column(),
	['prompt'=>'выбрать автора']
)->label('Имя автора');
?>

<div class="form-group">
	<div class="col-lg-offset-1 col-lg-11">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
	</div>
</div>

<?php ActiveForm::end(); ?>