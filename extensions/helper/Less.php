<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\extensions\helper;

/**
 * A template helper that assists in generating HTML content. Accessible in templates via
 * `$this->html`, which will auto-load this helper into the rendering context. For examples of how
 * to use this helper, see the documentation for a specific method. For a list of the
 * template strings this helper uses, see the `$_strings` property.
 */
class Html extends \lithium\template\helper\Html {

	public function __construct(array $config = array()) {

		debug('in'); exit;

	}

	public function link($title, $url = null, array $options = array()) { debug('in'); exit;
	}

	public function span($title, $url = null, array $options = array()) { debug('in'); exit;
	}

}

?>