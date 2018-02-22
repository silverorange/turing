<?php

namespace Silverorange\Turing\WebDriver;

/**
 * @package   Turing
 * @copyright 2017-2018 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
trait HasElementTrait
{
    // {{{ public function hasByClass()

    public function hasByClass($className)
    {
        return (count($this->findMultipleByClass($className)) > 0);
    }

    // }}}
    // {{{ public function hasByCss()

    public function hasByCss($cssSelector)
    {
        return (count($this->findMultipleByCss($cssSelector)) > 0);
    }

    // }}}
    // {{{ public function hasById()

    public function hasById($id)
    {
        return (count($this->findMultipleById($id)) > 0);
    }

    // }}}
    // {{{ public function hasByName()

    public function hasByName($name)
    {
        return (count($this->findMultipleByName($name)) > 0);
    }

    // }}}
    // {{{ public function hasByLinkText()

    public function hasByLinkText($linkText)
    {
        return (count($this->findMultipleByLinkText($linkText)) > 0);
    }

    // }}}
    // {{{ public function hasByPartialLinkText()

    public function hasByPartialLinkText($partialLinkText)
    {
        return (count($this->findMultipleByPartialLinkText($partialLinkText)) > 0);
    }

    // }}}
    // {{{ public function hasByTag()

    public function hasByTag($tagName)
    {
        return (count($this->findMultipleByTag($tagName)) > 0);
    }

    // }}}
    // {{{ public function hasByXpath()

    public function hasByXpath($xpath)
    {
        return (count($this->findMultipleByXpath($xpath)) > 0);
    }

    // }}}
}
