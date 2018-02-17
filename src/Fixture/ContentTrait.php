<?php

namespace Silverorange\Turing\Fixture;

/**
 * @package   Turing
 * @copyright 2018 silverorange
 */
trait ContentTrait
{
    // {{{ protected function getContent()

    protected function getContent($filename)
    {
        $path = getenv('CONTENT_PATH');
        if ($path === false) {
            $path = 'tests/content';
        }
        return trim(file_get_contents($path . '/' . $filename));
    }

    // }}}
}
