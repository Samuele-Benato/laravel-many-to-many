@extends('layouts.app')

@section('content')
    <section class="container mt-5">
        <h2 class="my-3 fw-bold">Dettaglio progetto : </h2>
        <div class="row g-3">
            <div class="col-4 col-lg-3 col-md-6 col-sm-12 ">
                <img class="img-fluid" src="{{ asset('/storage/' . $project->image) }}" alt="project img">
            </div>
            <div class="col-8 col-lg-9 col-md-6 col-sm-12 d-flex align-items-center">
                <div class="row g-3 ">
                    <div class="col-1">
                        <strong>Id: </strong> {{ $project->id }}
                    </div>
                    <div class="col-3">
                        <strong>Titolo: </strong> {{ $project->title }}
                    </div>
                    <div class="col-4">
                        <strong>Tipo: </strong>
                        {{ $project->type ? $project->type->label : 'Nessun type' }}
                    </div>
                    <div class="col-4">
                        <strong>Tecnologia: </strong>
                        @forelse ($project->technologies as $technology)
                            {{ $technology->label }} @unless ($loop->last)
                                ,
                            @else
                                .
                            @endunless
                        @empty
                            Nessuna technologia associata
                        @endforelse
                    </div>
                    <div class="col-12">
                        <strong>Descrizione: </strong> {{ $project->description }}
                    </div>
                    <div class="col-12">
                        <strong>Link: </strong> {{ $project->link }}
                    </div>
                    <div class="col-12">
                        <a class="btn btn-dark btn-sm" href="{{ route('admin.projects.index') }}">
                            <i class="fa-regular fa-circle-left me-1" style="color: #fafafa;"></i> Torna ai progetti
                        </a>
                        <a class="btn btn-warning btn-sm" href= "{{ route('admin.projects.edit', $project) }}">
                            <i class="fa-solid fa-pen-to-square me-1" style="color: #000000;"></i> Modifica
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
