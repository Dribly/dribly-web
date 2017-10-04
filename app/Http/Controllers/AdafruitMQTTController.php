<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\AdafruitMqtt;

class AdafruitMQTTController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index() {
//        $things = '';$searchterm = '';
//        $thingly = new AdafruitMqtt();
//        var_dump($thingly);
////        var_dump(AdafruitMqtt::pathsToPublish());
////        return view($this->templateDir . '.index', array('things' => $things, 'searchterm' => $searchterm));
//        return view('mqqt.test', array('things' => $things, 'searchterm' => $searchterm));
//    }
    public function index(AdafruitMQTT $customServiceInstance)
    {
        echo $customServiceInstance->doSomethingUseful();
    }
}
