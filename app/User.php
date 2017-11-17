<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \App\Traits\TalksToDriblyApiTrait;

class User extends Authenticatable {

    use Notifiable;
    use TalksToDriblyApiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function create() {
        $success = false;
        try {
            if ($this->post($_ENV['SERVICE_USERS'] . '/api/v1/register', ["json" => $this])) {
                $success = true;
            } else {
                $success = false;
            }
        } 
        
//        catch (\App\Exceptions\DriblyApiModelException $e)
//        {
//            if (400 <= $e->getCode() && 500 > $e->getCode()) {
//                $success = false;
//            }
//            echo __FILE__ . " " . __LINE__ . "\n<Br />";
//            var_dump($e->getMessage());die();
//        }
//        catch (\Exception $e) {
//echo __FILE__."<br />";
//var_dump(get_class($e));
//            var_dump($e->getMessage());
//            die();
//        }
 catch (\Exception $e) { throw $e;}
        return $success;
    }
}
