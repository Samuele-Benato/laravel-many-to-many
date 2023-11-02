@extends('layouts.app')

@section('content')
    <section class="container mt-5">
        <div class="row my-3">
            <div class="col d-flex align-items-center">
                <h1 class="my-3 fw-bold">Lista progetti :</h1>
                <div class="ms-auto">
                    <a class="btn btn-primary" href="{{ route('admin.projects.create') }}"><i class="fa-solid fa-plus mx-2"
                            style="color: #ffffff;"></i>Crea un Progetto</a>
                    <a class="btn btn-danger" href="{{ route('admin.projects.trash.index') }}"> <i
                            class="fa-solid fa-trash me-2" style="color: #ffffff;"></i>Vedi cestino</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titolo</th>
                            <th scope="col">Descrizione</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Tecnologie</th>
                            <th scope="col">Link</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($projects as $project)
                            <tr>
                                <th scope="row">{{ $project->id }}</th>
                                <td scope="col">{{ $project->title }}</td>
                                <td scope="col">{{ $project->description }}</td>
                                <td scope="col">{{ $project->type?->label }}</td>
                                <td scope="col">
                                    @forelse($project->technologies as $technology)
                                        {{ $technology->label }} @unless ($loop->last)
                                            ,
                                        @else
                                            .
                                        @endunless
                                    @empty
                                        -
                                    @endforelse
                                </td>
                                <td scope="col">{{ $project->link }}</td>
                                <td scope="col">
                                    <a class="btn btn-sm btn-success w-100"
                                        href="{{ route('admin.projects.show', $project) }}">
                                        <i class="fa-solid fa-circle-info me-1" style="color: #ffffff;"></i> Dettaglio
                                    </a>
                                    <button class="btn btn-danger btn-sm my-1 w-100" data-bs-toggle="modal"
                                        data-bs-target="#delete-modal-{{ $project->id }}">
                                        <i class="fa-solid fa-trash me-2" style="color: #ffffff;"></i>Elimina
                                    </button>
                                </td>
                            </tr>

                        @empty
                            <h3>Nessun project trovato</h3>
                        @endforelse
                    </tbody>
                </table>
                {{ $projects->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @foreach ($projects as $project)
            <div class="modal fade" id="delete-modal-{{ $project->id }}" tabindex="-1"
                aria-labelledby="delete-modal-{{ $project->id }}-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="delete-modal-{{ $project->id }}-label">
                                Conferma eliminazione
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            Sei sicuro di voler eliminare la project {{ $project->title }} con ID
                            {{ $project->id }}? <br />
                            L'operazione non è reversibile
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Annulla
                            </button>

                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                @method('DELETE') @csrf

                                <button type="submit" class="btn btn-danger">
                                    Elimina
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection
