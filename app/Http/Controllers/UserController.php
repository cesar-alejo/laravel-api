<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Services\GraphAutthService;
use GuzzleHttp\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $user = auth()->user();
        $offices = $user->offices;

        $this->swOficce(2);

        return view('users.index', compact('offices'));
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

    // Request $request
    public function swOficce($office)
    {
        $user = Auth::user();

        //$newOfficeId = $request->input('office_id'); // ID de la nueva oficina
        $newOfficeId = $office;

        // Validar que el usuario pertenece a la oficina seleccionada
        if ($user->offices()->where('office_id', $newOfficeId)->exists()) {

            // Desactivar la oficina actual
            $user->offices()->updateExistingPivot($user->defaultOffice()->id, ['is_default' => false]);

            // Activar la nueva oficina
            $user->offices()->updateExistingPivot($newOfficeId, ['is_default' => true]);

            // Actualizar la sesión o cualquier otro proceso adicional
            session(['office_id' => $newOfficeId, 'office_code' => $user->getActiveOffice()->code]);

            //return redirect()->back()->with('success', 'Oficina cambiada con éxito.');
            return true;
        } else {
            return false;
            //return redirect()->back()->with('error', 'No tienes acceso a esa oficina.');
        }
    }
}
