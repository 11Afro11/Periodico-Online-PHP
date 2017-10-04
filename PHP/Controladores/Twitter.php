<?php

/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 04/08/2017
 * Time: 11:09
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'TwitterAPIExchange.php';

class Twitter {

    function getMediaId($settings, $imagen) {

        $url = 'https://upload.twitter.com/1.1/media/upload.json';
        $method = 'POST';
        $twitter = new TwitterAPIExchange($settings);

        $file = file_get_contents($imagen);
        $data = base64_encode($file);

        $params = array(
            'media_data' => $data
        );

        try {
            $data = $twitter->request($url, $method, $params);
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            // hacer algo
            return null;
        }

        // para obtener más facilmente el media_id
        $obj = json_decode($data, true);

        // media_id en formato string
        return $obj ["media_id_string"];
    }

    function sendTweets($texto, $img) {
        $url = "https://api.twitter.com/1.1/statuses/update.json";
        $requestMethod = 'POST';

        // configuracion de la cuenta
        // configuracion de la cuenta
        $settings = array(
            'oauth_access_token' => 'XXX',
            'oauth_access_token_secret' => 'XXX',
            'consumer_key' => 'XXX',
            'consumer_secret' => 'XXX',
        );

        // establecer el mensaje
        $postfields = array('status' => $texto);
        // establecer el media_id
        $postfields['media_ids'] = $this->getMediaId($settings, $img);

        // crea la coneccion con Twitter
        $twitter = new TwitterAPIExchange($settings);

        // envia el tweet
        $twitter->buildOauth($url, $requestMethod)
            ->setPostfields($postfields)
            ->performRequest();
    }
}