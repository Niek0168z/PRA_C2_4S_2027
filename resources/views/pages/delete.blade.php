<x-layouts.app>
    <h2>Verwijderen</h2>
    <ol class="mb-0">
        @foreach ($manuals as $manual)
            <li>
                <form action="delete_manual">
                    <label for="">{{ $manual->brand->name }}: {{ $manual->name }}</label>
                    <input type="hidden" name="manualId" value="{{ $manual->id }}">
                    <input type="submit" value="Verwijderen" class="delete-button">
                </form>
            </li>
        @endforeach
    </ol>
</x-layouts.app>
