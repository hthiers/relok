<?php
use App\Libs\Config;

$config = Config::singleton();

$config->set('apachePath', '/var/www/html');
$config->set('rootPath', '');
$config->set('controllersFolder', 'controllers/');
$config->set('modelsFolder', 'models/');
$config->set('viewsFolder', 'views/');

$config->set('dbhost', 'mysql_db');
$config->set('dbname', 'sql_control_dioc');
$config->set('dbuser', 'sql_control_dioc');
$config->set('dbpass', '5be6f1c$2c97f7ea#a');

$config->set('timezone', 'America/La_Paz');
$config->set('charset', 'UTF8');
$config->set('debug', true);
#$config->set('token', '3756a4505914c97f76b8557a688466a4');

$config->set('multitask', true);
$config->set('scaleDecimal', false);
$config->set('usersNoView', true);
?>
