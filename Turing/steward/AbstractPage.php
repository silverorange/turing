<?php

namespace Silverorange\Turing;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverElement;
use Facebook\WebDriver\WebDriverSearchContext;

abstract class AbstractPage implements WebDriverSearchContext
{
    protected $wd;

    public function __construct(RemoteWebDriver $wd)
    {
        $this->wd = $wd;
    }

    public function getTitle()
    {
        return $this->wd->getTitle();
    }

    public function findElement(WebDriverBy $selector)
    {
        $element = null;
        $elements = $this->findElements($selector);
        if (count($elements) > 0) {
            $element = $elements[0];
        }
        return $element;
    }

    public function findElements(WebDriverBy $selector)
    {
        return $this->wd->findElements($selector);
    }

    protected function clearFields(array $fieldsToClear)
    {
        foreach ($fieldsToClear as $field) {
            $field->clear();
        }
    }

    public function getText(WebDriverBy $selector)
    {
        $text = null;
        $el = $this->findElement($selector);
        if ($el !== null) {
            $text = $el->getText();
        }
        return $text;
    }

    public function getBeforePseudoElement(WebDriverElement $element)
    {
        return $this->wd->executeScript(
            "return window.getComputedStyle(arguments[0], '::before').getPropertyValue('content');",
            [$element]
        );
    }
}
