<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::directive('to_currency', function ($price) {
            return "<?php 
                echo 'R$ ' . str_replace('.', ',', number_format($price, 2)); 
            ?>";
        });

        Blade::directive('translate_payment', function ($payment) {
            return "<?php 
                switch ($payment) {
                    case 'pix':
                        echo 'Pix';
                        break;
                    case 'card':
                        echo 'Cartão';
                        break;
                    case 'coin':
                        echo 'Dinheiro';
                        break;
                    default:
                        echo 'Método Inválido';
                }
            ?>";
        });

        Blade::directive('translate_status', function ($status) {
            return "<?php 
            switch ($status) {
                case 0:
                   echo 'Negado';
                    break;
                case 1:
                   echo 'Esperando confirmação';
                    break;
                case 2:
                   echo 'Em preparo';
                    break;
                case 3:
                   echo 'Pronto';
                    break;
                case 4:
                   echo 'Entregue';
                    break;
                default:
                   echo 'Desconhecido';
            }
            ?>";
        });
    }
}
