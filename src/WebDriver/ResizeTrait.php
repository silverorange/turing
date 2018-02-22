<?php

namespace Silverorange\Turing\WebDriver;

use Facebook\WebDriver\WebDriverDimension;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
trait ResizeTrait
{
    // {{{ protected function resizeToMobile()

    protected function resizeToMobile()
    {
        $this->wd->manage()->window()->setSize($this->$mobileDimension);
    }

    // }}}
    // {{{ protected function maximize()

    protected function maximize()
    {
        $this->wd->manage()->window()->maximize();
    }

    // }}}
}
