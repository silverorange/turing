<?php

namespace Silverorange\WebDriver\Context;

use Facebook\WebDriver\WebDriverElement;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
trait ContextSugarTrait
{
    // {{{ protected function findByClass()

    protected function findByClass($className)
    {
        return $this->context->findByClass($className);
    }

    // }}}
    // {{{ protected function findMultipleByClass()

    protected function findMultipleByClass($className)
    {
        return $this->context->findMultipleByClass($className);
    }

    // }}}
    // {{{ protected function hasByClass()

    protected function hasByClass($className)
    {
        return $this->context->hasByClass($className);
    }

    // }}}
    // {{{ protected function waitForClass()

    protected function waitForClass($className, $mustBeVisible = false)
    {
        return $this->context->waitForClass($className, $mustBeVisible);
    }

    // }}}
    // {{{ protected function findByCss()

    protected function findByCss($cssSelector)
    {
        return $this->context->findByCss($cssSelector);
    }

    // }}}
    // {{{ protected function findMultipleByCss()

    protected function findMultipleByCss($cssSelector)
    {
        return $this->context->findMultipleByCss($cssSelector);
    }

    // }}}
    // {{{ protected function hasByCss()

    protected function hasByCss($cssSelector)
    {
        return $this->hasByCss($cssSelector);
    }

    // }}}
    // {{{ protected function waitForCss()

    protected function waitForCss($cssSelector, $mustBeVisible = false)
    {
        return $this->context->waitForCss($cssSelector, $mustBeVisible);
    }

    // }}}
    // {{{ protected function findById()

    protected function findById($id)
    {
        return $this->context->findById($id);
    }

    // }}}
    // {{{ protected function findMultipleById()

    protected function findMultipleById($id)
    {
        return $this->context->findMultipleById($id);
    }

    // }}}
    // {{{ protected function hasById()

    protected function hasById($id)
    {
        return $this->hasById($id);
    }

    // }}}
    // {{{ protected function waitForId()

    protected function waitForId($id, $mustBeVisible = false)
    {
        return $this->context->waitForId($id, $mustBeVisible);
    }

    // }}}
    // {{{ protected function findByName()

    protected function findByName($name)
    {
        return $this->context->findByName($name);
    }

    // }}}
    // {{{ protected function findMultipleByName()

    protected function findMultipleByName($name)
    {
        return $this->context->findMultipleByName($name);
    }

    // }}}
    // {{{ protected function hasByName()

    protected function hasByName($name)
    {
        return $this->hasByName($name);
    }

    // }}}
    // {{{ protected function waitForName()

    protected function waitForName($name, $mustBeVisible = false)
    {
        return $this->context->waitForName($name, $mustBeVisible);
    }

    // }}}
    // {{{ protected function findByLinkText()

    protected function findByLinkText($linkText)
    {
        return $this->context->findByLinkText($linkText);
    }

    // }}}
    // {{{ protected function findMultipleByLinkText()

    protected function findMultipleByLinkText($linkText)
    {
        return $this->context->findMultipleByLinkText($linkText);
    }

    // }}}
    // {{{ protected function hasByLinkText()

    protected function hasByLinkText($linkText)
    {
        return $this->hasByLinkText($linkText);
    }

    // }}}
    // {{{ protected function waitForLinkText()

    protected function waitForLinkText($linkText, $mustBeVisible = false)
    {
        return $this->context->waitForLinkText($linkText, $mustBeVisible);
    }

    // }}}
    // {{{ protected function findByPartialLinkText()

    protected function findByPartialLinkText($partialLinkText)
    {
        return $this->context->findByPartialLinkText($partialLinkText);
    }

    // }}}
    // {{{ protected function findMultipleByPartialLinkText()

    protected function findMultipleByPartialLinkText($partialLinkText)
    {
        return $this->context->findMultipleByPartialLinkText($partialLinkText);
    }

    // }}}
    // {{{ protected function hasByPartialLinkText()

    protected function hasByPartialLinkText($partialLinkText)
    {
        return $this->hasByPartialLinkText($partialLinkText);
    }

    // }}}
    // {{{ protected function waitForPartialLinkText()

    protected function waitForPartialLinkText($partialLinkText, $mustBeVisible = false)
    {
        return $this->context->waitForPartialLinkText($partialLinkText, $mustBeVisible);
    }

    // }}}
    // {{{ protected function findByTag()

    protected function findByTag($tagName)
    {
        return $this->context->findByTag($tagName);
    }

    // }}}
    // {{{ protected function findMultipleByTag()

    protected function findMultipleByTag($tagName)
    {
        return $this->context->findMultipleByTag($tagName);
    }

    // }}}
    // {{{ protected function hasByTag()

    protected function hasByTag($tagName)
    {
        return $this->hasByTag($tagName);
    }

    // }}}
    // {{{ protected function waitForTag()

    protected function waitForTag($tagName, $mustBeVisible = false)
    {
        return $this->context->waitForTag($tagName, $mustBeVisible);
    }

    // }}}
    // {{{ protected function findByXpath()


    protected function findByXpath($xpath)
    {
        return $this->context->findByXpath($xpath);
    }

    // }}}
    // {{{ protected function findMultipleByXpath()

    protected function findMultipleByXpath($xpath)
    {
        return $this->context->findMultipleByXpath($xpath);
    }

    // }}}
    // {{{ protected function hasByXpath()

    protected function hasByXpath($xpath)
    {
        return $this->hasByXpath($xpath);
    }

    // }}}
    // {{{ protected function waitForXpath()

    protected function waitForXpath($xpath, $mustBeVisible = false)
    {
        return $this->context->waitForXpath($xpath, $mustBeVisible);
    }

    // }}}
    // {{{ protected function getBeforePseudoElement()

    protected function getBeforePseudoElement(WebDriverElement $element)
    {
        return $this->context->getBeforePseudoElement($element);
    }

    // }}}
    // {{{ protected function getAfterPseudoElement()

    protected function getAfterPseudoElement(WebDriverElement $element)
    {
        return $this->context->getAfterPseudoElement($element);
    }

    // }}}
}
