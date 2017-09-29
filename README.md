Inspired by [spatie/laravel-tail](https://github.com/spatie/laravel-tail)

Tail your logs with yii2 console

## How to install
* `composer require vladyslavstartsev/yii2-log-tail`
* Go to (or create) your console `LogController` and drop in
```php
    public function actions()
    {
        return [
            'tail' => ['class' => '\VladyslavStartsev\YiiLogTail\Actions\TailAction'],
        ];
    }
```

* Done! your should see your logs tailed by running `./yii log/tail`.

## How to use
* `./yii log/tail` - tails your logs

#### parameters
`lines` - number of lines to tail. use it like this `./yii log/tail`