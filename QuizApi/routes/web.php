<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\MainController;


Route::get('/', function () {
    return view('welcome');
});
//main controller->dashboard
Route::middleware(['middleware'=>'auth'])->prefix('panel')->group(function(){
  Route::get('/',[MainController::class,'dashboard'])->name('dashboard');
  Route::get('quiz/detay/{slug}',[MainController::class,'quiz_detail'])->name('quiz.detail');
  Route::get('quiz/{slug}',[MainController::class,'quiz'])->name('quiz.junior');
  Route::post('quiz/{slug}/quiz_result',[MainController::class,'quiz_result'])->name('quiz.result');
});
//main Controller





Route::middleware(['auth:sanctum', 'İsAdmin'])->prefix("admin")->group(function(){
Route::get('/quizzes',[QuizController::class,'quiz_list'])->name('quiz.list');
Route::get('/quizzes/quiz_ekle',[QuizController::class,'quiz_olustur'])->name('quiz.olustur');
Route::post('/quizzes/quiz_ekle_post',[QuizController::class,'quiz_ekle_post'])->name('quiz.post');
Route::get('/quizzes/guiz_guncelle/{id}',[QuizController::class,'quiz_guncelle'])->name('quiz.guncelle');
Route::post('/quizzes/{id}/quiz_guncelle_post',[QuizController::class,'quiz_guncelle_post'])->name('quiz.guncelle.post');
Route::get('/quizzes/{id}/quiz_sil',[QuizController::class,'quiz_sil'])->name('quiz.sil');
Route::get('/quizzes/{quiz_id}/questions',[QuestionsController::class,'question_list'])->name('questions.list');
Route::get('/quizzes/{id}/question_ekle',[QuestionsController::class,'question_olustur'])->name('questions.olustur');
Route::post('/quizzes/{id}/question_eklePost',[QuestionsController::class,'question_olustur_Post'])->name('questionsEkle');
Route::get('/quizzes/{quiz_id}/question_guncelle/{question_id}',[QuestionsController::class,'question_guncelle'])->name('questions.guncelle');
Route::post('/quizzes/{quiz_id}/question_guncelle_Post/{question_id}',[QuestionsController::class,'question_guncelle_Post'])->name('questions.guncelle_Post');
Route::get('/quizzes/{quiz_id}/question_sil/{question_id}',[QuestionsController::class,'question_sil'])->name('question.sil');
Route::get('quiz/info/{id}',[QuizController::class,'quiz_info'])->name('quiz.info');


});
