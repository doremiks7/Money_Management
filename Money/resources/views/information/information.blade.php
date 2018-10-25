@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your Infomation</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('postUpdate', Auth::user()->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include('error')
                        @if(session('success'))
                            <div class="alert alert-success">
                            {{ session('success') }}
                            </div>
                        @endif
                        <?php $data = Auth::user(); ?>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Avatar</label>

                            <?php $avatar = "http://192.168.56.56/Laravel1/public/upload/images/".Auth::user()->avatar; ?>

                            <div class="col-md-6">
                                <img src = {{$avatar}} width="200px" height="200px" />
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name<h style="color: red;">(*)</h></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{!! old('name',isset($data) ? $data['name'] : null)!!}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address<h style="color: red;">(*)</h></label>

                            <div class="col-md-6">
                                <input id="email" type="email" disabled="disabled" class="form-control" name="email" value="{!! old('email',isset($data) ? $data['email'] : null) !!}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('upd_avatar') ? ' has-error' : '' }}">
                            <label for="upd_avatar" class="col-md-4 control-label">Update Avatar</label>

                            <div class="col-md-6">
                                <input type="hidden" name="old_img" value="{{isset($data) ? $data['avatar'] : null}}">
                                <input id="upd_avatar" type="file" class="form-control" name="upd_avatar" value="{!! old('upd_avatar') !!}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address',isset($data) ? $data['address'] : null) }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone',isset($data) ? $data['phone'] : null) }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date_birth') ? ' has-error' : '' }}">
                            <label for="date_birth" class="col-md-4 control-label">Date of birth</label>

                            <div class="col-md-6">
                           
                                <input id="date_birth" type="date" class="form-control" name="date_birth" <?php $time=strtotime($data['date_birth']);
                                                   echo $day = date('d', $time);
                                                   echo $month=date("m",$time);
                                                   echo $year=date("Y",$time);

                                 ?> value="{{$year}}-{{$month}}-{{$day}}" >
                            </div>
                        </div>
                    

                        <div class="form-group{{ $errors->has('rdoStatus') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Sex</label>
                            <div class="col-md-6">
                            
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="Male" <?php if (isset($data['sex']) && $data['sex']=="Male") echo "checked";?> type="radio">Male
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="Female" <?php if (isset($data['sex']) && $data['sex']=="Female") echo "checked";?> type="radio">Female
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Save & Change
                                </button>
                                <a class="btn btn-link" href="{{ url('/changepassword') }}">Change Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
