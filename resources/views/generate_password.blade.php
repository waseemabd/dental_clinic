@extends('layouts.auth_template')

@push('custom_css')

@endpush



@section('content')

    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                <form method="POST" class="hash-form">
                    @csrf
                    <div class="form-group">
                        <label for="passVal">Enter Password</label>
                        <input type="text" class="form-control" id="passVal">
                    </div>
                    <div class="form-group">
                        <label for="result">Result</label>
                        <textarea id="result" class="form-control"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-primary" id="convert">Convert</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom_scripts')
<script>
    $(document).ready(function() {

        $("#convert").on('click', function (e) {

            e.preventDefault();

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });
            $.ajax({
                type: 'POST',
                url: "/generatePassword",
                data: {
                    key: $('#passVal').val(),

                },
                success: function (response) {
                    if (response.status === 1) {

                        $('#result').val(response.hash)
                        console.log(response.hash)

                    } else {
                        alert("something went wrong");
                    }


                },
                error: function (jqXHR) {

                    alert(jQuery.parseJSON(jqXHR.responseText).message);

                }
            });
        });

    });


</script>

@endpush
