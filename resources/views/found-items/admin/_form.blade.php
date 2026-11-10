@php($editing = $item !== null)

<form class="item-form" action="{{ $editing ? route('admin.found-items.update', $item) : route('admin.found-items.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($editing)
        @method('PUT')
    @endif
    <div class="field">
        <label for="name">Nome do item</label>
        <input id="name" name="name" type="text" maxlength="120" value="{{ old('name', $item?->name) }}" required>
        @error('name')<p class="error">{{ $message }}</p>@enderror
    </div>
    <div class="field">
        <label for="description">Descrição</label>
        <textarea id="description" name="description" maxlength="2000" required>{{ old('description', $item?->description) }}</textarea>
        @error('description')<p class="error">{{ $message }}</p>@enderror
    </div>
    <div class="two-fields">
        <div class="field">
            <label for="found_at">Data em que foi encontrado</label>
            <input id="found_at" name="found_at" type="date" max="{{ now()->toDateString() }}" value="{{ old('found_at', $item?->found_at?->toDateString() ?? now()->toDateString()) }}" required>
            @error('found_at')<p class="error">{{ $message }}</p>@enderror
        </div>
        <div class="field">
            <label for="location">Local <span class="optional">(opcional)</span></label>
            <input id="location" name="location" type="text" maxlength="160" value="{{ old('location', $item?->location) }}" placeholder="Ex.: biblioteca">
            @error('location')<p class="error">{{ $message }}</p>@enderror
        </div>
    </div>
    @if ($editing)
        <div class="current-photo">
            <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($item->image_path) }}" alt="Foto atual de {{ $item->name }}">
            <span>Foto atual</span>
        </div>
    @endif
    <div class="field">
        <label for="photo">{{ $editing ? 'Trocar foto (opcional)' : 'Foto do item' }}</label>
        <input id="photo" name="photo" type="file" accept="image/jpeg,image/png,image/webp" @required(!$editing)>
        <small>JPG, PNG ou WEBP · até 5 MB</small>
        @error('photo')<p class="error">{{ $message }}</p>@enderror
    </div>
    <button class="primary-button" type="submit">{{ $editing ? 'Salvar alterações' : 'Cadastrar item' }}</button>
</form>