<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use \Google_Client;
use \Google_Service_People;
class LoginController extends Controller
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

    public function redirectToProvider()
    {
        return Socialite::driver('google')
                ->scopes(['openid', 'profile', 'email', Google_Service_People::CONTACTS_READONLY])
                ->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();

        //set token for the Google API PHP Client

        $google_client_token = [
            'access_token'=>$user->token,
            'refresh_token'=>$user->refreshToken,
            'expires_in'=>$user->expiresIn
        ];

        $client = new Google_Client();
        $client->setApplicationName('Laravel');
        $client->setDeveloperKey(env('GOOGLE_SERVER_KEY'));
        $client->setAccessToken(json_encode($google_client_token));
        echo json_encode($user);
        $service = new Google_Service_People($client);

        $optParams = array('requestMask.includeField'=>'person.phone_numbers,person.names,person.email_addresses');
        $results = $service->people_connections->listPeopleConnections('people/me', $optParams);

        echo json_encode($results);
    }
}
