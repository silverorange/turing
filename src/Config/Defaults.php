<?php

namespace Silverorange\Turing\Config;

use Noodlehaus\Config;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class Defaults extends Config
{
    // {{{ protected function getDefaults()

    protected function getDefaults()
    {
        return [
            'development' => $this->getEnvironmentDefaults(),
            'stage' => $this->getEnvironmentDefaults(),
            'production' => $this->getEnvironmentDefaults(),
        ];
    }

    // }}}
    // {{{ protected function getEnvironmentDefaults()

    protected function getEnvironmentDefaults()
    {
        return [
            'baseURL' => 'https://www.google.com',
            'mobile' => [
                'width' => 320,
                'height' => 583,
            ],
            'database' => [
                'dsn' => '',
            ],
        ];
    }

    // }}}
}
