<?php

namespace Silverorange\Turing\Assertions;

use Silverorange\Turing\Url\Normalizer;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\TimeOutException;
use League\Uri;

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
        $expectedURL = (new Normalizer($this->baseURL))->getUrl($expectedURL);

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
        $normalizer = new Normalizer($this->baseURL);
        $actualURL = $normalizer->getUrl($actualURL);
        $expectedURL = $normalizer->getUrl($expectedURL);

        $this->assertEquals(
            (string)$expectedURL,
            (string)$actualURL,
            $message
        );
    }

    // }}}
}
