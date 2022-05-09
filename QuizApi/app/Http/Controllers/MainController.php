<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\Answer;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function dashboard()
    {
      $quizzes=Quiz::where('status','publish')->where(function($query){
        $query->whereNull('created_at')->orWhere('created_at','>',now());//bitiş tarihi biten sınavları göstermesin
      })->withCount('questions')->paginate(5);
      $results=auth()->user()->results;
      return view('dashboard',compact('quizzes','results'));
    }

    public function quiz($slug)
    {
      $quiz=Quiz::whereSlug($slug)->with('questions.my_answer','my_result')->first() ?? abort(404,'Quiz Bulunamadı');
      if($quiz->my_result){
        return view('quiz_result',compact('quiz'));
      }
      return view('quiz',compact('quiz'));
    }

    public function quiz_result($slug, Request $request)//doğru cevapları kontrol etme ve sınav gönderme işlemi!
    {
      $quiz=Quiz::with('questions')->whereSlug($slug)->first() ?? abort(404,'Quiz Bulunamadı');
      $correct=0;

      //eğerki sınavı bitir butonuna iki kere tıklarsan hata versin(BUG FİX)

       if($quiz->my_result){
         abort(404,'Bu Quize Daha Önce Katıldınız');
       }

      //eğerki sınavı bitir butonuna iki kere tıklarsan hata versin(BUG FİX)

      foreach($quiz->questions as $question)
      {
        Answer::create([
          'user_id'=>auth()->user()->id,//user_id ulaşıyoruz.
          'question_id'=>$question->id,//soru id ulaşıyoruz.
          'answer'=>$request->post($question->id),//doğru cevap id ulaşıyoruz.
        ]);

        if($question->correct_answer===$request->post($question->id)){//doğru cevap bulma işlemi.
          $correct+=1;
        }

      }
      $point=round((100/count($quiz->questions)) * $correct);//puan hesaplama işlemi.
      $wrong=count($quiz->questions)-$correct;//yanlış cevap sayısı.


      Result::create([
        'user_id'=>auth()->user()->id,
        'quiz_id'=>$quiz->id,
        'point'=>$point,
        'correct'=>$correct,
        'wrong'=>$wrong,
      ]);
        return redirect()->route('quiz.detail',$quiz->slug)->with('basarili',"Quiz'i Başarıyla Bitirdin. Puanın: ".$point);
    }

    public function quiz_detail($slug)
    {
      $quizzes=Quiz::whereSlug($slug)->with('my_result','topTen.user')->withCount('questions')->get() ?? abort(404,'Quiz Bulunamadı');//topTen.user o kullanıcıya ait user bilgilerini verir. İlk 10 veya bütün sınava giren verilerindeki user bilgileri için
      return view('quiz_detail',compact('quizzes'));
    }
}
