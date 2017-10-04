<?php
namespace App\Library\Services;

use Bluerhinos\phpMQTT;

class AdafruitMQTT
{
    const SERVER = 'io.adafruit.com';
    const USERNAME = 'powellblyth';
    const PORT = 1883;
    const KEY = 'a87ea08e1b5943c1ac013c9b468108f6';

    public function doSomethingUseful()
    {
        echo "<pre>";
        $mqtt = new phpMQTT(self::SERVER, self::PORT,self::USERNAME);
        $mqtt->debug = true;
        if ($mqtt->connect(true, NULL, self::USERNAME, self::KEY)) {
	$mqtt->publish("powellblyth/feeds/watersensor", "Hello World! at " . date("r"), 0);
	$mqtt->close();
        echo "Done";
} else {
    echo "Time out!\n";
}
        echo "</pre>";

      return 'Output from DemoOne';
    }
}
