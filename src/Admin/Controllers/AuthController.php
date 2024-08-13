<?php

namespace Yuga\Admin\Controllers;

use Yuga\Admin\Composables\Guardable;

class AuthController extends Controller
{
    use Guardable;
    /**
     * @var string
     */
    protected string $loginView = 'admin.login';

    /**
     * Show the login page.
     *
     * @return \Yuga\Views\View
     */
    public function getLogin()
    {
        if (!$this->guard()->guest()) {
            return redirect($this->redirectPath());
        }

        return view($this->loginView);
    }

    /**
     * Get the post login redirect path.
     *
     * @return string
     */
    protected function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : config('admin.route.prefix');
    }
}
