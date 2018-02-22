<?php

namespace Silverorange\Turing\Assertions;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\TimeOutException;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
trait NoTimeOutTrait
{
    // {{{ protected function assertNoTimeOut()

    protected function assertNoTimeOut(callable $action, $message)
    {
        $success = true;

        try {
            call_user_func($action);
        } catch (TimeOutException $e) {
            $success = false;
        }

        $this->assertTrue($success, $message);
    }

    // }}}
}
