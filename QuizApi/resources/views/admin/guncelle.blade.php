<x-app-layout>
<x-slot name="header">Quiz Güncelleme</x-slot>
  <a href="{{ route('quiz.list') }}" class="btn btn-primary" style="float:right">Quiz Listesi</a>
  <br><br>
<div class="card">
  <div class="card-body">
    <form method="post" action="{{route('quiz.guncelle.post',$quiz->id)}}">
      @csrf
        <div class="form-group">
            <label>Quiz Başlığı</label>
            <input type="text" name="title" class="form-control" value="{{$quiz->title}}">
        </div>
        <br>
        <div class="form-group">
            <label>Quiz Açıklama</label>
            <textarea type="text" name="description" class="form-control" rows='4'>{{$quiz->description}}</textarea>
        </div>
        <br>
        <div class="form-group">
            <select name="status" value="{{$quiz->status}}" class="form-control">
               <option @if($quiz->questions_count<4) disabled @endif  @if($quiz->status==='publish') selected @endif  value="publish">Aktif</option>
               <option @if($quiz->status==='passive') selected @endif  value="passive" >Pasif</option>
               <option @if($quiz->status==='draft') selected @endif  value="draft" >Taslak</option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <input id='isFinished'  @if(old('created_at')) checked @endif type="checkbox"><!--seçiliyse kalsın..-->
            <label>Bitiş Tarihi Olacak mı?</label>
        </div>
        <br>
        <div class="form-group" id='isFinishedInput'  @if(!old('created_at'))  style="display:none" @endif><!--seçiliyse kalsın..-->
            <label>Bitiş Tarihi</label>
            <input type="datetime-local" name="created_at" value="{{$quiz->created_at}}" class="form-control">
        </div>
        <br>
        <div class="form-group">
            <button class="btn btn-success btn-sm btn-block">Güncelle</button>
        </div>
    </form>
  </div>
</div>
<x-slot name="js">
    <script>
       $('#isFinished').change(function(){
           if($('#isFinished').is(':checked')){
             $('#isFinishedInput').show()
           }else {
             $('#isFinishedInput').hide()
           }
       });
    </script>
</x-slot>
</x-app-layout>
