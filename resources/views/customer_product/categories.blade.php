@extends('layouts.master')
@section('page_css')
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
@endsection
@section('contents')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                All Categories
            </div>
        </div>


        <div class="panel-body">
            @if ($errors->any())
            <h1>{{ $errors->first() }}</h1>
            @endif
            
            @foreach ($categories as $category)
                <div class="category">
                    <a href="{{ url('/category/'.$category->id) }}"><h4>{{ $category->name }}</h4></a>            
                </div>
                @endforeach
        </div>
    </div>
@endsection
@section('page_js')

@endsection
