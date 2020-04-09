<?php

header("Content-Type: text/html; charset=utf-8");
include_once('db.php');

$data = array();

if (isset($_GET['files'])) {
    $error = false;
    $files = array();

    // переместим файлы из временной директории в указанную
    foreach ($_FILES as $file) {
        if (end(explode('.', $file['name'])) !== 'csv') {
            continue;
        }

        if (($handle = fopen($file['tmp_name'], "r")) !== false) {
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                var_dump($row);
                if (!is_array($row) || count($row) < 3) {
                    die(json_encode(['error' => 'неверный формат']));
                } elseif (count($row) > 3) {
                    $row_inspect = array_slice($row, 0, 3);
                } else {
                    $row_inspect = $row;
                }

                $data[] = $row_inspect;
            }
            fclose($handle);
        }
    }

    if (!empty($data)) {
        echo insert_data($conn, $data);
    } else {
        echo json_encode(['error' => 'пустой файл']);
    }
} elseif (isset($_GET['row'])) {
    if (!empty($_POST['data']) && is_array($_POST['data'])) {
        $row = [];
        foreach ($_POST['data'] as $item) {
            $row[] = trim(strip_tags($item));
        }
        $data[] = $row;
    }
    echo insert_data($conn, $data);
}

