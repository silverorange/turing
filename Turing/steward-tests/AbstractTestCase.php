<?php

namespace Silverorange\Turing;

use Lmc\Steward\ConfigProvider;
use Lmc\Steward\Test\AbstractTestCase as StewardAbstractTestCase;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverElement;
use Facebook\WebDriver\WebDriverDimension;

abstract class AbstractTestCase extends StewardAbstractTestCase
{
	/** @var int Default width of browser window (Steward's default is 1280) */
	public static $browserWidth = 1024;

	/** @var int Default height of browser window (Steward's default is 1024) */
	public static $browserHeight = 768;

	/** @var int Width of browser window for mobile display */
	public static $mobileBrowserWidth = 600;

	/** @var string */
	public static $baseUrl;

	public function loadURL($url)
	{
		return $this->wd->get(Utils\URL::normalize(self::$baseUrl, $url));
	}

	public function setUp()
	{
		parent::setUp();

		// Set base URL according to environment
		$this->getBaseUrlFromEnvironment(ConfigProvider::getInstance()->env);

		$this->debug('Base URL set to "%s"', self::$baseUrl);

		if (ConfigProvider::getInstance()->env == 'production') {
			$this->warn('The tests are run against production, so be careful!');
		}
	}

	protected function getBaseUrlFromEnvironment($environment)
	{
		switch ($environment) {
		case 'local':
			self::$baseUrl = 'http://localhost/';
				break;
		case 'jenkins':
			self::$baseUrl = getenv('selenium_url');
				break;
		default:
			throw new \RuntimeException(
				sprintf('Unknown environment "%s"', ConfigProvider::getInstance()->env)
			);
		}
	}

	protected function assertNoErrors()
	{
		$this->assertNoExceptions();
		$this->assertNoXDebugErrors();
		$this->assertNoLESSErrors();
	}

	protected function assertNoLESSErrors()
	{
		$this->assertEmpty(
			$this->wd->findElements(WebDriverBy::xpath('//div[@class=\'less-error-message\']')),
			'One or more LESS CSS errors are present on the page.'
		);
	}

	protected function assertNoExceptions()
	{
		$this->assertEmpty(
			$this->wd->findElements(WebDriverBy::xpath('//div[@class=\'swat-exception\']')),
			'One or more exceptions are present on the page.'
		);
	}

	protected function assertNoXDebugErrors()
	{
		$this->assertEmpty(
			$this->wd->findElements(WebDriverBy::xpath('//table[@class=\'xdebug-error\']')),
			'One or more xdebug errors are present on the page.'
		);
	}

	protected function assertElementExists(WebDriverBy $by, $message)
	{
		$elements = $this->wd->findElements($by);
		$this->assertNotEmpty($elements, $message);
	}

	protected function assertElementDoesNotExist(WebDriverBy $by, $message)
	{
		$elements = $this->wd->findElements($by);
		$this->assertEmpty($elements, $message);
	}

	protected function assertNoTimeout(callable $action, $message)
	{
		$success = true;

		try {
			call_user_func($action);
		} catch (TimeOutException $e) {
			$success = false;
		}

		$this->assertTrue($success, $message);
	}

	protected function assertCurrentURLEquals($url, $message)
	{
		$url = Utils\URL::normalize(self::$baseUrl, $url);
		$this->assertEquals(
			$url,
			$this->wd->getCurrentURL(),
			$message
		);
	}

	protected function assertURLEquals($expectedURL, $actualURL, $message)
	{
		$expectedURL = Utils\URL::normalize(self::$baseUrl, $expectedURL);
		$this->assertEquals(
			$expectedURL,
			$actualURL,
			$message
		);
	}

	protected function clearFields(array $fieldsToClear)
	{
		foreach ($fieldsToClear as $fieldBy) {
			$this->wd->findElement($fieldBy)->clear();
		}
	}

	protected function getBeforePseudoElementContent(WebDriverElement $element)
	{
		return $this->wd->executeScript(
			"return window.getComputedStyle(arguments[0], '::before').getPropertyValue('content');",
			[$element]
		);
	}

	protected function setBrowserSizeToMobile()
	{
		$this->wd->manage()->window()->setSize(
			new WebDriverDimension(self::$mobileBrowserWidth, self::$browserHeight)
		);
	}

	protected function setBrowserSizeToDefault()
	{
		$this->wd->manage()->window()->setSize(
			new WebDriverDimension(self::$browserWidth, self::$browserHeight)
		);
	}

	protected function refreshPage()
	{
		$this->wd->navigate()->refresh();
	}

}

?>
