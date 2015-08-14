<?php

/**
 * Global functions for sipMVC MVC Framework.
 *
 * @author Mikael Jacobson <mikael@mludd.se>
 * @license http://s.mludd.se/COPYING GNU General Public License
 */

/*
 * This file is part of The Simple PHP MVC Framework (sipMVC).
 *
 * Copyright (C) 2012-2014 Mikael Jacobson <mikael@mludd.se>
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
 * Extended ucwords.
 */
function uc_words($string, $newSeparator = '_', $oldSeparator = '_')
{
    return str_replace(' ', $newSeparator, ucwords(str_replace($oldSeparator, ' ', $string)));
}

/*
 * Autoloader
 */
//function __autoload($class) {
spl_autoload_register(function ($class) {
    // Class name is DirectoryPrefix_OtherDir_ClassName
    $exploded = explode('_', $class);
    $path = dirname(__FILE__).DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $exploded).'.php';
    if (is_file($path)) {
        include $path;
        if (!class_exists($class)) {
            throw new Exception("Class '".$class."' not found in '".$path."'.");
        }
    }
});
//}
;
