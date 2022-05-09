<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use App\Models\Quiz;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function question_list($id)
     {
      $quiz= Quiz::whereId($id)->with('questions')->first() ?? abort(404,'Quiz Bulunamadı');
       return view('admin.questionslist',compact('quiz'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function question_olustur($id)
    {
        $quiz=Quiz::find($id) ?? abort(404,'Question Bulunamadı');
        return view('admin.questionolustur',compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function question_olustur_Post($id,Request $request)
    {
      $request->validate([
        'question' => 'required|min:3',
        'image'=>'image|nullable|file|mimes:jpg,jpeg,png',
        'answer1'=>'required|min:3',
        'answer2'=>'required|min:3',
        'answer3'=>'required|min:3',
        'answer4'=>'required|min:3',
        'correct_answer'=>'required',
    ]);
    if($request->hasFile('image')){
       $filename=Str::slug($request->question).'.'.$request->image->extension();//dosyas adı tanımlama
       $fileNamewithUpload='upload'.$filename;//dosya yükleme
       $request->image->move(public_path('upload'),$filename);
       $request->merge([
         'image'=>$fileNamewithUpload,
       ]);

    }
      Quiz::find($id)->questions()->create($request->post());//burayı all dersen dosya tmp tanımlanır.post tanımla
      return redirect()->route('questions.list',$id)->with('basarili','Soru başarıyla oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function question_guncelle($quiz_id,$question_id)
    {
      $question = Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404,'Quiz veya Soru Bulunamadı');
      return view('admin.question_guncelle',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function question_guncelle_Post($quiz_id,$question_id,Request $request)
    {
      $request->validate([
        'question' => 'required|min:3',
        'image'=>'image|nullable|file|mimes:jpg,jpeg,png',
        'answer1'=>'required|min:3',
        'answer2'=>'required|min:3',
        'answer3'=>'required|min:3',
        'answer4'=>'required|min:3',
        'correct_answer'=>'required',
    ]);
      if($request->hasFile('image')){
         $filename=Str::slug($request->question).'.'.$request->image->extension();//dosyas adı tanımlama
         $fileNamewithUpload='upload'.$filename;//dosya yükleme
         $request->image->move(public_path('upload'),$filename);
         $request->merge([
           'image'=>$fileNamewithUpload,
         ]);

      }
        Quiz::find($quiz_id)->questions()->whereId($question_id)->first()->update($request->post());//burayı all dersen dosya tmp tanımlanır.post tanımla
        return redirect()->route('questions.list',$quiz_id)->with('basarili','Soru Başarıyla Güncellendi');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionsRequest  $request
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function question_sil($quiz_id,$question_id)
    {
      Quiz::find($quiz_id)->questions()->whereId($question_id)->delete() ?? abort(404,'Soru veya Quiz Bulunamadı');
      return redirect()->route('questions.list',$quiz_id)->with('basarili','Sorunuz Başarıyla Silindi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
}
