<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Add clear fix. No need to remember spelling anymore
         */
        Blade::directive('clear', function ($expression) {
            return "<div class='clearfix'></div>";
        });
        /**
         * Laravel dd() function.
         *
         * Usage: @dd($variableToDump)
         */
        Blade::directive('dd', function ($expression) {
            return "<?php dd({$expression}); ?>";
        });

        /**
         * Set variable.
         *
         * Usage: @set($name, value)
         */
        Blade::directive('set', function ($argumentString) {
            list($name, $value) = $this->getArguments($argumentString);

            return "<?php {$name} = {$value}; ?>";
        });

        /**
         * Simple font awesome icon for yourlself
         */
        Blade::directive('fa', function ($arguements) {
            $arg = $this->getArguments($arguements);
            $arg[1] = isset($arg[1]) ? $arg[1] : '';
            return "<i class='fa fa-{$arg[0]} {$arg[1]}'></i>";
        });

        /**
         * Simple mi icons
         */
        Blade::directive('mi', function ($text) {
            $var = isset($this->getArguments($text)[0]) ? $this->getArguments($text)[0] : 'no-text-provided';
            return "<i class='material-icons'>{$var}</i>";
        });
        /**
         * Check if the everything works till here
         */
        Blade::directive('w', function () {
            return "<?php dd('works'); ?>";
        });

        /**
         * Provide the alert right here
         */
        Blade::directive('alert', function ($arg) {
            $arguments = $this->getArguments($arg);
            $message = $arguments[0];
            $class = isset($arguments[1]) ? $arguments[1] : 'info';
            return "<div class='alert alert-{$class}'> {$message} </div>";
        });
    }

    /**
     * Get argument array from argument string.
     *
     * @param string $argumentString
     *
     * @return array
     */
    private function getArguments($argumentString)
    {
        return explode(',', str_replace(['(', ')', "'", "'"], '', $argumentString));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
