<?php
namespace App\Auth;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Ixudra\Curl\Facades\Curl;
use Vyuldashev\XmlToArray\XmlToArray;
/*
 * https://stackoverflow.com/questions/53898804/what-is-authserviceprovider-in-laravel
 * https://stackoverflow.com/questions/45024429/how-to-add-a-custom-user-provider-in-laravel-5-4
 * https://stackoverflow.com/questions/33331421/custom-user-authentication-base-on-the-response-of-an-api-call
 * https://stackoverflow.com/questions/54706877/how-to-create-a-custom-auth-guard-provider-for-laravel-5-7
 * https://gist.github.com/paulofreitas/08ea4f2f09102df8630b8a3c8d7a41bb
 * http://semantic-portal.net/concept:794
 */

class AlmaUserProvider implements UserProvider
{
    public $user;

    public function __construct()
    {
        //$this->user = $user;
    }

    /**
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByID($identifier)
    {
        // Get and return a user by their unique identifier
        $this->user = User::find($identifier);
        //dd($identifier);
        //$this->user = AlmaUser::find($identifier);
        return $this->user;
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        // Get and return a user by looking up the given credentials
        if (!$credentials) {
            return null;
        }

        $user = null;

        $ws_credentials = [
            'uid' => $credentials['username'],
            'pw' => $credentials['password'],
        ];

        $response = Curl::to(env('AUTH_ENDPOINT'))
            ->withData($ws_credentials)
            ->withOption('SSL_VERIFYHOST', 0)
            ->withOption('SSL_VERIFYPEER', 0)
            ->withOption('POST', 1)
            ->withOption('RETURNTRANSFER', true)
            ->enableDebug(storage_path('curl.debug.log'))
            ->post();

        $response = preg_replace('/[\n\r]|\s{2,}/', '', $response);
        $response = XmlToArray::convert($response);

        Log::channel('auth')->info('*** ALMA WEBSERVICE AUTH ***');
        Log::channel('auth')->info($ws_credentials['uid']);
        Log::channel('auth')->info($response['result']);

        $session_data = [
            'auth_message' => $response['result']['messg'],
        ];

        session()->put($session_data);

        /*
         * CODE 0 = Login OK
         * CODE 1 = Wrong credentials
         */

        if ($response['result']['code'] == 0) {

            $userData = [
                'username' => $response['result']['primary_id'],
                'barcode' => $response['result']['barcode'],
                'email' => $response['result']['email_address'],
                'is_healthy' => true,
            ];

            $user = User::where('username', $userData['username'])->first();

            if ($user) {
                $user->update([
                    'barcode' => $userData['barcode'],
                    'email' => $userData['email'],
                    'is_healthy' => $userData['is_healthy']
                ]);
                Log::channel('auth')->info('Updated user.');
            } else {
                $user = User::create([
                    'username' => $userData['username'],
                    'barcode' => $userData['barcode'],
                    'email' => $userData['email'],
                    'is_healthy' => $userData['is_healthy']
                ]);
                Log::channel('auth')->info('Created user.');
            }
        }

        Log::channel('auth')->info($user);

        return $user;
    }

    /**
         * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return true;
        //return $credentials['username'] == $user->barcode || $credentials['username'] == $user->username;
    }

    public function updateRememberToken(Authenticatable $user, $token) { }
    public function retrieveByToken($identifier, $token) { }
}
