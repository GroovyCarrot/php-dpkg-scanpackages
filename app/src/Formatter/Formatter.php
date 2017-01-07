<?php
/**
 * @file
 * dpkg-scanpackages
 * Formatter.php
 *
 * Created by Jake Wise 07/01/2017.
 *
 * You are permitted to use, modify, and distribute this file in accordance with
 * the terms of the license agreement accompanying it.
 */

namespace GroovyCarrot\Dpkg\Formatter;

use GroovyCarrot\Dpkg\PackagesFormatter;

/**
 * Class Formatter
 * @package GroovyCarrot\Dpkg
 */
class Formatter implements PackagesFormatter
{
    /**
     * @inheritdoc
     */
    public function formatPackages(array $packages)
    {
        $data = '';
        foreach ($packages as $package) {
            $data .= (string) $package . PHP_EOL;
        }
        return $data;
    }
}
