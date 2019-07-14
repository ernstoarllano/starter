@php
  // Set background image
  if ( has_post_thumbnail($post->ID) ) {
    $bg_mobile = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'w960x800')[0];
    $bg_desktop = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'w1920x800')[0];
  } else {
    $bg_mobile = App\asset_path('images/placeholder.svg');
    $bg_desktop = App\asset_path('images/placeholder.svg');
  }
@endphp
<article @php post_class() @endphp>
  <div class="post__bg js-background" data-mobile="{{ $bg_mobile }}" data-desktop="{{ $bg_desktop }}">
    <a class="post__link" href="{{ get_permalink($post->ID) }}" title="{{ get_the_title($post->ID) }}"></a>
  </div>
  <div class="post__body">
    <header class="post__header">
      <h2 class="post__title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
      @include('partials/entry-meta')
    </header>
    <div class="post__summary">
      @php the_excerpt() @endphp
    </div>
  </div>
</article>
