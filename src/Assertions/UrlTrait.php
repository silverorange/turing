<?php

namespace Silverorange\Turing\Assertions;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\TimeOutException;
use League\Uri;
use League\Uri\Exception as UriException;
use League\Uri\Components\HierarchicalPath;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
trait UrlTrait
{
    // {{{ protected function assertCurrentURLEquals()

    protected function assertCurrentURLEquals($expectedURL, $message)
    {
        $currentURL = Uri\create($this->wd->getCurrentURL());
        $expectedURL = $this->getNormalizedURL($expectedURL);

        $this->assertEquals(
            (string)$expectedURL,
            (string)$currentURL,
            $message
        );
    }

    // }}}
    // {{{ protected function assertURLEquals()

    protected function assertURLEquals($expectedURL, $actualURL, $message)
    {
        $actualURL = $this->getNormalizedURL($actualURL);
        $expectedURL = $this->getNormalizedURL($expectedURL);

        $this->assertEquals(
            (string)$expectedURL,
            (string)$actualURL,
            $message
        );
    }

    // }}}
    // {{{ protected function getNormalizedURL()

    protected function getNormalizedURL($url)
    {
        try {
            $url = Uri\create($url);
        } catch (UriException $e) {
            $path = new HierarchicalPath($url);
            $basePath = new HierarchicalPath($this->baseURL->getPath());
            $url = $this->baseURL->withPath((string)$basePath->append($path));
        }
    }

    // }}}
}
