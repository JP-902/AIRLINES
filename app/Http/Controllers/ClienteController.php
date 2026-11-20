<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;



class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $clientes = Cliente::all();
        //dd($clientes);
        // return view('cliente.index',compact('clientes')); //agregado en clase

        // $clientes=Cliente::whereIn('id',[1,2,3])->get();
        // $clientes=Cliente::whereNotIn('id',[1,2,3])->get();

        $clientes = Cliente::all();
        // $clientes_count = Cliente::all()->count();
        // dd($clientes);
        $clientes_count= Cliente::exists();
        return view('Cliente.index', compact('clientes','clientes_count'));



        
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
    
       $validated = $request->validate([
        'codigo'=> 'string|max:20',
        'email'=> 'required|string|max:20',
        'nombre'=> 'required|string|max:20',
        'telefono'=>'nullable|string|max:8',
        'direccion'=>'nullable|string|max:255',
        'estado'=>'required|in:activo,inactivo'
       ],
       [
            'codigo.required' => 'El campo codigo es obligatorio',
            'codigo.max' => 'El campo codigo no puede tener mas de 20 caracteres',
            'nombre.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'telefono.required' => 'El campo telefono es obligatorio',
            'direccion.required' => 'El campo direccion es obligatorio',
            'estado.required' => 'El campo estado es obligatorio',
           ]);
    // dd($validated);
       Cliente::create($validated);

       return redirect()->route('clientes.index')->with('status','Cliente registrado');
        
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $cliente)
    {

        //   dd($cliente); 
        $clientes = Cliente::find($cliente);
        //   dd($clientess);
        $clientes->codigo=$request->codigo;
        $clientes->email=$request->email;
        $clientes->nombre=$request->nombre;
        $clientes->telefono=$request->telefono;
        $clientes->direccion=$request->direccion;
        $clientes->estado=$request->estado;

       $clientes->save();
       
        return redirect()->route('clientes.index')->with('success','Cliente actualizado');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->delete();

        return redirect()->route('clientes.index')->with('success','Cliente eliminado');
    }
}
