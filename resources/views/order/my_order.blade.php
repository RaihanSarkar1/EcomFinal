@extends('layouts.master')
@section('page_css')
    <link rel="stylesheet" href="{{ asset('backend/js/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('contents')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                My Orders
            </div>
        </div>
        <div class="panel-body">
            @if ($errors->any())
                <h1>{{ $errors->first() }}</h1>
            @endif
                <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Address</th>
                        <th>Payment</th>
                        <th>Products</th>
                        <th>Status</th>
                    </tr>
                    </thead>


                    @if ($orders)
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->payment }}</td>
                                <td>
                                    <ul>
                                        @foreach($order->products as $product)
                                            <li>
                                                {{ $product->name }}
                                            </li>
                                        @endforeach
                                    </ul>    
                                </td>
                                <td>{{ $order->status }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    @endif
                </table>
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
