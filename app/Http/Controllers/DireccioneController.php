<?php

namespace App\Http\Controllers;

use App\Models\Direccione;
use App\Models\Municipio;
use App\Models\Parroquia;
use Illuminate\Http\Request;
use PDF;

/**
 * Class DireccioneController
 * @package App\Http\Controllers
 */
class DireccioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $direcciones = Direccione::paginate();

        return view('direccione.index', compact('direcciones'))
            ->with('i', (request()->input('page', 1) - 1) * $direcciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $direccione = new Direccione();
        $municipio= Municipio::pluck('nombre','id');
        $parroquia= Parroquia::pluck('nombre','id');
        return view('direccione.create', compact('direccione', 'municipio','parroquia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Direccione::$rules);

        $direccione = Direccione::create($request->all());

        return redirect()->route('direcciones.index')
            ->with('success', 'Direccion Registrada Con Exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $direccione = Direccione::find($id);

        return view('direccione.show', compact('direccione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $direccione = Direccione::find($id);
        $municipio= Municipio::pluck('nombre','id');
        $parroquia= Parroquia::pluck('nombre','id');

        return view('direccione.edit', compact('direccione' ,'municipio','parroquia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Direccione $direccione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Direccione $direccione)
    {
        request()->validate(Direccione::$rules);

        $direccione->update($request->all());

        return redirect()->route('direcciones.index')
            ->with('success', 'Direccion Actualizada Con Exito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $direccione = Direccione::find($id)->delete();

        return redirect()->route('direcciones.index')
            ->with('success', 'Direccion Eliminida Con Exito');
    }

    public function reportes()
    {
      
        $municipios = Municipio::pluck('nombre', 'id');
        $parroquias = Parroquia::pluck('nombre', 'id');

        return view('direccione.reportes', compact('municipios', 'parroquias'));
            
    }

    public function reporte_pdf(Request $request)
    {
        //Fecha
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        //Obtener el nombre de la municipio
        $municipios = Municipio::find($request->municipio_id);
        $nombre_municipios = '';
        if($municipios){
            $nombre_municipios = $municipios->nombre;
        }
        //Obtener responsables
        $parroquias = Parroquia::find($request->parroquia_id);
        $nombre_parroquia = '';
        if($parroquias){
            $nombre_parroquia = $parroquias->nombre;
        }

        $direccion = $request->direccion;
      
        $direcciones = Direccione::direcciones($request->direccion)->municipios($request->municipio_id)->parroquias($request->parroquia_id)->fechaInicio($inicio)->fechaFin($fin)->get();
       

        $total_direcciones = count($direcciones);

        $datos = [
            
            'nombre_municipio' => $nombre_municipios,
            'nombre_parroquia' => $nombre_parroquia,
            'nombre_direccion' => $direccion,
            'total_direcciones' => $total_direcciones,
            'inicio' => $inicio,
            'fin' => $fin,
            
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('direccione.reportepdf', ['datos'=>$datos, 'direcciones'=>$direcciones]);
        return $pdf->stream();
        
    }
}
