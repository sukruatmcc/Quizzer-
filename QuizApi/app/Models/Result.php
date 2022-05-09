<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $table='result';
    protected $fillable=['user_id','quiz_id','point','correct','wrong','created_at','updated_at'];

    public function user()
    {
      return $this->belongsTo('App\Models\User');//kullanıcı bilgileri
    }

    public function quiz()
    {
      return $this->belongsTo('App\Models\Quiz');//quiz bilgileri
    }
}
