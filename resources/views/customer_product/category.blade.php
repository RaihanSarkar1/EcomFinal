@extends('layouts.master')
@section('page_css')
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
@endsection
@section('contents')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                All Products of {{ $category->name }}
            </div>
        </div>


        <div class="panel-body">
            @if ($errors->any())
            <h1>{{ $errors->first() }}</h1>
            @endif
            
            
                <div class="category">
                    <h4>{{ $category->name }}</h4>
                    
                    @foreach ($products as $product)
                    <a href="{{url('product/'.$product->id)}}">
                            <div class="card">
                                <div class="card-img">
                                    <img src="{{ asset('storage/'.$product->photo) }}" alt="" class="" height="100px">
                                </div>
                                <div class="card-body">
                                  <h5 class="card-name">{{ $product->name }}</h5>
                                  <p class="card-code">{{ $product->code }}</p>
                                  <p class="card-price">Price: {{ $product->price }}</p>
                                  <a href="{{ url('product/addToCart/'.$product->id) }}"><button type="button" class="btn btn-red">Add to cart</button></a>
                                </div>
                            </div>
                    </a>
                    @endforeach
            
                </div>

        </div>
    </div>
@endsection
@section('page_js')

@endsection
