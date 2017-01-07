<?php
/**
 * @file
 * dpkg-scanpackages
 * bootstrap.php
 *
 * Created by Jake Wise 07/01/2017.
 *
 * You are permitted to use, modify, and distribute this file in accordance with
 * the terms of the license agreement accompanying it.
 */

$autoload = require 'vendor/autoload.php';

/**
 * Factory function for the application.
 *
 * @return \GroovyCarrot\Dpkg\Application
 */
function app_create() {
    $directoryScanner = new \GroovyCarrot\Dpkg\DirectoryScanner\MimeTypeDirectoryScanner();
    $controlReader = new \GroovyCarrot\Dpkg\ControlFactory\NativePackageControlFactory();
    $formatter = new \GroovyCarrot\Dpkg\Formatter\Formatter();
    return new \GroovyCarrot\Dpkg\Application($directoryScanner, $controlReader, $formatter);
}

/**
 * List passed arguments.
 *
 * @return array
 */
function app_list_arguments()
{
    $getopt = new \Ulrichsg\Getopt\Getopt([
        new \Ulrichsg\Getopt\Option('g', 'gzip'),
        new \Ulrichsg\Getopt\Option('f', 'file', \Ulrichsg\Getopt\Getopt::OPTIONAL_ARGUMENT),
    ]);

    $getopt->parse();

    $g = $getopt->getOption('g');
    $f = $getopt->getOption('f');
    $dir = $getopt->getOperand(0);

    if (!$dir) {
        print <<<EOF
Usage: dpkg-scanpackages [--gzip|-g] [--file|-f <file>] <directory>

EOF;
        die;
    }

    return [$dir, $g, $f];
}
