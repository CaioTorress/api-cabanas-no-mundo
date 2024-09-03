<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveRequest;
use App\Models\Reserve;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Reserve::query();

        $all = $this->handle($query);
        
        return $this->success($all, "Lista de reservas");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $files = $request->all();

        $reserve = Reserve::create( $files );

        return $this->success($reserve, "Lista de reservas");

    }

    /**
     * Display the specified resource.
     */
    public function show(Reserve $reserve)
    {
        return $this->success($reserve, "Dados da Reserva.");
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReserveRequest $request, Reserve $reserve)
    {   
        $files = $request->all();
        $reserve->update( $files );
        
        return $this->success($reserve, 'Reserva alterada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserve $reserve)
    {
        $reserve->delete();

        return $this->success($reserve, 'Sucesso.', 'Cliente deletado.');
    }
}
