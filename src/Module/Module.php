<?php

namespace VladyslavStartsev\YiiLogTail\Module;

use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module as BaseModule;
use yii\console\Application as ConsoleApplication;

class Module extends BaseModule implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        if ($app instanceof ConsoleApplication) {
            $app->controllerMap[$this->id] = [
                'class' => 'VladyslavStartsev\YiiLogTail\Controllers\LogController',
                'module' => $this,
            ];
        }
    }
}