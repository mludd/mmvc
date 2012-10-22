<?php
/**
 * Contains Controller base class
 * @package Default
 * @license http://s.mludd.se/COPYING GNU General Public License
 */

/*
 * This file is part of Mludd's MVC Framework (MMVC).
 *
 * Copyright (C) 2012 Mikael Jacobson <mikael@mludd.se>
 *
 * MMVC is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * MMVC is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MMVC.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Controller base class
 * @author Mikael Jacobson <mikael@mludd.se>
 * @copyright Copyright (c) 2012 Mikael Jacobson
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
	 * Default constructor
	 * @param Smarty $template Smarty template object
	 */
	public function __construct($template) {
		$this->_template = $template;
		$this->_templateFile = "index.tpl"; // Our default template file
		$this->_dataType = "smarty";
		$this->_securityLevel = 0;
		$this->process();
	}

	/**
	 * This is the main function that processes input and sets all
	 * properties for the smarty template.
	 */
	protected function process() {
	}

	/**
	 * Displays the view
	 */
	public function display() {
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
