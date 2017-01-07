<?php
/**
 * @file
 * Portal test
 * Application.php
 *
 * Created by Jake Wise 02/11/2016.
 *
 * You are permitted to use, modify, and distribute this file in accordance with
 * the terms of the license agreement accompanying it.
 */

namespace GroovyCarrot\Dpkg;

/**
 * Class Application
 * @package Portal
 */
class Application
{
    const NAME = 'Dpkg-ScanPackages';
    const VERSION = '1.0.0';
    const MIN_PHP_VERSION = '5.4';

    protected $directory;
    protected $directoryScanner;
    protected $controlReader;
    protected $formatter;

    public function __construct(DirectoryScanner $directoryScanner, PackageControlFactory $controlReader, PackagesFormatter $formatter)
    {
        $this->checkPhpVersion();
        $this->directoryScanner = $directoryScanner;
        $this->controlReader = $controlReader;
        $this->formatter = $formatter;
    }

    /**
     * Check the version of PHP.
     *
     * @throws \RuntimeException
     */
    protected function checkPhpVersion()
    {
        if (version_compare(PHP_VERSION, self::MIN_PHP_VERSION) < 0) {
            throw new \RuntimeException('You must be running this application on PHP ' . self::MIN_PHP_VERSION . ' or later.');
        }
    }

    /**
     * Execute the application.
     *
     * @param string $directory
     *   The directory to scan.
     * @param bool $gzip
     *   Whether or not to gzip the output.
     * @param string|null $outFile
     *   An optional file to output to.
     */
    public function execute($directory, $gzip = false, $outFile = null)
    {
        if (PHP_SAPI !== 'cli' || !empty($_SERVER['REMOTE_ADDR'])) {
            throw new \RuntimeException('This application must be executed via the command line.');
        }

        if (!file_exists(realpath($directory))) {
            throw new \RuntimeException("Directory '{$directory}' does not exists.");
        }

        $directory = realpath($directory);

        $packages = [];
        foreach ($this->directoryScanner->scanForDebianPackages($directory) as $file) {
            $control = $this->controlReader->readControlFromDebianPackage($file);
            $packages[$file] = $control;
        }

        $data = $this->formatter->formatPackages($packages);

        if ($gzip) {
            $data = gzencode($data);
        }

        if ($outFile) {
            file_put_contents($file, $outFile);
        }
        else {
            print $data;
        }
    }
}
