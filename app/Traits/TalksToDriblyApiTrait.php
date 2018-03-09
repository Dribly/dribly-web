<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Traits;

use App\Exceptions;

/**
 * Description of TalksToDriblyApi
 *
 * @author toby
 */
trait TalksToDriblyApiTrait {

    /**
     * Formats a form array as a json object
     * @param array $input
     * @return \stdClass
     */
    protected function formatAsJsonObject(array $input): \stdClass {
        $output = new \stdClass();
        foreach ($input as $key => $value) {
            $output->{$key} = $value;
        }
        return $output;
    }

    /**
     * Post some data back to mothership
     * @param string $uri
     * @param mixed $settings
     * @throws \App\Exceptions\DriblyApiModelException
     * @return type
     */
    protected function post(string $uri, $settings) {
        try {
            $client = new \GuzzleHttp\Client(['cookies' => true]);
            /*
             * http://docs.guzzlephp.org/en/stable/quickstart.html#post-form-requests
             * Need to pass an array wrapper
             */
            $responseObj = $client->request('POST', $uri, ['json'=>$settings]);
            switch ($responseObj->getStatusCode()) {
                case 200:
                    $res = true;
                    break;
                default:
                    $res = false;
                    $response = json_decode($res->getBody());
                    break;
            }
            return $res;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            \Log::debug(print_r($e->getResponse(), true));
            \Log::debug('one');
            $response = json_decode($e->getResponse()->getBody());
            \Log::debug(print_r($response, true));
            \Log::debug('twp');
            throw new \App\Exceptions\DriblyApiModelException($e->getCode(), $response->error, $response->fieldErrors);
        } catch (\Exception $e) {
            echo __FILE__ . " is the file<br />";
            var_dump(get_class($e));
            var_dump($e->getMessage());
            die('where is the sausage');
        }
    }

    /**
     * GET some data back from mothership
     * @param string $uri
     * @param array $settings
     * @throws \App\Exceptions\DriblyApiModelException
     * @return type
     */
    protected function get(string $uri, array $settings) {
        try {
            $client = new \GuzzleHttp\Client(['cookies' => true]);
            $responseObj = $client->request('GET', $uri, ['query' => $settings]);
//            var_dump($responseObj);
            $response = json_decode($responseObj->getBody());
            switch ($responseObj->getStatusCode()) {
                case 200:
                    $res = true;
                    break;
                default:
                    $res = false;
                    $response = json_decode($responseObj->getBody());
                    break;
            }
            return $response;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            switch ($e->getCode()) {
                case 404:
                    return false;
                    break;
                default:
//                    var_dump($e);
                    throw new \App\Exceptions\DriblyApiModelException($e->getCode(), 'argh', []);
                    break;
            }
        } catch (\Exception $e) {
            echo __FILE__ . "<br />";
            var_dump(get_class($e));
            var_dump($e->getMessage());
            die();
        }
    }
}
