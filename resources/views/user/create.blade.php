@extends('layouts.master')
@section('contents')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Add User
            </div>
        </div>
        <div class="panel-body">
            @if ($errors->any())
                <h1>{{ $errors->first() }}</h1>
            @endif
            <form action="{{ url('add_user') }}" role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="control-label">Name</label>

                    <input type="text" class="form-control" name="name" id="name" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                </div>

                <div class="form-group">
                    <label class="control-label">Email</label>

                    <input type="email" class="form-control" name="email" id="email" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                    <span id="email_err"></span>
                </div>

                <div class="form-group">
                    <label class="control-label">Password</label>

                    <input type="password" class="form-control" name="password" id="password" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
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
    <script type="text/javascript">
        $( document ).ready(function() {
            //alert('ready');
        });

        // $('#submit_btn').on('click', function () {
        //     let current_password = $('#current_password').val();
        //     let new_password = $('#new_password').val();
        //     let confirm_password = $('#confirm_password').val();
        //     if (current_password && new_password && confirm_password) {
        //         if (new_password === confirm_password) {
        //             $('#form1').submit();
        //         } else {
        //             alert('New password and confirm password must match!');
        //         }
        //     } else {
        //         alert('Please check all input fields');
        //     }
        // });

        $('#submit_btn').on('click', function () {
            const email = $('#email').val();
          //  alert(email);
            $.ajax({
                type:'POST',
                url:'{{ url('check_email') }}',
                data: {
                    '_token':  '{{ csrf_token() }}',
                    'email': email
                },
                success:function(data){
                    console.log(data);
                    if (data === true) {
                        $('#form1').submit();
                    } else {
                       let span = document.getElementById('email_err');
                       span.innerHTML = 'Email Has Taken';
                       span.style.color = 'red';
                    }
                }
            });
        })

    </script>
@endsection
