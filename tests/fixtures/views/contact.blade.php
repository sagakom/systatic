@extends('layouts.app')

@section('content')
    <h1 class="mb-6">{{ $title }}</h1>
    {!! $content !!}

    <form action="#" method="get">
        <input name="email" type="email" placeholder="Email">
        <button type="submit">Send</button>
    </form>
@endsection