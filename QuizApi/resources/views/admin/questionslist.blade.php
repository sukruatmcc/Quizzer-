<x-app-layout>
    <x-slot name="header">{{$quiz->title}} Ait Sorular</x-slot>
<div class="card">
  <div class="card-body">
          <a href="{{route('questions.olustur',$quiz->id)}}" class="btn btn-success" style="float:right">Soru Oluştur</a>
          <a href="{{route('quiz.list',$quiz->id)}}" class="btn btn-secondary" style="float:left">Quizlere Dön<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
</svg></a>
          <br><br>
    <h5 class="card-title">
    </h5>
    <table class="table table-striped table-bordered zero-configuration">
        <thead>
            <tr>
                <th>Soru</th>
                <th>Fotoğraf</th>
                <th>1.Cevap</th>
                <th>2.Cevap</th>
                <th>3.Cevap</th>
                <th>4.Cevap</th>
                <th>Doğru Cevap</th>
                <th style="width:110px">İşlemler</th>
            </tr>
        </thead>
        <tbody>
          @if($quiz)
             @foreach ($quiz->questions as $question )
             <tr>
                 <td>{{$question->question }}</td>
                 <td>
                     @if($question->image)
                     <a href="{{asset($question->image)}}" target='_blank' class="btn btn-white">Görüntüle</a>
                       @endif
                 </td>
                 <td>{{$question->answer1}}</td>
                 <td>{{$question->answer2}}</td>
                 <td>{{$question->answer3}}</td>
                 <td>{{$question->answer4}}</td>
                 <td class="text-success">{{substr($question->correct_answer,-1)}}.Cevap</td>
                 <td>
                     <a href="{{route('questions.guncelle',[$quiz->id,$question->id])}}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
   <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
 </svg></a>
                     <a href="{{route('question.sil',[$quiz->id,$question->id])}}" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
   <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
 </svg></a>
                 </td>
             </tr>
             @endforeach
          @endif
        </tbody>
        <tfoot>
            <tr>
              <th>Soru</th>
              <th>Fotoğraf</th>
              <th>1.Cevap</th>
              <th>2.Cevap</th>
              <th>3.Cevap</th>
              <th>4.Cevap</th>
              <th>Doğru Cevap</th>
            </tr>
        </tfoot>
    </table>

  </div>
</div>
</x-app-layout>
