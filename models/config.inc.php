<?php
/**
 * Contains global application configuration
 * @package Default
 * @license http://sipmvc.mludd.se/LICENSE GNU General Public License
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

require_once(dirname(__FILE__)."/abstract/model.inc.php");

/**
 * Configuration class
 * @author Mikael Jacobson <mikael@mludd.se>
 * @copyright Copyright (c) 2012-2014 Mikael Jacobson
 */
class Config extends Model {
	/**
	 * Default constructor, loads configuration XML and populates
	 * the object with the data
	 */
	public function __construct() {
		$this->loadGeneralConfiguration('general.xml');
		//$this->loadControllerConfiguration('controllers.xml');
		$this->loadControllers('controllers.xml');
		$this->loadDbConfiguration('db.xml');
	}

	private function loadGeneralConfiguration($filename) {
		$xml = $this->getConfigXml($filename);

		$this->locale		= (string)$xml->locale;
		$this->smartyDir	= (string)$xml->smarty_dir;
		$this->defaultDatatype	= (string)$xml->default_datatype;
	}

	/**
	 * Attempts to load the configuration for the database
	 *
	 * @param string $filename File to load configuration from
	 */
	private function loadDbConfiguration($filename) {
		$xml = $this->getConfigXml($filename);

		$this->dbDsn	= (string)$xml->db_dsn;
		$this->dbUser	= (string)$xml->db_username;
		$this->dbPass	= (string)$xml->db_password;
	}

	/**
	 * Attempts to load the configuration for the controllers
	 *
	 * @param string $filename File to load configuration from
	 */
	private function loadControllers($filename) {
		$routeXml = $this->getConfigXml($filename);

		// controllers
		$this->routes = [];
		foreach($routeXml->routes->route as $_cont) {
			$this->routes[(string)$_cont->path] = $this->xmlControllerToArray($_cont);
		}

		// 404
		$this->fileNotFoundController = $this->xmlControllerToArray($routeXml->fileNotFoundController->controller);

		// Default controller
		$this->defaultRoute = (string)$routeXml->defaultRoute;
	}

	/**
	 * Returns a config file as a SimpleXMLElement object
	 *
	 * @param string $filename File to load configuration from
	 * @return SimplXMLElement
	 */
	private function getConfigXml($filename) {
		return new SimpleXMLElement(file_get_contents(dirname(__FILE__)."/../config/".$filename));
	}

	/**
	 * Converts a SimpleXMLElement Controller into an array
	 *
	 * @param SimpleXMLElement $controller Controller XML Element
	 * @return array
	 */
	private function xmlControllerToArray($controller) {
		error_log(print_r($controller, true));
		return [
			'templatefile'	=> (string)$controller->template,
			'filename'	=> (string)$controller->classfile,
			'classname'	=> (string)$controller->classname
			
		];
	}
}
?>
