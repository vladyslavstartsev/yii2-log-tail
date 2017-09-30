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

## Questions
- **Why it was written as action and not as separate controller?**

The reason is because `LogController` seems to be popular name for me. By using action,
you can just "inject" it wherever you want

- **Why did you use Laravel Collections ?**

There are 2 reasons of it

1. They have very  neat API
2. yii2 collections was not stable at the moment of the development


## Contributing

Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on [Github](https://github.com/vladyslavstartsev/yii2-log-tail/pulls).

