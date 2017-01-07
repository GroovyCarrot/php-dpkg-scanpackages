<?php
/**
 * @file
 * dpkg-scanpackages
 * DirectoryScanner.php
 *
 * Created by Jake Wise 06/01/2017.
 *
 * You are permitted to use, modify, and distribute this file in accordance with
 * the terms of the license agreement accompanying it.
 */

namespace GroovyCarrot\Dpkg;

/**
 * Interface DirectoryScanner
 * @package GroovyCarrot\Dpkg
 */
interface DirectoryScanner
{
    /**
     * Scan a directory for Debian packages.
     *
     * @param string $directory
     *
     * @return string[]
     *   A list of Debian packages in a directory.
     */
    public function scanForDebianPackages($directory);
}
