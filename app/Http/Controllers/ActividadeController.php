<?php

namespace App\Http\Controllers;

use App\Models\Actividade;
use App\Models\Proyecto;
use App\Models\Responsable;
use App\Models\Direccione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use PDF;

use App\Models\Corporacione;

/**
 * Class ActividadeController
 * @package App\Http\Controllers
 */
class ActividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $actividades = Actividade::paginate();

        $actividades = Actividade::query()
        ->when(request('search'), function($query){
            return $query->where ('id', 'like', '%'.request('search').'%')
                         
                         ->orWhere('nombre', 'like', '%'.request('search').'%')
                         ->orWhere('costo', 'like', '%'.request('search').'%')
                         ->orWhere('status', 'like', '%'.request('search').'%')
                         ->orWhere('descripcion', 'like', '%'.request('search').'%')

                         ->orWhereHas('proyecto', function($q){
                          $q->where('nombre', 'like', '%'.request('search').'%');
                          })
                           ->orWhereHas('responsable', function($qa){
                             $qa->where('nombre', 'like', '%'.request('search').'%');
                         })
                         ->orWhereHas('direccione', function($qa){
                            $qa->where('descripcion', 'like', '%'.request('search').'%');
                         }) ;
         },
         function ($query) {
             $query->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();


        return view('actividade.index', compact('actividades'))
            ->with('i', (request()->input('page', 1) - 1) * $actividades->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actividade = new Actividade();
        $proyectos = Proyecto::pluck('nombre', 'id');
        $responsables = Responsable::pluck('nombre','id');
        $direcciones = Direccione::pluck('descripcion', 'id');
        return view('actividade.create', compact('actividade', 'proyectos', 'responsables', 'direcciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Actividade::$rules);

        $file = $request->file('imagen')->store('public/imagenes/actividades/');
        $url = Storage::url($file);
        $actividade = Actividade::create($request->all());
        $actividade->imagen = $url;
        $actividade->save();

        return redirect()->route('actividades.index')
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
        $actividade = Actividade::find($id);

        return view('actividade.show', compact('actividade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actividade = Actividade::find($id);
        $proyectos = Proyecto::pluck('nombre', 'id');
        $responsables = Responsable::pluck('nombre','id');
        $direcciones = Direccione::pluck('descripcion', 'id');

        return view('actividade.edit', compact('actividade', 'proyectos', 'responsables', 'direcciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Actividade $actividade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividade $actividade)
    {
        request()->validate(Actividade::$rules);

        $file = $request->file('imagen')->store('public/imagenes/actividades/');
        $url = Storage::url($file);

        $actividade->update($request->all());

        $actividade->imagen = $url;
        $actividade->save();

        

        return redirect()->route('actividades.index')
            ->with('success', 'editar');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $actividade = Actividade::find($id)->delete();

        return redirect()->route('actividades.index')
            ->with('success', 'eliminar');
    }

    public function reportes()
    {
      
        $responsables = Responsable::pluck('nombre', 'id');
        $proyectos = Proyecto::pluck('nombre', 'id');
        $direcciones = Direccione::pluck('descripcion', 'id');

        return view('actividade.reportes', compact('responsables', 'proyectos', 'direcciones'));
            
    }

    public function reporte_pdf(Request $request)
    {
        //Fecha
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        //Obtener el nombre del proyecto
        $proyecto = Proyecto::find($request->proyecto_id);
        $nombre_proyecto = '';
        if($proyecto){
            $nombre_proyecto = $proyecto->nombre;
        }
        //Obtener responsables
        $responsable = Responsable::find($request->responsable_id);
        $nombre_responsable = '';
        if($responsable){
            $nombre_responsable = $responsable->nombre;
        }
        //Obtener la descripcion de la direccion
        $direccion = Direccione::find($request->direccion_id);
        $nombre_direccion ='';
        if($direccion){
            $nombre_direccion =$direccion->descripcion;
        }

        $estatus = $request->status;


        
      
        $actividades = Actividade::responsables($request->responsable_id)->estatus($estatus)->direcciones($request->direccion_id)->proyectos($request->proyecto_id)->fechaInicio($inicio)->fechaFin($fin)->get();
        $sin_empezar = Actividade::where('status', 'SIN EMPEZAR')->responsables($request->responsable_id)->estatus($estatus)->direcciones($request->direccion_id)->proyectos($request->proyecto_id)->fechaInicio($inicio)->fechaFin($fin)->count();
        $listo = Actividade::where('status', 'LISTO')->responsables($request->responsable_id)->estatus($estatus)->direcciones($request->direccion_id)->proyectos($request->proyecto_id)->fechaInicio($inicio)->fechaFin($fin)->count();
        $en_progreso = Actividade::where('status', 'EN PROGRESO')->responsables($request->responsable_id)->estatus($estatus)->direcciones($request->direccion_id)->proyectos($request->proyecto_id)->fechaInicio($inicio)->fechaFin($fin)->count();
        $archivado = Actividade::where('status', 'ARCHIVADO')->responsables($request->responsable_id)->estatus($estatus)->direcciones($request->direccion_id)->proyectos($request->proyecto_id)->fechaInicio($inicio)->fechaFin($fin)->count();
        $costo = $actividades->sum('costo');

        $total_proyecto = count($actividades);

        $datos = [
            
            'nombre_proyecto' => $nombre_proyecto,
            'nombre_responsable' => $nombre_responsable,
            'estatus' => $estatus,
            'nombre_direccion' => $nombre_direccion,
            'total_proyecto' => $total_proyecto,
            'sin_empezar' => $sin_empezar,
            'listo' => $listo,
            'en_progreso' => $en_progreso,
            'archivado' => $archivado,
            'inicio' => $inicio,
            'fin' => $fin,
            'costo' => $costo,
            
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('actividade.reportepdf', ['datos'=>$datos, 'actividades'=>$actividades]);
        return $pdf->stream();
        
    }
}
