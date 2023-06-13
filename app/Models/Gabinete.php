<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Gabinete
 *
 * @property $id
 * @property $nombre
 * @property $responsable
 * @property $imagen
 * @property $telefono
 * @property $correo
 * @property $created_at
 * @property $updated_at
 *
 * @property Corporacione[] $corporaciones
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Gabinete extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'responsable' => 'required',
		'imagen' => 'required',
		'telefono' => 'required',
		'correo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','responsable','imagen','telefono','correo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function corporaciones()
    {
        return $this->hasMany('App\Models\Corporacione', 'gabinete_id', 'id');
    }

    public function scopeResponsabilidad($query, $responsable) {
    	if ($responsable) {
    		return $query->where('responsable','like',"%$responsable%");
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
