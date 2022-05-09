<x-app-layout>
  @foreach($quizzes as $quiz)
    <x-slot name="header">{{$quiz->title}}</x-slot>

    <div class="card">
    <div class="card-body">
      <p class="card-text">
          <div class="row">
              <div class="col-md-4">
                <ol class="list-group ">
                  @if($quiz->my_result)
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                    Sıralaman
                    </div>
                    <span  class="badge bg-success rounded-pill">#{{$quiz->my_rank}}</span>
                  </li>
                  @endif
                  @if($quiz->my_result)<!--Point hesaplanmış ise göster-->
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                    Puan
                    </div>
                    <span  class="badge bg-primary rounded-pill">{{$quiz->my_result->point}}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                    Doğru / Yanlış
                    </div>
                    <div class="float-right">
                    <span  class="badge bg-success rounded-pill">{{$quiz->my_result->correct}} Doğru</span>
                    <span  class="badge bg-danger rounded-pill">{{$quiz->my_result->wrong}} Yanlış</span>
                    </div>
                  </li>
                  @endif
                  @if($quiz->created_at)
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                    Son Katılım Tarihi
                    </div>
                    <span  class="badge bg-secondary rounded-pill">{{$quiz->created_at->diffForHumans()}}</span>
                  </li>
                    @endif
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                    Soru Sayısı
                    </div>
                    <span class="badge bg-secondary rounded-pill">{{$quiz->questions_count}}</span>
                  </li>
                  @if($quiz->details)
    <li class="list-group-item d-flex justify-content-between align-items-start">
      <div class="ms-2 me-auto">
        Katılımcı Sayısı
      </div>
      <span class="badge bg-warning rounded-pill">{{$quiz->details['join_count']}}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-start">
      <div class="ms-2 me-auto">
        Ortalama Puan
      </div>
      <span class="badge bg-info rounded-pill">{{$quiz->details['average']}}</span>
    </li>
              @endif
  </ol>
              @if($quiz->my_result)
              <div class="card mt-3">
                 <div class="card-body">
                   <h5 class="card-title">İlk 10</h5>
                   <ul class="list-group">
                       @foreach($quiz->topTen as $result)
                         <li class="list-group-item d-flex justify-content-between align-items-start"><strong>{{$loop->iteration}}</strong>
                           <img class="w-9 h-9 rounded-full" src="{{$result->user->profile_photo_url}}">

                           <span @if(auth()->user()->id == $result->user_id)  class="text-danger" @endif >{{$result->user->name}}</span>
                           <span class="badge bg-info rounded-pill">{{$result->point}}</span>
                         </li>
                       @endforeach
                   </ul>
                 </div>
              </div>
               @endif


              </div>
              <div class="col-md-8">
                {{$quiz->description}}</p>
                @if($quiz->my_result)
                   <a href="{{route('quiz.junior',$quiz->slug)}}" class="btn btn-info w-100 btn-sm">Quiz'i Görüntüle</a>
                @else
                  <a href="{{route('quiz.junior',$quiz->slug)}}" class="btn btn-primary w-100 btn-sm">Quize Katıl</a>
              @endif
              </div>
          </div>
    </div>
  </div>
@endforeach
</x-app-layout>
