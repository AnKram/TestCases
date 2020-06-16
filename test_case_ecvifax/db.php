<?php
require_once 'config.php';


class DB
{

    /**
     * @return mysqli
     */
    public function connection()
    {
        return new mysqli(DB_PARAMS['hostname'], DB_PARAMS['username'], DB_PARAMS['pass'], DB_PARAMS['db']);
    }

    /**
     * @param string $table_name
     * @return int
     */
    public function getTableSize(string $table_name): int
    {
        $conn = $this->connection();
        $result = $conn->query('SELECT COUNT(*) AS "count" FROM `' . $table_name . '`;')->fetch_assoc();
        $conn->close();

        return $result['count'];
    }

    /**
     * @param int $limit_start
     * @param int $chunk_size
     * @return array|null
     */
    public function getAllPaymentsWithoutCredits(int $limit_start = 0, int $chunk_size = 0): array
    {
        $conn = $this->connection();

        $sql = '
            SELECT p.`id`, p.`data_set` 
            FROM `payments` AS p
            LEFT JOIN `credits` AS c ON (p.`cred_id` = c.`id`)
            WHERE p.`cred_id` IS NULL';

        $sql .= $chunk_size ? ' LIMIT ' . $limit_start . ',' . $chunk_size . ';' : ';';

        $result = $conn->query($sql);
        $conn->close();

        $records = [];
        while($row = $result->fetch_assoc()) {
            $records[] = [
                'id' => $row['id'],
                'data_set' => $row['data_set'],
            ];
        }

        return $records;
    }

    /**
     * @param int $limit_start
     * @param int $chunk_size
     * @return array
     */
    public function getLatePaymentsFromDB(int $limit_start = 0, int $chunk_size = 0): array
    {
        $conn = $this->connection();

        $sql = '
            SELECT p.`id`, p.`cred_id`, p.`data_set`, c.`cred_no`, c.`cred_date`, c.`cred_sum` 
            FROM `payments` AS p
            LEFT JOIN `credits` AS c ON (p.`cred_id` = c.`id`)
            WHERE NOW() - INTERVAL ' . DELAY_IN_PAYMENT . ' DAY > c.`cred_date` ';

        $sql .= $chunk_size ? ' LIMIT ' . $limit_start . ',' . $chunk_size . ';' : ';';

        $result = $conn->query($sql);
        $conn->close();

        $records = [];
        while($row = $result->fetch_assoc()) {
            $records[] = [
                'id' => $row['id'],
                'cred_id' => $row['cred_id'],
                'data_set' => $row['data_set'],
                'cred_no' => $row['cred_no'],
                'cred_sum' => $row['cred_sum'],
                'cred_date' => $row['cred_date'],
            ];
        }

        return $records;
    }
}