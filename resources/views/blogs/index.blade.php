@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">

        <h3 class="page__heading">Services</h3>
        <div class="col-xl-12">
            @can('create-service')
            <a class="btn btn-warning " href="{{ route('blogs.create') }}">New</a>
            @endcan
            <form action="" class="action float-right">
                <div class="form-row">

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


                        <div class="row mb-3">
                            @can('create-service')
                            <form action="{{ route('download-placa') }}" class="action float-right">
                                <div class="form-row">
                                    <div class="col col-sm-4 my-1 mx-4">
                                        <input type="text" class="form-control" name="plate" placeholder="Print by plate">
                                    </div>
                                    <div class="col col-md-auto my-2">
                                        <input type="submit" class="btn btn-primary" value ="Print report per plate">
                                    </div>
                                    <!-- <div class="col col-md-auto my-2">
                                        <a class=" btn btn-primary" name="printe-plate"
                                            href="{{ route('download-placa') }}">Print report per plate</a>
                                    </div> -->
                                    <div class="col col-md-auto my-2">
                                        <a class="btn btn-primary" name="printe" href="{{ route('download-pdf') }}">Print Report
                                            General</a>
                                    </div>
                                </div>
                            </form>
                            
                            @endcan
                        </div>



                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="display:none;">ID</th>
                                <th style="color:#fff;">Plate</th>
                                <th style="color:#fff;">Title</th>
                                <th style="color:#fff;">Description</th>
                                <th style="color:#fff;">Image</th>
                                <th style="color:#fff;">Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $blog)
                                <tr>
                                    <td style="display:none;">{{ $blog->id }}</td>
                                    <td>{{ $blog->id_plate }}</td>
                                    <td>{{ $blog->titulo }}</td>
                                    <td>{{ $blog->contenido }}</td>

                                    <td>
                                        <div class="container-img">
                                            <img src="/imagen/{{ $blog->image }}" style="object-fit: cover; max-width: 100%;" width= "100%"; height= "100%"; alt="">
                                            
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-toolbar" role="toolbar">
                                            <div class="btn-group btn-group-justified">
                                                <form action="{{ route('blogs.destroy',$blog->id) }}" method="POST">
                                                <div class="grid-container">
                                                    <div class="grid-item">   
                                                        @can('edit-service')
                                                        <a class="btn btn-info"
                                                            href="{{ route('blogs.edit',$blog->id) }}">Edit</a>
                                                        @endcan
                                                    </div>
                                                    <div class="grid-item">
                                                        @csrf
                                                        @method('DELETE')
                                                        @can('delete-service')
                                                        <button type="submit" class="btn btn-danger ">Delete</button>
                                                        @endcan
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $blogs->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection