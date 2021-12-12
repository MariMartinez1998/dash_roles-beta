@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Users</h3>
<<<<<<< HEAD
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-xl-12">
=======
        <div class="col-xl-12">
>>>>>>> 770a5bf6806f76abf0e8d98cfa37a007cb6e8d7e
                <form action="" class="action">
                    <div class="form-row">
                        <div class="col-sm-4 my-1">
                            <input type="text" class="form-control" name="buscar" placeholder="Search of plate">
                        </div>
                        <div class="col-auto my-1">
                            <input type="submit" class="btn-primary" value="Search for">
                        </div>
                    </div>
                </form>
            </div>
<<<<<<< HEAD
=======
    </div>
    <div class="section-body">
        <div class="row">
            
>>>>>>> 770a5bf6806f76abf0e8d98cfa37a007cb6e8d7e
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        @can('create-user')
<<<<<<< HEAD
                        <a class="btn btn-warning" href="{{ route('usuarios.create') }}">New</a>
=======
                        <a class="btn btn-warning fa fa-plus" href="{{ route('usuarios.create') }}">New</a>
>>>>>>> 770a5bf6806f76abf0e8d98cfa37a007cb6e8d7e

                        @endcan

                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="display:none;">ID</th>
                                <th style="color:#fff;">Plate</th>
                                <th style="color:#fff;">Name</th>
                                <th style="color:#fff;">Last name</th>
                                <th style="color:#fff;">E-mail</th>
                                <th style="color:#fff;">Rol</th>
                                <th style="color:#fff;">Phone</th>
                                <th style="color:#fff;">Address</th>
                                <th style="color:#fff;">City</th>
                                <th style="color:#fff;">State</th>
                                <th style="color:#fff;">Zip Code</th>
                                <th style="color:#fff;">Vin</th>
                                <th style="color:#fff;">Model</th>
                                <th style="color:#fff;">Make</th>
                                <th style="color:#fff;">Colour</th>
                                <th style="color:#fff;">Year</th>
                                <th style="color:#fff;">Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                <tr>
                                    <td style="display:none;">{{ $usuario->id }}</td>
                                    <td>{{ $usuario->plate }}</td>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->last_name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>
                                        @if(!empty($usuario->getRoleNames()))
                                        @foreach($usuario->getRoleNames() as $rolNombre)
                                        <h5><span class="badge badge-dark">{{ $rolNombre }}</span></h5>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $usuario->phone }}</td>
                                    <td>{{ $usuario->address }}</td>
                                    <td>{{ $usuario->city }}</td>
                                    <td>{{ $usuario->state }}</td>
                                    <td>{{ $usuario->zip_code }}</td>
                                    <td>{{ $usuario->vin }}</td>
                                    <td>{{ $usuario->model }}</td>
                                    <td>{{ $usuario->make }}</td>
                                    <td>{{ $usuario->color }}</td>
                                    <td>{{ $usuario->year }}</td>
                                    <td>

                                        @can('edit-user')
                                        <a class="btn btn-info"
                                            href="{{ route('usuarios.edit',$usuario->id) }}">Edit</a>
                                        @endcan

                                        @can('delete-user')
                                        {!! Form::open(['method' => 'DELETE','route' => ['usuarios.destroy',
                                        $usuario->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Centramos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $usuarios->links() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection