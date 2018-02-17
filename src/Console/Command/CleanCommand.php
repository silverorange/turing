<?php

namespace Silverorange\Turing\Console\Command;

use Lmc\Steward\Console\Command\CleanCommand as StewardCleanCommand;
use Lmc\Steward\Console\Configuration\ConfigResolver;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @package   Turing
 * @copyright 2018 silverorange
 */
class CleanCommand extends StewardCleanCommand
{
    // {{{ protected function resolveConfiguration()

    /**
     * @param InputInterface $input
     * @return array
     */
    protected function resolveConfiguration(InputInterface $input)
    {
        // Steward uses a steward.yml file for some config options. We override
        // it here so we can specify config options in the environment and so
        // we can dynamically configure the capabilities resolver class. We set
        // the logs_dir here as well because when wrapping the run command the
        // logs_dir doesn't get passed to the clean command. Clean is run from
        // the event dispatcher.

        $configFileValues = [
            'capabilities_resolver' => 'Silverorange\Turing\Selenium\CapabilitiesResolver',
            'logs_dir' => getenv('STEWARD_LOGS_PATH') ?: 'tests/logs',
        ];

        $configResolver = new ConfigResolver(new OptionsResolver(), $this->getDefinition());

        return $configResolver->resolve($input, $configFileValues);
    }

    // }}}
}
