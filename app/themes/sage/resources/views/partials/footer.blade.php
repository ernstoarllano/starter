<footer class="footer">
  <div class="container">
    @if($copyright)
      {!! $copyright !!}
    @endif
    @if($social)
      <div class="social-links footer__social">
        @foreach($social as $key => $link)
          <a class="social-link" href="{{ $link['url'] }}" title="Check Us Out on {{ ucfirst($key) }}" aria-label="{{ ucfirst($key) }}">
            {!! $link['svg'] !!}
          </a>
        @endforeach
      </div>
    @endif
  </div>
</footer>
