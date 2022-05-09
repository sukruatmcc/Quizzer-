<x-app-layout>
    <x-slot name="header">Anasayfa</x-slot>
    <div class="row">
      <div class="col-md-8">
  <div class="list-group">
    @foreach($quizzes as $quiz)
        <div class="col-md-8">
  <a href="{{route('quiz.detail',$quiz->slug)}}" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">{{$quiz->title}}</h5>
      <small>{{$quiz->created_at ? $quiz->created_at->diffForHumans().' bitiyor' : null}}</small>
     </div>
    <p class="mb-1">{{Illuminate\Support\Str::limit($quiz->description,100)}}</p>
    <small>{{$quiz->questions_count}} Soru</small>
  </a>

             </div>
    @endforeach
<br>
   {{$quizzes->links("pagination::bootstrap-4")}}
        </div>
    </div>
            <div class="col-md-4">
              <div class="card-header">
                  Quiz Sonuçları
              </div>
              <ul class="list-group list-group-flash">
                @foreach($results as $result)
                <a class="link-secondary" style="text-decoration:none" href="{{route('quiz.detail',$quiz->slug)}}">
                  <li class="list-group-item">
                  <strong>{{$result->point}} -</strong>
                   {{$result->quiz->title}}</li>
                </a>
                @endforeach
                <br>
</ul>
            </div>
</div>

</x-app-layout>
