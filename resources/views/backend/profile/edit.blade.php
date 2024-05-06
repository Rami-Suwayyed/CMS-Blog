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
                            <h3 class="tile-title">{{__("update_manager")}}</h3>
                            <div class="tile-body">
                                <form method="post" action="{{route('admin.profile.update', ["profile" =>Auth::user()->id])}}" enctype="multipart/form-data">
                                    @csrf
                                    @method("put")
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">{{__("name")}}</label>
                                                <input class="form-control @if($errors->has('name')) is-invalid @endif" type="text" name="name" placeholder="{{__("enter_name")}}" value="{{Auth::user()->name}}">
                                            </div>
                                            @error("name")
                                            <div class="input-error">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">{{__('username')}}</label>
                                                <input class="form-control @if($errors->has('username')) is-invalid @endif" type="text" name="username" readonly placeholder="{{__("enter_username")}}"  value="{{Auth::user()->username}}" >
                                            </div>
                                            @error("username")
                                            <div class="input-error">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">{{__("email")}}</label>
                                                <input class="form-control @if($errors->has('email')) is-invalid @endif" type="text" name="email" placeholder="example : example@example.com" value="{{Auth::user()->email}}">
                                            </div>
                                            @error("email")
                                            <div class="input-error">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
{{--                                            @if(isPermissionsAllowed("view-notifications"))--}}
                                            <div class="panel panel-default">
                                                <!-- List group -->
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                <input type="checkbox" class="custom-control-input" @if(Auth::user()->receive_notice == 1)  checked @endif name="receive_notice" id="receive_notice">
                                                                <label class="custom-control-label" for="receive_notice"> {{__('receive_notice')}}</label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                <input type="checkbox" class="custom-control-input" @if(Auth::user()->receive_email == 1)  checked @endif name="receive_email" id="receive_email">
                                                                <label class="custom-control-label" for="receive_email">   {{__('receive_email')}}</label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
{{--                                            @endif--}}
                                        </div>
                                        <!-- /.col (right) -->
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">{{__("profile_photo")}}</label>
                                                <div>
                                                <input class="input-file show-uploaded" data-upload-type="single" data-imgs-container-class="uploaded-images" type="file"  accept="image/*" name="profile_photo">
                                                </div>
                                            </div>
                                            @error("profile_photo")
                                            <div class="input-error">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-3 col-md-5 col-sm-6">
                                            <div class="uploaded-images">
                                                <div class="img-container">
                                                    @if (auth()->user()->user_image != '')
                                                            <div id="imgArea">
                                                                <img src="{{ asset('assets/users/' . auth()->user()->user_image) }}" width="200" height="200">
                                                                <button class="btn btn-danger removeImage">{{ __('Backend/users.remove_image') }}</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
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
@section('script')
    <script>
        $(function () {
            $('.removeImage').click(function () {
                $.post('{{ route('admin.users.remove_image') }}', {
                    user_id: '{{ auth()->user()->id }}',
                    _token: '{{ csrf_token() }}'
                }, function (data) {
                    if (data == 'true') {
                        window.location.href = window.location;
                    }
                })

            });
        });
    </script>
@endsection
