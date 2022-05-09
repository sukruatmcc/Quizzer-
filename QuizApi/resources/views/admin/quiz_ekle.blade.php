<x-app-layout>
<x-slot name="header">Quiz Ekle</x-slot>
  <a href="{{ route('quiz.list') }}" class="btn btn-primary" style="float:right">Quiz Listesi</a>
  <br><br>
<div class="card">
  <div class="card-body">
    <form method="post" action="{{route('quiz.post')}}">
      @csrf
        <div class="form-group">
            <label>Quiz Başlığı</label>
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
        </div>
        <br>
        <div class="form-group">
            <label>Quiz Açıklama</label>
            <textarea type="text" name="description" class="form-control" rows='4'>{{old('description')}}</textarea>
        </div>
        <br>
        <div class="form-group">
            <input id='isFinished' @if(old('created_at')) checked @endif type="checkbox"><!--seçiliyse kalsın..-->
            <label>Bitiş Tarihi Olacak mı?</label>
        </div>
        <br>
        <div class="form-group" id='isFinishedInput' @if(!old('created_at'))  style="display:none" @endif><!--seçiliyse kalsın..-->
            <label>Bitiş Tarihi</label>
            <input type="datetime-local" name="created_at" value="{{old('created_at')}}" class="form-control">
        </div>
        <br>
        <div class="form-group">
            <button class="btn btn-success btn-sm btn-block">Quiz Oluştur</button>
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
