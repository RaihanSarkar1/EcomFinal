@extends('layouts.master')
@section('contents')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Change Password
            </div>
        </div>
        <div class="panel-body">
            <form action="{{ url('change_password') }}" role="form" id="form1" method="post" class="validate">
                @csrf
                <div class="form-group">
                    <label class="control-label">Current Password</label>

                    <input type="password" class="form-control" name="current_password" id="current_password" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                </div>

                <div class="form-group">
                    <label class="control-label">New Password</label>

                    <input type="password" class="form-control" name="new_password" id="new_password" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                </div>

                <div class="form-group">
                    <label class="control-label">Confirm Password</label>

                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                </div>

                <div class="form-group">
                    <button type="button" id="submit_btn" onclick="btn_clicked()" class="btn btn-success custom_c">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('page_js')
    <script src="{{ asset('backend/js/jquery-validate/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            //alert('ready');
        });

        $('#submit_btn').on('click', function () {
            let current_password = $('#current_password').val();
            let new_password = $('#new_password').val();
            let confirm_password = $('#confirm_password').val();
            if (current_password && new_password && confirm_password) {
                if (new_password === confirm_password) {
                    $('#form1').submit();
                } else {
                    alert('New password and confirm password must match!');
                }
            } else {
                alert('Please check all input fields');
            }
        });

    </script>
@endsection
