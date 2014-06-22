<?php
/**
 * Contains FileNotFoundController class
 * @package Default
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
 * Default error controller, called when a controller can't be found.
 * Returns a 404 error. 
 * @author Mikael Jacobson <mikael@mludd.se>
 */
class Controllers_ErrorController extends Controllers_Controller {
	/**
	 * Handles page display logic
	 */
	protected function indexAction() {
		$this->codeAction();
	}

	public function codeAction() {
		$code = "500";
		$title = "Unknown error";
		if(isset($this->_args[0]) && is_numeric($this->_args[0])) {
			if($this->_args[0] == "403") {
				$code = "403";
				$title = "403 / Forbidden";
			}
			else if($this->_args[0] == "404") {
				$code = "404";
				$title = "404 / File not found";
			}
			else if($this->_args[0] == "500") {
				$code = "500";
				$title = "500 / Internal server error";
			}
		}
		http_response_code($code);
		$this->_template->assign('title', $title);
		$this->_templateFile = $code.'.tpl';
	}
}
?>
