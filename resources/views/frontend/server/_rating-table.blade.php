<table class="table table-sm table-bordered-info text-info">
    <thead>
    <tr class="text-right">
        <th class="text-center">{{ __('server.rating') }}</th>
        <th class="text-left">{{ __('server.player-name') }}</th>
        <th>{{ __('server.REP') }}</th>
        <th>{{ __('server.wins') }}</th>
        <th>{{ __('server.loses') }}</th>
        <th>{{ __('server.wins-percent') }}</th>
        <th>{{ __('server.avg-opps-rating') }}</th>
        <th>{{ __('server.avg-opps-REP') }}</th>
        <th>{{ __('server.disconnections-percent') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($players as $player)
        <tr>
            <td class="text-center">{{ $loop->index + 1 }}</td>
            <td>{{ $player['name'] }}</td>
            <td class="text-right">{{ number_format($player['REP'], 0, '', ' ') }}</td>
            <td class="text-right">{{ number_format($player['wins'], 0, '', ' ') }}</td>
            <td class="text-right">{{ number_format($player['loses'], 0, '', ' ') }}</td>
            <td class="text-right">{{ $player['wins_percent'] }}</td>
            <td class="text-right">{{ number_format($player['avg_opps_rating'], 0, '', ' ') }}</td>
            <td class="text-right">{{ number_format($player['avg_opps_REP'], 0, '', ' ') }}</td>
            <td class="text-right">{{ $player['disc_percent'] }}</td>
        </tr>

    @endforeach
    </tbody>
</table>


