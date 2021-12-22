@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">

        <h3 class="page__heading">Users</h3>
        <div class="col-xl-12">
            @can('create-user')
            <a class="btn btn-warning" href="{{ route('usuarios.create') }}">New</a>
            @endcan
            <form action="" class="action float-right">
                <div class="form-row float-right">

                    <div class="col-auto my-1">
                        <input type="submit" class="btn btn-primary" value="Search for">
                    </div>

                    <div class="col-sm-4 my-1">
                        <input type="text" class="form-control" name="buscar" placeholder="Plate">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="section-body">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="display:none;">ID</th>
                                <th style="color:#fff;">ID</th>
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
                                    <td>{{ $usuario->id }}</td>
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
                                        <div class="btn-toolbar" role="toolbar">
                                            <div class="btn-group btn-group-justified">
                                                <div class="grid-container">
                                                    <div class="grid-item">
                                                        @can('edit-user')
                                                        <a class="btn btn-info"
                                                            href="{{ route('usuarios.edit',$usuario->id) }}">Edit</a>
                                                        @endcan
                                                    </div>
                                                    <div class="grid-item">
                                                        @can('delete-user')
<<<<<<< HEAD
                                                        {!! Form::open(['method' => 'DELETE','route' =>
                                                        ['usuarios.destroy', $usuario->id],'style'=>'display:inline'])
                                                        !!}
=======
                                                        {!! Form::open(['method' => 'DELETE','route' => ['usuarios.destroy', $usuario->id.'-'.$usuario->plate ,                                              $usuario->id],'style'=>'display:inline']) !!}
>>>>>>> a88bad4e99e426d56360c8737916223e26880923
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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