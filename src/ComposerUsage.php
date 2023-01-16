<?php

namespace Larakit;

use Symfony\Component\Process\Process;

class ComposerUsage
{
    /**
     * Checks to see if the package is already required
     *
     * @param  string|null  $package
     * @return bool
     */
    public static function check(string $package = null): bool
    {
        if ($package == null) {
            return false;
        }

        $process = new Process(['composer', 'show']);
        $process->run();

        $output = $process->getOutput();

        return strpos($output, $package) !== false;
    }

    /**
     * Runs the Composer Require command
     *
     * @param  string|null  $package
     * @param $dev
     * @return string
     */
    public static function require(string $package = null, $dev = false): string
    {
        $command = ['composer', 'require'];
        if ($dev) {
            $command[] = '--dev';
        }
        $command[] = $package;
        $process = new Process($command);
        $process->run();

        return $process->getOutput();
    }

    /**
     * Uses the check method to see if the package is already required. If any of them are required, it will
     * return true.
     *
     * @param array $packages
     * @return bool
     */
    public static function checkMulti(array $packages)
    {
        foreach ($packages as $package) {
            if (!self::check($package)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Installs multiple composer packages at once.
     *
     * @param array $packages
     * @param bool $dev
     * @return string
     */
    public static function requireMulti(array $packages, bool $dev = false): string
    {
        $command = ['composer', 'require'];
        if ($dev) {
            $command[] = '--dev';
        }
        foreach ($packages as $package){
            $command[] = $package;
        }
        $process = new Process($command);
        $process->run();

        return $process->getOutput();
    }
}
