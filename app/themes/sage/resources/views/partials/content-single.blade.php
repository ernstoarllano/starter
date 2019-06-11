<article @php post_class() @endphp>
  <header class="post__header">
    <h1 class="post__title">{!! get_the_title() !!}</h1>
    @include('partials/entry-meta')
  </header>
  <div class="post__content">
    @php the_content() @endphp
  </div>
</article>
