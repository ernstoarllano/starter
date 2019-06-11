@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert--error">
      {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
    </div>
  @endif
@endsection
