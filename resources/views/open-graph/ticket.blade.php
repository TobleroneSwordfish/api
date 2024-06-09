<x-open-graph-layout>
  <div class="header">
    <span>
      {{ $data->gameRound->server->name ?? 'Goonstation' }}
    </span>
    <span>
      Round #{{ number_format($data->gameRound->id) }}
    </span>
  </div>
  <div class="title">
    <strong>{{ $data->reason }}</strong>
  </div>
  <div class="content-wrap">
    <div class="content">
      <div class="details">
        <div>
          <div>
            {{ $data->target }}
            <span class="dimmed">ticketed by</span>
            {{ $data->issuer }}
          </div>
        </div>
      </div>
      <div class="footer">
        <div>
          {!! Storage::get('icons/calendar-outline.svg') !!}
          {{ $data->created_at->format('D, M j, Y g:i A e') }}
        </div>
      </div>
    </div>
    <div class="logo">
      <img src="@base64img('storage/img/logo.png')" width="200" height="200" />
    </div>
  </div>
</x-open-graph-layout>
