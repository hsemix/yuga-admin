<?php

namespace Yuga\Admin\Providers;

use Yuga\Route\Route;
use Yuga\Providers\ServiceProvider;
use Yuga\Interfaces\Application\Application;
use Yuga\Providers\Shared\MakesCommandsTrait;

class AdminServiceProvider extends ServiceProvider
{
    use MakesCommandsTrait;

    
    public function load(Application $app)
    {
        
    }

    public function boot(Route $router)
    {
        $router->group(['prefix' => 'admin', 'namespace' => 'Yuga\Admin\Controllers'], function () {
            require __DIR__ . '/../Routes/web.php';
        });
    }
}
