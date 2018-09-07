<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 07/09/2018
 * Time: 12:45
 */

class Messaging
{

    private $ci;

    private $api_key;
    private $sms_push_url;
    private $user;

    public function __construct()
    {
        $this->ci =& get_instance();
        log_message('debug', 'Messaging library initialized');

        $this->api_key = '';
        $this->user = 'kadefue@sua.ac.tz';
        $this->sms_push_url = 'http://msdg.ega.go.tz/msdg/public/quick_sms';
    }

    public function send_push_sms($post_data)
    {
        if (!is_array($post_data)) {
            log_message("error", "Data received is not array");
            return FALSE;
        }

        //HASH the JSON with the generated user API key using SHA-256 method.
        $hash = hash_hmac('sha256', $post_data['data'], $this->api_key, TRUE);

        $http_header = array(
            'X-Auth-Request-Hash:' . base64_encode($hash),
            'X-Auth-Request-Id:' . $this->user,
            'X-Auth-Request-Type:api'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->sms_push_url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        log_message("info", "http response code " . curl_getinfo($ch, CURLINFO_HTTP_CODE));
        curl_close($ch);


    }
}