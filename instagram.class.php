<?php

class Instagram {

    var $user_id;
    var $client_id;
    var $json;
    var $endpoint;

    public function __construct($user_id, $client_id) {
        $this->user_id = $user_id;
        $this->client_id = $client_id;
        $this->endpoint = "https://api.instagram.com/v1/";
    }

    public function getRecentMedia($limit = 10) {
        try {
            $curl = curl_init($this->endpoint. "users/$this->user_id/media/recent/?access_token=$this->client_id&count=$limit");
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $data = curl_exec($curl);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        
        return json_decode($data);
    }
}
