@if( class_exists('ACF') )
  @if( get_field('hero_type') === 'image' )
    @include('partials.hero-image')
  @elseif( get_field('hero_type') === 'carousel' )
    @include('partials.hero-carousel')
  @elseif( get_field('hero_type') === 'video' )
    @include('partials.hero-video')
  @endif
@endif
