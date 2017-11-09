<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Traits;
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
}
