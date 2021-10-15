<?php

namespace Yuga\Admin\Providers;

use Yuga\Route\Route;
use Yuga\Providers\ServiceProvider;
use Yuga\Application\Application as App;
use Yuga\Interfaces\Application\Application;

class AdminServiceProvider extends ServiceProvider
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function boot(Route $router)
    {
        $router->group(['prefix' => 'admin', 'namespace' => 'Yuga\Admin\Controllers'], function () {
            require __DIR__ . '/../Routes/web.php';
        });
    }

    public function load(Application $app)
    {
        
    }
}