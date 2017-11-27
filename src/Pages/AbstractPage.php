<?php

namespace Silverorange\Turing\Components;

use Facebook\WebDriver\WebDriver;
use Silverorange\Turing\WebDriver\Context;
use Silverorange\Turing\WebDriver\ContextSugarTrait;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class AbstractPage
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

    // }}}
    // {{{ public function __construct()

    public function __construct(WebDriver $wd)
    {
        $this->wd = $wd;
        $this->context = new Context($wd);
    }

    // }}}
    // {{{ public function getTitle()

    public function getTitle()
    {
        return $this->wd->getTitle();
    }

    // }}}
    // {{{ public function getURL()

    public function getURL()
    {
        return $this->wd->getCurrentURL();
    }

    // }}}
    // {{{ public function refresh()

    public function refresh()
    {
        $this->wd->navigate()->refresh();
    }

    // }}}
}
