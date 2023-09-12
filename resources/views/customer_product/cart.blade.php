@extends('layouts.master')
@section('page_css')
    <link rel="stylesheet" href="{{ asset('backend/js/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('contents')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Cart
            </div>
        </div>
        <div class="panel-body">
            @if ($errors->any())
                <h1>{{ $errors->first() }}</h1>
            @endif
                <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    
                    @php $total = 0 @endphp
                    @if (session('cart'))
                        <tbody>
                        @foreach(session('cart') as $id => $products)
                            @php $total += $products['price'] * $products['quantity'] @endphp
                            <tr>
                                <td>{{ $id }}</td>
                                <td><div class="user-profile">
                                        <img src="{{ asset('storage/'.$products['image']) }}" alt="" class="img-inline" height="50px">
                                    </div></td>
                                    <td>{{ $products['name'] }}</td>
                                    <td>{{ $products['price'] }}</td>
                                    <td>{{ $products['quantity'] }}</td>
                                    <td>
                                        <a href="{{ url('remove/'.$id) }}"><button type="button" class="btn btn-danger">Remove</button></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    @endif
                    <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $total }}</td>
                        <td>
                        </td>
                    </tfoot>
                </table>

                @if ($errors->any())
                <h1>{{ $errors->first() }}</h1>
            @endif
            <form action="{{ url('cart') }}" role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="control-label">Billing Address</label>
                    
                    <input type="text" class="form-control" name="address" id="address" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                </div>
                
                <label class="control-label">Payment type: Cash on Delivery</label>
                <div class="form-group">

                    <button type="submit" id="submit_btn" class="btn btn-success custom_c">Place Order</button>
                </div>

            </form>
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
