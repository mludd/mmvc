<?php
/**
 * Contains global application configuration
 * @package Default
 * @license http://mvc.mludd.se/LICENSE GNU General Public License
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
 * Configuration class
 * @author Mikael Jacobson <mikael@mludd.se>
 * @copyright Copyright (c) 2012 Mikael Jacobson
 */
class Config {
	public static $LOCALE = "sv_SE.UTF-8";

	// Database settings
	public static $DB_DSN = 'mysql:host=yourhostname;dbname=shorturl';
	public static $DB_PASSWORD = 'password';
	public static $DB_USER = 'username';

	// Smarty
	public static $SMARTY_DIR = '/usr/share/php/smarty3/';

	public static $DEFAULT_DATATYPE = "smarty"; // Valid values: 'smarty', 'json'

	/**
	 * The default error controller, used when we can't find the requested controller
	 */
	public static $DEFAULTERRORCONTROLLER = array(
		'filename' => 'filenotfoundcontroller.inc.php',
		'templatefile' => '404.tpl',
		'classname' => 'FileNotFoundController');

	/**
	 * Add your controllers here.
	 */
	public static $DEFAULT_CONTROLLER = 'index';
	public static $CONTROLLERS = array(
		'index' => array(
			'filename' => 'indexcontroller.inc.php',
			'templatefile' => 'index.tpl',
			'classname' => 'IndexController'),
		'about' => array(
			'filename' => 'aboutcontroller.inc.php',
			'templatefile' => 'about.tpl',
			'classname' => 'AboutController')
	);
}
?>
