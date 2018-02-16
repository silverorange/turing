<?php

namespace Silverorange\Turing\Console\Command;

use Lmc\Steward\Console\Command\RunCommand as StewardRunCommand;
use Lmc\Steward\Console\Configuration\ConfigResolver;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @package   Turing
 * @copyright 2018 silverorange
 */
class RunCommand extends StewardRunCommand
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
        // we can dynamically configure the capabilities resolver class. All
        // properties except the capabilities resolver are already expressable
        // via command options so we just include the capabilities resolver
        // config here.

        $configFileValues = [
            'capabilities_resolver' => 'Silverorange\Turing\Selenium\CapabilitiesResolver',
        ];

        $configResolver = new ConfigResolver(new OptionsResolver(), $this->getDefinition());

        return $configResolver->resolve($input, $configFileValues);
    }

    // }}}
}
