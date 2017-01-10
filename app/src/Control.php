<?php
/**
 * @file
 * dpkg-scanpackages
 * Control.php
 *
 * Created by Jake Wise 07/01/2017.
 *
 * You are permitted to use, modify, and distribute this file in accordance with
 * the terms of the license agreement accompanying it.
 */

namespace GroovyCarrot\Dpkg;

/**
 * Class ControlInfo
 * @package GroovyCarrot\Dpkg
 */
class Control
{
    public $Package;
    public $Version;
    public $Architecture;
    public $Maintainer;
    public $Filename;
    public $Size;
    public $MD5sum;
    public $SHA1;
    public $SHA256;
    public $Section;
    public $Description;
    public $Author;
    public $Depiction;
    public $Name;

    public function __toString()
    {
        $data = '';
        foreach (array_filter((array) $this) as $key => $value) {
            $data .= ucfirst($key) . ': ' . $value . PHP_EOL;
        }
        return $data;
    }
}
