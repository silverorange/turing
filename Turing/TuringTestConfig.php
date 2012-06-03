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
	protected $domain = '';

	/**
	 * @var string
	 */
	protected $filename = '';

	/**
	 * @var PHPUnit_Framework_TestCase
	 */
	protected $test = null;

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
	}

	// }}}
	// {{{ public function tearDown()

	public function tearDown()
	{
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
	// {{{ public function getDomain()

	public function getDomain()
	{
		return $this->domain;
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
			|| !isset($config['base_href'])
		) {
			$this->test->markTestSkipped(
				'Functional test configuration is missing or incorrect.'
			);
		}

		if (isset($config['instance'])) {
			$this->instance = $config['instance'];
		}

		if (isset($config['domain'])) {
			$this->domain = $config['domain'];
		}

		if (strpos($config['base_href'], '%s') === false) {
			$this->base_href = $config['base_href'];
		} elseif ($this->instance == '') {
			$this->base_href = sprintf(
				$config['base_href'],
				$config['working_dir']
			);
		} else {
			$this->base_href = sprintf(
				$config['base_href'],
				$this->instance,
				$config['working_dir']
			);
		}
	}

	// }}}
}

?>
