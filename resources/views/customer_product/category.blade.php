@extends('layouts.master')
@section('page_css')
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
@endsection
@section('contents')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                All Products of category: {{ $category->name }}
            </div>
        </div>


        <div class="panel-body">
            @if ($errors->any())
            <h1>{{ $errors->first() }}</h1>
            @endif
            
            
                <div class="category">
                    <h4>{{ $category->name }}</h4>
                    
                    <div class="box">
                        @foreach ($products as $product)
                        <a href="{{url('product/'.$product->id)}}">
                                <div class="product-card">
                                    <div class="card-img">
                                        <img src="{{ asset('storage/'.$product->photo) }}" alt="" class="" height="200px">
                                    </div>
                                    <div class="card-body">
                                      <h5 class="card-name">{{ $product->name }}</h5>
                                      <p class="card-code">{{ $product->code }}</p>
                                      <p class="card-price">Price: {{ $product->price }}</p>
                                      <div class="btn-cart"><a href="{{ url('product/addToCart/'.$product->id) }}"><button type="button" class="btn btn-red btn-block">Add to cart</button></a></div>
                                    </div>
                                </div>
                        </a>
                        @endforeach
                    </div>
            
                </div>

        </div>
    </div>
@endsection
@section('page_js')

@endsection
