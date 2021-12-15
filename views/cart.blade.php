@extends('layout')
  
@section('content')
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">PRODUK</th>
            <th style="width:10%">HARGA</th>
            <th style="width:8%">KUANTITAS</th>
            <th style="width:22%" class="text-center">SUBTOTAL</th>
            <th style="width:10%">HAPUS</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ $details['image'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
								<h9 class="nomargin">{{ $details['kode'] }}</h9>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">Rp. {{ number_format($details['price'], 0,',',',' ) }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center">Rp. {{ number_format($details['price'] * $details['quantity'], 0,',',',' ) }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
		    <td colspan="4" class="text-right">
				@if (! session()->has('coupon'))
					<a href="#" class="have-code">Gunakan Kode Diskon/Reward</a>
					<div class="have-code-container">
						<form action="{{ route('coupon.store') }}" method="POST">
							{{ csrf_field() }}
							<input type="text" name="coupon_code" id="coupon_code">
							<button type="submit" class="button btn-success">Terapkan</button>
						</form>
					
					</div> <!-- end have-code-container -->
				@endif				
			</td>
        </tr>			

        <tr>
		    <td colspan="4" class="text-right">
				<div class="cart-totals">
					<div class="cart-totals-right">
						<div>
							Subtotal <br>
							@if (session()->has('coupon'))
								Code ({{ session()->get('coupon')['name'] }})
								<form action="{{ route('coupon.destroy') }}" method="POST" style="display:block">
									{{ csrf_field() }}
									{{ method_field('delete') }}
									<button type="submit" style="font-size:14px;">Remove</button>
								</form>
								<hr>
								New Subtotal <br>
							@endif
							<span class="cart-totals-total">Total</span>
						</div>
						<div class="cart-totals-subtotal">

						</div>
					</div>			
				</div> 
			</td>
        </tr>
		
        <tr>
		    <td colspan="3" class="text-right"><h3><strong>Subtotal</strong></h3></td>
			<td colspan="1" class="text-right"><h3><strong>Rp. {{ number_format($total, 0,',',',' ) }}</strong></h3></td>
		</tr>
        <tr> 		
		    <td colspan="3" class="text-right"><h3><strong>Diskon</strong></h3></td>
		    <td colspan="1" class="text-right" data-td="jumDiskon" ><h3><strong></strong></h3></td>				
		</tr>
		<tr>
		    <td colspan="3" class="text-right"><h3><strong>Total</strong></h3></td>
		    <td colspan="1" class="text-right"><h3><strong>Rp. {{ number_format($total, 0,',',',' ) }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
            </td>
        </tr>

    </tfoot>
</table>

@endsection
  
@section('scripts')
<script type="text/javascript">


  
    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
  
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  
</script>
@endsection