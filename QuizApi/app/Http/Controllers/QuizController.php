<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use Illuminate\Http\Request;
use App\Http\Request\QuizOlusturRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function quiz_list()
      {
        //arama kısmı
        $quizzes=Quiz::withCount('questions');//withCount ile soru sayımızı ekrana bastırdık.
        if(request()->get('title')){
          $quizzes=$quizzes->where('title','LIKE',"%".request()->get('title')."%");
        }
        if(request()->get('status')){
          $quizzes=$quizzes->where('status',request()->get('status'));
        }
        $quizzes=$quizzes->paginate(5);
        return view('admin.list',compact('quizzes'));
      }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quiz_olustur()
    {
        return view('admin.quiz_ekle');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuizRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function quiz_ekle_post(Request $request)
    {
      $request->validate([
        'title' => 'required|max:255',
        'description'=>'required|min:10|max:1000',
        'created_at'=>'after:'.now(),
    ]);
      $title=$request->title;
      $description=$request->description;
      $created_at=$request->created_at;
       Quiz::create([
           'title'=>$title,
           'description'=>$description,
           'created_at'=>$created_at,
       ]);
       return redirect()->route('quiz.list')->with('basarili','Quiziniz Başarıyla Eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function quiz_guncelle($id)
    {
      $quiz=Quiz::withCount('questions')->find($id) ?? abort(404,'Quiz Bulunamadı');
        return view('admin.guncelle',compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function quiz_guncelle_post($id, Request  $request)
    {
      $quiz=Quiz::find($id) ?? abort(404,'Quiz Bulunamadı');

      Quiz::where('id',$id)->first()->update($request->except(['method','token']));
      /*
      $title=$request->title;
      $description=$request->description;
      $created_at=$request->created_at;
       Quiz::whereId($id)->update([
           'title'=>$title,
           'description'=>$description,
           'created_at'=>$created_at,
       ]);
       */
       return redirect()->route('quiz.list')->with('basarili','Quiziniz Başarıyla Güncellendi');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuizRequest  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function quiz_sil($id)
    {
       $quiz=Quiz::find($id) ?? abort(404,'Quiz Bulunamadı');//hata mesajı
       $quiz->whereId($id)->delete();
       return redirect()->route('quiz.list')->with('basarili','Quiziniz Başarıyla Silindi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function quiz_info($id)
    {
      $quiz=Quiz::with('topTen.user','results.user')->withCount('questions')->find($id) ?? abort(404,'Quiz Bulunamadı');//topTen.user o kullanıcıya ait user bilgilerini verir. İlk 10 veya bütün sınava giren verilerindeki user bilgileri için
      return view('admin.quiz_info',compact('quiz'));
    }
}
