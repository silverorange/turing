<?php

namespace Silverorange\Turing\Screenshot;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverElement;

/**
 * @package   Turing
 * @copyright 2017-2018 silverorange
 */
class Taker
{
    // {{{ protected properties

    /**
     * @var Facebook\WebDriver\WebDriver
     */
    protected $driver = null;

    // }}}
    // {{{ public function __construct()

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    // }}}
    // {{{ public function take()

    public function take(WebDriverElement $element = null, $padding = 0)
    {
        $screenshot = $this->getTemporaryFilename();
        $this->driver->takeScreenshot($screenshot);

        if (!file_exists($screenshot)) {
            throw new \Exception('Could not save screenshot');
        }

        if ($element instanceof WebDriverElement) {
            $screenshot = $this->cropElementScreenshot(
                $screenshot,
                $element,
                $padding
            );
        }

        return $screenshot;
    }

    // }}}
    // {{{ protected function cropElementScreenshot()

    protected function cropElementScreenshot(
        $full_screenshot,
        WebDriverElement $element,
        $padding = 0
    ) {
        $element_screenshot = $this->getTemporaryFilename();

        $element_width = $element->getSize()->getWidth();
        $element_height = $element->getSize()->getHeight();

        $element_src_x = $element->getLocation()->getX();
        $element_src_y = $element->getLocation()->getY();

        // Create image instances
        $src = imagecreatefrompng($full_screenshot);
        $dest = imagecreatetruecolor(
            $element_width + ($padding * 2),
            $element_height + ($padding * 2)
        );

        // Copy
        imagecopy(
            $dest,
            $src,
            0,
            0,
            $element_src_x - $padding,
            $element_src_y - $padding,
            $element_width + ($padding * 2),
            $element_height + ($padding * 2)
        );

        imagepng($dest, $element_screenshot);

        // Remove full screenshot.
        unlink($full_screenshot);

        if (!file_exists($element_screenshot)) {
            throw new \Exception('Could not save element screenshot');
        }

        return $element_screenshot;
    }

    // }}}
    // {{{ protected function getTemporaryFilename()

    protected function getTemporaryFilename()
    {
        return tempnam(sys_get_temp_dir(), 'webdriver') . '.png';
    }

    // }}}
}
