<?php

/**
 * @package   Turing
 * @copyright 2012 silverorange
 */
class TuringTestConfig
{
	// {{{ protected properties

	/**
	 * @var string
	 */
	protected $base_href = '';

	/**
	 * @var string
	 */
	protected $instance = '';

	/**
	 * @var string
	 */
	protected $filename = '';

	/**
	 * @var PHPUnit_Framework_TestCase
	 */
	protected $test = null;

	/**
	 * @var integer
	 */
	protected $old_error_level = 0;

	// }}}
	// {{{ public function __construct()

	public function __construct(PHPUnit_Framework_TestCase $test, $filename)
	{
		$this->test     = $test;
		$this->filename = $filename;
	}

	// }}}
	// {{{ public function setUp()

	public function setUp()
	{
		$this->loadConfig();
		$this->setErrorLevel();
	}

	// }}}
	// {{{ public function tearDown()

	public function tearDown()
	{
		$this->restoreErrorLevel();
	}

	// }}}
	// {{{ public function getBaseHref()

	public function getBaseHref()
	{
		return $this->base_href;
	}

	// }}}
	// {{{ public function getInstance()

	public function getInstance()
	{
		return $this->instance;
	}

	// }}}
	// {{{ protected function loadConfig()

	protected function loadConfig()
	{
		@include $this->filename;

		if (   !isset($GLOBALS['FunctionalTest_Config'])
			|| !is_array($GLOBALS['FunctionalTest_Config'])
		) {
			$this->test->markTestSkipped(
				'Functional test configuration is missing.'
			);
		}

		$config = $GLOBALS['FunctionalTest_Config'];

		if (   !isset($config['working_dir'])
			|| !isset($config['instance'])
			|| !isset($config['base_href'])
		) {
			$this->test->markTestSkipped(
				'Functional test configuration is missing or incorrect.'
			);
		}

		$this->instance = $config['instance'];

		if (strpos($config['base_href'], '%s') === false) {
			$this->base_href = $config['base_href'];
		} elseif ($config['instance'] == '') {
			$this->base_href = sprintf(
				$config['base_href'],
				$config['working_dir']
			);
		} else {
			$this->base_href = sprintf(
				$config['base_href'],
				$config['instance'],
				$config['working_dir']
			);
		}
	}

	// }}}
	// {{{ protected function setErrorLevel()

	protected function setErrorLevel()
	{
		$this->old_error_level = error_reporting(E_ALL | E_STRICT);
	}

	// }}}
	// {{{ protected function restoreErrorLevel()

	protected function restoreErrorLevel()
	{
		error_reporting($this->old_error_level);
	}

	// }}}
}

?>
