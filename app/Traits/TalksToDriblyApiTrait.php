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
trait TalksToDriblyApiTrait
{
    /**
     * Formats a form array as a json object
     * @param array $input
     * @return \stdClass
     */
    protected function formatAsJsonObject(array $input): \stdClass
    {
        $output = new \stdClass();
        foreach ($input as $key => $value) {
            $output->{$key} = $value;
        }
        return $output;
    }

    /**
     * Post some data back to mothership
     * @param string $uri
     * @param array $settings
     * @throws \App\Exceptions\DriblyApiModelException
     * @return type
     */
    protected function post(string $uri, array $settings)
    {
        try
        {
            $client = new \GuzzleHttp\Client(['cookies' => true]);
            $response = $client->request('POST', $uri, $settings);
            switch ($response->getStatusCode()) {
                case 200:
                    $res = true;
                    break;
                default:
                    $res = false;
                    $response = json_decode($res->getBody());
                    break;
            }
            return $res;
        }
        catch (\GuzzleHttp\Exception\RequestException $e)
        {
            $response = json_decode($e->getResponse()->getBody());
            \Log::debug(print_r($response,true));
            throw new \App\Exceptions\DriblyApiModelException($e->getCode(), $response->error, $response->fieldErrors);
            
        }
        catch (\Exception $e)
        {echo __FILE__."<br />";
        var_dump(get_class($e));
            var_dump($e->getMessage());die();
        }
    }
    
    /**
     * GET some data back from mothership
     * @param string $uri
     * @param array $settings
     * @throws \App\Exceptions\DriblyApiModelException
     * @return type
     */
    protected function get(string $uri, array $settings)
    {
        try
        {
            $client = new \GuzzleHttp\Client(['cookies' => true]);
            $response = $client->request('GET', $uri, $settings);
            switch ($response->getStatusCode()) {
                case 200:
                    $res = true;
                    break;
                default:
                    $res = false;
                    $response = json_decode($res->getBody());
                    break;
            }
            return $res;
        }
        catch (\GuzzleHttp\Exception\RequestException $e)
        {
            switch ($e->getCode())
            {
                case 404:
                    return false;
                    break;
                default:
//                    var_dump($e);
                    throw new \App\Exceptions\DriblyApiModelException($e->getCode(), 'argh', []);
                    break;
            }
            
        }
        catch (\Exception $e)
        {echo __FILE__."<br />";
        var_dump(get_class($e));
            var_dump($e->getMessage());die();
        }
    }
    
}
