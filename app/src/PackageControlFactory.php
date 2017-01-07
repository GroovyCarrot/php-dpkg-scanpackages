<?php
/**
 * @file
 * dpkg-scanpackages
 * PackageControlFactory.php
 *
 * Created by Jake Wise 07/01/2017.
 *
 * You are permitted to use, modify, and distribute this file in accordance with
 * the terms of the license agreement accompanying it.
 */

namespace GroovyCarrot\Dpkg;

/**
 * Interface PackageControlFactory
 * @package GroovyCarrot\Dpkg
 */
interface PackageControlFactory
{
    /**
     * Read the control file from a Debian package.
     *
     * @param string $filePath
     *   Path to the Debian package.
     *
     * @return Control
     *   The control data.
     */
    public function readControlFromDebianPackage($filePath);
}
