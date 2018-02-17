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
            $this->findByClass($className),
            $padding
        );
    }

    // }}}
    // {{{ protected function takeScreenshotByCss()

    protected function takeScreenshotByCss($cssSelector, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $this->findByCss($cssSelector),
            $padding
        );
    }

    // }}}
    // {{{ protected function takeScreenshotById()

    protected function takeScreenshotById($id, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $this->findById($id),
            $padding
        );
    }

    // }}}
    // {{{ protected function takeScreenshotByName()

    protected function takeScreenshotByName($name, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $this->findByName($name),
            $padding
        );
    }

    // }}}
    // {{{ protected function takeScreenshotByLinkText()

    protected function takeScreenshotByLinkText($linkText, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $this->findByLinkText($linkText),
            $padding
        );
    }

    // }}}
    // {{{ protected function takeScreenshotByPartialLinkText()

    protected function takeScreenshotByPartialLinkText($partialLinkText, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $this->findByPartialLinkText($partialLinkText),
            $padding
        );
    }

    // }}}
    // {{{ protected function takeScreenshotByTag()

    protected function takeScreenshotByTag($tagName, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $this->findByTag($tagName),
            $padding
        );
    }

    // }}}
    // {{{ protected function takeScreenshotByXpath()

    protected function takeScreenshotByXpath($xpath, $filename, $padding = 0)
    {
        return $this->takeScreenshot(
            $filename,
            $this->findByXpath($xpath),
            $padding
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
