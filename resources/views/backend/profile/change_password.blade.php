@extends('layouts.admin')
@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="tile">
                            <div class="tile-body">

                                @if (count($errors) > 0)
                                    <div  class="is-invalid">
                                        <ul>
                                            @foreach ($errors->all() as $key => $error)
                                                <li>
                                                    <span style="color: red">{{ $error }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="post" action="{{route('admin.profile.update_password')}}" enctype="multipart/form-data">
                                    @csrf
                                    <h2>{{__('change_password')}}</h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>{{__('current_password')}}</label>
                                                <input class="form-control  @if($errors->has('current_password')) is-invalid @endif" type="password" name="current_password" placeholder="{{__("enter_current_password")}}" autocomplete="off">
                                            </div>
                                            @error("current_password")
                                            <div class="input-error">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">{{__("password")}}</label>
                                                <input class="form-control @if($errors->has('password')) is-invalid @endif" type="password" name="password" placeholder="****" autocomplete="off">
                                            </div>
                                            @error("password")
                                            <div class="input-error">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">{{__("password_confirmation")}}</label>
                                                <input class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" type="password" name="password_confirmation" placeholder="****" autocomplete="off">
                                            </div>
                                            @error("password_confirmation")
                                            <div class="input-error">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <br>
                                    </div>
                                    <div class="tile-footer">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> {{__('update')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
