Turing
======
End-to-end testing framework for websites. The Turing package is built upon:

 - Lmc\\Steward
 - Facebook\\WebDriver
 - League\\Uri
 - Vlucas\\Dotenv

Turing provides a base class for writing Selenium WebDriver tests as
`Silverorange\Turing\Tests\AbstractTest` as well as a test runner `turing`.

Installation
------------
Turing should usually be installed as a development depencency. Make sure the
silverorange composer repository is added to the `composer.json` for the
project and then run:

```sh
composer require --dev silverorange/turing
```

Test Runner
-----------
After installing Turing as a dev dependency you can run tests with:

```sh
./vendor/bin/turing
```

There are no command line arguments as all configuration is handled via
environment variables. Tests are found in the `tests/` directory.

Writing Tests
-------------
Test should extend `Silverorange\Turing\Tests\AbstractTest`. This base class
takes care of connecting to WebDriver and provides syntax sugar to make writing
WebDriver commands easier. For example:

```php
<?php

use Silverorange\Turing\Tests\AbstractTest;

class MyTest extends AbstractTestCase
{
    public function testFoo()
    {
        $this->loadUrl('foo');

        // Turing provides syntax sugar for getting WebDriverElements.
        $this->getById('bar')->type('this is a test');
        $this->getByXpath("//button[@text='Save']")->click();
    }
}
```

Tests may also use provided components for high-level access to common widgets:

```php
<?php

use Silverorange\Turing\Tests\AbstractTest;
use Silverorange\Turing\Components\DateEntry;

class MyTest extends AbstractTestCase
{
    public function testFoo()
    {
        $this->loadUrl('foo');

        // Components for common widgets are provided.
        (new DateEntry($this->wd, $this->findById('start_date')))
            ->setDate($start_date);

        $this->getByXpath("//button[@text='Save']")->click();
    }
}
```

Test Configuration
------------------
Turing is configured with environment variables. This allows maximum
flexibility when running in continuous integration environments.

Available environment variables are:

 - **CONTENT_PATH** - where to load fixture data. `tests/content` by default.
 - **DATABASE_DSN** - PDO DSN for DB connection.
 - **SCREENSHOTS_PATH** - where to store test screenshots. `tests/screenshots` by default.
 - **SELENIUM_BROWSER** - *required*. Browser to test.
 - **SELENIUM_HEADLESS** - If defined and truthy, run in headless mode.
 - **SELENIUM_SERVER_URL** - *required*. Selenium server URL.
 - **SELENIUM_URL** - *required*. Base URL to test.
 - **SELENIUM_WIDTH** - browser width. 800 by default.
 - **SELENIUM_HEIGHT** - browser height. 600 by default.
 - **SELENIUM_MOBILE_WIDTH** - mobile browser width. 320 by default.
 - **SELENIUM_MOBILE_HEIGHT** - mobile browser height. 583 by default.
 - **STEWARD_LOGS_PATH** - Where test logs are stored. `tests/logs` by default.

Turing can use a `.env` file to load configuration. The file `tests/.env` is
used to set environment variables if it exists. In keeping with the principles
of the [12 Factor App](https://12factor.net/), the file should not be
committed to version control. An example file named `tests/.env.example` may
be committed to version control instead.

Traits
------
Many of Turing's test features are provided as optional traits.

### Assertions/NoErrorsTrait

This provides a method to assert the current page has no errors.

Example:

```php
<?php

use Silverorange\Turing\Tests\AbstractTest;
use Silverorange\Turing\Assertions\NoErrorsTrait;

class MyTest extends AbstractTest
{
    use NoErrorsTrait;

    public function testFoo()
    {
        $this->loadURL('test-page');
        $this->assertNoErrors();
    }
}
```

### Assertions/UrlTrait

This provides the ability to validate the current page URL or other URLs. The
base URL is used for relative URLs and is controlled with the environment
variable `SELENIUM_URL`.

Example:

```php
<?php

use Silverorange\Turing\Tests\AbstractTest;
use Silverorange\Turing\Assertions\UrlTrait;

class MyTest extends AbstractTest
{
    use UrlTrait;

    public function testFoo()
    {
        $this->loadURL('test-page');
        $this->findById('submit')->click();
        $this->assertCurrentURLEquals('thank-you');
    }
}
```

### Database/DatabaseTrait

This provides a PDO database connection for each test method. The database
DSN is configured with the `DATABASE_DSN` environment variable.

Example:

```php
<?php

use Silverorange\Turing\Tests\AbstractTest;
use Silverorange\Turing\Database\DatabaseTrait;

class MyTest extends AbstractTest
{
    use DatabaseTrait;

    public function testFoo()
    {
        $this->db->query('insert into foo (title) values (\'test\')');

        $this->loadURL('test-page');
        $this->assertEquals(
            'test',
            $this->getById('foo')->getText()
        );
    }
}
```

### Fixture/ContentTrait

This provides the ability to load file content for test fixtures. File
content is loaded from `tests/content` by default and can be overridden
with the `CONTENT_PATH` environment variable.

Example:

```php
<?php

use Silverorange\Turing\Tests\AbstractTest;
use Silverorange\Turing\Fixture\ContentTrait;

class MyTest extends AbstractTest
{
    use ContentTrait;

    public function testFoo()
    {
        $this->assertEquals(
            $this->getContent('sample-content.txt'),
            $this->getById('foo')->getText()
        );
    }
}
```

### Screenshot/ScreenshotTrait

This provides the ability to take screenshots or whole pages or sections of
a page. Screenshots are saved to `tests/screenshots` by default and can be
overridden with the `SCREENSHOTS_PATH` environment variable.

Example:

```php
<?php

use Silverorange\Turing\Tests\AbstractTest;
use Silverorange\Turing\Screenshot\ScreenshotTrait;

class MyTest extends AbstractTest
{
    use ScreenshotTrait;

    public function testFoo()
    {
        $this->loadURL('test-page');
        $this->takeScreenshotById('my_element', 'filename');
    }
}
```
