@extends('layouts.app')

@section('content')
    <section class="container mt-5">
        <div class="row my-3">
            <div class="col d-flex align-items-center">
                <h2 class="my-3 fw-bold">Lista progetti cestinati :</h2>
                <div class="ms-auto">
                    <a class="btn btn-dark btn-sm" href="{{ route('admin.projects.index') }}">
                        <i class="fa-regular fa-circle-left me-1" style="color: #fafafa;"></i> Torna ai progetti
                    </a>
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
                                        <button class="btn btn-success btn-sm my-1 w-100" data-bs-toggle="modal"
                                            data-bs-target="#restore-modal-{{ $project->id }}">
                                            <i class="fa-solid fa-backward me-2" style="color: #ffffff;"></i>Recupera
                                        </button>

                                        <button class="btn btn-danger btn-sm my-1 w-100" data-bs-toggle="modal"
                                            data-bs-target="#delete-modal-{{ $project->id }}">
                                            <i class="fa-solid fa-trash me-2" style="color: #ffffff;"></i>Elimina
                                        </button>
                                    </td>
                                </tr>

                            @empty
                                <h3>Nessun progetto trovato</h3>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                Sei sicuro di voler eliminare <strong>definitivamente</strong> il progetto
                                {{ $project->title }} con ID
                                {{ $project->id }}? <br />
                                L'operazione non è reversibile
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Annulla
                                </button>

                                <form action="{{ route('admin.projects.trash.force-destroy', $project) }}" method="POST">
                                    @method('DELETE') @csrf

                                    <button type="submit" class="btn btn-danger">
                                        Elimina
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="restore-modal-{{ $project->id }}" tabindex="-1"
                    aria-labelledby="restore-modal-{{ $project->id }}-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="restore-modal-{{ $project->id }}-label">
                                    Conferma riptistino
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                Sei sicuro di voler ripristinare il progetto
                                {{ $project->title }} con ID
                                {{ $project->id }}? <br />

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Annulla
                                </button>

                                <form action="{{ route('admin.projects.trash.restore', $project) }}" method="POST">
                                    @method('PATCH') @csrf

                                    <button type="submit" class="btn btn-success">
                                        Ripristina
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
    </section>
@endsection
