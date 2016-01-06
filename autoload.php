<?php

namespace Silverorange\Autoloader;

$package = new Package('silverorange/turing');

$package->addRule(new Rule('', 'Turing'));

Autoloader::addPackage($package);

?>
