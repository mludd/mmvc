<?php
/**
 * Contains IndexController class
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

require_once(dirname(__FILE__)."/controller.inc.php");
/**
 * Controller for index page
 * @author Mikael Jacobson <mikael@mludd.se>
 * @copyright Copyright (c) 2012 Mikael Jacobson
 */
class IndexController extends Controller {
	/**
	 * Performs page rendering logic
	 */
	protected function indexAction() {
		$this->_templateFile = 'index.tpl';
	}
}
?>
