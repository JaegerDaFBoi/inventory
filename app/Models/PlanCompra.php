<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanCompra extends Model
{
    public $timestamps = false;
    protected $table = 'plan_compras';
    protected $primaryKey = 'referencia';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'referencia',
        'materia_prima',
        'inventario_actual',
        'cantidad',
        'stock_seguridad',
        'consumo_mrp',
        'consumo',
        'pedido',
        'necesidad',
        'final_teorico',
    ];

    protected $appends = [
        'final_teorico_rotura_stock',
    ];

    public function getFinalTeoricoRoturaStockAttribute()
    {
        return $this->inventario_actual - $this->stock_seguridad;
    }
}
