<div class="mt-1 ml-1">
    <strong>{{ $event['name'] }}</strong> (#{{ $event['id'] }})

    <p>{{ $event['description'] }}</p>

    <ul>
        <li>Starts at {{ \Carbon\Carbon::parse($event['start_date'])->format('H:i \\o\\n \\t\\h\\e jS \\of F Y') }}</li>
        <li>Ends at {{ \Carbon\Carbon::parse($event['end_date'])->format('H:i \\o\\n \\t\\h\\e jS \\of F Y') }}</li>
        <li>Code redemptions expire at <strong>{{ \Carbon\Carbon::parse($event['expiry_date'])->format('H:i \\o\\n \\t\\h\\e jS \\of F Y') }}</strong></li>
    </ul>

    <p>View on POAP Gallery: <a href="https://poap.gallery/event/{{ $event['id'] }}">https://poap.gallery/event/{{ $event['id'] }}</a></p>
</div>
