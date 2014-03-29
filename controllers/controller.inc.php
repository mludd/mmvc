<?php
/**
 * Contains Controller base class
 * @package Default
 * @license http://siphmvc.mludd.se/COPYING GNU General Public License
 */

/*
 * This file is part of The Simple PHP MVC Framework (siphMVC).
 *
 * Copyright (C) 2012 Mikael Jacobson <mikael@mludd.se>
 *
 * siphMVC is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * siphMVC is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with siphMVC.  If not, see <http://www.gnu.org/licenses/>.
 */

//require_once(dirname(__FILE__)."/../models/config.inc.php");
require_once(dirname(__FILE__)."/../models/resourcemanager.inc.php");

/**
 * Controller base class
 * @author Mikael Jacobson <mikael@mludd.se>
 * @copyright Copyright (c) 2012-2014 Mikael Jacobson
 */
class Controller {
	/**
	 * Smarty template
	 * @var Smarty
	 * @access protected
	 */
	protected $_template;

	/**
	 * Name of Smarty template file to use
	 * @var string
	 * @access protected
	 */
	protected $_templateFile;

	/**
	 * Data format for output, 'json' or 'smarty'
	 * @var string
	 * @access protected
	 */
	protected $_dataType;

	/**
	 * Security level, UNUSED
	 * @var int
	 * @access protected
	 */
	protected $_securityLevel;

	/**
	 * Controller action
	 * @var string
	 * @access protected
	 */
	protected $_action;

	/**
	 * GET arguments
	 * @var array
	 * @access protected
	 */
	protected $_args;

	/**
	 * Default constructor
	 * @param Smarty $template Smarty template object
	 * @param array $args GET arguments
	 */
	public function __construct($action, $args, $template) {
		$config = ResourceManager::get('config');
		$this->_template = $template;
		$this->_templateFile = $config->controllers[$config->defaultController]['templatefile'];
		$this->_dataType = $config->defaultDatatype;
		$this->_securityLevel = 0;
		$this->_action = $action;
		$this->_args = $args;
	}

	/**
	 * This is the main function that processes input and sets all
	 * properties for the smarty template.
	 * @param string $action Action to run
	 */
	protected function process($action) {
		$methodName = $action."Action";
		$this->{$methodName}();
	}

	/**
	 * Displays the view
	 * @param string $action Action to run before outputting.
	 */
	public function display() {
		$this->process($this->_action);
		if($this->_dataType == "smarty") {
			$this->_template->display($this->_templateFile);
		}
		else if($this->_dataType == "json") {
			echo $this->displayJSON();
		}
	}

	/**
	 * Outputs all the data from $this->_template as a JSON response
	 */
	private function displayJSON() {
		$vars = array();
		if(method_exists($this->_template, 'get_template_vars')) {
			$vars = $this->_template->get_template_vars();
		}
		else {
			foreach($this->_template->tpl_vars AS $key => $value) {
				$vars[$key] = $value;
			}
		}
		//$vars->unset('SCRIPT_NAME');
		echo json_encode($vars);
	}
}
?>
