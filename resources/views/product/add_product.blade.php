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
            <!-- <div class="form-group">
                <label for="category">Choose a category:</label>

                <select name="category[]" id="category" class="form-control" multiple data-validate="required">
                    @foreach($categories as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>

            </div> -->

            <div class="form-group">
                <label class="control-label">Choose categories</label>


                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        $("#s2example-2").select2({
                            placeholder: 'Choose category',
                            allowClear: true
                        }).on('select2-open', function() {
                            // Adding Custom Scrollbar
                            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                        });

                    });
                </script>


                <select name="category[]" class="form-control select2-offscreen" id="s2example-2" multiple="true" tabindex="-1">
                    <option></option>
                    <optgroup label="Categories">
                        @foreach($categories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach

                    </optgroup>
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

<!-- Imported styles on this page -->
<link rel="stylesheet" href="{{ asset('backend/js/daterangepicker/daterangepicker-bs3.css') }}">
<link rel="stylesheet" href="{{ asset('backend/js/select2/select2.css') }}">
<link rel="stylesheet" href="{{ asset('backend/js/select2/select2-bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('backend/js/multiselect/css/multi-select.css') }}">

<!-- Bottom Scripts -->
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/TweenMax.min.js') }}"></script>
<script src="{{ asset('backend/js/resizeable.js') }}"></script>
<script src="{{ asset('backend/js/joinable.js') }}"></script>
<script src="{{ asset('backend/js/xenon-api.js') }}"></script>
<script src="{{ asset('backend/js/xenon-toggles.js') }}"></script>
<script src="{{ asset('backend/js/moment.min.js') }}"></script>


<!-- Imported scripts on this page -->
<script src="{{ asset('backend/js/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('backend/js/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('backend/js/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('backend/js/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('backend/js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
<script src="{{ asset('backend/js/tagsinput/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('backend/js/typeahead.bundle.js') }}"></script>
<script src="{{ asset('backend/js/handlebars.min.js') }}"></script>
<script src="{{ asset('backend/js/multiselect/js/jquery.multi-select.js') }}"></script>


<!-- JavaScripts initializations and stuff -->
<script src="{{ asset('backend/js/xenon-custom.js') }}"></script>
@endsection