<?php
/**
 * Contains ControllerFactory class
 * @package Default
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

require_once(dirname(__FILE__)."/../controllers/controller.inc.php");

/**
 * Controller factory class
 * @author Mikael Jacobson <mikael@mludd.se>
 * @copyright Copyright (c) 2012 Mikael Jacobson
 */
class ControllerFactory {
	/**
	 * Handles requests for a new controller
	 * @param string $controllerName Name of controller
	 * @param Smarty $smarty Smarty object to pass to controller
	 * @return mixed Controller
	 */
	public static function get($controllerName, $smarty) {
		$controller = new Controller($smarty);
		$controllerDir = dirname(__FILE__)."/../controllers/";
		switch($controllerName) {
			case 'index':
				require_once($controllerDir."indexcontroller.inc.php");
				$controller = new IndexController($smarty);
				break;
			case 'ajax':
				require_once($controllerDir."ajaxcontroller.inc.php");
				$controller = new AjaxController($smarty);
				break;
			case 'about':
				require_once($controllerDir."aboutcontroller.inc.php");
				$controller = new AboutController($smarty);
				break;
			case 'redirect':
				require_once($controllerDir."redirectcontroller.inc.php");
				$controller = new RedirectController($smarty);
				break;
			case 'statistics':
				require_once($controllerDir."statisticscontroller.inc.php");
				$controller = new StatisticsController($smarty);
				break;
			default:
				require_once($controllerDir."filenotfoundcontroller.inc.php");
				$controller = new FileNotFoundController($smarty);
				break;
		}

		return $controller;
	}
}
?>
