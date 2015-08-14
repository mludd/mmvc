<?php

/**
 * Contains Controller base class.
 *
 * @license http://sipmvc.mludd.se/COPYING GNU General Public License
 */

/*
 * This file is part of The Simple PHP MVC Framework (sipMVC).
 *
 * Copyright (C) 2012 Mikael Jacobson <mikael@mludd.se>
 *
 * sipMVC is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * sipMVC is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with sipMVC.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Controller base class.
 *
 * @author Mikael Jacobson <mikael@mludd.se>
 * @copyright Copyright (c) 2012-2014 Mikael Jacobson
 */
class Controllers_Controller
{
    /**
     * Smarty template.
     *
     * @var Smarty
     */
    protected $_template;

    /**
     * Name of Smarty template file to use.
     *
     * @var string
     */
    protected $_templateFile;

    /**
     * Data format for output, 'json' or 'smarty'.
     *
     * @var string
     */
    protected $_dataType;

    /**
     * Security level, UNUSED.
     *
     * @var int
     */
    protected $_securityLevel;

    /**
     * Controller action.
     *
     * @var string
     */
    protected $_action;

    /**
     * GET arguments.
     *
     * @var array
     */
    protected $_args;

    /**
     * Default constructor.
     *
     * @param Smarty $template Smarty template object
     * @param array $args GET arguments
     */
    public function __construct($action, $args, $template)
    {
        $config = Models_ResourceManager::get('config');
        $this->_template = $template;
        $this->_templateFile = $config->routes[$config->defaultRoute]['templatefile'];
        $this->_dataType = $config->defaultDatatype;
        $this->_securityLevel = 0;
        $this->_action = $action;
        $this->_args = $args;
    }

    /**
     * This is the main function that processes input and sets all
     * properties for the smarty template.
     *
     * @param string $action Action to run
     */
    protected function process($action)
    {
        $methodName = $action.'Action';
        $this->{$methodName}();
    }

    /**
     * Displays the view.
     *
     * @param string $action Action to run before outputting.
     */
    public function display()
    {
        $this->process($this->_action);
        if ($this->_dataType == 'smarty') {
            $this->_template->display($this->_templateFile);
        } elseif ($this->_dataType == 'json') {
            echo $this->displayJSON();
        }
    }

    /**
     * Returns the value of an argument or false if the argument doesn't exist.
     *
     * @param string $argument Argument name
     * @return mixed Argument value
     */
    public function getArg($argument)
    {
        if (array_key_exists($argument, $this->_args)) {
            if (!empty($this->_args[$argument])) {
                return $this->_args[$argument];
            } else {
                return false;
            }
        }
    }

    /**
     * Outputs all the data from $this->_template as a JSON response.
     */
    private function displayJSON()
    {
        $vars = array();
        if (method_exists($this->_template, 'get_template_vars')) {
            $vars = $this->_template->get_template_vars();
        } else {
            foreach ($this->_template->tpl_vars as $key => $value) {
                $vars[$key] = $value;
            }
        }
        //$vars->unset('SCRIPT_NAME');
        echo json_encode($vars);
    }
}
