@if( get_field('hero_image') )
  @php
    // Set hero background
    $hero_mobile = get_field('hero_image')['sizes']['w960x800'];
    $hero_desktop = get_field('hero_image')['sizes']['w1920x800'];
  @endphp
  <section class="hero hero--static js-hero" data-mobile="{{ $hero_mobile }}" data-desktop="{{ $hero_desktop }}">
    @include('partials.hero-content')
  </section>
@endif
