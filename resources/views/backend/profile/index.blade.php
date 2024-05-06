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
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/users/' . auth()->user()->user_image) }}" alt="{{Auth::user()->name}}" style="width: 100px; height: 100px">
                                    </div>

                                    <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                                    <p class="text-muted text-center">
                                        {{Auth::user()->email}}
                                    </p>

                                     <ul class="list-group list-group-unbordered mb-3">
                                      <li class="list-group-item">
                                        <b>{{__('email')}}</b> <a class="float-right">{{Auth::user()->email}}</a>
                                      </li>
                                      <li class="list-group-item">
                                        <b>{{__('roles')}}</b> <a class="float-right">{{Auth::user()->role->name}}</a>
                                      </li>
                                      <li class="list-group-item">
                                        <b>{{__('username')}}</b> <a class="float-right">{{Auth::user()->username}}</a>
                                      </li>
                                    </ul>
                                    <div class="float-right">
                                        <a href="{{route('admin.profile.change_password')}}" class="btn btn-primary"> <i class="fa fa-key"></i> {{__('change_password')}}</a>
                                        <a href="{{route('admin.profile.edit', ["profile" => Auth::user()->id])}}" class="btn btn-primary"> <i class="fa fa-edit"></i> {{__('edit')}}</a>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
