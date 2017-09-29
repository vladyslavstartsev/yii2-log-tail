<?php

namespace VladyslavStartsev\YiiLogTail\Controllers;

use SplFileInfo;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;
use Yii;
use yii\console\Controller;

class LogController extends Controller
{

    public $lines;

    public $color = true;

    public function options($actionID)
    {
        return ['lines'];
    }

    public function actionTail()
    {
        $logDirectory = Yii::getAlias('@runtime') . '/logs';
        if (!$path = $this->findLatestLogFile($logDirectory)) {
            $this->stderr("Could not find a log file in `{$logDirectory}`.");
            return;
        }

        $tailCommand = "tail -f -n {$this->lines} " . escapeshellarg($path);
        $this->stdout("start tailing {$path}");
        (new Process($tailCommand))
            ->setTimeout(null)
            ->run(function ($type, $line) {
                echo $this->stdout($line);
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
