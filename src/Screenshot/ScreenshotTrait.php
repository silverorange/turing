<?php

namespace Silverorange\Turing\Screenshot;

use Facebook\WebDriver\WebDriverElement;
use Facebook\WebDriver\Interactions\WebDriverActions;

/**
 * @package   Turing
 * @copyright 2017-2018 silverorange
 */
trait ScreenshotTrait
{
    // {{{ protected function takeScreenshotByClass()

    protected function takeScreenshotByClass($className, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $padding,
            $this->findByClass($className)
        );
    }

    // }}}
    // {{{ protected function takeScreenshotByCss()

    protected function takeScreenshotByCss($cssSelector, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $padding,
            $this->findByCss($cssSelector)
        );
    }

    // }}}
    // {{{ protected function takeScreenshotById()

    protected function takeScreenshotById($id, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $padding,
            $this->findById($id)
        );
    }

    // }}}
    // {{{ protected function takeScreenshotByName()

    protected function takeScreenshotByName($name, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $padding,
            $this->findByName($name)
        );
    }

    // }}}
    // {{{ protected function takeScreenshotByLinkText()

    protected function takeScreenshotByLinkText($linkText, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $padding,
            $this->findByLinkText($linkText)
        );
    }

    // }}}
    // {{{ protected function takeScreenshotByPartialLinkText()

    protected function takeScreenshotByPartialLinkText($partialLinkText, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $padding,
            $this->findByPartialLinkText($partialLinkText)
        );
    }

    // }}}
    // {{{ protected function takeScreenshotByTag()

    protected function takeScreenshotByTag($tagName, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $padding,
            $this->findByTag($tagName)
        );
    }

    // }}}
    // {{{ protected function takeScreenshotByXpath()

    protected function takeScreenshotByXpath($xpath, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $padding,
            $this->findByXpath($xpath)
        );
    }

    // }}}
    // {{{ protected function takeScreenshot()

    protected function takeScreenshot(
        $filename,
        $padding = 0,
        WebDriverElement $element = null
    ) {
        // de-focus any selected elements
        $body = $this->findByTag('body');
        $action = new WebDriverActions($this->wd);
        $action->moveToElement($body, 0, 0)->click()->perform();

        $element = null;

        if (!$element instanceof WebDriverElement) {
            $element = $this->findByTag('body');
        }

        $taker = new Taker($this->wd);
        $screenshot = $taker->take($element, $padding);

        $path = getenv('SCREENSHOTS_PATH') ?: 'tests/screenshots';
        $path = $this->getProjectRoot() . '/' . $path;
        copy($screenshot, $path . '/' . $filename . '.png');
    }

    // }}}
}
