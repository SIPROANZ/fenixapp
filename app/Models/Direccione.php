<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Direccione
 *
 * @property $id
 * @property $descripcion
 * @property $municipios_id
 * @property $parroquias_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Actividade[] $actividades
 * @property Municipio $municipio
 * @property Parroquia $parroquia
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Direccione extends Model
{
    
    static $rules = [
		'descripcion' => 'required',
		'municipios_id' => 'required',
		'parroquias_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion','municipios_id','parroquias_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actividades()
    {
        return $this->hasMany('App\Models\Actividade', 'direcion_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function municipio()
    {
        return $this->hasOne('App\Models\Municipio', 'id', 'municipios_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parroquia()
    {
        return $this->hasOne('App\Models\Parroquia', 'id', 'parroquias_id');
    }
    

    public function scopeDirecciones($query, $descripcion) {
    	if ($descripcion) {
    		return $query->where('descripcion','like',"%$descripcion%");
    	}
    }

    public function scopeMunicipios($query, $municipios_id) {
    	if ($municipios_id) {
    		return $query->where('municipios_id','like',"$municipios_id");
    	}
    }

    public function scopeParroquias($query, $parroquias_id) {
    	if ($parroquias_id) {
    		return $query->where('tipo','like',"$parroquias_id");
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
