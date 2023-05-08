<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    
    public function boot(): void
    {
        config(['app.locale' => 'id']);
        setlocale(LC_TIME, 'id_ID');
        
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        Blade::directive('money', function ($money) {
            return "<?php echo number_format($money, 0, ',', '.'); ?>";
        });
    }
}
