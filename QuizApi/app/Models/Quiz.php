<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Quiz extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table='quiz';
    protected $fillable=['title','slug','description','status','created_at','updated_at'];

    protected $appends=['details','my_rank'];//yeni sütun oluşturma

    public function getMyRankAttribute()
    {
      $rank=0;
      foreach($this->results()->orderByDesc('point')->get() as $result){
        $rank+=1;
        if(auth()->user()->id==$result->user_id){
          return $rank;
        }
      }
    }

    public function getDetailsAttribute() //laravelin mutation yapısı ile veri tabanında olmamasına rağmen yeni bir sütun veya alan oluşturma
    {
       return[
         'average'=>round($this->results()->avg('point')),//sınav sonuçlarını gösterme detail. avg ile katılımcıların puan ortalamasını ekran basabiliriz.
         'join_count'=>$this->results()->count(),//katılımcı sayısını bulduk.
       ];
    }

     public function topTen()
     {
       return $this->results()->orderByDesc('point')->take(10);//puan top10 listesi
     }


    public function results()//tüm sınava girenleri gösterme
    {
      return $this->hasMany('App\Models\Result');
    }

    public function my_result()//sınava girilmiş sonuçları gösterme
    {
      return $this->hasOne('App\Models\Result')->where('user_id',auth()->user()->id);//benim üye id olan veriyi getir.
    }


    public function questions()
    {
      return $this->hasMany('App\Models\Questions','quiz_id','id');
    }
    public function sluggable(): array
    {
      return [
          'slug' => [
              'onUpdate' => true,//slug değeri guncellemsi için bu kod gerekli!!!
              'source' => 'title'
          ]
        ];
    }
}
