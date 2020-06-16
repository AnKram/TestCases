<?php
// выставляем ограничение 8 мб
ini_set('memory_limit', '8M');

require_once 'config.php';
require_once 'db.php';
require_once 'controller.php';

$controller = new Controller();
$records = $controller->getRecords();
$records_clear = call_user_func_array('array_merge', $records);
unset($records);

// отображение полученных записей оплаты без кредита
foreach ($records_clear as $record) {
    echo '<b>id платежа: ' . $record['id'] . '</b>';

    if (!empty($record['data_set'])) {
        $data_set = json_decode($record['data_set'], true);
    }

    if (!empty($data_set) && is_array($data_set) && count($data_set) > 0) {
        echo '<p>Параметры платежа:</p>';
        foreach ($data_set as $key => $val) {
            echo '<p>' . $key . ': ' . $val . '</p>';
        }
    }
}

echo '</br></br>';
unset($records_clear);

// получаем просроченные кредиты
$result = $controller->getLatePayments();

// выводим результат записи в файл
if ($result['late_payments_quantity'] === 0) {
    echo '<p>Просроченных платежей нет</p>';
} else {
    $write_success = $result['write_success'] ? 'успешно' : 'ошибка!';
    $valid = $result['valid'] ? 'успешно' : 'ошибка!';
    echo '<p>Просроченных платежей обнаружено: ' . $result['late_payments_quantity'] . '</p>';
    echo '<p>Запись в файл: ' . $write_success . '</p>';
    echo '<p>Файл: ' . $result['file_name'] . '</p>';
    echo '<p>Результат валидации файла: ' . $valid . '</p>';
}

if (!empty($result['write_logs_success'])) {
    echo '<p>' . $result['write_log_comment'] . '</p>';
}

unset($result);
