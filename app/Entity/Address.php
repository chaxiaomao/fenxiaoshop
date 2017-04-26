<?php
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;
    protected $table = '_address';
    protected $primaryKey = 'aid';
}