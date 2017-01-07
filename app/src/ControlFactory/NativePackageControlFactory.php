<?php
/**
 * @file
 * dpkg-scanpackages
 * NativePackageControlReader.php
 *
 * Created by Jake Wise 07/01/2017.
 *
 * You are permitted to use, modify, and distribute this file in accordance with
 * the terms of the license agreement accompanying it.
 */

namespace GroovyCarrot\Dpkg\ControlFactory;

use GroovyCarrot\Dpkg\Control;
use GroovyCarrot\Dpkg\PackageControlFactory;

/**
 * Class NativePackageControlReader
 * @package GroovyCarrot\Dpkg
 *
 * Use `ar` and `tar` on the operating system to read the control file.
 */
class NativePackageControlFactory implements PackageControlFactory
{
    /**
     * @inheritdoc
     */
    public function readControlFromDebianPackage($filePath)
    {
        $info = new Control();

        $info->Filename = $filePath;
        $info->Size = filesize($filePath);
        $info->MD5sum = md5_file($filePath);
        $info->SHA1 = sha1_file($filePath);
        $info->SHA256 = hash_file('sha256', $filePath);

        exec('ar -p ' . $filePath . ' control.tar.gz | tar -xzO', $control);
        foreach ($control as $entry) {
            list($entry, $value) = explode(':', $entry, 2);
            $info->{$entry} = trim($value);
        }

        return $info;
    }
}
