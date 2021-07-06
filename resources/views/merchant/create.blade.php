<form id='create' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="box-body">
        <div id="status"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Country Code </label>
            <input type="text" class="form-control" id="country_code" name="country_code" value="" placeholder=""
                required>
            <span id="error_country_code" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Merchant Name </label>
            <input type="text" class="form-control" id="merchant_name" name="merchant_name" value="" placeholder=""
                required>
            <span id="error_merchant_name" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-12">
            <input type="submit" id="submit" name="submit" value="Save" class="btn btn-primary">
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- /.box-body -->
</form>


<script>
    $(document).ready(function () {
        $('#loader').hide();
        $('#create').validate({ // <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                country_code: {
                    required: true
                },
                merchant_name: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                country_code: {
                    required: 'please enter country code'
                },
                merchant_name: {
                    required: 'please enter merchant name'
                }
            },
            submitHandler: function (form) {

                var myData = new FormData($("#create")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url: 'merchants',
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#loader').show();
                        $("#submit").prop('disabled', true); // disable button
                    },
                    success: function (data) {

                        $("#status").html(data.html);
                        reload_table();
                        $('#loader').hide();
                        $("#submit").prop('disabled', false); // disable button
                        $("html, body").animate({
                            scrollTop: 0
                        }, "slow");
                        $('#modalMerchant').modal('hide'); // hide bootstrap modal
                    }
                });
            }
            // <- end 'submitHandler' callback
        }); // <- end '.validate()'

    });

</script>
