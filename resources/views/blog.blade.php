@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1>@title()</h1>
    @content()
    <ul>
        <li>
            <a class="text-black no-underline hover:underline" href="/awesome-first-blog-post.html">
                Awesome first blog post
            </a>
        </li>
    </ul>
</div>
@endsection