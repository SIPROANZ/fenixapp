<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Corporacione
 *
 * @property $id
 * @property $nombre
 * @property $rif
 * @property $imagen
 * @property $telefono
 * @property $responsable
 * @property $correo
 * @property $gabinete_id
 * @property $direcion_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Direccione $direccione
 * @property Gabinete $gabinete
 * @property Proyecto[] $proyectos
 * @property Responsable[] $responsables
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Corporacione extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'rif' => 'required',
		'imagen' => 'required|image|max:2048',
		'telefono' => 'required',
		'responsable' => 'required',
		'correo' => 'required',
		'gabinete_id' => 'required',
		'direcion_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','rif','imagen','telefono','responsable','correo','gabinete_id','direcion_id'];


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
    public function gabinete()
    {
        return $this->hasOne('App\Models\Gabinete', 'id', 'gabinete_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proyectos()
    {
        return $this->hasMany('App\Models\Proyecto', 'corporacion_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responsables()
    {
        return $this->hasMany('App\Models\Responsable', 'corporacion_id', 'id');
    }

    public function scopeResponsabilidad($query, $responsable) {
    	if ($responsable) {
    		return $query->where('responsable','like',"%$responsable%");
    	}
    }

   

    public function scopeDirecciones($query, $direccion) {
    	if ($direccion) {
    		return $query->where('direcion_id','like',"$direccion");
    	}
    }

    public function scopeGabinetes($query, $gabinete) {
    	if ($gabinete) {
    		return $query->where('gabinete_id','like',"$gabinete");
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
