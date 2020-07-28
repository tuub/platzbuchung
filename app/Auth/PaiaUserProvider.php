<?php
namespace App\Auth;

use App\User;
use DateTime;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Ixudra\Curl\Facades\Curl;
use Vyuldashev\XmlToArray\XmlToArray;

/**
 * Authenticate against PAIA
 *
 * This class should work with any implementation of PAIA. It is verified to 
 * work with library systems hosted by the GBV (https://www.gbv.de) with the 
 * endpoint being https://paia.gbv.de/ followed by the library id 
 * (e.g. https://paia.gbv.de/DE-830/). 
 *
 * @see: https://gbv.github.io/paia/   Patron Account Information API
 *
 * @author  Tobias Zeumer <tobias.zeumer@tuhh.de>
 * @license https://opensource.org/licenses/MIT MIT License 
 * @link    https://github.com/tubhh/platzbuchung
 *
 * @since   2020-07-25 Initial version (copy of AlmaUserProvider.php)
 *
 * @todo    Maybe use session data to indicate that an email is set for the 
 *          account and thus not requiring a phone number upon first login.
 */
class PaiaUserProvider implements UserProvider
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
        return $this->user;
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @todo: Maybe use Curl::to() instead of file_get_contents() too...
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        Log::channel('auth')->info('*** PAIA WEBSERVICE AUTH ***');

        // Get and return a user by looking up the given credentials
        if (!$credentials) {
            Log::channel('auth')->info('No credentials supplied');
            return null;
        }

        $user = null;

        // Login & token (suppress warning on wrong url/user/password)
        $patron         = @file_get_contents(env('AUTH_ENDPOINT').'/auth/login?username='.$credentials['username'].'&password='.$credentials['password'].'&grant_type=password&scope=read_patron');
        $http_status    = explode(' ', $http_response_header[0])[1]; // https://www.php.net/manual/en/reserved.variables.httpresponseheader.php

        // Error in request?
        if (!$patron || ($http_status < 200 && $http_status >= 300)) {
            Log::channel('auth')->info("No access. HTTP Status: $http_status");
            return null;
        }
        Log::channel('auth')->info('Login ok');

        // PAIA token is valid for 3600 seconds
        $access_token   = json_decode($patron, true)['access_token'];

        // Get user data
        $patron_data_json = file_get_contents(env('AUTH_ENDPOINT').'/core/'.$credentials['username'].'?access_token='.$access_token);
        $patron_data      = json_decode($patron_data_json, true);
        
        /* No session data needed yet...
            // Maybe use session data later to check if a email is set. And if so don't ask for phone number 
            // Maybe use for user type (different reservation conditions for students and external patrons)
        $session_data = [
            'auth_message' => $response['result']['messg'],
        ];
        session()->put($session_data);
        */
        
        if ($access_token) {
            // Usertype (might be useful to restrict access by patron status)
            $user_type = explode(':', $patron_data['type'][0])[2];

            // Membership valid in days (just an example)
            $today  = new DateTime();
            $expiry = DateTime::createFromFormat('Y-m-d', $patron_data['expires']);
            $interval = $today->diff($expiry);
            //echo $today->format('d.m.Y').'<br>'. $expiry->format('d.m.Y').'<br>'.$interval->format('%R%a days').'<br>';

            // Status
            //echo $patron_data['status'].'<br>'; // 0 = active, 1 = inactive (OUS-Status 8 (Ausweisverlust), 9 "Siehe interne Bemerkung"),  2 = inactive because account expired, 3 = inactive because of outstanding fees, 4 = inactive because account expired and outstanding fees

            $userData = [
                'username' => $patron_data['name'],
                'barcode' => $credentials['username'],
                'email' => $patron_data['email'],
                'is_healthy' => true,
            ];

            $user = User::where('username', $userData['username'])->first();

            // The data for the mysql "user" table
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
    }

    public function updateRememberToken(Authenticatable $user, $token) { }
    public function retrieveByToken($identifier, $token) { }
}
