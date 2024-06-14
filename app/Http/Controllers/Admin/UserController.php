<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Services\GraphAuthService;
//use App\Services\MsalAuthService;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    protected $graphAuthService;
    //protected $msalAuthService;

    public function __construct(GraphAuthService $graphAuthService)
    {
        $this->graphAuthService = $graphAuthService;
    }
    //public function __construct(MsalAuthService $msalAuthService)
    //{
    //    $this->msalAuthService = $msalAuthService;
    //}

    /**
     * Validation LDAP
     */
    public function auth()
    {
        $username = 'prubasCd';
        $password = '2156dsa4856184'; //0rF3oM5p5+2024*2024**
        //$username = 'porfeo';
        //$password = '0rF3o+2024*2024**';

        //$result = $this->msalAuthService->validateCredentials($username, $password);
        //$result = $this->graphAuthService->validateCredentials($username, $password);

        $result = [];

        return view('users.index', ['users' => $result]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = 'prubasCd';
        $password = '2156dsa4856184'; //0rF3oM5p5+2024*2024**
        //$username = 'porfeo';
        //$password = '0rF3o+2024*2024**';

        //$result = $this->msalAuthService->validateCredentials($username, $password);
        $result = $this->graphAuthService->validateCredentials($username, $password);

        return view('users.index', ['users' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
