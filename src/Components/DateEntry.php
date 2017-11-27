<?php

namespace Silverorange\Turing\Components;

use Facebook\WebDriver\WebDriverSelect;

/**
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class DateEntry extends AbstractComponent
{
    // {{{ protected properties

    /**
     * @var array
     */
    protected static $month_map = array(
        'January'   => '01',
        'February'  => '02',
        'March'     => '03',
        'April'     => '04',
        'May'       => '05',
        'June'      => '06',
        'July'      => '07',
        'August'    => '08',
        'September' => '09',
        'October'   => '10',
        'November'  => '11',
        'December'  => '12',
    );

    // }}}
    // {{{ public function setDate()

    public function setDate($date)
    {
        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date);
        }

        $id = $this->el->getAttribute('id');

        (new WebDriverSelect($this->findById($id . '_year')))
            ->selectByVisibleText($date->format('Y'));

        if ($this->hasById($id . '_month')) {
            (new WebDriverSelect($this->findById($id . '_month')))
                ->selectByVisibleText($date->format('F'));
        }

        if ($this->hasById($id . '_day')) {
            (new WebDriverSelect($this->findById($field.'_day')))
                ->selectByVisibleText($date->format('j'));
        }
    }

    // }}}
    // {{{ public function getDate()

    public function getDate()
    {
        $id = $this->el->getAttribute('id');

        $year_select = $this->findById($id . '_year');
        $year = $year_select->getFirstSelectedOption->getText();

        if ($this->hasById($id . '_month')) {
            $month_select = $this->findById($id . '_month');
            $month = $month_select->getFirstSelectedOption()->getText();
            $month = self::$month_map[$month];
        } else {
            $month = '01';
        }

        if ($this->hasById($id . '_day')) {
            $day_select = $this->findById($id . '_day');
            $day = $day_select->getFirstSelectedOption()->getText();
            $day = sprintf('%02d', $day);
        } else {
            $day = '01';
        }

        return new \DateTime($year . '-' . $month . '-' . $day);
    }

    // }}}
    // {{{ public function getMinimumDate()

    public function getMinimumDate()
    {
        return $this->getDateRange()['start'];
    }

    // }}}
    // {{{ public function getMaximumDate()

    public function getMaximumDate()
    {
        return $this->getDateRange()['end'];
    }

    // }}}
    // {{{ protected function getDateRange()

    protected function getDateRange()
    {
        $id = $this->el->getAttribute('id');

        // get year range
        $year_select = $this->findById($id . '_year');
        $year_options = $year_select->getOptions();
        $start_year = $year_options[1]->getText();
        $end_year = $year_options[count($year_options) - 1]->getText();

        // get month range
        if ($this->hasById($id . '_month')) {
            $month_select = $this->findById($id . '_month');
            $month_options = $month_select->getOptions();

            $start_month = $month_options[1]->getText();
            $start_month = preg_replace('/[^A-Za-z]/', '', $start_month);
            $start_month = self::$month_map[$start_month];

            $end_month = $month_options[count($month_options) - 1]->getText();
            $end_month = preg_replace('/[^A-Za-z]/', '', $end_month);
            $end_month = self::$month_map[$end_month];
        } else {
            $start_month = '01';
            $end_month = '01';
        }

        // get day range
        if ($this->hasById($id . '_day')) {
            $day_select = $this->findById($id . '_day');
            $day_options = $day_select->getOptions();
            $start_day = sprintf('%02d', $day_options[1]->getText());
            $end_day = sprintf('%02d', $day_options[count($day_options) - 1]->getText());
        } else {
            $start_day = '01';
            $end_day = '01';
        }

        return [
            'start' => new \DateTime($start_year . '-' . $start_month . '-' . $start_day),
            'end' => new \DateTime($end_year . '-' . $end_month . '-' . $end_day),
        ];
    }

    // }}}
}
