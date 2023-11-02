@extends('layouts.app')

@section('content')
    <section class="container mt-5">
        <div class="row my-3">
            <div class="col d-flex align-items-center">
                <h2 class="my-3 fw-bold">Modifica progetto :</h2>
                <div class="ms-auto">
                    <a class="btn btn-dark" href="{{ route('admin.projects.index') }}">
                        <i class="fa-regular fa-circle-left me-1" style="color: #fafafa;"></i>Torna ai progetti
                    </a>
                    <a class="btn btn-warning" href="{{ route('admin.projects.show', $project) }}">
                        <i class="fa-solid fa-circle-info me-1" style="color: #000000;"></i>Torna al dettaglio
                    </a>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="row g-3"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-4 my-2">
                <label for="title" class="form-label"><strong>Titolo</strong></label>
                <input type="text" id="title" name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    value=" {{ old('title') ?? $project->title }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-8">
                <label for="link"><strong>Link</strong></label>
                <textarea name="link" id="link" class="form-control" rows="1">{{ $project->link }}</textarea>
            </div>
            @error('link')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="col-12 my-2">
                <div class="row">
                    <div class="col-4">
                        <img class="img-fluid" src="{{ asset('/storage/' . $project->image) }}" alt="project img"
                            id="imagePreview">
                    </div>

                    <div class="col-8">
                        <label for="image" class="form-label"><strong>Immagine</strong></label>
                        <input type="file" name="image" class="form-control" id="image"
                            @error('image') is-invalid @enderror value=" {{ old('image') ?? $project->image }}">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-4 my-2">
                <label for="type_id" class="form-label"><strong>Tipo</strong></label>
                <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                    <option value="">Seleziona il tipo</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @if (old('type_id') ?? $project->type_id == $type->id) selected @endif>
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

            <div class="col-4 my-2">
                <label class="form-label"><strong>Tecnologia</strong></label>

                <div class="form-check @error('technologies') is-invalid @enderror p-0">
                    @foreach ($technologies as $technology)
                        <input type="checkbox" id="technology-{{ $technology->id }}" value="{{ $technology->id }}"
                            name="technologies[]" class="form-check-control "
                            @if (in_array($technology->id, old('technologies', $project_technologies ?? []))) checked @endif>
                        <label for="technology-{{ $technology->id }}">
                            {{ $technology->label }}
                        </label>
                        <br>
                    @endforeach
                </div>

                @error('technologies')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="col-12">
                <label for="description"><strong>Descrizione</strong></label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ $project->description }}</textarea>
            </div>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button class="btn btn-success">Salva</button>
            </div>
        </form>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        const inputFileElement = document.getElementById('image');
        const imagePreview = document.getElementById('image_preview');

        if (!imagePreview.getAttribute('src') || imagePreview.getAttribute('src') == "http: //127.0.0.1:8000/storage")

            inputFileElement.addEventListener('change', function() {
                const [file] = this.files;
                imagePreview.src = URL.createObjectURL(file);
            })
    </script>
@endsection
