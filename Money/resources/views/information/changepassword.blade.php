@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your Infomation</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('postChangePassword') }}">
                        {{ csrf_field() }}
                        @include('error')
                        @if(session('success'))
                            <div class="alert alert-success">
                            {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                            {{ session('error') }}
                            </div>
                        @endif
                        <?php $data = Auth::user(); ?>
                        
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address<h style="color: red;">(*)</h></label>

                            <div class="col-md-6">
                                <input id="email" type="email" disabled="disabled" class="form-control" name="email" value="{!! old('email',isset($data) ? $data['email'] : null) !!}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('[oldpassword]') ? ' has-error' : '' }}">
                            <label for="oldpassword" class="col-md-4 control-label">Recent Password<h style="color: red;">(*)</h></label>

                            <div class="col-md-6">
                                <input id="oldpassword" type="password" class="form-control" name="oldpassword" value="">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password<h style="color: red;">(*)</h></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password<h style="color: red;">(*)</h></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Save & Change
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
