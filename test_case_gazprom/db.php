<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function get_all($conn)
{
    $sql = 'SELECT * FROM tree';
    $result_sql = $conn->query($sql);

    if (mysqli_num_rows($result_sql) > 0) {
        $result = [];
        while ($row = mysqli_fetch_assoc($result_sql)) {
            $result[$row['id']] = [
                'pos' => $row['row_position'],
                'title' => $row['title'],
                'value' => $row['price']
            ];
        }
    } else {
        $result = [];
    }

    return $result;
}

function insert_data($conn, $data)
{
    $sql = 'INSERT INTO tree (`row_position`, `title`, `price`) VALUES ';

    foreach ($data as $row) {
        $sql .= '("' . $row[0] . '", "' . $row[1] . '", "' . $row[2] . '"), ';
    }

    $sql = substr_replace(trim($sql), ';', -1);

    try {
        $result = $conn->query($sql);
    } catch (\mysql_xdevapi\Exception $e) {
        $result = $e->getMessage();
    }

    return $result;
}
