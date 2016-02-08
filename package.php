<?php

/* vim: set noexpandtab tabstop=4 shiftwidth=4 foldmethod=marker: */

require_once 'PEAR/PackageFileManager2.php';

$version = '0.1.3';
$notes = <<<EOT
No release notes for you!
EOT;

$description =<<<EOT
Turning is a testing framework for the silverorange Site framework.
EOT;

$package = new PEAR_PackageFileManager2();
PEAR::setErrorHandling(PEAR_ERROR_DIE);

$result = $package->setOptions(
	array(
		'filelistgenerator' => 'file',
		'simpleoutput'      => true,
		'baseinstalldir'    => '/',
		'packagedirectory'  => './',
		'dir_roles'         => array(
			'Turing'         => 'php',
		),
	)
);

$package->setPackage('Turing');
$package->setSummary('Turing is a test framework');
$package->setDescription($description);
$package->setChannel('pear.silverorange.com');
$package->setPackageType('php');
$package->setLicense('LGPL', 'http://www.gnu.org/copyleft/lesser.html');

$package->setReleaseVersion($version);
$package->setReleaseStability('stable');
$package->setAPIVersion('0.1.0');
$package->setAPIStability('stable');
$package->setNotes($notes);

$package->addIgnore('package.php');

$package->addMaintainer(
	'lead',
	'gauthierm',
	'Mike Gauthier',
	'mike@silverorange.com'
);

$package->addReplacement(
	'Turing/Turing.php',
	'pear-config',
	'@DATA-DIR@',
	'data_dir'
);

$package->setPhpDep('5.1.5');
$package->setPearinstallerDep('1.4.0');
$package->addExtensionDep('required', 'mbstring');
$package->addPackageDepWithChannel(
	'required',
	'HotDate',
	'pear.silverorange.com',
	'0.1.3'
);

$package->addPackageDepWithChannel(
	'required',
	'Swat',
	'pear.silverorange.com',
	'1.4.0'
);

$package->addPackageDepWithChannel(
	'required',
	'Site',
	'pear.silverorange.com',
	'1.5.0'
);

$package->addPackageDepWithChannel(
	'required',
	'PHPUnit',
	'pear.phpunit.de',
	'3.5.0'
);

$package->addPackageDepWithChannel(
	'required',
	'PHPUnit_Selenium',
	'pear.phpunit.de',
	'1.0.3'
);

$package->generateContents();

if (   isset($_GET['make'])
	|| (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')
) {
	$package->writePackageFile();
} else {
	$package->debugPackageFile();
}

?>
