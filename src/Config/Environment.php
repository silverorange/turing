<?php

namespace Silverorange\Turing\Config;

use Dotenv\Dotenv;

/**
 * Valid environment variables for configuring Turing are:
 *
 * - CONTENT_PATH           - where to load fixture data. tests/content by default.
 *
 * - DATABASE_DSN           - PDO DSN for DB connection.
 *
 * - SCREENSHOTS_PATH       - where to store test screenshots.
 *
 * - SELENIUM_BROWSER       - required. Browser to test.
 * - SELENIUM_HEADLESS      - If defined and truthy, run in headless mode.
 * - SELENIUM_SERVER_URL    - required. Selenium server URL.
 * - SELENIUM_URL           - required. Base URL to test.
 * - SELENIUM_WIDTH         - browser width. 800 by default.
 * - SELENIUM_HEIGHT        - browser height. 600 by default.
 * - SELENIUM_MOBILE_WIDTH  - mobile browser width. 320 by default.
 * - SELENIUM_MOBILE_HEIGHT - mobile browser height. 583 by default.
 *
 * - STEWARD_LOGS_PATH     - Where test logs are stored. tests/logs by default.
 *
 * @package   Turing
 * @copyright 2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class Environment
{
    public static function load(): void
    {
        $rootPath = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
        $testsPath = $rootPath . '/tests';

        $dotenv = new Dotenv($testsPath);
        $dotenv->load();

        $dotenv->required('SELENIUM_URL')->notEmpty();
        $dotenv->required('SELENIUM_SERVER_URL')->notEmpty();
        $dotenv->required('SELENIUM_BROWSER')->notEmpty();
    }
}
