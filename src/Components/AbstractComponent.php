<?php

namespace Silverorange\Turing\Components;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverElement;
use Silverorange\Turing\WebDriver\Context;
use Silverorange\Turing\WebDriver\ContextSugarTrait;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class AbstractComponent
{
    use ContextSugarTrait;

    // {{{ protected properties

    /**
     * @var Silverorange\Turing\WebDriver\Context
     */
    protected $context = null;

    /**
     * @var Facebook\WebDriver\WebDriver
     */
    protected $wd = null;

    /**
     * @var Facebook\WebDriver\WebDriverElement
     */
    protected $el = null;

    // }}}
    // {{{ public function __construct()

    public function __construct(WebDriver $wd, WebDriverElement $el)
    {
        $this->context = new Context($wd, $el);
        $this->wd = $wd;
        $this->el = $el;
    }

    // }}}
    // {{{ public function getEl()

    public function getEl()
    {
        return $this->el;
    }

    // }}}
}
