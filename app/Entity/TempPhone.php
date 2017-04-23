<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/20
 * Time: 19:52
 */
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class TempPhone extends Model
{
    protected $table = '_temp_phone';
    protected $primaryKey = 'pid';
    public $timestamps = false;

}