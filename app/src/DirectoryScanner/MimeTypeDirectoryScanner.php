<?php
/**
 * @file
 * dpkg-scanpackages
 * ScanDirectory.php
 *
 * Created by Jake Wise 06/01/2017.
 *
 * You are permitted to use, modify, and distribute this file in accordance with
 * the terms of the license agreement accompanying it.
 */

namespace GroovyCarrot\Dpkg\DirectoryScanner;

use GroovyCarrot\Dpkg\DirectoryScanner;

/**
 * Class NativeDirectoryScanner
 * @package GroovyCarrot\Dpkg
 *
 * Uses standard UNIX file command to
 */
class MimeTypeDirectoryScanner implements DirectoryScanner
{
    protected static $allowedMimeTypes = [
        'application/x-deb',
        'application/x-debian-package',
        'application/vnd.debian.binary-package',
    ];

    /**
     * @inheritdoc
     */
    public function scanForDebianPackages($directory)
    {
        $files = scandir($directory);
        array_walk($files, function (&$value) use ($directory) {
            $value = "{$directory}/{$value}";
        });

        $files = array_filter($files, function ($file) use ($directory) {
            if (pathinfo($file, PATHINFO_EXTENSION) !== 'deb') {
                return false;
            }

            if (!in_array(mime_content_type($file), self::$allowedMimeTypes)) {
                return false;
            }

            return true;
        });

        return $files;
    }
}
