<?php

namespace Larakit;

use Symfony\Component\Process\Process;

class RunProcess
{
    /**
     * Uses Symfony Process to run a command.
     *
     * @param  array  $command
     * @return string
     */
    public static function run(array $command = []): string
    {
        if ($command = []) {
            return '';
        }

        $process = new Process($command);
        $process->run();

        return $process->getOutput();
    }
}
