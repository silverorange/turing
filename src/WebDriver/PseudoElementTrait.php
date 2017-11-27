<?php

namespace Silverorange\Turing\WebDriver;

use Facebook\WebDriver\WebDriverElement;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
trait PseudoElementTrait
{
    // {{{ public function getBeforePseudoElement()

    public function getBeforePseudoElement(WebDriverElement $element)
    {
        return $this->wd->executeScript(
            "return window.getComputedStyle(arguments[0], '::before').getPropertyValue('content');",
            [$element]
        );
    }

    // }}}
    // {{{ public function getAfterPseudoElement()

    public function getAfterPseudoElement(WebDriverElement $element)
    {
        return $this->wd->executeScript(
            "return window.getComputedStyle(arguments[0], '::after').getPropertyValue('content');",
            [$element]
        );
    }

    // }}}
}
