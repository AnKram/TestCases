<?php

class Controller
{
    /**
     * @return array
     * получаем записи оплат без кредита
     */
    public function getRecords(): array
    {
        $table_size = $this->getTableSize('payments');
        $function = 'getAllPaymentsWithoutCredits';

        return $this->getChunks($function, $table_size, CHUNK_SIZE);
    }

    /**
     * @return array
     */
    public function getLatePayments(): array
    {
        $table_size = $this->getTableSize('credits');
        $function = 'getLatePaymentsFromDB';

        $late_payments = $this->getChunks($function, $table_size, CHUNK_SIZE);
        $late_payments_merge = call_user_func_array('array_merge', $late_payments);

        if (!empty($late_payments_merge)) {
            // запись в файл просроченных платежей
            $xml = $this->makeXmlFromLatePayments($late_payments_merge);

            $cred_id_list = array_column($late_payments_merge, 'cred_id');
            $log = $this->writeLateCreditsIdToFile($cred_id_list);

            // валидация xml файла
            if (!empty($xml['success'])) {
                $valid = $this->xmlValidate($xml['file_name']);
            } else {
                $valid = false;
            }
        } else {
            $xml['success'] = $valid = $log['success'] = false;
            $log['comment'] = '';
        }

        return [
            'late_payments_quantity' => count($late_payments_merge),
            'write_success' => $xml['success'],
            'valid' => $valid,
            'file_name' => $xml['file_name'] ?? 'error',
            'write_logs_success' => $log['success'],
            'write_log_comment' => $log['comment'],
        ];
    }

    /**
     * @param int $table_size
     * @param int $chunk_size
     * @param string $function
     * @return array
     * получаем записи оплат без кредита
     * в задании указано "скрипт должен выполняться при 8Мб оперативной памяти", поэтому сделан механизм чанков,
     * который позволит скрипту работать с малыми объемами данных, в зависимости от настройки в файле config.php
     */
    private function getChunks(string $function, int $table_size, int $chunk_size = 0): array
    {
        $db = new DB;

        $chunks = [];
        $iterations = ceil($table_size / $chunk_size);
        $limit_start = !empty($function_attributes['limit_start']) ? $function_attributes['limit_start'] : 0;

        for ($i = 0; $i < $iterations; $i++) {
            $chunk = $db->$function($limit_start, $chunk_size);
            if ($chunk) {
                $chunks[] = $chunk;
            }
            $limit_start += $chunk_size;
        }

        return $chunks;
    }

    /**
     * @param string $table_name
     * @return int
     */
    private function getTableSize(string $table_name): int
    {
        $db = new DB;
        return $db->getTableSize($table_name);
    }

    /**
     * @param array $data
     * @return array
     * запись в файл просроченных платежей
     */
    private function makeXmlFromLatePayments(array $data): array
    {
        $file_name = 'late_payments_' . date('m_j_Y_g_i_a') . '.xml';

        $xml = new DomDocument('1.0','utf-8');
        $payments = $xml->appendChild($xml->createElement('payments'));

        foreach ($data as $item) {
            $payment = $payments->appendChild($xml->createElement('payment'));
            $payment_attr = $xml->createAttribute('id');
            $payment_attr->value = $item['id'];
            $payment->appendChild($payment_attr);
            $cred_id = $payment->appendChild($xml->createElement('cred_id'));
            $cred_id->appendChild($xml->createTextNode($item['cred_id']));
            $payment->appendChild($cred_id);
            $overdue = $payment->appendChild($xml->createElement('overdue'));
            $overdue->appendChild($xml->createTextNode($item['cred_sum']));
            $payment->appendChild($overdue);
        }

        $xml->formatOutput = true;

        $result = $xml->save(XML_PATH . $file_name);

        return [
            'file_name' => $file_name,
            'success' => $result ? true : false
        ];
    }

    /**
     * @param string $file_name
     * @return bool
     * валидация xml файла по схеме (example.xsd)
     */
    private function xmlValidate(string $file_name): bool
    {
        $dom = new DOMDocument;
        $dom->load(XML_PATH . $file_name);

        if (!$dom->schemaValidate(XML_PATH . 'example.xsd')) {
            return false;
        }

        return true;
    }

    /**
     * @param array $data
     * @return array
     */
    private function writeLateCreditsIdToFile(array $data): array
    {
        $str = '';

        if(!$f = fopen(LOGS_PATH . 'log_late_credits.txt', 'w')) {
            return [
                'success' => false,
                'comment' => 'не удалось открыть файл для записи логов',
            ];
        }

        foreach ($data as $id) {
            $str .= 'id кредита: ' . $id . PHP_EOL;
        }

        $result = fwrite($f, $str);
        if(!$result) {
            return [
                'success' => false,
                'comment' => 'не удалось записать логи в файл',
            ];
        }

        fclose($f);

        return [
            'success' => true,
            'comment' => 'логи записаны успешно',
        ];
    }
}