<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace li3_less\extensions\helper;

require(LITHIUM_APP_PATH . '/libraries/lessphp/lessc.inc.php');

use lithium\core\Libraries;

/**
 * A template helper that assists in generating HTML content. Accessible in templates via
 * `$this->html`, which will auto-load this helper into the rendering context. For examples of how
 * to use this helper, see the documentation for a specific method. For a list of the
 * template strings this helper uses, see the `$_strings` property.
 */
class Less extends \lithium\template\Helper{

	public function __construct(array $config = array()) {

		//Libraries::add('lessc', array('path' => 'libraries/lessphp', 'prefix' => false, 'suffix' => '.inc.php')); debug(class_exists('lessc')); exit;

	}

	public function generate($source, $options = array()) {
		if(is_string($options)) $options = array('target' => $options);
		if(!is_array($source)) $source = array($source);

		$defaults = array(
			'sourceFolder' => APP_CSS_PATH,
			'targetFolder' => APP_CSS_PATH,
			'target' => 'core',
			'set' => array()
		);
		$options += $defaults;

		// Append DS to folders
		if(!preg_match('/\\' . DS . '$/', $options['sourceFolder'])) $options['sourceFolder'] .= DS;
		if(!preg_match('/\\' . DS . '$/', $options['targetFolder'])) $options['targetFolder'] .= DS;

		$targetFile = $options['targetFolder'] . $options['target'] . '.css';
		if(is_file($targetFile)) unlink($targetFile);

		foreach($source as $file) {
			if(!preg_match('/(.css|.less)$/is', $file)) $file .= '.less';
			//if(!is_file($options['sourceFolder'] . $file)) throw new \BadMethodCallException(sprintf('File %s does not exists.', $options['sourceFolder'] . $file));
			$less = new \lessc($options['sourceFolder'] . $file);
			file_put_contents($targetFile, $less->parse(null, $options['set']), FILE_APPEND);
		}

	}

}

?>