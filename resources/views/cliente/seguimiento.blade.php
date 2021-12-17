@extends('layouts.app')

@section('content')
    
    <section class="section">
        <div class="section-header">
            <div class="row " style="width: 100%">
                <div class="col-lg-7 page__heading ">
                    <h3 clase>{{ $blog[0]->titulo }}</h3>
                    <p>{{ $blog[0]->contenido }}</p>
                </div>
                <div class="col-lg-5">
                    <img class="rounded" src="/imagen/{{ $blog[0]->image }}" height="150" alt="">
                </div>
            </div>
        </div>  
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Detalles
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
                                            <ul>
                                                <li>{{ $blog[0]->id_plate }}</li>  
                                                <li>{{ $blog[0]->name }}</li>  
                                                <li>{{ $blog[0]->make }}</li>                             
                                                <li>{{ $blog[0]->created_at }}</li>
                                                <li>{{ $blog[0]->email }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Comentarios
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="list-group">
                                                        @foreach ($message as $messages)
                                                            <a href="#" class="list-group-item list-group-item-action">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 class="mb-1">{{$messages->mensaje}}</h5>
                                                                    <small>{{$messages->created_at}}</small>
                                                                </div>
                                                                <p class="mb-1">{{$messages->name}} {{$messages->last_name}}</p>
                                                                <small>Actualizado: {{$messages->updated_at}}</small>
                                                            </a>
                                                        @endforeach
                                                        @if ( count($message) <= 0)
                                                            <a href="#" class="list-group-item list-group-item-action">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <h5 class="mb-1">No hay mensaje</h5>
                                                                    <small>2021-12-17 </small>
                                                                </div>
                                                                <p class="mb-1"></p>
                                                                <small>Actualizado: 2021-12-17</small>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-lg-12">
                                                    <form action="{{route('message.store')}}" method="POST" class="border p-lg-4 mt-lg-4 rounded-lg" >
                                                        @csrf
                                                        <input type="hidden" value="{{ $blog[0]->id }}" name="id_servicio">
                                                        <div class="form-group">
                                                            <label for="mensaje">Comentar</label>
                                                            <textarea class="form-control" id="mensaje" name="mensaje" style="max-height: 100px;min-height: 70px;height: 70px;" rows="4"></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
