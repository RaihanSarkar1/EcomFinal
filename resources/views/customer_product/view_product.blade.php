@extends('layouts.master')
@section('page_css')
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
@endsection
@section('contents')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                All Products sorted by categories
            </div>
        </div>


        <div class="panel-body">
            @if ($errors->any())
            <h1>{{ $errors->first() }}</h1>
            @endif
            
            @foreach ($categories as $category)
                <div class="category">
                    <h4>{{ $category }}</h4>
                    
                    <div class="box">
                        
                        @foreach ($products as $product)
                            @if ($product->category_name == $category)
                                <a href="{{url('product/'.$product->id)}}">
                                    <div class="product-card">
                                        <div class="card-img">
                                            <img src="{{ asset('storage/'.$product->photo) }}" alt="Product Image" class="" height="200px">
                                        </div>
                                        <div class="card-body">
                                        <h1 class="card-name">{{ $product->name }}</h1>
                                        <p class="card-code">Code: {{ $product->code }}</p>
                                        <p class="card-price">Price: {{ $product->price }}</p>
                                        <div class="btn-cart">
                                            <a href="{{ url('product/addToCart/'.$product->id) }}"><button type="button" class="btn btn-red btn-block">Add to cart</button></a>
                                        </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
            
                </div>
                @endforeach
        </div>
    </div>
@endsection
@section('page_js')

@endsection
