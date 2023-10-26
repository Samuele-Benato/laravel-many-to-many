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
        <a href="{{ route('admin.projects.index') }}" class="btn btn-dark">
            Torna ai projects
        </a>

        <h1 class="my-3">Crea un progetto</h1>

        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-4">
                    <img src="" id="preview-image" class="img-fluid" alt="image">
                </div>

                <div class="col-8">
                    <div class="row">
                        <div class="col-4">
                            <label for="title" class="form-label">Titolo</label>
                            <input type="text" id="title" name="title" class="form-control"
                                placeholder="Project title" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="image" class="form-label">Immagine</label>
                            <input type="text" id="image" name="image" class="form-control"
                                placeholder="Project img url" value="{{ old('image') }}">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="type_id" class="form-label">Type</label>
                            <select name="type_id" id="type_id"
                                class="form-select @error('type_id') is-invalid @enderror">
                                <option value="">Seleziona il tipo</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" @if (old('type_id') == $type->id) selected @endif>
                                        {{ $type->label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Descrizione</label>
                            <input type="textarea" id="description" name="description" class="form-control"
                                placeholder="Project description" value="{{ old('description') }}">
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <button class="btn btn-success w-100 my-3">Salva</button>
        </form>
    </section>
@endsection
