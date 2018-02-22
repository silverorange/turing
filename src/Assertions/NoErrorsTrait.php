<?php

namespace Silverorange\Turing\Assertions;

use Facebook\WebDriver\WebDriverBy;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
trait NoErrorsTrait
{
    // {{{ protected function assertNoErrors()

    protected function assertNoErrors()
    {
        $this->assertNoExceptions();
        $this->assertNoXdebugErrors();
        $this->assertNoLessErrors();
    }

    // }}}
    // {{{ protected function assertNoExceptions()

    protected function assertNoExceptions()
    {
        $this->assertEmpty(
            $this->findMultipleByXpath('//div[@class=\'swat-exception\']'),
            'One or more exceptions are present on the page.'
        );
    }

    // }}}
    // {{{ protected function assertNoXdebugErrors()

    protected function assertNoXdebugErrors()
    {
        $this->assertEmpty(
            $this->findMultipleByXpath('//table[@class=\'xdebug-error\']'),
            'One or more xdebug errors are present on the page.'
        );
    }

    // }}}
    // {{{ protected function assertNoLessErrors()

    protected function assertNoLessErrors()
    {
        $this->assertEmpty(
            $this->findMultipleByXpath('//div[@class=\'less-error-message\']'),
            'One or more LESS CSS errors are present on the page.'
        );
    }

    // }}}
}
