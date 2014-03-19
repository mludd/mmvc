<?php
/**
 * Dispatcher for MMVC MVC Framework
 * @author Mikael Jacobson <mikael@mludd.se>
 * @license http://s.mludd.se/COPYING GNU General Public License
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

require_once(dirname(__FILE__)."/models/config.inc.php");
require_once(dirname(__FILE__)."/models/controllerfactory.inc.php");

setlocale(LC_ALL, Config::$LOCALE);

// Smarty setup
define("SMARTY_DIR", Config::$SMARTY_DIR);
require_once(SMARTY_DIR.'Smarty.class.php');
$smarty = new Smarty();
$smarty->setTemplateDir('smarty/templates/');
$smarty->setCompileDir('smarty/templates_c/');
$smarty->setConfigDir('smarty/configs/');
$smarty->setCacheDir('smarty/cache/');

// Filter input
$controllerName = Config::$DEFAULT_CONTROLLER;
$action = 'index';
if(isset($_GET['controller'])) {
	$controllerName = preg_replace('/[^a-z0-9]/', '', strtolower($_GET['controller']));
}
if(isset($_GET['action']) && !empty($_GET['action'])) {
	$action = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['action']);
}

$args = array();
if(isset($_GET['args'])) {
	$args = preg_split('/\//', $_GET['args']);
}

$controller = ControllerFactory::get($controllerName, $smarty);
$controller->display($action);
?>
