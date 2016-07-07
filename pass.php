<?php
class PasswordSingleton{
    /**
     * @var Singleton The reference to *Singleton* instance of this class
     */
    private static $instance;
	
	private static $proxy = 'web-proxy.il.hpecorp.net:8080';

	private static $proxyValue = NULL;
	
    /**
     * Returns the *Singleton* instance of this class.
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance(){
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }
    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct(){
    }
    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     * @return void
     */
    private function __clone(){
    }
    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     * @return void
     */
    private function __wakeup(){
    }
	
	public function clearSession(){
		session_start();
		session_unset();
		session_destroy();
		session_write_close();
	}
	
	public function getProxy(){
		$data=array();
		session_start(['cookie_lifetime' => 86400,]);
		
		if(array_key_exists('_proxy',$_SESSION)){
			//$json = $_SESSION['_proxy'];
			$obj = $_SESSION['_proxy'];
			//$obj = stripslashes($json);
			//$data['pass']=$obj;
			//$data['message']='is set';
			//return $data;
			return $obj;
		}else{
			$timeout = 5;
			$splited = explode(':',static::$proxy);
			$val = NULL;
			//$data['message']='not  set';
			if($con = @fsockopen($splited[0], $splited[1], $errorNumber, $errorMessage, $timeout)){
				//proxy works
				$data['message']='not  set working';
				$val = static::$proxy;
			}
			$_SESSION["_proxy"] = $val;
			//$data['pass']=$val;
			return $val;
		}
	}
}