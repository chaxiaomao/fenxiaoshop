<?php
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $timestamps = false;
    protected $table = '_order_item';
    protected $primaryKey = 'iid';

    public function order()
    {
        return $this->belongsTo('App\Entity\Orders');
    }
}