<?php
namespace App\Library\Services;

use Lightning\App;
//// Try to establish connection to server
//$client = new LibMQTT\Client("serverName",8883,"ThisIsYourUniqueClientID");
//// Set connection protocol ("tls" = all tls versions)
//$client->setCryptoProtocol("tls");
//// If server is running with self-signed certificate, provide CA file here
//#$client->setCAFile("path_to_cafile");
//$result = $client->connect();
//// Publish message to "topic1/topic2"
//$client->publish("topic1/topic2", "Test Message", 0);
//// Close the connection.
//$client->close();
class CloudMQTT {

    const SERVER = 'm21.cloudmqtt.com';
    const USERNAME = 'powellblyth';
    const PORT = 16317;
    const KEY = 'a87ea08e1b5943c1ac013c9b468108f6';
    const FEED_WATERSENSOR = 0;
    const FEED_TAP = 1;
    const FEED_TYPES = [self::FEED_WATERSENSOR => "powellblyth/feeds/watersensor", self::FEED_TAP => "powellblyth/feeds/tap"];

    /*
     * @var phpMQTT $mqtt 
     */
    static $mqtt;

    public function sendMessage(int $feed, String $message) {
        $this->initMqtt();
        static::$mqtt->connect();
        sleep(1);
        static::$mqtt->publish(self::FEED_TYPES[$feed], '{"message":"'.$message."'}", 1);
        static::$mqtt->close();
    }

    public function readMessage(int $feed) {
        $this->initMqtt();
        static::$mqtt->connect();
        static::$mqtt->subscribe(self::FEED_TYPES[$feed], 0, function (\Lightning\Response $response) {
echo "got a message\n";
flush();
echo "it was " . $response->getMessage()."\n";
            $messageLog = new \App\MessageLog();
            $messageLog->message =  $response->getMessage();
            $messageLog->route =  '';
            $messageLog->topic =  $response->getRoute();
            $messageLog->received =  $response->getReceived();
            $messageLog->attributes =  implode(', ',$response->getAttributes());
            $messageLog->save();

            $message = $response->getMessage();
            echo 'Message - ' . $message ."\n";
            flush();
//            die();
            });
            static::$mqtt->listen(true);
//        static::$mqtt->publish(self::FEED_TYPES[$feed], '{"message":"'.$message."'}", 1);
        static::$mqtt->close();
//        if (static::$mqtt->connect(true, NULL, self::USERNAME, self::KEY)) {
//            $topics[self::FEED_TYPES[$feed]] = array("qos" => 0, "function" => "procmsg");
//            static::$mqtt->subscribe($topics, 0);
////            var_dump(static::$mqtt->message(self::FEED_TYPES[$feed]));
////            
//$x = 0;
//            while (static::$mqtt->proc(false)) {
//                sleep(1);
//                echo "HI<br />\n";
//                if ($x++ > 2){break;}
////                $mqtt = new phpMQTT();
////                static::$mqtt->proc(true);
//            }
//            static::$mqtt->close();
//        } else {
//            echo "Time out, could not read message!\n";
//        }


    }
    function procmsg($topic, $msg) {
        echo "Msg Received: " . date("r") . "\n";
        echo "Topic: {$topic}\n\n";
        echo "\t$msg\n\n";
        exit;
    }

    /**
     * 
     * $host = 'mqtt.example.com';
$port = 1883;
$clientID = md5(uniqid());
$username = 'user';
$password = 'password';

// Without username/password
$mqtt = new \Lightning\App($host, $port, $clientID);

// With username/password
$mqtt = new \Lightning\App($host, $port, $clientID, $username, $password);

if (!$mqtt->connect()) {
    exit(1);
}

$mqtt->close();
     */

    /**
     * Simply initiates the MQTT if it is not already done
     */
    private function initMqtt() {
        if (!static::$mqtt) {
            try{
                static::$mqtt = new App(
                        self::SERVER, 
                        self::PORT, 
                        'powellblythconnection'.md5(uniqid()), 
                        self::USERNAME, 
                        self::KEY);
//                        new Client(, self::USERNAME,"HeresJohnny");
            
            }
            catch (Exception $e)
            {
                var_dump($e);exit;
            }
//            static::$mqtt->setCryptoProtocol("tls");
//            $result = 
            
//            static::$mqtt = new phpMQTT(self::SERVER, self::PORT, self::USERNAME);
            static::$mqtt->debug = true;
        }
    }

    public function doSubscriptions() {
        echo "<pre>";
        echo "<pre>";
        echo "<h1>Begin monitor</h1>";
//        $this->sendMessage(self::FEED_WATERSENSOR, date('s') . "s Hello World! at " . date("r"));
        $this->readMessage(self::FEED_WATERSENSOR);
//        $this->sendMessage(self::FEED_WATERSENSOR, date('s') . "s Bananas are great! at " . date("r"));
        echo "</pre>";
        return 'Output from DemoOne';
    }
    public function writeMessage() {
        echo "<pre>";
        echo "<h1>Begin writign</h1>";
        echo "<a href=\"/mqttsendmessage\">Reload</a><br />";
        echo '<pre>';
        
        $message = date('s.U') . "s Hello World! at " . date("r");
        $this->sendMessage(self::FEED_WATERSENSOR, $message);
        return 'done writing '. $message . "\n";
    }
    public function messageBoard() {
        flush();
        echo "<pre>";
        echo "<h1>Begin monitor</h1>";
        flush();
        sleep(2);
//        echo "slept";
//            $messageLog = new \App\MessageLog();
//            $messageLog->message =  'message';
//            $messageLog->topic =  'topic';
//            $messageLog->route =  'route';
//            $messageLog->received =  'received';
//            $messageLog->attributes =  'attributes';
//            $messageLog->save();
//        echo "exiting";exit();
//        $this->sendMessage(self::FEED_WATERSENSOR, date('s') . "s Hello World! at " . date("r"));
        $this->readMessage(self::FEED_WATERSENSOR);
//        $this->sendMessage(self::FEED_WATERSENSOR, date('s') . "s Bananas are great! at " . date("r"));
        echo "</pre>";
        return 'Output from DemoOne';
    }

}
