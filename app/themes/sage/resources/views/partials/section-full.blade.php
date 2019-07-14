@php
  // Define background images
  $bg_mobile = get_sub_field('section_builder_background')['sizes']['w960x800'];
  $bg_desktop = get_sub_field('section_builder_background')['sizes']['w1920x800'];

  // Background State
  $background_state = !empty(get_sub_field('section_builder_background')) ? 'js-background' : null;

  // Background Color State
  $background_color_state = get_sub_field('section_builder_background_color');

  // Flex State
  $flex_state = get_sub_field('section_builder_flex') === 'yes' ? 'container--flex' : 'container--normal';

  // Text State
  $text_state = get_sub_field('section_builder_text_center') === 'yes' ? 'text-center' : null;

  // Action State
  $action_state = get_sub_field('section_builder_action') === 'yes' ? 'has-action' : null;

  // Content
  $content = get_sub_field('section_builder_content');
@endphp
<section class="section section--{{ $i }} section--{{ $section_state }} {{ $background_state }} bg-{{ $background_color_state }} {{ $action_state }}" data-mobile="{{ $bg_mobile }}" data-desktop="{{ $bg_desktop }}">
  @if( $content )
    <div class="container {{ $flex_state }} {{ $text_state }}">
      {!! $content !!}
    </div>
  @endif
</section>
