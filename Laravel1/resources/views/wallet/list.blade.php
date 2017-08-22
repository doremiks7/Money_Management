@extends('wallet.master')
@section('noidung')

  <h2>List Wallet</h2>
    @if(Session::has('flash-message'))
      <div class="alert alert-{!! Session::get('flash-level') !!}">       
          {!! Session::get('flash-message') !!}
      </div>
    @endif
  <p><button class="btn btn-primary" style="float:left; margin-bottom: 10px;" onclick="window.location='{{ URL::route('wallet.create') }}'"> Thêm mới </button></p>        
  <p><a href="{{ url('gettransfer') }}" class="btn btn-primary" style="float:right; margin-bottom: 10px;" }}'"> Chuyển tiền </a></p>    
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Tên ví</th>
        <th>Số tiền</th>
        <th>Xoa</th>
        <th>Sửa</th>
      </tr>
    </thead>
    <tbody>
    @foreach($wl as $value)
      <tr>
        <td><a href="{{route('wallet_be_list', $value->id)}}" style="font-size: 30px;font-weight: bold;"> <img src="public/img/wallet/wallet.png" class="img-circle" size="14px;"> {{$value->name}} </a></td>
        <td class="color-money">{{adddotstring($value->amount)}} vnđ</td>
        <td>
         
        <form method="POST" action="{{route('wallet.destroy', $value->id)}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <input type="hidden" name="_method" value="DELETE" />
          <input type="hidden" name="id" value="{{ $value->id }}" />
          <button onclick="return ConfirmDelete()" type="submit" class="btn btn-warning"><i class="fa fa-trash-o  fa-fw"></i>Delete</button>
        </form>
        </td>
        <td><a href="{!! route('wallet.edit', $value->id) !!}" class="btn btn-info" role="button"><i class="fa fa-pencil fa-fw"></i>Edit</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>
<script type="text/javascript">
  function ConfirmDelete()
  {
    var x = confirm("Are you sure you want to delete?");
    if (x)
      return true;
    else
      return false;
  }
</script>
@endsection