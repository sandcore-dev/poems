<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('number', function ($number) {
            return "<?php echo (new \\NumberFormatter(config('app.locale'), \\NumberFormatter::DECIMAL))->format({$number}); ?>";
        });

        Blade::directive('markdown', function ($text) {
            return <<<PHP
<?php echo nl2br(\\Illuminate\\Support\\Str::of($text)->markdown(['html_input' => 'strip'])); ?>
PHP;
        });
    }
}
