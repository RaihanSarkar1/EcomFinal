@extends('layouts.master')
@section('contents')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Edit Category
            </div>
        </div>
        <div class="panel-body">
            @if ($errors->any())
                <h1>{{ $errors->first() }}</h1>
            @endif
            <form action="{{ url('category/edit/'.$item->id) }}" role="form" id="form1" method="post" class="validate">
                @csrf
                <div class="form-group">
                    <label class="control-label">Name</label>

                    <input type="text" class="form-control" value="{{$item->name}}" name="name" id="name" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
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
