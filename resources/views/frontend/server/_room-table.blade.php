<table class="table table-sm table-bordered-info text-info">

    @foreach($rooms as $room)
        <tr>
            <td colspan="4">{{ $room['name'] }}</td>
            <td class="text-right">{{ $room['count'] }}</td>
        </tr>

        @if ((int)$room['players'])
            @foreach ($room['players'] as $name)
                <tr>
                    <td colspan="5" class="pl-3">{{ $name }}</td>
                </tr>

            @endforeach
        @endif
    @endforeach
</table>

