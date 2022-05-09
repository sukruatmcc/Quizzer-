<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $table='questions';
    protected $fillable=['question','image','answer1','answer2','answer3','answer4','correct_answer','created_at','updated_at'];

    protected $appends = ['true_percent'];
   //Doğru Cevap Yüzdesi
   public function getTruePercentAttribute()
   {
    $answer_count = $this->answers()->count();
    $true_answer = $this->answers()->where('answer',$this->correct_answer)->count();

    return round((100/$answer_count) * $true_answer);
   }

   public function answers()//burada cevapları aldık
   {
     return $this->hasMany('App\Models\Answer','question_id');
   }
   //Doğru Cevap Yüzdesi


   //quiz sonucu göster
   public function my_answer()
   {
     return $this->hasOne('App\Models\Answer','question_id')->where('user_id',auth()->user()->id);//benim üye id olan veriyi getir.
   }
   //quiz sonucu göster

    public function quiz()
    {
      return $this->hasMany('App\Models\Questions','quiz_id');
    }
}
