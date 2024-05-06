@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Backend/permissions.permissions') }}</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">{{ __('Backend/permissions.add_permission') }}</span>
                </a>
            </div>
        </div>

        @include('backend.permissions.filter.filter')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{ __('Backend/permissions.slug') }}</th>
                    <th>{{ __('Backend/permissions.name') }}</th>
                    <th class="text-center" style="width: 30px;">{{ __('Backend/permissions.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($permissions as $permission)
                    <tr>
                        <td>{{ $permission->slug }}</td>
                        <td>{{ $permission->name }}</a></td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this permission?') ) { document.getElementById('permission-delete-{{ $permission->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="post" id="permission-delete-{{ $permission->id }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">{{ __('Backend/permissions.no_permissions_found') }}</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        <div class="float-right">
                            {!! $permissions->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


@endsection
