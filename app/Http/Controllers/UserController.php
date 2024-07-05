<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Services\GraphAutthService;
use GuzzleHttp\Client;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    //protected $graphAuthService;

    //public function __construct(GraphAuthService $graphAuthService)
    //{
    //    $this->graphAuthService = $graphAuthService;
    //}

    public function auth()
    {
        $client = new Client();

        $result = [];

        //$result = $this->graphAuthService->validateCredentials(config('graph.user'), config('graph.userPws'));

        try {

            throw new \Exception("Authentication in development");
            // Flujo ROPC No Recomendado
            $response = $client->post('https://login.microsoftonline.com/' . config('graph.tenantId') . '/oauth2/v2.0/token', [
                'form_params' => [
                    'client_id' => config('graph.clientId'),
                    'client_secret' => config('graph.clientSecret'),
                    'grant_type' => 'password',
                    'scope' => 'https://graph.microsoft.com/.default',
                    'username' => config('graph.user'),
                    'password' => config('graph.userPws'),
                ],
            ]);

            $result = json_decode((string)$response->getBody(), true);
        } catch (\Exception $e) {

            $result = [
                'error' => true,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }

        return view('users.index', compact('result'));
    }

    public function index()
    {
        $username = 'prubasCd';
        $password = '2156dsa4856184'; //0rF3oM5p5+2024*2024**
        //$username = 'porfeo';
        //$password = '0rF3o+2024*2024**';

        $result = [];
        //$result = $this->msalAuthService->validateCredentials($username, $password);
        //$result = $this->graphAuthService->validateCredentials($username, $password);

        return view('users.index', ['users' => $result]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
