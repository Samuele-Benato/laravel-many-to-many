@extends('layouts.app')

@section('content')
    <section class="container mt-5">
        <div class="row g-3">
            <div class="col-4 col-lg-3 col-md-6 col-sm-12 ">
                <img class="img-fluid" src="{{ $project->image }}" alt="project img">
            </div>
            <div class="col-8 col-lg-9 col-md-6 col-sm-12 d-flex align-items-center">
                <div class="row g-3 ">
                    <div class="col-4">
                        <strong>Id: </strong> {{ $project->id }}
                    </div>
                    <div class="col-4">
                        <strong>Title: </strong> {{ $project->title }}
                    </div>
                    <div class="col-4">
                        <strong>Type: </strong>
                        {{ $project->type ? $project->type->label : 'Nessun type' }}
                    </div>
                    <div class="col-12">
                        <strong>Description: </strong> {{ $project->description }}
                    </div>
                    <div class="col-12">
                        <a class="btn btn-dark btn-sm" href="{{ route('admin.projects.index') }}">
                            Torna ai projects
                        </a>
                        <a class="btn btn-warning btn-sm" href= "{{ route('admin.projects.edit', $project) }}">
                            Modifica
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
