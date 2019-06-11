@if( get_field('popup_content', 'option') )
  <div class="modal js-popup">
    {!! get_field('popup_content', 'option') !!}
  </div>
@endif
