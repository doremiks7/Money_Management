@extends('wallet.master')
@section('noidung')

<table class="table table-bordered">
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

            @foreach($data as $value)

                <?php 
                   $color_amount ="";
                   $cate = DB::table('categories')->where('id', $value->id_category)->first();
                          if($cate->kind == 1){
                            $color_amount = "blue";
                          }
                          else{
                            $color_amount = "rgb(208, 2, 27)";
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
                <td style="color:{{$color_amount}};"> {{adddotstring($value->amount)}}</td>

                <td> {{$value->created_at}} </td>
                <td>
                <form method="POST" action="{{route('transaction.destroy', $value->id)}}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="_method" value="DELETE" />
                  <input type="hidden" name="id" value="{{ $value->id }}" />
                  <button onclick="return ConfirmDelete()" type="submit" class="btn btn-warning"><i class="fa fa-trash-o  fa-fw"></i>Delete</button>
                </form>

                </td>
                <td><a href="{!! route('transaction.edit', $value->id) !!}" class="btn btn-info" role="button"><i class="fa fa-pencil fa-fw"></i>Edit</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>


@endsection