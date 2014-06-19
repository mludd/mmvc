<?php
/**
 * Extended ucwords
 */
function uc_words($string, $newSeparator='_', $oldSeparator='_') {
	return str_replace(' ', $newSeparator, ucwords(str_replace($oldSeparator, ' ', $string)));
}

/**
 * Autoloader
 */
function __autoload($class) {
}
?>
