@extends('layouts.dash', [
    'class' => '',
    'elementActive' => 'rbac'
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div id="alert" class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-globe text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <h3 class="title caps">{{$role->name}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-money-coins text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Users</p>
                                    <p class="card-title">
                                        {{count($users)}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-vector text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Abilities</p>
                                    <p class="card-title">
                                        {{count($abilities)}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title">Users</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>___</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$user->name}}</td>
                                        <td> {{$user->email}} </td>
                                        <td> {{$user->status}} </td>
                                        <td>
                                
                                            <form method="POST" style="display: inline-flex;" action="{{route('rbac.retract.role', $user->id)}}">
                                               @method('post')
                                                @csrf
                                                <a type="submit" class="retract-btn" href="#"><i class="fa fa-remove"></i></a>
                                                <input type="hidden" name="role"  value="{{$role->name}}">
                                            </form> 

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.retract-btn').click(function(e){
            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('User role will be retracted - confirm ?')) {
                // Post the form
                $(e.target).closest('form').submit() // Post the surrounding form
            }
        });
    </script>

    <script>
        $("document").ready(function(){
            setTimeout(function(){
               $("#alert").remove();
            }, 3000 ); // 5 secs
            $("#alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#alert").slideUp("500");
            });
        });
    </script>
    
@endpush