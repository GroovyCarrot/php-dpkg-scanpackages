<?php
/**
 * @file
 * dpkg-scanpackages
 * PackagesWriter.php
 *
 * Created by Jake Wise 07/01/2017.
 *
 * You are permitted to use, modify, and distribute this file in accordance with
 * the terms of the license agreement accompanying it.
 */

namespace GroovyCarrot\Dpkg;


interface PackagesFormatter
{
    /**
     * Format a list of packages.
     *
     * @param Control[] $packages
     *   An array of package control data.
     *
     * @return string
     *   Formatted Packages.
     */
    public function formatPackages(array $packages);
}
