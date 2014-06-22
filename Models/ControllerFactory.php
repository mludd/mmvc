<?php
/**
 * Contains ControllerFactory class
 * @package Default
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
 * Controller factory class
 * @author Mikael Jacobson <mikael@mludd.se>
 * @copyright Copyright (c) 2012-2014 Mikael Jacobson
 */
class Models_ControllerFactory extends Models_Abstract_Model {
	/**
	 * Handles requests for a new controller
	 * @param string $route Name of route
	 * @param string $action Controller action
	 * @param array $args GET arguments
	 * @param Smarty $smarty Smarty object to pass to controller
	 * @return mixed Controller
	 */
	public static function get($route, $action, $args, $smarty) {
		$config		= Models_ResourceManager::get('config');
		$controller	= new Controllers_Controller($action, $args, $smarty);
		$controllerDir	= dirname(__FILE__)."/../controllers/";

		// We only allow controller names that are alphanumeric
		$route = preg_replace('/[^a-zA-Z0-9]/', '', $route);


		if(array_key_exists($route, $config->routes)) {
			if(method_exists($config->routes[$route]['classname'], $action."Action")) {
				$classname = $config->routes[$route]['classname'];
				$controller = new $classname($action, $args, $smarty);
			}
			else {
				// User is requesting action which does not exist
				$action = "code";
				$args = array("404");
				$classname = $config->fileNotFoundController['classname'];
				$controller = new $classname($action, $args, $smarty);
			}
		}
		else {
			// User is requesting controller which does not exist
			$action = "code";
			$args = array("404");
			$classname = $config->fileNotFoundController['classname'];
			$controller = new $classname($action, $args, $smarty);
		}


		return $controller;
	}
}
?>
