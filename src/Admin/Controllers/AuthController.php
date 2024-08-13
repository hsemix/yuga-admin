<?php

namespace Yuga\Admin\Controllers;

use Yuga\Http\Request;
use Yuga\Admin\Composables\Guardable;
use Yuga\Validate\Validate;

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

        echo '<pre>';

        print_r($_SERVER);
        die();
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

    /**
     * Handle a login request.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        $this->loginValidator($request->all())->validate();

        $credentials = $request->only([$this->username(), 'password']);
        $remember = $request->get('remember', false);

        if ($this->guard()->attempt($credentials, $remember)) {
            return $this->sendLoginResponse($request);
        }

        return redirect()->back()->withInput()->withErrors([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }

    /**
     * Get a validator for an incoming login request.
     *
     * @param array $data
     *
     * @return \Yuga\Validate\Validator
     */
    protected function loginValidator(array $data)
    {
        return Validate::make($data, [
            $this->username()   => 'required',
            'password'          => 'required',
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    protected function username()
    {
        return 'username';
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    protected function getFailedLoginMessage()
    {
        return 'These credentials do not match our records.';
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Yuga\Http\Request $request
     *
     * @return \Yuga\Http\Redirect
     */
    protected function sendLoginResponse(Request $request)
    {
        admin_toastr(trans('admin.login_successful'));

        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath());
    }
}
