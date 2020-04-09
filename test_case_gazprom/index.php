<?php header("Content-Type: text/html; charset=utf-8");
include_once('db.php');
include_once('functions.php');
$all_rows = get_all($conn);
$data = [];
$structure_data = [];
foreach ($all_rows as $item) {
    $position_exp = explode('.', $item['pos']);

    $result = null;
    $last_index = null;
    $result_link = [];

    foreach ($position_exp as $val) {
        if (empty($val)) {
            continue;
        }
        if (!is_array($result)) {
            $result = [];
            $result[$val] = '';
            $result_link = &$result;
        } else {
            foreach ($result_link as &$link) {
                $link = [];
                $link[$val] = '';
                $result_link = &$link;
            }
        }
        $last_index = $val;
    }
    $result_link[$last_index] = ['title' => $item['title'], 'value' => $item['value']];

    $structure_data = getStructure($result, $structure_data);
    unset($result);
}

$structure_sort = getSortStructure($structure_data);
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Test</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="/js/common.js"></script>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
<header class="flex">
	<div id="upload-file" class="flex">
		<div class="fl_upld flex">
			<label><input id="fl_inp" type="file" name="file">Выберите файл</label>
			<div id="fl_nm">Файл не выбран</div>
		</div>
		<div id="send-file" class="button">Отправить</div>
	</div>
	<div id="add-row" class="flex">
		<input type="text" id="position" name="position" placeholder="Пункт">
		<input type="text" id="title" name="title" placeholder="Текст">
		<input type="text" id="value" name="value" placeholder="Стоимость">
		<div id="send-row" class="button">Добавить</div>
	</div>
</header>
<main>
	<h2>Дерево</h2>
	<?php echo getUls($structure_sort, '', ''); ?>
</main>
</body>
</html>