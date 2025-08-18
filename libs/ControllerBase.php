<?php

namespace App\Libs;

use App\Libs\ErrorMessage;

/**
 * Base Controller
 */
abstract class ControllerBase {

    protected $view;
    protected $root;
    protected $utils;
    protected $errorMessage;
    protected $timezone;
    protected $constants;

    function __construct() {
        $this->view = new View();
        if (!$this->view) {
            throw new Exception("View class could not be instantiated.");
        }

        $this->utils = new Utils();
        if (!$this->utils) {
            throw new Exception("Utils class could not be instantiated.");
        }

        $this->errorMessage = new ErrorMessage();
        if (!$this->errorMessage) {
            throw new Exception("ErrorMessage class could not be instantiated.");
        }

        $this->constants = new Constants();
        if (!$this->constants) {
            throw new Exception("Constants class could not be instantiated.");
        }

        $config = Config::singleton();
        $this->root = $config->get('rootPath');
        $this->timezone = $config->get('timezone');
    }

}