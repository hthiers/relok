<?php
namespace App\Libs;

use PDO;
use PDOException;
use App\Libs\Config;

/**
 * Pre Compiled SQL Query Object
 */
class SPDO extends PDO
{
    private static ?SPDO $instance = null;

    // Support for charset set, this is compatible with modern PHP versions
    private static array $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4', // Use utf8mb4 for better UTF-8 support
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Use exceptions for error handling
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Default fetch mode to associative array
        PDO::ATTR_EMULATE_PREPARES => false, // Disable emulation of prepared statements
    ];

    private function __construct()
    {
        $config = Config::singleton();

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $config->get('dbhost'),
            $config->get('dbport'),
            $config->get('dbname')
        );

        try {
            parent::__construct($dsn, $config->get('dbuser'), $config->get('dbpass'), self::$options);
        } catch (PDOException $e) {
            // Handle connection errors
            // You could log this error or rethrow it with additional information
            throw new PDOException("Database connection failed: " . $e->getMessage(), (int)$e->getCode());
        }
    }

    public static function singleton(): SPDO
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
