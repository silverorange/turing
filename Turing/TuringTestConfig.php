<?php

/**
 * @package   Turing
 * @copyright 2012-2016 silverorange
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
	 * @var string
	 */
	protected $screenshot_path = '';

	/**
	 * @var string
	 */
	protected $screenshot_url = '';

	/**
	 * @var string
	 */
	protected $selenium_host = 'localhost';

	/**
	 * @var integer
	 */
	protected $selenium_port = 4444;

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
	// {{{ public function getScreenshotPath()

	public function getScreenshotPath()
	{
		return $this->screenshot_path;
	}

	// }}}
	// {{{ public function getScreenshotUrl()

	public function getScreenshotUrl()
	{
		return $this->screenshot_url;
	}

	// }}}
	// {{{ public function getSeleniumHost()

	public function getSeleniumHost()
	{
		return $this->selenium_host;
	}

	// }}}
	// {{{ public function getSeleniumPort()

	public function getSeleniumPort()
	{
		return $this->selenium_port;
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

		if (isset($config['screenshot_path'])) {
			$this->screenshot_path = $config['screenshot_path'];
		}

		if (isset($config['screenshot_url'])) {
			$this->screenshot_url = $config['screenshot_url'];
		}

		if (isset($config['selenium_host'])) {
			$this->selenium_host = $config['selenium_host'];
		}

		if (isset($config['selenium_port'])) {
			$this->selenium_port = (integer)$config['selenium_port'];
		}
	}

	// }}}
}

?>
