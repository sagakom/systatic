@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1>{{ $title }}</h1>
    {!! $content !!}
</div>
@endsection