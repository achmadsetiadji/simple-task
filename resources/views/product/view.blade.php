<div class="row">
    <div class="col-md-12 col-sm-12 table-responsive">
        <table id="view_details" class="table table-bordered table-hover">
            <tbody>
            <tr>
                <td class="subject"> Product Name</td>
                <td> :</td>
                <td> {{ $product->name }} </td>
            </tr>
            <tr>
                <td class="subject"> Merchant</td>
                <td> :</td>
                <td> {{ $product->merchants->merchant_name }} </td>
            </tr>
            <tr>
                <td class="subject"> Price</td>
                <td> :</td>
                <td> {{ $product->price }} </td>
            </tr>
            <tr>
                <td class="subject"> Product Status</td>
                <td> :</td>
                <td>
                    @if ($product->status === 0)
                        Tersedia
                    @else
                        Habis
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
