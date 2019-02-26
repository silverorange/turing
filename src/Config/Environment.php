<?php

namespace Silverorange\Turing\Config;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

/**
 * Valid environment variables for configuring Turing are:
 *
 * - CONTENT_PATH           - where to load fixture data. tests/content by
 *                            default.
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
 * - STEWARD_LOGS_PATH      - Where test logs are stored. tests/logs by default.
 * - STEWARD_TESTS_PATH     - Where Steward Selenium tests are located. tests
 *                            by default.
 *
 * @package   Turing
 * @copyright 2017-2019 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class Environment
{
    public static function load(): void
    {
        $dir = dirname($_SERVER['PHP_SELF']);
        $rootPath = dirname(dirname($dir));
        $testsPath = $rootPath . '/tests';

        $dotenv = new Dotenv($testsPath);

        try {
            $dotenv->load();
        } catch (InvalidPathException $e) {
            // phpdotenv requires the .env file to exist but we want it to be
            // optional. Catch InvalidPathException that is thrown when the
            // file does not exist in the directory.
        }

        $dotenv->required('SELENIUM_URL')->notEmpty();
        $dotenv->required('SELENIUM_SERVER_URL')->notEmpty();
        $dotenv->required('SELENIUM_BROWSER')->notEmpty();
    }
}
