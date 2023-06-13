<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Unidadmedida;
use App\Models\Responsable;
use App\Models\Corporacione;
use App\Models\Actividade;
use Illuminate\Http\Request;

use PDF;

/**
 * Class ProyectoController
 * @package App\Http\Controllers
 */
class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $proyectos = Proyecto::paginate();

        $proyectos = Proyecto::query()
        ->when(request('search'), function($query){
            return $query->where ('id', 'like', '%'.request('search').'%')
                         
                         ->orWhere('nombre', 'like', '%'.request('search').'%')

                         
                         ->orWhereHas('corporacione', function($q){
                          $q->where('nombre', 'like', '%'.request('search').'%');
                          })
                           ->orWhereHas('responsable', function($qa){
                             $qa->where('nombre', 'like', '%'.request('search').'%');
                         })
                         ->orWhereHas('unidadmedida', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                         }) ;
         },
         function ($query) {
             $query->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();


        $unidades = Unidadmedida::pluck('nombre', 'id');

        return view('proyecto.index', compact('proyectos'))
            ->with('i', (request()->input('page', 1) - 1) * $proyectos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proyecto = new Proyecto();

        $unidades = Unidadmedida::pluck('nombre', 'id');
        $responsables = Responsable::pluck('nombre', 'id');
        $corporaciones = Corporacione::pluck('nombre', 'id');

        return view('proyecto.create', compact('proyecto', 'unidades', 'responsables', 'corporaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Proyecto::$rules);

        $proyecto = Proyecto::create($request->all());

        return redirect()->route('proyectos.index')
            ->with('success', 'registrar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyecto = Proyecto::find($id);

        return view('proyecto.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyecto = Proyecto::find($id);

        $unidades = Unidadmedida::pluck('nombre', 'id');
        $responsables = Responsable::pluck('nombre', 'id');
        $corporaciones = Corporacione::pluck('nombre', 'id');

        return view('proyecto.edit', compact('proyecto', 'unidades', 'responsables', 'corporaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Proyecto $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        request()->validate(Proyecto::$rules);

        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')
            ->with('success', 'editar');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        

        //Validar que el proyecto no tenga ninguna actividad registrada.
        $actividad = Actividade::where('proyecto_id', $id)->exists();

        if($actividad){
            return redirect()->route('proyectos.index')
            ->with('success', 'error');
        }else{
            $proyecto = Proyecto::find($id)->delete();
            return redirect()->route('proyectos.index')
            ->with('success', 'eliminar');
        }

        
    }

    public function reportes()
    {
      
        $responsables = Responsable::pluck('nombre', 'id');
        $corporaciones = Corporacione::pluck('nombre', 'id');

        return view('proyecto.reportes', compact('responsables', 'corporaciones'));
            
    }

    public function reporte_pdf(Request $request)
    {
        //Fecha
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        //Obtener el nombre de la corporacion
        $corporacion = Corporacione::find($request->corporacion_id);
        $nombre_corporacion = '';
        if($corporacion){
            $nombre_corporacion = $corporacion->nombre;
        }
        //Obtener responsables
        $responsable = Responsable::find($request->responsable_id);
        $nombre_responsable = '';
        if($responsable){
            $nombre_responsable = $responsable->nombre;
        }

        $estatus = $request->status;
        $tipo = $request->tipo;
      
        $proyectos = Proyecto::responsables($request->responsable_id)->estatus($estatus)->tipos($tipo)->corporaciones($request->corporacion_id)->fechaInicio($inicio)->fechaFin($fin)->get();
        $sin_empezar = Proyecto::where('status', 'SIN EMPEZAR')->responsables($request->responsable_id)->estatus($estatus)->tipos($tipo)->corporaciones($request->corporacion_id)->fechaInicio($inicio)->fechaFin($fin)->count();
        
        $listo = Proyecto::where('status', 'LISTO')->responsables($request->responsable_id)->estatus($estatus)->tipos($tipo)->corporaciones($request->corporacion_id)->fechaInicio($inicio)->fechaFin($fin)->count();
        $en_progreso = Proyecto::where('status', 'EN PROGRESO')->responsables($request->responsable_id)->estatus($estatus)->tipos($tipo)->corporaciones($request->corporacion_id)->fechaInicio($inicio)->fechaFin($fin)->count();
        $archivado = Proyecto::where('status', 'ARCHIVADO')->responsables($request->responsable_id)->estatus($estatus)->tipos($tipo)->corporaciones($request->corporacion_id)->fechaInicio($inicio)->fechaFin($fin)->count();
        

        $total_proyecto = count($proyectos);

        $datos = [
            
            'nombre_corporacion' => $nombre_corporacion,
            'nombre_responsable' => $nombre_responsable,
            'estatus' => $estatus,
            'tipo' => $tipo,
            'total_proyecto' => $total_proyecto,
            'sin_empezar' => $sin_empezar,
            'listo' => $listo,
            'en_progreso' => $en_progreso,
            'archivado' => $archivado,
            'inicio' => $inicio,
            'fin' => $fin,
            
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('proyecto.reportepdf', ['datos'=>$datos, 'proyectos'=>$proyectos]);
        return $pdf->stream();
        
    }
}
