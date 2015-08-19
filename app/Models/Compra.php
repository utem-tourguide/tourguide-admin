<?php namespace TourGuide\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model {

	protected $fillable = ['usuario_id', 'postal_id'];

	public function usuario() {
		return $this->belongsTo('TourGuide\Models\Usuario');
	}

	public function sumaDePostalesVendidas{
		
	}

}
