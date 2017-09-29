<?php

namespace VladyslavStartsev\YiiLogTail\Actions;

use SplFileInfo;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;
use Yii;
use yii\base\Action;

class TailAction extends Action
{

    public $lines;

    public $color = true;

    public function options($actionID)
    {
        return ['lines'];
    }

    /**
     * Tails your log, was param - number of lines
     * @param $lines
     */
    public function run($lines = 100)
    {
        $logDirectory = Yii::getAlias('@runtime') . '/logs';
        if (!$path = $this->findLatestLogFile($logDirectory)) {
            echo "Could not find a log file in `{$logDirectory}`." . PHP_EOL;
            return;
        }

        $tailCommand = "tail -f -n {$lines} " . escapeshellarg($path);
        echo "start tailing {$path}" . PHP_EOL;
        (new Process($tailCommand))
            ->setTimeout(null)
            ->run(function ($type, $line) {
                echo ($line);
            });

    }

    protected function findLatestLogFile($directory)
    {
        $logFile = collect($this->getAllFiles($directory))
            ->sortByDesc(function (SplFileInfo $file) {
                return $file->getMTime();
            })
            ->first();
        return $logFile
            ? $logFile->getPathname()
            : false;
    }

    public function getAllFiles($directory)
    {
        return iterator_to_array(
            Finder::create()->files()->in($directory),
            false
        );
    }
}
