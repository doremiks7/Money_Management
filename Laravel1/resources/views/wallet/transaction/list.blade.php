@extends('wallet.master')
@section('noidung')


<a href="{{route('wallet_be_add', $id_wallet)}}" type="button" class="btn btn-primary"> Thêm giao dịch </a>

  @if(Session::has('flash-message'))
        <div class="alert alert-{!! Session::get('flash-level') !!}">       
            {!! Session::get('flash-message') !!}
        </div>
  @endif
<?php $name_wallet = DB::table('wallets')->where('id', $id_wallet)->first(); ?>
<h2> List Transaction of Wallet : <u style="color: red;">{{$name_wallet->name}} </u> </h2>

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
  <div class="col-md-6" style="padding-left: 0px;">
    <table class="table table-bordered ">
    <?php 
        $transfer_gift = DB::table('transfers')->where('id_from', $id_wallet)->get(); 
        $total_gift = 0;$total_recieve=0;
    ?>
      <thead>
        <tr>
          <th>Số tiền chuyển</th>
          <th>Chuyển sang</th>
          <th>Ngày giao dịch</th>
        </tr>
      </thead>
      <tbody>

          @foreach($transfer_gift as $value)
          <tr>
            <?php $total_gift += $value->amount_transfer; ?>
              <td style="color: rgb(208, 2, 27); font-weight: bold;"> -{{adddotstring($value->amount_transfer)}} </td>
              <td style="color: rgb(208, 2, 27);"> <?php $name = DB::table('wallets')->where('id', $value->id_to)->first(); echo $name->name; ?> </td>
              <td> {{$value->created_at}} </td>
           </tr>
          @endforeach
       
      </tbody>
    </table>

    <table class="table table-bordered">
    <?php $transfer_recieve = DB::table('transfers')->where('id_to', $id_wallet)->get(); ?>
      <thead>
        <tr>
          <th>Số tiền nhận </th>
          <th> Nhận từ </th>
          <th>Ngày giao dịch</th>
        </tr>
      </thead>
      <tbody>

        
          @foreach($transfer_recieve as $value)
          <tr>
            <?php $total_recieve += $value->amount_transfer; ?>
              <td style="color: blue; font-weight: bold;"> +{{adddotstring($value->amount_transfer)}} </td>
              <td style="color: blue"> <?php $name = DB::table('wallets')->where('id', $value->id_from)->first(); echo $name->name; ?> </td>
              <td> {{$value->created_at}} </td>
          </tr>
          @endforeach
       
      </tbody>
    </table>
  </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Tổng thu</th>
          <th>Tổng chi</th>
          <th>Tổng tiền giao dịch</th>
          <th>Tổng số dư chuyển tiền</th>
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
              <td style="color:blue;font-weight: bold;">+{{adddotstring($total)}}</td>
            @else
              <td style="color:rgb(208, 2, 27);font-weight: bold;">{{adddotstring($total)}}</td>
            @endif

            @if( ($total_recieve - $total_gift) > 0)
              <td style="color:blue; font-weight: bold;">+{{adddotstring($total_recieve - $total_gift)}}</td>
            @else
              <td style="color:rgb(208, 2, 27); font-weight: bold;">{{adddotstring($total_recieve - $total_gift)}}</td>
            @endif
            
            <td style="color:blue;">+{{adddotstring($wallet_now->amount - $total - $total_recieve + $total_gift)}}</td>
            @if($wallet_now->amount > 0)
              <td style="color:blue;">+{{adddotstring($wallet_now->amount)}}</td>
            @else
              <td style="color:rgb(208, 2, 27);">{{adddotstring($wallet_now->amount)}}</td>
            @endif
        </tr>
      </tbody>

    </table>
  <u style="color: red;">  Ghi chú (*) </u> <u> : Số tiền hiện tại = Số tiền ban đầu + Tổng tiền giao dịch + Tổng số dư chuyển tiền </u>

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