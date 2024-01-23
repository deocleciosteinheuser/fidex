<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePessoaRequest;
use App\Http\Resources\PessoaResource;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PessoaResource::collection(Pessoa::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdatePessoaRequest $request)
    {
        $oPessoa = Pessoa::create($request->validated());
        return new PessoaResource($oPessoa);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {        
        return new PessoaResource(Pessoa::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdatePessoaRequest $request, string $id)
    {
        $oPessoa = Pessoa::findOrFail($id);
        $oPessoa->update($request->all());
        return new PessoaResource($oPessoa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pessoa::findOrFail($id)->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
