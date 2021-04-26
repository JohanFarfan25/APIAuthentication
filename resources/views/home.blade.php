@extends('layouts.app')
@section('content')
<div class="container">
<div class="panel-default"><h4><b>Welcome {{ Auth::user()->name }}</b></h4></div>
 @if($messege = Session::get('Listo'))
<div class="col-lg-12 alert-info alert-dismissable text-center" role="alert">
<h5>Mensaje:<span> {{ $messege }} </span></h5></div>
@endif
 @if($messege = Session::get('Error'))
  <div class="col-lg-12 alert-danger alert-dismissable text-center" role="alert">
   <h5>Mensaje:<span> {{ $messege }} </span></h5></div>
   @endif
    <br></br>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header panel-orange">Register User</div>

                <div class="card-body">
                    <form class="form-horizontal " method="POST" action="{{ route('home') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                            <label for="name" class="col-md-4 control-label input-font-family">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} row">
                            <label for="last_name" class="col-md-4 control-label input-font-family">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('document_number') ? ' has-error' : '' }} row">
                            <label for="document_number" class="col-md-4 control-label input-font-family">Document Number</label>

                            <div class="col-md-6">
                                <input id="document_number" type="number" class="form-control" name="document_number" value="{{ old('document_number') }}" required autofocus>

                                @if ($errors->has('document_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('document_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('cel_phone') ? ' has-error' : '' }} row">
                            <label for="cel_phone" class="col-md-4 control-label input-font-family">Cel Phone</label>

                            <div class="col-md-6">
                                <input id="cel_phone" type="number" class="form-control" name="cel_phone" value="{{ old('cel_phone') }}" required autofocus>

                                @if ($errors->has('cel_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cel_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                            <label for="email" class="col-md-4 control-label input-font-family">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                            <label for="password" class="col-md-4 control-label input-font-family">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="btn  panel-orange btn-block">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header panel-orange">{{ __('Users') }}</div>

                <div class="card-body">
                    <form class="form-horizontal" method="GET" action="{{ route('home') }}">
                        {{ csrf_field() }}
                    <table  class="table  table-striped table-bordered table-responsive" >
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Doc Number</th>
                            <th>Cel phone</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $us)
                        <tr>
                            <td>{{$us->id}}</td>
                            <td>{{$us->name}}</td>
                            <td>{{$us->last_name}}</td>
                            <td>{{$us->document_number}}</td>
                            <td>{{$us->cel_phone}}</td>
                            <td>{{$us->email}}</td>
                            <td>
                            <div class="form-group">

                                <form method="POST" action="{{ route('home.destroy', $us->id) }}">
                                @csrf @method('DELETE')                                
                                <button class="btn btn-outline-danger btn-block " >Delete</button>
                                </form >
                                <a href="#" class="btn  btn-outline-primary pull-right btn-block" style="margin-top:10px;" data-toggle="modal" data-target="#edit{{$us->id}}">
                                Edit
                                </a>

                                </div>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                       
                    </tbody>
                </table>
                </div>  
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit{{$us->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header panel-orange">
                <strong><h4>Edit User {{$us->name}}</h4></strong>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('home.update',$us->id) }}">
                 @csrf @method('PATCH')

                 <div class="form-group  row">
                        <label  for="" class="col-md-4 control-label input-font-family">Name</label>
                        <div class="col-md-6">
                            <input  type="text" name="name" value="{{$us->name}}" class="form-control"  >
                        </div>
                 </div>
                 <div class="form-group  row">
                        <label  for="" class="col-md-4 control-label input-font-family">Last Name</label>
                        <div class="col-md-6">
                            <input  type="text" name="last_name" value="{{$us->last_name}}" class="form-control"  >
                        </div>
                 </div>
                 <div class="form-group  row">
                        <label  for="" class="col-md-4 control-label input-font-family">Doc Number</label>
                        <div class="col-md-6">
                            <input  type="text" name="document_number" value="{{$us->document_number}}" class="form-control" >
                        </div>
                 </div>
                 <div class="form-group  row">
                        <label  for="" class="col-md-4 control-label input-font-family">Cel Phone</label>
                        <div class="col-md-6">
                            <input  type="text" name="cel_phone" value="{{$us->cel_phone}}" class="form-control"  >
                        </div>
                 </div>
                 <div class="form-group  row">
                        <label  for="" class="col-md-4 control-label input-font-family">Email</label>
                        <div class="col-md-6">
                            <input  type="text" name="email" value="{{$us->email}}" class="form-control"  >
                        </div>
                 </div>
                 <div class="form-group  row">
                        <label  for="" class="col-md-4 control-label input-font-family">Password</label>
                        <div class="col-md-6">
                            <input  type="text" name="password" placeholder="password" class="form-control"  >
                        </div>
                 </div>

                <div class="modal-footer">
                 <button type="submit" class="btn panel-orange">Update</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 </div>
                </form >
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
