@extends('wallet.master')
@section('noidung')

  <h2> List Transaction </h2>

  @if(Session::has('flash-message'))
        <div class="alert alert-{!! Session::get('flash-level') !!}">       
            {!! Session::get('flash-message') !!}
        </div>
  @endif

<?php $data = DB::table('transactions')->where('id_category', $id_category)->get(); ?>

<table class="table table-bordered" style="margin-top: 30px;">
            <thead>
              <tr>
                <th>Description</th>
                <th>Cùng ai</th>
                <th>Số tiền</th>
                <th>Tên ví</th>
                <th>Ngày tạo</th>
                
              </tr>
            </thead>
            <tbody>
            
            @foreach($data as $value)
            <?php $cate = DB::table('categories')->where('id', $value->id_category)->first();
                  $name_wallet = DB::table('wallets')->where('id', $value->id_wallet)->first();
            ?>
              <tr>
                <td> 
                  <ul style=" padding-left: 0px;"> 
                    <li style="font-size: 20px; color: rgb(208, 2, 27); font-weight: bold;"> {{$cate->name}} </li> 
                    <li style="color: rgb(51, 51, 51);"> {{$value->description}} </li> 
                  </ul>
                </td>

                <td> {{$value->with_who}} </td>
              @if($cate->kind == 1)
                <td style="color:blue;"> +{{adddotstring($value->amount)}} </td>
              @else
                <td style="color:rgb(208, 2, 27);"> -{{adddotstring($value->amount)}} </td>
              @endif

                <td style="font-size: 30px; font-weight: bold;"> {{$name_wallet->name}} </td>
                <td> {{$value->created_at}} </td>            
              </tr>

            @endforeach
            </tbody>
</table>

<style type="text/css">
  .table-bordered>thead>tr>th {
      padding: 10px;
  }
  .table-bordered>tbody>tr>td {
      padding: 10px;
  }
</style>
@endsection