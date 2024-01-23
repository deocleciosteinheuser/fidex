<?php

namespace App\Http\Controllers;

use App\Models\app;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home');    
    }

    public static function listMenu() {
        return [
            'navbar' => [
                'logo' => [
                    'route' => 'home',
                    'title' => '<h1>Fidex</h1>',
                ],
                'lista' => [
                    [
                        'route' => 'home', 
                        'title' => 'Home',
                    ],
                    [
                        'route' => 'consultas', 
                        'title' => 'Consultas',
                        'lista' => ConsultaController::agrupadores()
                    ],
                ], 
            ]
        ];
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
    public function show(app $app)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(app $app)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, app $app)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(app $app)
    {
        //
    }
}
