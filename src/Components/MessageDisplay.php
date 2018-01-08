<?php

namespace Silverorange\Turing\Components;

use Facebook\WebDriver\WebDriverBy;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class MessageDisplay extends AbstractComponent
{
    public function getMessages()
    {
        return array_map(
            function ($el) {
                return new Message($this->wd, $el);
            },
            $this->findMultipleByClassName('swat-message')
        );
    }
}
