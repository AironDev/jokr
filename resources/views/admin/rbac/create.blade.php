@extends('layouts.dash', [
    'class' => '',
    'elementActive' => 'rbac'
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 d-flex">
                <div class="col-md-6">
                    <form class="" action="{{ route('rbac.store.role', 'id') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">{{ __('New Role') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="role_name" class="form-control" placeholder="Role Name" required>
                                        </div>
                                        @if ($errors->has('role_name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('role_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Title') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="role_title" class="form-control" placeholder="Role Title" required>
                                        </div>
                                        @if ($errors->has('role_title'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('role_title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Description') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="role_description" class="form-control" placeholder="Role Description" required>
                                        </div>
                                        @if ($errors->has('role_description'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('role_description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-info btn-round">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="" action="{{ route('rbac.store.ability', 'id') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">{{ __('Attach Ability') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Role') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option class="form-control" value="">{{'select'}}</option>
                                                @foreach($roles as $role)
                                                <option name="role_name" value="{{$role->name}}">
                                                    {{$role->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('role_name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('role_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Ability') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option class="form-control" value="">{{'select'}}</option>
                                                @foreach($abilities as $ability)
                                                <option name="ability_name" value="{{$ability->name}}">
                                                    {{$ability->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('ability_name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('ability_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Are you sure?') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group mt-2">
                                            <label class="checkbox-inline"><input type="checkbox" name="comfirm_attach" title="yes" value="yes"><span class="ml-2">Yes</span>
                                            </label>
                                        </div>
                                        @if ($errors->has('ability_description'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('ability_description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-info btn-round">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Roles') }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hovered">
                            <thead class="text-primary">
                                <tr class="title">
                                    <th>s/n</th>
                                    <th>name</th>
                                    <th>title</th>
                                    <th>description</th>
                                    <th>__</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->title}}</td>
                                    <td>{{$role->description}}</td>
                                    <td>
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                        <a href="#"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="button-container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-6 ml-auto">
                                   
                                </div>
                                <div class="col-lg-6 col-md-6 col-6 ml-auto">
                                    <small>{{ "Pagination" }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Abilities') }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                @foreach($abilities as $ability)
                                    <tr>
                                        <td>{{ __($ability->name) }}</td>
                                        <td>
                                            <span class="text-muted">
                                                <small>{{ __($ability->description) }}</small>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-success btn-round btn-icon">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>        
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {!! $abilities->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection