@if( have_rows('hero_carousel') )
  <section class="hero hero--carousel has-carousel">
    <div class="hero__carousel js-carousel-hero">
      @while( have_rows('hero_carousel') ) @php the_row() @endphp
        @php
          if ( get_sub_field('hero_carousel_image') ) {
            $carousel_mobile = get_sub_field('hero_carousel_image')['sizes']['w960x800'];
            $carousel_desktop = get_sub_field('hero_carousel_image')['sizes']['w1920x800'];
          }
        @endphp
        <div class="hero__carousel__image js-background" data-mobile="{{ $carousel_mobile }}" data-desktop="{{ $carousel_desktop }}"></div>
      @endwhile
    </div>
  </section>
@endif
