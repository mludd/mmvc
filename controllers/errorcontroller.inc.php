<?php
/**
 * Contains FileNotFoundController class
 * @package Default
 * @license http://s.mludd.se/COPYING GNU General Public License
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

require_once(dirname(__FILE__)."/controller.inc.php");

/**
 * Default error controller, called when a controller can't be found.
 * Returns a 404 error. 
 * @author Mikael Jacobson <mikael@mludd.se>
 */
class ErrorController extends Controller {
	/**
	 * Handles page display logic
	 */
	protected function indexAction() {
		$this->codeAction();
	}

	public function codeAction() {
		$code = "500";
		if(isset($this->_args[0]) && is_numeric($this->_args[0])) {
			if($this->_args[0] == "403") {
				$code = "403";
			}
			else if($this->_args[0] == "404") {
				$code = "404";
			}
			else if($this->_args[0] == "500") {
				$code = "500";
			}
		}
		http_response_code($code);
		$this->_templateFile = $code.'.tpl';
	}
}
?>
