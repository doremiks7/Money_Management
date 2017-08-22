@extends('wallet.master')
@section('noidung')

<div class="panel panel-default col-md-offset-4 col-md-4" style="margin-top: 40px;">
    <table class="table table-bordered">
    <h2>List Wallet</h2>
    <thead style="border-top: 1px solid #ddd;">
      <tr>
        <th>Tên ví</th>
        <th>Số tiền</th>
      </tr>
    </thead>
    <tbody>
    @foreach($wl as $value)
      <tr>
        <td><a href="#" style="text-decoration: none;"> {{$value->name}} </a></td>
        <td class="color-money">{{adddotstring($value->amount)}} vnđ</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>

    <div class="panel panel-default col-md-offset-4 col-md-4" style="margin-top: 40px;">
      <table class="table">

      <form action="{!! route('postTransfer') !!}" method="POST">
       {{ csrf_field() }}
          @include('blocks.error')
      
       <h1 style="margin: 10px 0px 10px 10px;"> Money Transfer </h1>
       <div class="container col-md-12">
          <div class="form-group" style="color: #FF8800;">
            <label for="name warning-color">Tên ví chuyển</label>
                <select class="form-control" name='sltFrom'>
                    <option value="0">Please Choose Wallet From</option>
                         @foreach ($wl as $value)
                            <option style="color: #FF8800;" value="{{$value->id}}" id="classFrom{{$value->id}}"> {{ $value->name }} </option>
                         @endforeach

                </select>
          </div>
          <div class="form-group" style="color:#00C851;">
            <label>Tên ví nhận</label>
                <select class="form-control" name='sltTo'>
                    <option value="0">Please Choose Wallet To</option>
                         @foreach ($wl as $value)
                            <option style="color: #00C851;" value="{{$value->id}}" id="classTo{{$value->id}}"> {{ $value->name }} </option>
                         @endforeach

                </select>
          </div>
          <div class="form-group">
            <label for="toan"> Số tiền </label>
            <input type="text" class="form-control color-money" name="txtAmount" id="txtAmount" value="{!! old('txtAmount') !!}">
          </div>
          <div class="form-group">
            <label for="submit"></label>
            <input class="btn btn-warning" type="submit" class="form-control">
          </div>
      </div>

      </form>
      </table>
    </div>
  
  <script type="text/javascript">
      $('select[name=sltFrom]').change(function() 
      {
          var hidden = '#classTo' + $('select[name=sltFrom]').val();

             $(hidden).hide();
             $('select[name=sltFrom]').change(function(){
                $(hidden).show();
                 var hidden1 = '#classTo' + $('select[name=sltFrom]').val();
                $(hidden1).hide(); 

             });
         
      });
      $('select[name=sltTo]').change(function() 
      {
          var hidden = '#classFrom' + $('select[name=sltTo]').val();

             $(hidden).hide();
             $('select[name=sltTo]').change(function(){
                $(hidden).show();
                 var hidden1 = '#classFrom' + $('select[name=sltTo]').val();
                $(hidden1).hide(); 

             });
         
      });
  </script>
  <script type="text/javascript">
     $('input#txtAmount').keyup(function(event) {

      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40) return;

      // format number
      $(this).val(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
      });
  });
</script>
  
@endsection