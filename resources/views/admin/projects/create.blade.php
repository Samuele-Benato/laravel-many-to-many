@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <h4>Correggi i seguenti errori per proseguire:</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="container mt-5">

        <div class="row my-3">
            <div class="col d-flex align-items-center">
                <h2 class="my-3 fw-bold">Crea un progetto :</h2>
                <div class="ms-auto">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-dark">
                        <i class="fa-regular fa-circle-left me-1" style="color: #fafafa;"></i>Torna ai progetti
                    </a>
                </div>
            </div>

            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-6 my-2">
                                <label for="title" class="form-label"><strong>Titolo</strong></label>
                                <input type="text" id="title" name="title"
                                    class="form-control  @error('title') is-invalid @enderror" placeholder="Project title"
                                    value="{{ old('title') }}">
                                {{-- @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                            </div>

                            <div class="col-6 my-2">
                                <label for="image" class="form-label"><strong>Immagine</strong></label>
                                <input type="file" id="image" name="image"
                                    class="form-control @error('image') is-invalid @enderror" placeholder="Project img url"
                                    value="{{ old('image') }}">
                                {{-- @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                            </div>

                            <div class="col-6 my-2">
                                <label for="type_id" class="form-label"><strong>Tipo</strong></label>
                                <select name="type_id" id="type_id"
                                    class="form-select @error('type_id') is-invalid @enderror">
                                    <option value="">Seleziona il tipo</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            @if (old('type_id') == $type->id) selected @endif>
                                            {{ $type->label }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- @error('type_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror --}}
                            </div>

                            <div class="col-6 my-2">
                                <label class="form-label"><strong>Tecnologia</strong></label>

                                <div class="form-check @error('technologies') is-invalid @enderror p-0">
                                    @foreach ($technologies as $technology)
                                        <input type="checkbox" id="technology-{{ $technology->id }}"
                                            value="{{ $technology->id }}" name="technologies[]" class="form-check-control"
                                            @if (in_array($technology->id, old('technologies', $project_technologies ?? []))) checked @endif>
                                        <label for="technology-{{ $technology->id }}">
                                            {{ $technology->label }}
                                        </label>
                                        <br>
                                    @endforeach
                                </div>

                                {{-- @error('technologies')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror --}}
                            </div>

                            <div class="col-6">
                                <label for="link" class="form-label"><strong>Link</strong></label>
                                <input type="textarea" id="link" name="link"
                                    class="form-control @error('link') is-invalid @enderror" placeholder="Project link"
                                    value="{{ old('link') }}">
                                {{-- @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                            </div>
                            <div class="col-6">
                                <label for="description" class="form-label"><strong>Descrizione</strong></label>
                                <input type="textarea" id="description" name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Project description" value="{{ old('description') }}">
                                {{-- @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                            </div>

                        </div>
                    </div>
                </div>
                <button class="btn btn-success w-100 my-3">Salva</button>
            </form>
    </section>
@endsection
