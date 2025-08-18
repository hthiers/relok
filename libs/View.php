<?php
namespace App\Libs;

/**
 * View Controller 
 */
class View
{
    /**
     * Constructor for the View class.
     */
    function __construct() 
    {
        // Initialization can be done here if needed in the future
    }

    /**
     * Renders a template with the provided variables.
     *
     * @param string $name The name of the template file (e.g., 'listado.php').
     * @param array $vars An associative array of variables to pass to the template.
     * @throws Exception if the template file does not exist.
     */
    public function show($name, $vars = array()) 
    {
        // Get an instance of the configuration class
        $config = Config::singleton();
        
        // Build the path to the template
        $viewsFolder = rtrim($config->get('viewsFolder'), '/') . '/';
        $path = $viewsFolder . $name;

        // Check if the template file exists
        if (!file_exists($path)) 
        {
            throw new Exception('Template `' . $path . '` does not exist.');
        }

        // Extract variables to be available in the template
        if (is_array($vars)) 
        {
            extract($vars, EXTR_SKIP);
        }

        // Include the template
        include($path);
    }
}

/*
 Usage example:
 $view = new View();
 $view->show('listado.php', array("nombre" => "Juan"));
*/
?>
