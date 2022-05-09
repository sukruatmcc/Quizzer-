<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>
    <div class="card">
    <div class="card-body">
<form method="post" action="{{route('quiz.result',$quiz->slug)}}">
  @csrf
        @foreach($quiz->questions as $questions)
        <strong>#{{$loop->iteration}}</strong> {{$questions->question}}
        @if($questions->image)
        <img src="{{asset($questions->image)}}">
        @endif
        <div class="form-check mt-2">
  <input class="form-check-input" type="radio" name="{{$questions->id}}" value="answer1" required id="quiz{{$questions->id}}1">
  <label class="form-check-label" for="quiz{{$questions->id}}1">
    {{$questions->answer1}}
  </label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="{{$questions->id}}" value="answer2" required id="quiz{{$questions->id}}2">
<label class="form-check-label" for="quiz{{$questions->id}}2">
{{$questions->answer2}}
</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="{{$questions->id}}" value="answer3" required id="quiz{{$questions->id}}3">
<label class="form-check-label" for="quiz{{$questions->id}}3">
{{$questions->answer3}}
</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="{{$questions->id}}" value="answer4" required id="quiz{{$questions->id}}4">
<label class="form-check-label" for="quiz{{$questions->id}}4">
{{$questions->answer4}}
</label>
</div>
        <hr>
        @endforeach
        <button type="submit" class="btn-sm btn btn-success w-100">Sınavı Bitir</button>
        </form>
    </div>
  </div>
</x-app-layout>
