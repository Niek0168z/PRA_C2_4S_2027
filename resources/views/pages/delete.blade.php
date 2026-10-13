<x-layouts.app>
    <div class="manual-list-delete brand-list">
        <h2>{{ __('misc.deletetext')}}</h2>
        <table>
            @foreach ($manuals as $manual)
                <form action="delete_manual/{{$manual->id}}" method="POST">
                    {{-- @csrf fixt page expired --}}
                    @csrf
                    @method('delete')
                    <tr>
                        <td><label for="">{{ $manual->brand->name }}: {{ $manual->name }}</label></td>
                        <td><input type="hidden" name="manualId" value="{{ $manual->id }}"></td>
                        <td><input type="submit" value="{{ __('misc.deletetext')}}" class="delete-button"></td>
                    </tr>
                </form>
            @endforeach
        </table>
    </div>
</x-layouts.app>
