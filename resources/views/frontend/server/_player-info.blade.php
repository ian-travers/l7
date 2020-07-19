<div class="h2">{{ $playerInfo['name'] }}</div>
<table class="table table-sm table-dark table-bordered text-info">
    <thead>
    <tr class="text-center">
        <th class="w-10"></th>
        <th class="w-18">{{ __('server.overall') }}</th>
        <th class="w-18">{{ __('server.circuit') }}</th>
        <th class="w-18">{{ __('server.sprint') }}</th>
        <th class="w-18">{{ __('server.drag') }}</th>
        <th class="w-18">{{ __('server.drift') }}</th>
    </tr>
    </thead>
    <tbody>
    <tr class="text-right">
        <td class="text-center">{{ __('server.rating') }}</td>
        <td>{{ $playerInfo['overall']['rank'] }}</td>
        <td>{{ $playerInfo['circuit']['rank'] }}</td>
        <td>{{ $playerInfo['sprint']['rank'] }}</td>
        <td>{{ $playerInfo['drag']['rank'] }}</td>
        <td>{{ $playerInfo['drift']['rank'] }}</td>
    </tr>
    <tr class="text-right">
        <td class="text-center">{{ __('server.REP') }}</td>
        <td>{{ number_format($playerInfo['overall']['REP'], 0, '', ' ') }}</td>
        <td>{{ number_format($playerInfo['circuit']['REP'], 0, '', ' ') }}</td>
        <td>{{ number_format($playerInfo['sprint']['REP'], 0, '', ' ') }}</td>
        <td>{{ number_format($playerInfo['drag']['REP'], 0, '', ' ') }}</td>
        <td>{{ number_format($playerInfo['drift']['REP'], 0, '', ' ') }}</td>
    </tr>
    <tr class="text-right">
        <td class="text-center">{{ __('server.wins') }}</td>
        <td>{{ number_format($playerInfo['overall']['wins'], 0, '', ' ') }}</td>
        <td>{{ number_format($playerInfo['circuit']['wins'], 0, '', ' ') }}</td>
        <td>{{ number_format($playerInfo['sprint']['wins'], 0, '', ' ') }}</td>
        <td>{{ number_format($playerInfo['drag']['wins'], 0, '', ' ') }}</td>
        <td>{{ number_format($playerInfo['drift']['wins'], 0, '', ' ') }}</td>
    </tr>
    <tr class="text-right">
        <td class="text-center">{{ __('server.loses') }}</td>
        <td>{{ number_format($playerInfo['overall']['loses'], 0, '', ' ') }}</td>
        <td>{{ number_format($playerInfo['circuit']['loses'], 0, '', ' ') }}</td>
        <td>{{ number_format($playerInfo['sprint']['loses'], 0, '', ' ') }}</td>
        <td>{{ number_format($playerInfo['drag']['loses'], 0, '', ' ') }}</td>
        <td>{{ number_format($playerInfo['drift']['loses'], 0, '', ' ') }}</td>
    </tr>
    <tr class="text-right">
        <td class="text-center">{{ __('server.wins-percent') }}</td>
        <td>{{ $playerInfo['overall']['winsPercent'] }}</td>
        <td>{{ $playerInfo['circuit']['winsPercent'] }}</td>
        <td>{{ $playerInfo['sprint']['winsPercent'] }}</td>
        <td>{{ $playerInfo['drag']['winsPercent'] }}</td>
        <td>{{ $playerInfo['drift']['winsPercent'] }}</td>
    </tr>
    <tr class="text-right">
        <td class="text-center">{{ __('server.disconnections-percent') }}</td>
        <td>{{ $playerInfo['overall']['discPercent'] }}</td>
        <td>{{ $playerInfo['circuit']['discPercent'] }}</td>
        <td>{{ $playerInfo['sprint']['discPercent'] }}</td>
        <td>{{ $playerInfo['drag']['discPercent'] }}</td>
        <td>{{ $playerInfo['drift']['discPercent'] }}</td>
    </tr>
    </tbody>
</table>
