<?php

class Swapi
{

    public $order_data;
    public $debug_data = array();

    public function __construct($order_data)
    {
        include_once "sslmarket_api/api.php";

        $this->order_data = $this->checkOrderData($order_data);
    }

    public function sendOrder()
    {
        $this->debug_data['order_data'] = $this->order_data;

        if (empty($this->order_data)) {
            throw new SwapiException('no_order_data_available');
        }

        $return = apiQuery($this->order_data);

        $this->debug_data['server_response'] = $return;

        if ($return === false) {
            throw new SwapiException('server_connection_failed');
        }

        if ($return['ack'] === 'Error') {
            throw new SwapiException('server_return_error', $return['errors']);
        }

        if ($return['ack'] !== 'Success') {
            throw new SwapiException('order_unknown_error');
        }

        return true;
    }

    public function getDebugData()
    {
        return $this->debug_data;
    }

    private function checkOrderData($order_data)
    {
        $safe_data = array();
        foreach ($order_data as $key => $value) {
            if (is_bool($value) || is_numeric($value)) {
                $safe_data[$key] = $value;
            } else {
                $safe_data[$key] = htmlspecialchars(trim($value), ENT_COMPAT, 'UTF-8');
            }
        }

        return $safe_data;
    }

}
