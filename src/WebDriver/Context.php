<?php

namespace Silverorange\Turing\WebDriver;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverElement;
use Lmc\Steward\Test\SyntaxSugarTrait;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class Context
{
    use SyntaxSugarTrait;
    use PseudoElementTrait;

    // {{{ protected properties

    /**
     * @var Facebook\WebDriver\WebDriverElement
     */
    protected $el = null;

    /**
     * @var Facebook\WebDriver\WebDriver
     */
    protected $wd = null;

    /**
     * @var Facebook\WebDriver\WebDriverSearchContext
     */
    protected $context;

    // }}}
    // {{{ public function __construct()

    public function __construct(WebDriver $wd, WebDriverElement $el = null)
    {
        $this->wd = $wd;
        $this->el = $el;

        $this->context = ($el instanceof WebDriverElement) ? $el : $wd;
    }

    // }}}
    // {{{ public function findByClass()

    /**
     * Locates element whose class name contains the search value; compound class names are not permitted.
     *
     * @param string $className
     * @throws NoSuchElementException
     * @return RemoteWebElement The first element located using the mechanism. Exception is thrown if no element found.
     */
    public function findByClass($className)
    {
        return $this->context->findElement(WebDriverBy::className($className));
    }

    // }}}
    // {{{ public function findMultipleByClass()

    /**
     * Locates all elements whose class name contains the search value; compound class names are not permitted.
     *
     * @param string $className
     * @return RemoteWebElement[] A list of all elements, or an empty array if nothing matches
     */
    public function findMultipleByClass($className)
    {
        return $this->context->findElements(WebDriverBy::className($className));
    }

    // }}}
    // {{{ public function hasByClass()

    public function hasByClass($className)
    {
        return (count($this->findMultipleByClass($className)) > 0);
    }

    // }}}
    // {{{ public function findByCss()

    /**
     * Locates element matching a CSS selector.
     *
     * @param string $cssSelector
     * @throws NoSuchElementException
     * @return RemoteWebElement The first element located using the mechanism. Exception is thrown if no element found.
     */
    public function findByCss($cssSelector)
    {
        return $this->context->findElement(WebDriverBy::cssSelector($cssSelector));
    }

    // }}}
    // {{{ public function findMultipleByCss()

    /**
     * Locates all elements matching a CSS selector.
     *
     * @param string $cssSelector
     * @return RemoteWebElement[] A list of all elements, or an empty array if nothing matches
     */
    public function findMultipleByCss($cssSelector)
    {
        return $this->context->findElements(WebDriverBy::cssSelector($cssSelector));
    }

    // }}}
    // {{{ public function hasByCss()

    public function hasByCss($cssSelector)
    {
        return (count($this->findMultipleByCss($cssSelector)) > 0);
    }

    // }}}
    // {{{ public function findById()

    /**
     * Locates element whose ID attribute matches the search value.
     *
     * @param string $id
     * @throws NoSuchElementException
     * @return RemoteWebElement The first element located using the mechanism. Exception is thrown if no element found.
     */
    public function findById($id)
    {
        return $this->context->findElement(WebDriverBy::id($id));
    }

    // }}}
    // {{{ public function findMultipleById()

    /**
     * Locates all elements whose ID attribute matches the search value.
     *
     * @param string $id
     * @return RemoteWebElement[] A list of all elements, or an empty array if nothing matches
     */
    public function findMultipleById($id)
    {
        return $this->context->findElements(WebDriverBy::id($id));
    }

    // }}}
    // {{{ public function hasById()

    public function hasById($id)
    {
        return (count($this->findMultipleById($id)) > 0);
    }

    // }}}
    // {{{ public function findByName()

    /**
     * Locates element whose NAME attribute matches the search value.
     *
     * @param string $name
     * @throws NoSuchElementException
     * @return RemoteWebElement The first element located using the mechanism. Exception is thrown if no element found.
     */
    public function findByName($name)
    {
        return $this->context->findElement(WebDriverBy::name($name));
    }

    // }}}
    // {{{ public function findMultipleByName()

    /**
     * Locates all elements whose NAME attribute matches the search value.
     *
     * @param string $name
     * @return RemoteWebElement[] A list of all elements, or an empty array if nothing matches
     */
    public function findMultipleByName($name)
    {
        return $this->context->findElements(WebDriverBy::name($name));
    }

    // }}}
    // {{{ public function hasByName()

    public function hasByName($name)
    {
        return (count($this->findMultipleByName($name)) > 0);
    }

    // }}}
    // {{{ public function findByLinkText()

    /**
     * Locates anchor element whose visible text matches the search value.
     *
     * @param string $linkText
     * @throws NoSuchElementException
     * @return RemoteWebElement The first element located using the mechanism. Exception is thrown if no element found.
     */
    public function findByLinkText($linkText)
    {
        return $this->context->findElement(WebDriverBy::linkText($linkText));
    }

    // }}}
    // {{{ public function findMultipleByLinkText()

    /**
     * Locates all anchor elements whose visible text matches the search value.
     *
     * @param string $linkText
     * @return RemoteWebElement[] A list of all elements, or an empty array if nothing matches
     */
    public function findMultipleByLinkText($linkText)
    {
        return $this->context->findElements(WebDriverBy::linkText($linkText));
    }

    // }}}
    // {{{ public function hasByLinkText()

    public function hasByLinkText($linkText)
    {
        return (count($this->findMultipleByLinkText($linkText)) > 0);
    }

    // }}}
    // {{{ public function findByPartialLinkText()

    /**
     * Locates anchor element whose visible text partially matches the search value.
     *
     * @param string $partialLinkText
     * @throws NoSuchElementException
     * @return RemoteWebElement The first element located using the mechanism. Exception is thrown if no element found.
     */
    public function findByPartialLinkText($partialLinkText)
    {
        return $this->context->findElement(WebDriverBy::partialLinkText($partialLinkText));
    }

    // }}}
    // {{{ public function findMultipleByPartialLinkText()

    /**
     * Locates all anchor elements whose visible text partially matches the search value.
     *
     * @param string $partialLinkText
     * @return RemoteWebElement[] A list of all elements, or an empty array if nothing matches
     */
    public function findMultipleByPartialLinkText($partialLinkText)
    {
        return $this->context->findElements(WebDriverBy::partialLinkText($partialLinkText));
    }

    // }}}
    // {{{ public function hasByPartialLinkText()

    public function hasByPartialLinkText($partialLinkText)
    {
        return (count($this->findMultipleByPartialLinkText($partialLinkText)) > 0);
    }

    // }}}
    // {{{ public function findByTag()

    /**
     * Locates element whose tag name matches the search value.
     *
     * @param string $tagName
     * @throws NoSuchElementException
     * @return RemoteWebElement The first element located using the mechanism. Exception is thrown if no element found.
     */
    public function findByTag($tagName)
    {
        return $this->context->findElement(WebDriverBy::tagName($tagName));
    }

    // }}}
    // {{{ public function findMultipleByTag()

    /**
     * Locates all elements whose tag name matches the search value.
     *
     * @param string $tagName
     * @return RemoteWebElement[] A list of all elements, or an empty array if nothing matches
     */
    public function findMultipleByTag($tagName)
    {
        return $this->context->findElements(WebDriverBy::tagName($tagName));
    }

    // }}}
    // {{{ public function hasByTag()

    public function hasByTag($tagName)
    {
        return (count($this->findMultipleByTag($tagName)) > 0);
    }

    // }}}
    // {{{ public function findByXpath()

    /**
     * Locates element matching an XPath expression.
     *
     * @param string $xpath
     * @throws NoSuchElementException
     * @return RemoteWebElement The first element located using the mechanism. Exception is thrown if no element found.
     */
    public function findByXpath($xpath)
    {
        return $this->context->findElement(WebDriverBy::xpath($xpath));
    }

    // }}}
    // {{{ public function findMultipleByXpath()

    /**
     * Locates all elements matching an XPath expression.
     *
     * @param string $xpath
     * @return RemoteWebElement[] A list of all elements, or an empty array if nothing matches
     */
    public function findMultipleByXpath($xpath)
    {
        return $this->context->findElements(WebDriverBy::xpath($xpath));
    }

    // }}}
    // {{{ public function hasByXpath()

    public function hasByXpath($xpath)
    {
        return (count($this->findMultipleByXpath($xpath)) > 0);
    }

    // }}}
}
