<?php

/**
 * @package   Turing
 * @copyright 2018 silverorange
 */
trait ContentTrait
{
    // {{{ protected function getContent()

    protected function getContent($filename)
    {
        $path = $this->config->get('content.path');
        return trim(file_get_contents($path . '/' . $filename));
    }

    // }}}
}
