@extends('wallet.master')
@section('noidung')

	<table class="table">
      <form action="{{ route('update', [$transaction->id, $id_wallet]) }}" method="POST">
       {{ csrf_field() }}
        @include('blocks.error')
        	<input type="hidden" name="_method" value="PUT" /> 
          <input type="hidden" name="id" value="{{ $transaction->id }}" /> 
       <p1 class="btn btn-primary " style="margin: 10px 0px 10px 10px;"> Thêm mới </p1>
       <div class="container col-md-12">
          <div class="form-group">
            <label for="name"> Loại danh mục </label>
            <select class="form-control" name="sltKindCate" id="sltKindCate">
              <option value="0">Please Choose Category</option>
              <?php $category = DB::table('categories')->where('id', $transaction->id_category)->first(); 
                    $all_cate = DB::table('categories')->where('user_id', Auth::user()->id)->where('kind', $category->kind)->get();
              ?>
              @if($category->kind == 1)
                <option value="1" class="thu" selected=""> Mục Thu </option>
              @else
                <option value="2" class="chi" selected=""> Mục Chi </option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label for="name"> Chọn danh mục </label>
            <select class="form-control" name="sltCate" id="sltCate">
              <option value="0">Please Choose Category</option>
                 @foreach($all_cate as $value)
                      @if($transaction->id_category == $value->id)
                        <option value="{{$value->id}}" class="txtThu" selected> {{$value->name}} </option>
                      @else
                        <option value="{{$value->id}}" class="txtThu" > {{$value->name}} </option>
                      @endif
                  @endforeach
            </select>
          </div>
          
          <div class="form-group">
            <label for="name">Số tiền</label>
            <input type="text" class="form-control color-money" name="txtAmount" id="txtAmount" value="{{$transaction->amount}}">
          </div>
          <div class="form-group">
            <label for="name">Ghi chú</label>
            <input type="text" class="form-control" name="txtDescription" value="{{$transaction->description}}">
          </div>
          <div class="form-group">
            <label for="name">Đi cùng ai</label>
            <input type="text" class="form-control" name="txtWithWho" value="{{$transaction->with_who}}">
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

  $('select[name=sltKindCate').change(function(){

      if( $('select[name=sltKindCate').val() == 0)
        {
             $('.txtThu').hide();
        }
      if($('select[name=sltKindCate').val() != 0)
      {
        $('.txtThu').show();
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