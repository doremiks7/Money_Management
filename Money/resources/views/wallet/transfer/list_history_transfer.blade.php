@extends('wallet.master')
@section('noidung')
    <h2>List History Transfers</h2>

    @if(Session::has('flash-message'))
      <div class="alert alert-{!! Session::get('flash-level') !!}">       
          {!! Session::get('flash-message') !!}
      </div>
    @endif
    
        <table class="table table-bordered">

          <thead>
            <tr>
                <th>Ví chuyển</th>
                <th>Ví nhận</th>
                <th>Số tiền</th>
                <th>Ngày giao dịch</th>
                <th>Xóa</th>
                
            </tr>
          </thead>
          <tbody style="font-weight: bold;">

          @foreach($data as $value)
              <?php 
                    $wallet_from = DB::table('wallets')->select('name')->where('id', $value->id_from)->first();
                    $wallet_to = DB::table('wallets')->where('id', $value->id_to)->first(); 
              ?>

              <tr>
                <td style="color: #FF8800;"> {{$wallet_from->name}} </td>
                <td style="color:#00C851;""> {{$wallet_to->name}}</td>              
                <td class="color-money"> {{adddotstring($value->amount_transfer)}} </td>
                  <td> {{$value->created_at}} </td>
                  <td>
                  <form method="POST" action="{{route('deleteHistoryTransfer', $value->id)}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <button onclick="return ConfirmDelete()" type="submit" class="btn btn-warning"><i class="fa fa-trash-o  fa-fw"></i>Delete</button>
                  </form>
                  </td>
                  
                </tr>
              @endforeach
            </tbody>
          </table>

<!-- script to confirm delete -->
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