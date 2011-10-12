<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace less\extensions\helper;

//require(__DIR__ . '/../../libraries/lessphp/lessc.inc.php');

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

	public function generate($sourceFiles, $options = array()) {

		if(!is_array($sourceFiles)) $sourceFiles = array($sourceFiles);

		$defaults = array(
			'source' => APP_CSS_PATH . DS . 'source',
			'dest' => APP_CSS_PATH,
			'file' => "core",
			'set' => array()
		);
		$options += $defaults;

		if(!preg_match('/\\' . DS . '$/', $options['source'])) $options['source'] .= DS;
		if(!preg_match('/\\' . DS . '$/', $options['dest'])) $options['dest'] .= DS;

		$cssDest = $options['dest'] . $options['file'] . '.css';
		if(is_file($cssDest)) @unlink($cssDest);

		foreach($sourceFiles as $sourceFile) {
			if(!preg_match('/(.css|.less)$/is', $sourceFile)) $sourceFile .= '.less';
			$less = new \lessc($options['source'] . $sourceFile);
			file_put_contents($cssDest, $less->parse(null, $options['set']), FILE_APPEND);
		}

	}

}

?>