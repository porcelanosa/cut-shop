<?php

namespace App\Providers;

use App\Faker\FakerImageProvider;
use Faker\Factory;
use Faker\Generator;
use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Generator::class, static function () {
            $faker = Factory::create();
            $faker->addProvider(new FakerImageProvider($faker));
            return $faker;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
         * Model::preventLazyLoading(! app()->isProduction());
         * Model::preventSilentlyDiscardingAttributes(! app()->isProduction());
         * = this is equalent to
         * Model::shouldBeStrict(! app()->isProduction());
        */
        Model::shouldBeStrict(! app()->isProduction());

        if (app()->isProduction()) {
           /* DB::whenQueryingForLongerThan(
                CarbonInterval::seconds(5),
                static function (Connection $connection) {
                    logger()
                        ->channel('telegram')
                        ->debug('whenQueryingForLongerThan: '.$connection->totalQueryDuration());
                }
            );*/
            DB::listen(static function ($query) {
                if ($query->time > 1500) {
                    logger()
                        ->channel('telegram')
                        ->debug(
                            'Query longe than 1.5 s: '.$query->time.'ms'.PHP_EOL.$query->sql,
                            $query->bindings
                        );
                }
            });
        }
        $kernel = app(Kernel::class);

        $kernel->whenRequestLifecycleIsLongerThan(
            CarbonInterval::seconds(4),
            static function () {
                logger()->channel('telegram')->debug('whenRequestLifecycleIsLongerThan: '.request()->url());
            }
        );
    }
}
