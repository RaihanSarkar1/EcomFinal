@extends('layouts.master')
@section('contents')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Add Product
            </div>
        </div>
        <div class="panel-body">
            @if ($errors->any())
                <h1>{{ $errors->first() }}</h1>
            @endif
            <form action="{{ url('add_product') }}" role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="control-label">Code</label>

                    <input type="text" class="form-control" value="{{ old('code') }}" name="code" id="code" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                </div>
                <div class="form-group">
                    <label class="control-label">Name</label>

                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                </div>
                <div class="form-group">
                    <label class="control-label">Price</label>

                    <input type="text" class="form-control" value="{{ old('price') }}" name="price" id="price" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                </div>
                <div class="form-group">
                    <label for="category">Choose a category:</label>

                    <select name="category[]" id="category" class="form-control" multiple data-validate="required">
                        @foreach($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label class="control-label">Image</label>

                    <input type="file" class="form-control" name="image" id="image" />
                </div>

                <div class="form-group">
                    <button type="submit" id="submit_btn" class="btn btn-success custom_c">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('page_js')
    <script src="{{ asset('backend/js/jquery-validate/jquery.validate.min.js') }}"></script>
@endsection
