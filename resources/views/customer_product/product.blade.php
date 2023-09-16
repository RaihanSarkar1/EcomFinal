@extends('layouts.master')
@section('page_css')
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
@endsection
@section('contents')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
               Product Details
            </div>
        </div>


        <div class="panel-body">
            @if ($errors->any())
            <h1>{{ $errors->first() }}</h1>
            @endif

            <div class="product">
                <div class="product-photo">
                    <img src="{{ asset('storage/'.$product->photo) }}" alt="" class="" height="400px">
                </div>

                <div class="product-details">
                    <div class="title">
                        <h1>{{$product->name}}</h1>
                        <span>Code: {{$product->code}}</span>
                    </div>

                    <div class="categories">
                        <span>Categories: </span>
                        @foreach ($product->categories as $category)
                            {{ $loop->first ? '': ', '}}
                            <a href="{{ url('/category/'.$category->id) }}"><span>{{ $category->name }}</span></a>            
                        @endforeach

                    </div>

                    <div class="price">
                        <h1>Price: {{$product->price}}</h1>
                    </div>

                    <div class="btn-cart">
                        <a href="{{ url('product/addToCart/'.$product->id) }}"><button type="button" class="btn btn-red btn-lg">Add to cart</button></a>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
@endsection
@section('page_js')

@endsection
