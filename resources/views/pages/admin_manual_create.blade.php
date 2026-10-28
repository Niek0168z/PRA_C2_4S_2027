<x-layouts.app>
    <h1>Handleiding toevoegen</h1>

    @if (session('status'))
        <p role="status">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('admin.manuals.store') }}">
        @csrf

        <div class="form-group">
            <label for="brand_id">Merk</label>
            <select class="form-control" id="brand_id" name="brand_id" required>
                <option value="">Kies een merk</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @selected(old('brand_id') == $brand->id)>{{ $brand->name }}</option>
                @endforeach
            </select>
            @error('brand_id')
                <p role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="type_id">Type</label>
            <select class="form-control" id="type_id" name="type_id" required>
                <option value="">Kies eerst een merk</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" data-brand-id="{{ $type->brand_id }}" @selected(old('type_id') == $type->id)>
                        {{ $type->brand->name }} - {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('type_id')
                <p role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="type_name">Of voeg een nieuw type toe</label>
            <input class="form-control" id="type_name" name="type_name" type="text" value="{{ old('type_name') }}" maxlength="255">
            @error('type_name')
                <p role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">Modelnaam</label>
            <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="255">
            @error('name')
                <p role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="filesize">Bestandsgrootte (bytes)</label>
            <input class="form-control" id="filesize" name="filesize" type="number" value="{{ old('filesize', 0) }}" min="0" required>
            @error('filesize')
                <p role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="originUrl">Link naar de handleiding</label>
            <input class="form-control" id="originUrl" name="originUrl" type="url" value="{{ old('originUrl') }}" required>
            @error('originUrl')
                <p role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="filename">Bestandsnaam (optioneel)</label>
            <input class="form-control" id="filename" name="filename" type="text" value="{{ old('filename') }}" maxlength="255">
            @error('filename')
                <p role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="downloadedServer">Server (optioneel)</label>
            <input class="form-control" id="downloadedServer" name="downloadedServer" type="text" value="{{ old('downloadedServer') }}" maxlength="255">
            @error('downloadedServer')
                <p role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="testcolumn">Extra veld (optioneel)</label>
            <input class="form-control" id="testcolumn" name="testcolumn" type="text" value="{{ old('testcolumn') }}" maxlength="255">
            @error('testcolumn')
                <p role="alert">{{ $message }}</p>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Handleiding opslaan</button>
    </form>

    <script>
        const brandSelect = document.getElementById('brand_id');
        const typeSelect = document.getElementById('type_id');
        const typeOptions = Array.from(typeSelect.options).filter(option => option.dataset.brandId);

        function filterTypes() {
            const brandId = brandSelect.value;

            typeOptions.forEach(option => {
                const matchesBrand = option.dataset.brandId === brandId;
                option.hidden = !matchesBrand;
                option.disabled = !matchesBrand;
            });

            if (!typeSelect.selectedOptions[0]?.dataset.brandId || typeSelect.selectedOptions[0].dataset.brandId !== brandId) {
                typeSelect.value = '';
            }

            typeSelect.required = typeNameInput.value.trim() === '';
        }

        const typeNameInput = document.getElementById('type_name');
        typeNameInput.addEventListener('input', function () {
            typeSelect.required = typeNameInput.value.trim() === '';
            if (typeNameInput.value.trim() !== '') {
                typeSelect.value = '';
            }
        });

        brandSelect.addEventListener('change', filterTypes);
        filterTypes();
    </script>
</x-layouts.app>
