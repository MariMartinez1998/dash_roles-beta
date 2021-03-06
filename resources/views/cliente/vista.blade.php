@extends('layouts.app')

@section('client')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Look at your services {{\Illuminate\Support\Facades\Auth::user()->name}}!</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mt-2">
                                        <thead style="background-color:#6777ef">         
                                            <th style="color:#fff;">See more</th>                                
                                            <th style="display: none;">ID</th>
                                            <th style="color:#fff;">Plate</th>
                                            {{-- <th style="color:#fff;">Name</th> --}}
                                            <th style="color:#fff;">Make</th>
                                            <th style="color:#fff;">Title</th>
                                            {{-- <th style="color:#fff;">Description</th>  --}}
                                            <th style="color:#fff;">Check-in Time</th> 
                                            {{-- <th style="color:#fff;">Email</th> 
                                            <th style="color:#fff;">Image</th>                                     --}}
                                    </thead>
                                    <tbody>
                                    @foreach ($blog as $blogs)
                                    <tr>
                                        <td>
                                            <a class="btn btn-warning fa fa-eye" href="{{ route('seguimiento',["$blogs->id_servicio"]) }}"></a>
                                        </td>
                                        <td style="display: none;">{{ $blogs->id }}</td>  
                                        <td>{{ $blogs->id_plate }}</td>  
                                        {{--<td>{{ $blogs->name }}</td>   --}}
                                        <td>{{ $blogs->make }}</td>                             
                                        <td>{{ $blogs->titulo }}</td>
                                        {{-- <td>{{ $blogs->contenido }}</td> --}}
                                        <td>{{  $blogs->created_at }}</td>
                                        {{-- <td>{{  $blogs->email }}</td>
                                        <td class="border px-14 py-1">
                                            <img src="/imagen/{{ $blogs->image }}" height="150" alt="">
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
