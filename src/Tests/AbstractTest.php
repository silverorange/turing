<?php

namespace Silverorange\Turing\Tests;

use Facebook\WebDriver\WebDriverDimension;
use Lmc\Steward\ConfigProvider;
use Lmc\Steward\Test\AbstractTestCase as StewardAbstractTestCase;
use League\Uri;
use League\Uri\Components\HierarchicalPath;
use League\Uri\Exception as UriException;
use Silverorange\Turing\Config\Defaults as ConfigDefaults;
use Silverorange\Turing\Config\Environment as ConfigEnvironment;
use Silverorange\Turing\Url\Normalizer;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class AbstractTest extends StewardAbstractTestCase
{
    // {{{ protected properties

    /**
     * @var Facebook\WebDriver\WebDriverDimension
     */
    protected $mobileDimension = null;

    /**
     * @var League\Uri\Interfaces\Uri
     */
    protected $baseURL = null;

    /**
     * @var Silverorange\Turing\Config\Environment
     */
    protected $config = null;

    // }}}
    // {{{ public function setUp()

    public function setUp()
    {
        parent::setUp();

        // Load environment-specific config values.
        $this->config = $this->getConfig(ConfigProvider::getInstance()->env);

        // Create base URL.
        $this->baseURL = Uri\create($this->config->get('baseURL'));
        $this->debug('Base URL set to "%s"', $this->baseURL);

        // Create mobile dimensions.
        $this->mobileDimension = new WebDriverDimension(
            $this->config->get('mobile.width'),
            $this->config->get('mobile.height')
        );

        if (ConfigProvider::getInstance()->env === 'production') {
            $this->warn('The tests are run against production, so be careful!');
        }
    }

    // }}}
    // {{{ protected function getConfig()

    protected function getConfig($environment)
    {
        $config = new ConfigDefaults(
            $this->getProjectRoot() . 'tests/config.json'
        );

        $environmentData = $config->get($environment);
        if ($environmentData === null) {
            $this->warn('No config for "%s" was found. Using "development".', $environment);
            $environmentData = $config->get('development');
        }

        // Support environment-specific overrides of config values.
        $environmentBaseURL = getenv('SELENIUM_URL');
        if ($environmentBaseURL !== false) {
            $environmentData->set('baseURL', $environmentBaseURL);
        }

        return new ConfigEnvironment($environmentData);
    }

    // }}}
    // {{{ protected function getProjectRoot()

    protected function getProjectRoot()
    {
        return dirname(dirname(dirname(dirname(dirname(__DIR__)))));
    }

    // }}}
    // {{{ protected function loadURL()

    protected function loadURL($url)
    {
        $this->wd->get($this->getNormalizedUrl($url));
    }

    // }}}
    // {{{ protected function getNormalizedUrl()

    protected function getNormalizedUrl($url)
    {
        return (new Normalizer($this->baseURL))->getUrl($url);
    }

    // }}}
}
