<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use GuzzleHttp;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /** @var GuzzleHttp\Client  */
    protected $client;

    /** @var array */
    protected $credentials;

    public function __construct(GuzzleHttp\Client $client, Repository $configRepository)
    {
        $this->client = $client;
        $this->credentials = $configRepository->get('auth.passport.grant.password');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $username = $request->input('name');
        $password = $request->input('password');

        return $this->authenticate($request, $username, $password);
    }

    protected function authenticate(Request $request, string $username, string $password)
    {
        $protocol = config('app.protocol');
        $domain   = config('app.domain');

        $response = $this->client->post("{$protocol}://{$domain}/oauth/token", [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $this->credentials['client_id'],
                'client_secret' => $this->credentials['client_secret'],
                'username' => $username,
                'password' => $password,
                'scope' => '*',
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            $this->clearLoginAttempts($request);
            $authorization = json_decode($response->getBody(), true);

            return response($authorization);
        }

        $this->incrementLoginAttempts($request);

        $content = $response->getBody();

        return response($content, $response->getStatusCode());
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'name';
    }
}
