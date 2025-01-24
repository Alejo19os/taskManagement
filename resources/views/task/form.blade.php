<div class="row p-3">
    <div class="col-md-12">
        <div class="form-group mb-3">
            <label for="title" class="form-label">{{ __('Título') }}</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}" id="title" placeholder="Ingrese el título de la tarea" required>
            </div>
            {!! $errors->first('title', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">{{ __('Descripción') }}</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-pencil"></i></span>
                <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                    value="{{ old('description', $task?->description) }}" id="description" placeholder="Descripción de la tarea">
                </textarea>
            </div>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="due_date" class="form-label">{{ __('Fecha de vencimiento') }}</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
                <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror"
                    value="{{ old('due_date', $task?->due_date) }}" id="due_date" placeholder="Fecha de vencimiento">
            </div>
            {!! $errors->first('due_date', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <button type="submit" class="btn btn-primary btn-sm">{{ __('Guardar') }}</button>
    </div>
</div>
