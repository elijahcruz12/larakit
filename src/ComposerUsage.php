<?php

namespace Larakit;

use Symfony\Component\Process\Process;

class ComposerUsage
{
    /**
     * Checks to see if the package is already required
     *
     * @param string|null $package
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
     * @param string|null $package
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
}
