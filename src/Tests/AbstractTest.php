<?php

namespace Silverorange\Turing\Tests;

use Facebook\WebDriver\WebDriverDimension;
use Lmc\Steward\Component\TestUtils;
use Lmc\Steward\ConfigProvider;
use Lmc\Steward\Test\AbstractTestCase as StewardAbstractTestCase;
use League\Uri;
use League\Uri\Components\HierarchicalPath;
use League\Uri\Exception as UriException;
use Silverorange\Turing\Config\Defaults as ConfigDefaults;
use Silverorange\Turing\Config\Environment as ConfigEnvironment;
use Silverorange\Turing\Url\Normalizer;
use Silverorange\Turing\WebDriver\HasElementTrait;
use Silverorange\Turing\WebDriver\PseudoElementTrait;
use Silverorange\Turing\WebDriver\ResizeTrait;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class AbstractTest extends StewardAbstractTestCase
{
    use HasElementTrait;
    use PseudoElementTrait;
    use ResizeTrait;

    // {{{ protected properties

    /**
     * @var Facebook\WebDriver\WebDriverDimension
     */
    protected $mobileDimension = null;

    /**
     * @var League\Uri\Interfaces\Uri
     */
    protected $baseURL = null;

    // }}}
    // {{{ public function setUp()

    public function setUp()
    {
        // Don't call parent method here because we want to skip the browser
        // resize. Browser resizing causes issues in latest Selenium and
        // Chromedriver versions. This also lets us use externally specified
        // dimensions in headless Chrome mode.

        $this->log(
            'Starting execution of test ' .
            get_called_class() . '::' . $this->getName()
        );

        $this->utils = new TestUtils($this);

        // Create base URL.
        $this->baseURL = Uri\create(getenv('SELENIUM_URL'));
        $this->debug('Base URL set to "%s"', $this->baseURL);

        // Create mobile dimensions.
        $this->mobileDimension = new WebDriverDimension(
            getenv('SELENIUM_MOBILE_WIDTH') ?: 320,
            getenv('SELENIUM_MOBILE_HEIGHT') ?: 583
        );

        if (ConfigProvider::getInstance()->env === 'production') {
            $this->warn('The tests are run against production, so be careful!');
        }
    }

    // }}}
    // {{{ protected function getProjectRoot()

    protected function getProjectRoot()
    {
        $dir = dirname($_SERVER['PHP_SELF']);

        // Since test cases run in a separate process, this is the path from
        // the steward bin file.
        return dirname(dirname(dirname(dirname($dir))));
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
