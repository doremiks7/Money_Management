@extends('wallet.master')
@section('noidung')

	<table class="table">

      <form action="{{ route('transaction.store') }}" method="POST">
       {{ csrf_field() }}
        @include('blocks.error')
       <p1 class="btn btn-primary " style="margin: 10px 0px 10px 10px;"> Thêm mới </p1>
       <div class="container col-md-12">
          <div class="form-group">
            <label for="name"> Loại danh mục </label>
            <select class="form-control" name="sltKindCate" id="sltKindCate">
              <option value="0">Please Choose Category</option>
              <option value="1" class="thu"> Mục Thu </option>
              <option value="2" class="chi"> Mục Chi </option>
            </select>
          </div>
          <div class="form-group">
            <label for="name"> Chọn danh mục </label>
            <select class="form-control" name="sltCate" id="sltCate">
              <option value="0">Please Choose Category</option>
                @foreach($cate as $value)
                  @if($value->kind==1)
                    <option value="{{$value->id}}" class="txtThu">{{$value->name}}</option>
                  @else
                    <option value="{{$value->id}}" class="txtChi">{{$value->name}}</option>
                  @endif
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="name"> Chọn ví </label>
            <select class="form-control" name="sltWallet" id="sltCate">
              <option value="0">Please Choose Category</option>
                @foreach($wallet as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="name">Số tiền</label>
            <input type="text" class="form-control color-money" name="txtAmount" id="txtAmount">
          </div>
          <div class="form-group">
            <label for="name">Ghi chú</label>
            <input type="text" class="form-control" name="txtDescription">
          </div>
          <div class="form-group">
            <label for="name">Đi cùng ai</label>
            <input type="text" class="form-control" name="txtWithWho">
          </div>
          <div class="form-group">
            <label for="submit"></label>
            <input class="btn btn-warning" type="submit" class="form-control">
          </div>
      </div>

      </form>
      </table>

<!-- script to limit parent category -->
<script type="text/javascript">
  $('.txtThu').hide();
  $('.txtChi').hide();
  $('select[name=sltKindCate').change(function(){

      if( $('select[name=sltKindCate').val() == 1)
        {
             $('.txtThu').show();
             $('.txtChi').hide();
        }
      if($('select[name=sltKindCate').val() == 2)
      {
        $('.txtThu').hide();
        $('.txtChi').show();
      }
      if( $('select[name=sltKindCate').val() == 0)
        {
             $('.txtThu').hide();
             $('.txtChi').hide();
        }

  });
</script>

<!-- script to add comma and force user must be typed number -->
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