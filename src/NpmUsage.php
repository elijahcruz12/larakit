<?php

namespace Larakit;

use Symfony\Component\Process\Process;

class NpmUsage
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

        $process = new Process(['npm', 'list']);
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
        $command = ['npm', 'install'];
        if ($dev) {
            $command[] = '--save-dev';
        }
        $command[] = $package;
        $process = new Process($command);
        $process->run();

        return $process->getOutput();
    }
}
