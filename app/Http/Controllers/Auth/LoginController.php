<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\Mail;
class  LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // Simple LDAP AddminLess authentication: https://github.com/jotaelesalinas/laravel-simple-ldap-auth
    // if not added in a previous step
    public function username()
    {
        return config('ldap_auth.usernames.eloquent');
    }
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string|regex:/^\w+$/',
            'password' => 'required|string',
        ]);
    }
    protected function attemptLogin(Request $request)
    {
        $remember = ($request->input('remember')) ? true : false;
        $credentials = $request->only($this->username(), 'password');
        $username = $credentials[$this->username()];
        $password = $credentials['password'];
        $user_format = env('LDAP_USER_FORMAT', 'cn=%s,'.env('LDAP_BASE_DN', ''));
        $userdn = sprintf($user_format, $username);
        // you might need this, as reported in
        // [#14](https://github.com/jotaelesalinas/laravel-simple-ldap-auth/issues/14):
        // Adldap::auth()->bind($username, $password);
        // $userdn is not working for me, since it concatenates
        if(Adldap::auth()->attempt($username, $password, true)) {
            // the user exists in the LDAP server, with the provided password
            $user = \App\User::where($this->username(), $username)->first();
            if (!$user) {
                // the user doesn't exist in the local database, so we have to create one
                $user = new \App\User();
                $user->username = $username;
                $user->password = '';
                // you can skip this if there are no extra attributes to read from the LDAP server
                // or you can move it below this if(!$user) block if you want to keep the user always
                // in sync with the LDAP server
                $sync_attrs = $this->retrieveSyncAttributes($username);

                foreach ($sync_attrs as $field => $value) {
                    $user->$field = $value !== null ? $value : '';
                }

            }
            // by logging the user we create the session, so there is no need to login again (in the configured time).
            // pass false as second parameter if you want to force the session to expire when the user closes the browser.
            // have a look at the section 'session lifetime' in `config/session.php` for more options.

            $this->guard()->login($user, true);

            return true;
        }
        // the user doesn't exist in the LDAP server or the password is wrong
        // log error
        return false;
    }
    protected function retrieveSyncAttributes($username)
    {
        $ldapuser = Adldap::search()->where(env('LDAP_USER_ATTRIBUTE', 'sAMAccountName'), '=', $username)->first();
        if ( !$ldapuser ) {
            // log error
            return false;
        }
        // if you want to see the list of available attributes in your specific LDAP server:

        // needed if any attribute is not directly accessible via a method call.
        // attributes in \Adldap\Models\User are protected, so we will need
        // to retrieve them using reflection.
        $ldapuser_attrs = null;
        $attrs = [];
        foreach (config('ldap_auth.sync_attributes') as $local_attr => $ldap_attr) {
            if ( $local_attr == 'username' ) {
                continue;
            }

            $method = 'get' . $ldap_attr;

            if (method_exists($ldapuser, $method)) {

                $attrs[$local_attr] = $ldapuser->$method();

            }

            if ($ldapuser_attrs === null) {
                $ldapuser_attrs = self::accessProtected($ldapuser, 'attributes');
            }

            if (!isset($ldapuser_attrs[$ldap_attr])) {
                // an exception could be thrown
                $attrs[$local_attr] = null;
                continue;
            }

            if (!is_array($ldapuser_attrs[$ldap_attr])) {
                $attrs[$local_attr] = $ldapuser_attrs[$ldap_attr];
            }

            if (count($ldapuser_attrs[$ldap_attr]) == 0) {
                // an exception could be thrown
                $attrs[$local_attr] = null;
                continue;
            }

            // Check for LDAP User Memberships and based on that determine the application Role
            // Web-admins become application Super admins
            // Docenten-MT become application admins
            // If none of those groups, the user is marked as a Student.


            if ( $local_attr == 'role') {
                $roles = $ldapuser_attrs[$ldap_attr]; // Copy membersof array to the roles array
                // Check is the $ldap_attr 'memberof' contains

                if(in_array('Web-admins', $roles))
                {
                    $attrs[$local_attr] = 'Admin';
                    continue;
                }
                // Check if the $ldap_attr 'memberof' contains CN=Docenten MT,OU=Docenten,DC=ict,DC=lab,DC=locals
                else if(in_array('CN=Docenten MT,OU=Docenten,DC=ict,DC=lab,DC=locals', $roles))
                {
                    $attrs[$local_attr] = 'Docent';
                    continue;
                } else { // If none of the above, we mark the user as a Student
                    $attrs[$local_attr] = 'Student';
                    continue;
                }

            }

            // now it returns the first item, but it could return
            // a comma-separated string or any other thing that suits you better
            $attrs[$local_attr] = $ldapuser_attrs[$ldap_attr][0];
            //$attrs[$local_attr] = implode(',', $ldapuser_attrs[$ldap_attr]);
        }
        return $attrs;
    }
    protected static function accessProtected ($obj, $prop)
    {
        $reflection = new \ReflectionClass($obj);
        $property = $reflection->getProperty($prop);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }
}
