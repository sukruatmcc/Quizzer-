<x-app-layout>
    <x-slot name="header">Quizler</x-slot>
<div class="card">
  <div class="card-body">
       <a href="{{route('quiz.olustur')}}" class="btn btn-primary btn-md" style="float:right">Quiz Oluştur</a>
    <h5 class="card-title">
      <form method="get" action="">
        <div class="col-md-2 mb-2">
          <input class="btn-sm btn btn-secondary" type="button" value="Quiz Ara">
        </div>
      <div class="form-row">
           <div class="col-md-3" style="float:left">
              <input type="text" name="title" value="{{request()->get('title')}}" placeholder="Quiz Adı" class="form-control">
           </div>
           <div class="col-md-3" style="float:left; margin-left:8px">
             <select name="status" onchange="this.form.submit()"  class="form-control">
               <option value="">Durum Seçiniz</option>
                  <option @if(request()->get('status')=='publish') selected @endif value="publish">Aktif</option>
                  <option @if(request()->get('status')=='draft') selected @endif value="draft">Taslak</option>
                  <option @if(request()->get('status')=='passive') selected @endif value="passive">Pasif</option>
             </select>
           </div>
           @if(request()->get('title') || request()->get('status'))
           <div class="col-md-3" style="float:left">
              <button type="submit" class="btn-sm btn btn-secondary">Sıfırla</button>
           </div>
           @endif
         </div>
      </div>
    </form>
    </h5>
    <table class="table table-striped table-bordered zero-configuration">
        <thead>
            <tr>
                <th>Quiz</th>
                <th>Durum</th>
                <th>Soru Adedi</th>
                <th>Bitiş Tarihi</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
         @if ($quizzes)
            @foreach ($quizzes as $quiz )
            <tr>
                <td>{{$quiz->title }}</td>
                <td>
                  @switch($quiz->status)
                  @case('publish')
                  @if(!$quiz->created_at)
                    <span class="btn-sm btn btn-success">Aktif</span>
                  @elseif($quiz->created_at > now())
                     <span class="btn-sm btn btn-success">Aktif</span>
                  @else
                     <span class="btn-sm btn btn-secondary text-white">Tarihi Dolmuş</span>
                  @endif
                  @break
                  @case('passive')
                      <span class="btn-sm btn btn-danger">Pasif</span>
                  @break
                  @case('draft')
                        <span class="btn-sm btn btn-warning">Taslak</span>
                  @break
                  @endswitch
                </td>
                <td>{{ $quiz->questions_count}}</td>
                <td>{{$quiz->created_at }}</td>
                <td>
                  <a href="{{route('quiz.info',$quiz->id)}}"><svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-info-square-fill text-secondary float-left mr-2" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
</svg></a>
                  <a href="{{route('questions.list',$quiz->id)}}" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
</svg></a>
                    <a href="{{route('quiz.guncelle',$quiz->id)}}" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
</svg></a>
                    <a href="{{route('quiz.sil',$quiz->id)}}" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
                </td>
            </tr>
            @endforeach
         @endif
        </tbody>
        <tfoot>
            <tr>
              <th>Quiz</th>
              <th>Durum</th>
              <th>Soru Adedi</th>
              <th>Bitiş Tarihi</th>
              <th>İşlemler</th>
            </tr>
        </tfoot>
    </table>
  {{$quizzes->withQueryString()->links("pagination::bootstrap-5")}}<!--withQueryString 2.sayfaya geçtiğimdede arama sonuçalrındaki yazı kaybolmasın.-->
  </div>
</div>
</x-app-layout>
