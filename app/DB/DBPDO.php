<?php

namespace App\DB;

class DbPdo{
    private $url;
    private $key;
    protected static $instance;
    public static function getInstance(array $options)
    {
        if(!self::$instance){
            self::$instance = new self($options);
        }
        return self::$instance;
    }

    public function __construct(array $options)
    {
        $this->url = $options['url'];
        $this->key = $options['key'];
    }
    public function query($sql, $data = [], $method = 'POST')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->url . $sql);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = [
            'apikey: '.$this->key,
            'Authorization: Bearer '.$this->key,
        ];

        if( count($data) > 0 || $method == "DELETE" ) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Prefer: return=minimal';
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

        return json_decode($server_output);
    }
}