<?php
namespace App\Libs;

/**
 * System general constants
 *
 * @author hernan
 */
class Constants {

    private $system_version = "1.5";
    private static $instance;

    public static function singleton()
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    public function getSysVersion()
    {
        return $this->system_version;
    }
}
