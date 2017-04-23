<?php
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = '_member';
    protected $primaryKey = 'uid';
    public $timestamps = false;

}