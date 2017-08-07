@extends('wallet.master')
@section('noidung')
    <h2>List Category</h2>
    <p><button class="btn btn-primary" style="float:left; margin-bottom: 10px;" onclick="window.location='{{URL::route('category.create')}}'"> Thêm mới </button></p>        
    <p><a href="#" class="btn btn-primary" style="float:right; margin-bottom: 10px;" }}'">  </a></p>


 
    <table class="table table-border">
      <div class="tab">
        <button class="tablinks btn btn-success" onclick="openCity(event, 'txtThu')">Danh mục thu</button>
        <button class="tablinks btn btn-danger" onclick="openCity(event, 'txtChi')">Danh mục chi</button>
        <button class="tablinks btn btn-warning" onclick="openCity(event, 'txtAll')">Tất cả danh mục</button>
      </div>
    </table>


  @if(Session::has('flash-message'))
      <div class="alert alert-{!! Session::get('flash-level') !!}">       
          {!! Session::get('flash-message') !!}
      </div>
  @endif
      <div id="txtThu" class="tabcontent">
        <h3>Danh mục thu</h3>
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>Tên danh mục</th>
                <th>Loại</th>
                <th>Danh mục cha</th>
                <th>Ngày tạo</th>
                <th>Xóa</th>
                <th>Sửa</th>
              </tr>
            </thead>
            <tbody class="color-income">

            @foreach($cate_thu as $value)
              <tr>
                <td> {{$value->name}} </td>
                <td>Thu</td>
                <td>
                @if($value->parent_id == 0 || $value->parent_id == 1)
                    {!! "None" !!}
                @else
                    <?php $parent = DB::table('categories')->where('id',$value->parent_id)->first();
                        echo $parent->name;
                     ?>
                @endif
                </td>
                <td> {{$value->created_at}} </td>
                <td>
                <form method="POST" action="{{route('category.destroy', $value->id)}}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="_method" value="DELETE" />
                  <input type="hidden" name="id" value="{{ $value->id }}" />
                  <button onclick="return ConfirmDelete()" type="submit" class="btn btn-warning"><i class="fa fa-trash-o  fa-fw"></i>Delete</button>
                </form>

                </td>
                <td><a href="{!! route('category.edit', $value->id) !!}" class="btn btn-info" role="button"><i class="fa fa-pencil fa-fw"></i>Edit</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>
      </div>

      <div id="txtChi" class="tabcontent">
        <h3>Danh mục chi</h3>
        <table class="table table-bordered">

          <thead>
            <tr>
                <th>Tên danh mục</th>
                <th>Loại</th>
                <th>Danh mục cha</th>
                <th>Ngày tạo</th>
                <th>Xóa</th>
                <th>Sửa</th>
            </tr>
          </thead>
          <tbody class="color-expense">

          @foreach($cate_chi as $value)
              <tr>
                <td> {{$value->name}} </td>
                <td>Chi</td>              
                <td>
                  @if($value->parent_id == 0 || $value->parent_id == 1)
                      {!! "None" !!}
                  @else
                      <?php $parent = DB::table('categories')->where('id',$value->parent_id)->first();
                          echo $parent->name;
                       ?>
                  @endif
                </td>
                <td> {{$value->created_at}} </td>
                <td>
                <form method="POST" action="{{route('category.destroy', $value->id)}}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="_method" value="DELETE" />
                  <input type="hidden" name="id" value="{{ $value->id }}" />
                  <button onclick="return ConfirmDelete()" type="submit" class="btn btn-warning"><i class="fa fa-trash-o  fa-fw"></i>Delete</button>
                </form>
                </td>
                <td><a href="{!! route('category.edit', $value->id) !!}" class="btn btn-info" role="button"><i class="fa fa-pencil fa-fw"></i>Edit</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

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

<!-- script create tab content for each specific category -->
<script>
  function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
  }
  
</script>

@endsection