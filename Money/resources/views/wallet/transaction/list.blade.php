@extends('wallet.master')
@section('noidung')


<a href="{{route('wallet_be_add', $id_wallet)}}" type="button" class="btn btn-primary"> Thêm giao dịch </a>

  @if(Session::has('flash-message'))
        <div class="alert alert-{!! Session::get('flash-level') !!}">       
            {!! Session::get('flash-message') !!}
        </div>
  @endif

<table class="table table-bordered" style="margin-top: 20px;">
            <thead>
              <tr>
                <th>Description</th>
                <th>Cùng ai</th>
                <th>Số tiền</th>
                <th>Ngày tạo</th>
                <th>Xóa</th>
                <th>Sửa</th>
              </tr>
            </thead>
            <tbody>

          <?php 
            $total_income = 0; $total_expense = 0; $total = 0;
          ?>    

            @foreach($data as $value)

                <?php 
                   $color_amount ="";
                   $cate = DB::table('categories')->where('id', $value->id_category)->first();
                          if($cate->kind == 1){
                            $_amount = "+".adddotstring($value->amount);
                            $total_income += $value->amount;
                            $color_amount = "color:blue;";
                          }
                          else{
                            $_amount = "-".adddotstring($value->amount);
                            $total_expense += $value->amount;
                            $color_amount = "color:rgb(208, 2, 27);";
                          }
                ?>
              <tr>

                <td> 
                  <ul style=" padding-left: 0px;"> 
                    <li style="font-size: 20px; color: rgb(208, 2, 27); font-weight: bold;"> {{$cate->name}} </li> 
                    <li style="color: rgb(51, 51, 51);"> {{$value->description}} </li> 
                  </ul>
                </td>

                <td>{{$value->with_who}}</td>
                <td style="{{$color_amount}};"> {{$_amount}}</td>

                <td> {{$value->created_at}} </td>
                <td>
                <form method="POST" action="{{route('transaction_be_delete', [$value->id, $id_wallet])}}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="id" value="{{ $value->id }}" />
                  <button onclick="return ConfirmDelete()" type="submit" class="btn btn-warning"><i class="fa fa-trash-o  fa-fw"></i>Delete</button>
                </form>

                </td>
                <td><a href="{!! route('edit', [$value->id, $id_wallet]) !!}" class="btn btn-info" role="button"><i class="fa fa-pencil fa-fw"></i>Edit</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Tổng thu</th>
          <th>Tổng chi</th>
          <th>Tổng tiền giao dịch</th>
          <th>Số tiền ban đầu</th>
          <th>Số tiền hiện tại</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = $total_income - $total_expense; $wallet_now = DB::table('wallets')->where('id', $id_wallet)->first(); ?>
          <tr>
          <td style="color:blue;">+{{adddotstring($total_income)}}</td>
          <td style="color:rgb(208, 2, 27);">-{{adddotstring($total_expense)}}</td>
            @if($total > 0)
              <td style="color:blue;">+{{adddotstring($total)}}</td>
            @else
              <td style="color:rgb(208, 2, 27);">{{adddotstring($total)}}</td>
            @endif
          <td style="color:blue;">+{{adddotstring($wallet_now->amount - $total)}}</td>
          @if($wallet_now->amount > 0)
            <td style="color:blue;">+{{adddotstring($wallet_now->amount)}}</td>
          @else
            <td style="color:rgb(208, 2, 27);">{{adddotstring($wallet_now->amount)}}</td>
          @endif
        </tr>
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