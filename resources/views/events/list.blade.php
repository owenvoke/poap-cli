<div class="mt-1 ml-1">
    <ul>
        @foreach($events as $event)
            <li><strong>{{ preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]|\xED[\xA0-\xBF].|\xEF\xBF[\xBE\xBF]/', '\xEF\xBF\xBD', $event['name']) }}</strong> (#{{ $event['id'] }})</li>
        @endforeach
    </ul>
</div>
