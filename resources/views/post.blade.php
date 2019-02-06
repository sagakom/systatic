@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1>@title()</h1>
    <h3>Published on @matter(date) by @matter(author).</h3>
    @content()
</div>
@endsection