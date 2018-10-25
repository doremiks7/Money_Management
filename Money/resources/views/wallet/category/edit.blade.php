@extends('wallet.master')
@section('noidung')
    <div class="panel panel-default" style="margin: 20px 20px 20px 20px; display: inline-table;">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Tên danh mục</th>
            <th>Loại danh mục</th>
            <th>Danh mục cha</th>
          </tr>
        </thead>
        <tbody>
        @foreach($cate as $value)
          <tr>
            <td> {{$value->name}} </td>
            <td>
              @if($value->kind == 1)
                  Thu
              @else
                  Chi
              @endif
            </td>
            <td> 
                @if($value->parent_id == 0 || $value->parent_id == 1)
                    {!! "None" !!}
                @else
                    <?php $parent = DB::table('categories')->where('id',$value->parent_id)->first();
                        echo $parent->name;
                     ?>
                @endif 
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>

    <div class="panel panel-default" style="margin: 20px 20px 20px 40px; display: inline-table;">

      <table class="table">

      <form action="{{ route('category.update', $data['id']) }}" method="POST">
       {{ csrf_field() }}
          @include('blocks.error')
           @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
           @endif
          <input type="hidden" name="_method" value="PUT" /> 
          <input type="hidden" name="id" value="{{ $data['id'] }}" /> 
      
       <p1 class="btn btn-primary " style="margin: 10px 0px 10px 10px;"> Sửa danh mục </p1>
       <div class="container col-md-12">
          <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" class="form-control" name="txtNameCate" value="{{ old('txtNameCate',isset($data) ? $data['name'] : null) }}">
          </div>
          <div class="form-group">
            <label for="name"> Loại danh mục </label>
            <select class="form-control" name="sltKindCate">
              <?php
                $thu=""; $chi=""; 
                if($data['kind'] == 1)
                {
                    $thu = "selected";
                }
                else{
                  $chi = "selected";
                }
               ?>
              <option value="0">Please Choose Kind of Category</option>
              <option value="1" {{$thu}} > Mục Thu </option>
              <option value="2" {{$chi}} > Mục Chi </option>
            </select>
          </div>
          <div class="form-group">
            <label for="name"> Danh mục cha </label>
            <select class="form-control" name="sltParentCate" >
              @if($data->parent_id == 0)
                <option value="0" selected> Please Choose Kind of Category </option>
              @else
                <option value="0"> Please Choose Kind of Category </option>
              @endif 
                  @foreach($cate as $value)
                      @if($value->id == $data->parent_id)
                        <option value="{{$value->id}}" selected> {{$value->name}} </option>
                      @else
                        <option value="{{$value->id}}"> {{$value->name}} </option>
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