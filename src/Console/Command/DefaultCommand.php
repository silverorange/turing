<?php

namespace Silverorange\Turing\Console\Command;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package   Turing
 * @copyright 2018 silverorange
 */
class DefaultCommand extends Command
{
    // {{{ protected function configure()

    /**
     * Configure command
     */
    protected function configure()
    {
        $this->setName('default')
            ->setDescription('Runs the steward run command with environment specified config');
    }

    // }}}
    // {{{ protected function execute()

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('run');

        $browser = getenv('SELENIUM_BROWSER') ?: 'chrome';
        $serverURL = getenv('SELENIUM_SERVER_URL') ?: 'http://localhost:4444';
        $logsDir = getenv('STEWARD_LOGS_PATH') ?: 'tests/logs';
        $testsDir = getenv('STEWARD_TESTS_PATH') ?: 'tests';

        $arguments = [
            'environment' => 'test',
            'browser' => $browser,
            '--logs-dir' => $logsDir,
            '--server-url' => $serverURL,
            '--tests-dir' => $testsDir,
        ];

        // Can't pass verbosity as argument to sub-command. It's tied to the
        // application.
        $output->setVerbosity(OutputInterface::VERBOSITY_VERY_VERBOSE);

        $runInput = new ArrayInput($arguments);
        return $command->run($runInput, $output);
    }

    // }}}
}
