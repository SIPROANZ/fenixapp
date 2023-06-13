<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Responsable
 *
 * @property $id
 * @property $nombre
 * @property $telefono
 * @property $correo
 * @property $cargo
 * @property $imagen
 * @property $corporacion_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Actividade[] $actividades
 * @property Corporacione $corporacione
 * @property Proyecto[] $proyectos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Responsable extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'telefono' => 'required',
		'correo' => 'required',
		'cargo' => 'required',
		'imagen' => 'required',
		'corporacion_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','telefono','correo','cargo','imagen','corporacion_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actividades()
    {
        return $this->hasMany('App\Models\Actividade', 'responsable_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function corporacione()
    {
        return $this->hasOne('App\Models\Corporacione', 'id', 'corporacion_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proyectos()
    {
        return $this->hasMany('App\Models\Proyecto', 'responsable_id', 'id');
    }

    public function scopeResponsabilidad($query, $responsable) {
    	if ($responsable) {
    		return $query->where('nombre','like',"%$responsable%");
    	}
    }

    public function scopeCorporaciones($query, $corporacion) {
    	if ($corporacion) {
    		return $query->where('corporacion_id','like',"$corporacion");
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
