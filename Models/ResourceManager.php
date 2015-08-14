<?php

/**
 * Contains ResourceManager class.
 *
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
 * Manages resource singletons, in practice just the db connection,
 * should probably be joined with ControllerFactory.
 *
 * @author Mikael Jacobson <mikael@mludd.se>
 * @copyright Copyright (c) 2012-2014 Mikael Jacobson
 */
class Models_ResourceManager extends Models_Abstract_Model
{
    /**
     * Database connection singleton.
     *
     * @var PDO
     */
    private static $db;

    /**
     * Config.
     *
     * @var mixed
     */
    private static $config;

    /**
     * Fetches a singleton.
     *
     * @param string $resource Name of resource to fetch
     * @param mixed  $options
     *
     * @return mixed Requested singleton
     */
    public static function get($resource, $options = false)
    {
        if (property_exists('Models_ResourceManager', $resource)) {
            if (empty(self::$$resource)) {
                self::_init_resource($resource, $options);
            }
            if (!empty(self::$$resource)) {
                return self::$$resource;
            }
        }

        return;
    }

    /**
     * Initializes a requested resource.
     *
     * @param string $resource Name of requested resource
     * @param mixed  $options
     */
    private static function _init_resource($resource, $options = null)
    {
        if ($resource === 'db') {
            $config = self::get('config');
            try {
                self::$db = new PDO(
                    $config->dbDsn,
                    $config->dbUser,
                    $config->dbPass
                );
            } catch (PDOException $pe) {
                echo "Database connection failed!\n".$pe->getMessage();
            }
        } elseif ($resource === 'config') {
            self::$config = new Models_Config();
        } elseif (
            class_exists($resource) &&
            property_exists('ResourceManager', $resource)) {
            self::$$resource = new $resource($options);
        }
    }
}
