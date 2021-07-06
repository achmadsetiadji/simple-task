<form id='create' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="box-body">
        <div id="status"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Product Name </label>
            <input type="text" class="form-control" id="name" name="name" value="" placeholder="" required>
            <span id="error_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Merchant Name </label>
            <select name="merchant_id" id="merchant_id" class="form-control" required>
                @foreach ($merchant as $m)
                    <option value="{{$m->id}}" id="{{$m->merchant_name}}">{{$m->merchant_name}}</option>
                @endforeach
            </select>
            <span id="error_merchant_id" class="has-error"></span>
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Price </label>
            <input type="text" class="form-control" id="price" name="price" value="" placeholder="" required>
            <span id="error_price" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Product Status </label>
            <select name="status" id="status" class="form-control" required>
                <option value="0" id="Tersedia" selected>Tersedia</option>
                <option value="1" id="Habis">Habis</option>
            </select>
            <span id="error_status" class="has-error"></span>
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
                name: {
                    required: true
                },
                merchant_id: {
                    required: true
                },
                price: {
                    required: true
                },
                status: {
                    required: true
                },
            },
            // Messages for form validation
            messages: {
                name: {
                    required: 'please enter product name'
                },
                merchant_id: {
                    required: 'please select merchant'
                },
                price: {
                    required: 'please enter price'
                },
                status: {
                    required: 'please select product status'
                },
            },
            submitHandler: function (form) {

                var myData = new FormData($("#create")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url: 'products',
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
                        $('#modalProduct').modal('hide'); // hide bootstrap modal
                    }
                });
            }
            // <- end 'submitHandler' callback
        }); // <- end '.validate()'

    });

</script>
