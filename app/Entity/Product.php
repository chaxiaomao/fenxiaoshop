<?php
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = '_product';
    protected $primaryKey = 'pid';
    public $timestamps = false;

}