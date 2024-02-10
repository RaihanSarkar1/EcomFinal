@extends('layouts.master')
@section('page_css')
    <link rel="stylesheet" href="{{ asset('backend/js/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
@endsection
@section('contents')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h4>
                    <i class="fa-shopping-cart"></i> Order Details
                    <a href="{{url('manage_orders')}}" class="btn-danger btn-sm float-end">Back</a>

                </h4>
            </div>
        </div>
        <div class="container">
            <div class="row" style="display:flex;" >
                <div style="width:40%; float:left">
                    <h5>Order details</h5>
                    <hr>
                    <h6>Order Id: {{ $order->id }} </h6>
                    <h6>Ordered date: {{ $order->created_at }}</h6>
                    <h6>Payment mode: {{ $order->payment}}</h6>
                    <h6 class="border">Order status: <span class="text-uppercase">{{$order->status}}</span> </h6>
                </div>
                <div style="width:40%">
                    <h5>User details</h5>
                    <hr>
                    <h6>User ID: {{ $user->id}} </h6>
                    <h6>User Name: {{ $user->name }}</h6>
                    <h6>User Email: {{ $user->email }}</h6>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <br>
            <h4>Order Items</h4>
            <br>
            @if ($errors->any())
                <h1>{{ $errors->first() }}</h1>
            @endif

                <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    </thead>


                        <tbody>
                            @php
                                $total_price = 0;
                            @endphp
                            @foreach($products as $product)
                                <tr>
                                    <td><div class="">
                                        <img src="{{ asset('storage/'.$product->photo) }}" alt="" class="" height="50px">
                                    </div></td>
                                    <td>
                                        {{$product->name}} 
                                    </td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->pivot->quantity}}</td>
                                    <td>{{$product->pivot->quantity * $product->price}}</td>
                                    @php 
                                        $total_price += $product->pivot->quantity * $product->price;
                                    @endphp
                                </tr>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <td colspan="4">Total Amount</td>
                                        <td colspan="1">{{ $total_price }}</td>
                                    </tr>

                                </tfoot>
                        </tbody>
                    </table>
                    <div class="button-list">
                        <a href="{{ url('order/approve/'.$order->id) }}"><button type="button" class="btn btn-blue btn-block" style="display:block">Approve</button></a>
                        <a href="{{ url('order/deliver/'.$order->id) }}"><button type="button" class="btn btn-success btn-block " style="display:block">Delivered</button></a>
                        <a href="{{ url('order/cancel/'.$order->id) }}"><button type="button" class="btn btn-danger btn-block " style="display:block">Cancel</button></a>
                    </div>
                </div>
    </div>
@endsection
@section('page_js')
    <script src="{{ asset('backend/js/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('backend/js/datatables/yadcf/jquery.dataTables.yadcf.js') }}"></script>
    <script src="{{ asset('backend/js/datatables/tabletools/dataTables.tableTools.min.js') }}"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $("#example-1").dataTable({
                aLengthMenu: [
                    [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                ]
            });
        });
    </script>
@endsection
