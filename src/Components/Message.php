<?php

namespace Silverorange\Turing\Components;

use Facebook\WebDriver\WebDriverBy;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class Message extends AbstractComponent
{
    public function getPrimaryContentText()
    {
        return $this
            ->findByClass('swat-message-primary-content')
            ->getText();
    }

    public function getSecondaryContentText()
    {
        return $this
            ->findByClass('swat-message-secondary-content')
            ->getText();
    }

    public function getSecondaryContentBulletPoint($bulletNumber)
    {
        $xpath = "//div[@class='swat-message-secondary-content']/ul/li[" .
            $bulletNumber . "]";

        $this->findByXpath($xpath)->getText();
    }

    public function getText()
    {
        return $this->getEl()->getText();
    }

    public function getSecondaryContentLink()
    {
        return $this->findByXpath(
            "//div[@class='swat-message-secondary-content']/a"
        )->getAttribute('href');
    }

    public function getDismissLink()
    {
        return $this->findByClassName('swat-message-display-dismiss-link');
    }

    public function dismiss()
    {
        $this->getDismissLink()->click();

        // Wait for message dismiss animation to complete.
        $id = $this->getEl()->getAttribute('id');
        $this->wd->wait()->until(
            function () use ($id) {
                return count($this->wd->findMultipleById($id)) === 0;
            }
        );

        return $this;
    }
}
