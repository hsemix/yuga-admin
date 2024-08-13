<?php

namespace Yuga\Admin\Controllers;

use Yuga\Controllers\Controller as Base;

class Controller extends Base
{
    public function __construct()
    {
        parent::__construct();

        if (!is_dir(path('resources/views/yuga/admin'))) {
            $this->view->setTemplateDirectory(app('yuga-admin-views'));
        }

        $this->view->menu = [
            '/tox/dashboard'            => 'Dashboard',
            '/tox/packages'             => config('app.name', 'Tox').' Tiers',
            '/tox/admin/tiers/create'   => 'Create Package',
            '/tox/transactions'         => 'Transactions',
            '/tox/admin/payments'       => 'Payments',
        ];

        $this->view->currentPage = $this->request->getUri();
        $this->view->title = config('app.name', 'Tox Payments');
        $this->view->injectSetup = false;
    }
}
