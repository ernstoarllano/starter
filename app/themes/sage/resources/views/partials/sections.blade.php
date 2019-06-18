@if( class_exists('ACF') )
  @php
    $i = 1;
  @endphp

  @if(have_rows('section_builder'))
    @while(have_rows('section_builder')) @php the_row() @endphp
      @php
        // Section Type State
        // Defines if it's a normal full width section or split section
        $section_state = get_sub_field('section_builder_type');
      @endphp
      @if(get_sub_field('section_builder_type') === 'split')
        @include('partials.section-split', [$i, $section_state])
      @elseif(get_sub_field('section_builder_type') === 'full')
        @include('partials.section-full', [$i, $section_state])
      @endif
      @php $i++ @endphp
    @endwhile
  @endif
@endif
