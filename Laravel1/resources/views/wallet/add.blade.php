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
    
    <div class="panel panel-default col-md-offset-4 col-md-4" style="margin-top: 30px;">

      <table class="table">

      <form action="{!! route('wallet.store') !!}" method="POST">
       {{ csrf_field() }}
        @include('blocks.error')
        <h1> Thêm mới ví </h1>
       <div class="container col-md-12" style="margin-top: 20px;">
          <div class="form-group">
            <label for="name">Tên ví</label>
            <input type="text" class="form-control" name="txtNameWallet">
          </div>
          <div class="form-group">
            <label for="toan"> Số tiền </label>
            <input type="text" class="form-control color-money" name="txtAmountWallet" id="txtAmountWallet">
          </div>
          <div class="form-group">
            <label for="submit"></label>
            <input class="btn btn-warning" type="submit" class="form-control">
          </div>
      </div>

      </form>
      </table>
    </div>

<!-- script to add comma and not follow user types string -->
<script type="text/javascript">
     $('input#txtAmountWallet').keyup(function(event) {

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