@extends('wallet.master')
@section('noidung')
    <div class="panel panel-default col-md-offset-4 col-md-4" style="margin-top: 20px;">

      <table class="table">

      <form action="{!! route('category.store') !!}" method="POST">
       {{ csrf_field() }}
        @include('blocks.error')
       
       <div class="container col-md-12">
        <h1> Add Category </h1>
          <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" class="form-control" name="txtNameCate">
          </div>
          <div class="form-group">
            <label for="name"> Loại danh mục </label>
            <select class="form-control" name="sltKindCate" >
              <option value="0">Please Choose Kind of Category</option>
              <option value="1"> Mục Thu </option>
              <option value="2"> Mục Chi </option>
            </select>
          </div>
          <div class="form-group">
            <label for="name"> Danh mục cha </label>
            <select class="form-control" name="sltParentCate" id="sltParentCate">
              <option value="0" id="def">Please Choose Category</option>
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
            <label for="submit"></label>
            <input class="btn btn-warning" type="submit" class="form-control">
          </div>
      </div>

      </form>
      </table>
    </div>

<!-- script to limit parent category -->
<script type="text/javascript">
  $('.txtThu').hide();
  $('.txtChi').hide();
  $('select[name=sltKindCate]').change(function(){

      if( $('select[name=sltKindCate]').val() == 1)
        {
          $('.txtThu').show();
          $('.txtChi').hide();
        }    
             
      
      if($('select[name=sltKindCate]').val() == 2)
      {  
          $('.txtThu').hide();
          $('.txtChi').show();
      }
      if( $('select[name=sltKindCate]').val() == 0)
        {
           $('.txtThu').hide();
           $('.txtChi').hide();
        }

  });
</script>
@endsection