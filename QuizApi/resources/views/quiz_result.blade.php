<x-app-layout>
    <x-slot name="header">{{$quiz->title}} Sonucu</x-slot>
    <div class="card">
    <div class="card-body">

        <h3>Puan : <strong>{{$quiz->my_result->point}}</strong></h3>
        <div class="alert alert-danger  bg-light">
        <svg xmlns="http://www.w3.org/2000/svg" class="text-success float-left mr-2" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </svg>Doğru Cevap<br>
  <svg xmlns="http://www.w3.org/2000/svg" class="text-danger float-left mr-2" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg>Yanlış Cevap<br>
<svg xmlns="http://www.w3.org/2000/svg" class="text-success float-left mr-2" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
<path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
</svg>Doğru Şık<br>
<svg xmlns="http://www.w3.org/2000/svg" class="float-left mr-2" width="16" height="16" fill="currentColor" class="bi bi-square-fill" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z"/>
</svg>
<circle cx="8" cy="8" r="8"/>İşaretlediğin Şık
        </div>
        <br>
        @foreach($quiz->questions as $questions)
        @if($questions->correct_answer == $questions->my_answer->answer)
        <svg xmlns="http://www.w3.org/2000/svg" class="text-success float-left" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg>
        @else
        <svg xmlns="http://www.w3.org/2000/svg" class="text-danger float-left" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg>
        @endif
        <strong>#{{$loop->iteration}}</strong> {{$questions->question}}
        <br>
                <small>Bu soruya <strong>%{{$questions->true_percent}}</strong>oranında doğru cevap verildi.</small>
        @if($questions->image)
        <img src="{{asset($questions->image)}}">
        @endif
        <div class="form-check mt-2">
          @if('answer1' == $questions->correct_answer)
          <svg xmlns="http://www.w3.org/2000/svg" class="text-success float-left" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
  </svg>
  @elseif('answer1'==$questions->my_answer->answer)
  <svg xmlns="http://www.w3.org/2000/svg" class="float-left mr-1" width="16" height="16" fill="currentColor" class="bi bi-square-fill" viewBox="0 0 16 16">
    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z"/>
  </svg>
  <circle cx="8" cy="8" r="8"/>
</svg>
  @endif
  <label class="form-check-label" for="quiz{{$questions->id}}1">
    {{$questions->answer1}}
  </label>
</div>
<div class="form-check">
  @if('answer2' == $questions->correct_answer)
  <svg xmlns="http://www.w3.org/2000/svg"  class="text-success float-left" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
<path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
</svg>
@elseif('answer2'==$questions->my_answer->answer)
<svg xmlns="http://www.w3.org/2000/svg" class="float-left mr-1" width="16" height="16" fill="currentColor" class="bi bi-square-fill" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z"/>
</svg>
  @endif
<label class="form-check-label" for="quiz{{$questions->id}}2">
{{$questions->answer2}}
</label>
</div>
<div class="form-check">
  @if('answer3' == $questions->correct_answer)
  <svg xmlns="http://www.w3.org/2000/svg" class="text-success float-left" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
<path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
</svg>
@elseif('answer3'==$questions->my_answer->answer)
<svg xmlns="http://www.w3.org/2000/svg" class="float-left mr-1" width="16" height="16" fill="currentColor" class="bi bi-square-fill" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z"/>
</svg>
  @endif
<label class="form-check-label" for="quiz{{$questions->id}}3">
{{$questions->answer3}}
</label>
</div>
<div class="form-check">
  @if('answer4' == $questions->correct_answer)
  <svg xmlns="http://www.w3.org/2000/svg" class="text-success float-left" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
<path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
</svg>
@elseif('answer4'==$questions->my_answer->answer)
<svg xmlns="http://www.w3.org/2000/svg" class="float-left mr-1" width="16" height="16" fill="currentColor" class="bi bi-square-fill" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z"/>
</svg>
  @endif
<label class="form-check-label" for="quiz{{$questions->id}}4">
{{$questions->answer4}}
</label>
</div>
<hr>
        @endforeach

    </div>
  </div>
</x-app-layout>
