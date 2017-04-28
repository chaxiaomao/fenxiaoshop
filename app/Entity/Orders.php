<?php
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public $timestamps = false;
    protected $table = '_orders';
    protected $primaryKey = 'oid';

    public function item()
    {
        return $this->hasMany('App\Entity\OrderItem', 'oid');
    }
}