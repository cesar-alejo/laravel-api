<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\OutlookService;
use App\Models\radicationMail;

class RadicationMailController extends Controller
{
    protected $outlookService;

    public function __construct(OutlookService $outlookService)
    {
        $this->outlookService = $outlookService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mails = $this->outlookService->getEmails();

        return view('rmail.index', ['mails' => $mails]);
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
    public function show(radicationMail $radicationMail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(radicationMail $radicationMail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, radicationMail $radicationMail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(radicationMail $radicationMail)
    {
        //
    }
}
