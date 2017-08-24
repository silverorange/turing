<?php

namespace Silverorange\Turing;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverElement;

abstract class AbstractComponent extends AbstractPage
{
    protected $el;

    public function __construct(RemoteWebDriver $wd, WebDriverElement $el)
    {
        parent::__construct($wd);
        $this->el = $el;
    }

    public function findElements(WebDriverBy $selector)
    {
        return $this->el->findElements($selector);
    }

    public function getEl()
    {
        return $this->el;
    }

    public function isDisplayed()
    {
        return $this->getEl()->isDisplayed();
    }
}
