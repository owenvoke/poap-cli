<div class="mt-1 ml-1">
    <strong>{{ $token['event']['name'] }}</strong> (#{{ $token['tokenId'] }})

    <p>{{ $token['event']['description'] }}</p>

    <ul>
        <li>Minted at {{ \Carbon\Carbon::parse($token['created'])->format('H:i \\o\\n \\t\\h\\e jS \\of F Y') }}</li>
        <li>Stored on {{ $token['layer'] }}</li>
        <li>Supply <strong>{{ $token['supply']['order'] }} / {{ $token['supply']['total'] }}</strong></li>
    </ul>

    <p>
        View on POAP: <a href="https://app.poap.xyz/token/{{ $token['tokenId'] }}">https://app.poap.xyz/token/{{ $token['tokenId'] }}</a><br/>
        View owners POAPs: <a href="https://app.poap.xyz/scan/{{ $token['owner'] }}">https://app.poap.xyz/scan/{{ $token['owner'] }}</a><br/>
    </p>
</div>
