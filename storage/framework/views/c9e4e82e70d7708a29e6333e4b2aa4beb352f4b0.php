
  
<?php $__env->startSection('content'); ?>
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
        <?php $total = 0 ?>
        <?php if(session('cart')): ?>
            <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $total += $details['price'] * $details['quantity'] ?>
                <tr data-id="<?php echo e($id); ?>">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="<?php echo e($details['image']); ?>" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin"><?php echo e($details['name']); ?></h4>
								<h9 class="nomargin"><?php echo e($details['kode']); ?></h9>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">Rp. <?php echo e(number_format($details['price'], 0,',',',' )); ?></td>
                    <td data-th="Quantity">
                        <input type="number" value="<?php echo e($details['quantity']); ?>" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center">Rp. <?php echo e(number_format($details['price'] * $details['quantity'], 0,',',',' )); ?></td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
		    <td colspan="4" class="text-right">
				<?php if(! session()->has('coupon')): ?>
					<a href="#" class="have-code">Gunakan Kode Diskon/Reward</a>
					<div class="have-code-container">
						<form action="<?php echo e(route('coupon.store')); ?>" method="POST">
							<?php echo e(csrf_field()); ?>

							<input type="text" name="coupon_code" id="coupon_code">
							<button type="submit" class="button btn-success">Terapkan</button>
						</form>
					
					</div> <!-- end have-code-container -->
				<?php endif; ?>				
			</td>
        </tr>			

        <tr>
		    <td colspan="4" class="text-right">
				<div class="cart-totals">
					<div class="cart-totals-right">
						<div>
							Subtotal <br>
							<?php if(session()->has('coupon')): ?>
								Code (<?php echo e(session()->get('coupon')['name']); ?>)
								<form action="<?php echo e(route('coupon.destroy')); ?>" method="POST" style="display:block">
									<?php echo e(csrf_field()); ?>

									<?php echo e(method_field('delete')); ?>

									<button type="submit" style="font-size:14px;">Remove</button>
								</form>
								<hr>
								New Subtotal <br>
							<?php endif; ?>
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
			<td colspan="1" class="text-right"><h3><strong>Rp. <?php echo e(number_format($total, 0,',',',' )); ?></strong></h3></td>
		</tr>
        <tr> 		
		    <td colspan="3" class="text-right"><h3><strong>Diskon</strong></h3></td>
		    <td colspan="1" class="text-right" data-td="jumDiskon" ><h3><strong></strong></h3></td>				
		</tr>
		<tr>
		    <td colspan="3" class="text-right"><h3><strong>Total</strong></h3></td>
		    <td colspan="1" class="text-right"><h3><strong>Rp. <?php echo e(number_format($total, 0,',',',' )); ?></strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="<?php echo e(url('/')); ?>" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
            </td>
        </tr>

    </tfoot>
</table>

<?php $__env->stopSection(); ?>
  
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">


  
    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '<?php echo e(route('update.cart')); ?>',
            method: "patch",
            data: {
                _token: '<?php echo e(csrf_token()); ?>', 
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
                url: '<?php echo e(route('remove.from.cart')); ?>',
                method: "DELETE",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shopping\resources\views/cart.blade.php ENDPATH**/ ?>