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
            <div class="col-md-6 col-order-1 text-center">
                <form class="col-md-12" action="{{ route('admin.rbac.roles', 'id') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
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
                <form class="col-md-12" action="{{ route('admin.users.password', 'id') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('New Ability') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Name') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="ability_name" class="form-control" placeholder="Ability Name" required>
                                    </div>
                                    @if ($errors->has('ability_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('ability_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Title') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="ability_title" class="form-control" placeholder="Role Title" required>
                                    </div>
                                    @if ($errors->has('ability_title'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('ability_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Description') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="ability_description" class="form-control" placeholder="Ability Description" required>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Roles') }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hovered">
                            <thead class="text-primary">
                                <tr class="title">
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>admin</td>
                                    <td>Administrator</td>
                                    <td>
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                        <a href="#"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>editor</td>
                                    <td>Editor</td>
                                    <td>
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                        <a href="#"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="button-container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12 ml-auto">
                                        <small>{{ "Pagination" }}</small>
                                    </h5>
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
                                <tr>
                                    <td>{{ __('Edit User') }}</td>
                                    <td>
                                        <span class="text-muted">
                                            <small>{{ __('Lorem ipsum dolor sit amet, consectetur') }}</small>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('CRUD User') }}</td>
                                    <td>
                                        <span class="text-muted">
                                            <small>{{ __('Lorem ipsum dolor sit amet, consectetur') }}</small>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('CRUD Games') }}</td>
                                    <td>
                                        <span class="text-muted">
                                            <small>{{ __('Lorem ipsum dolor sit amet, consectetur') }}</small>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('CRUD Channels') }}</td>
                                    <td>
                                        <span class="text-muted">
                                            <small>{{ __('Create, Read, Update and Delete Jokr Channels') }}</small>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection