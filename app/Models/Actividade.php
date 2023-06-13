<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Actividade
 *
 * @property $id
 * @property $nombre
 * @property $costo
 * @property $status
 * @property $cantidad
 * @property $descripcion
 * @property $proyecto_id
 * @property $responsable_id
 * @property $direcion_id
 * @property $imagen
 * @property $created_at
 * @property $updated_at
 *
 * @property Direccione $direccione
 * @property Proyecto $proyecto
 * @property Responsable $responsable
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Actividade extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'status' => 'required',
		'descripcion' => 'required',
		'proyecto_id' => 'required',
		'responsable_id' => 'required',
		'direcion_id' => 'required',
        'created_at' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','costo','status','cantidad','descripcion','proyecto_id','responsable_id','direcion_id','imagen', 'created_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function direccione()
    {
        return $this->hasOne('App\Models\Direccione', 'id', 'direcion_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proyecto()
    {
        return $this->hasOne('App\Models\Proyecto', 'id', 'proyecto_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function responsable()
    {
        return $this->hasOne('App\Models\Responsable', 'id', 'responsable_id');
    }

     public function scopeResponsables($query, $responsable) {
    	if ($responsable) {
    		return $query->where('responsable_id','like',"$responsable");
    	}
    }

    public function scopeEstatus($query, $estatus) {
    	if ($estatus) {
    		return $query->where('status','like',"$estatus");
    	}
    }

    public function scopeDirecciones($query, $direccion) {
    	if ($direccion) {
    		return $query->where('direcion_id','like',"$direccion");
    	}
    }

    public function scopeProyectos($query, $proyecto) {
    	if ($proyecto) {
    		return $query->where('proyecto_id','like',"$proyecto");
    	}
    }

    public function scopeFechaInicio($query, $inicio) {
    	if ($inicio) {
    		return $query->where('created_at','>=',"$inicio");
    	}
    }

    public function scopeFechaFin($query, $fin) {
    	if ($fin) {
    		return $query->where('created_at','<=',"$fin");
    	}
    }
    

}
