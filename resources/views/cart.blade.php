@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('css/cart-style.css') }}">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/cartjs.js') }}"></script>

@section('content')

<div class="container">
	<section id="cart">
		<?php $final_amount = 0; ?>
		@foreach ($products as $product)
		<article class="product">
			<header>
				<a href="#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();" class="remove">
					<img src="{{ $product -> path }}" alt="">

					<h3>Remove product</h3>
				</a>
				<form action="/cart/delete" method="post" id="delete-form" accept-charset="utf-8" hidden>
					{{ csrf_field() }}
					<input type="hidden" name="product_id" value="{{ $product -> product_id }}">
					<input type="hidden" name="cart_id" value="{{ $product -> cart_id }}">
				</form>
			</header>

			<div class="content">

				<h1>{{ $product -> name }}</h1>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vehicula placerat ante, eget interdum turpis auctor vitae. Nulla eu ex tortor. Curabitur eu mauris urna. In at felis nibh. Mauris odio eros, blandit a leo in, lacinia ullamcorper magna. Sed placerat maximus dui, non cursus tortor fringilla non.
				<div style="top: 0px" class="type small">{{ $product -> barcode }}</div>
			</div>
			
			<footer class="content">
				<a href="#" onclick="event.preventDefault(); document.getElementById('update-form').submit();" class="type small update">
					UPDATE
				</a>
				<form action="/cart/update" method="POST" id="update-form" accept-charset="utf-8" hidden>
					{{ csrf_field() }}
					<input type="hidden" name="quantity" id="quantity">
					<input type="hidden" name="product_id" value="{{ $product -> product_id }}">
				</form>
				<span class="qt-minus" onclick="minusQuantity()">-</span>
				<span class="qt" id="quantity_value">{{ $product -> quantity }}</span>
				<span class="qt-plus" onclick="addQuantity()">+</span>

				<script type="text/javascript">
					function addQuantity() {
						var value = parseInt($("#quantity_value").text())+1;
						var lower = $("#quantity").val(value);
					}

					function minusQuantity() {
						var value = parseInt($("#quantity_value").text())-1;
						var lower = $("#quantity").val(value);
					}
				</script>

				<h2 class="full-price">
					<i class="fa fa-rub" aria-hidden="true"></i>
					<?php
						$price = $product -> amount;
						$quantity = $product -> quantity;
						$each = $price * 0.040;

						$subtotal = $price * $quantity;
						$final_amount += $subtotal;
						echo $subtotal;
					?>
				</h2>
				<h2 class="price">
					{{ $product -> amount }} <i class="fa fa-rub" aria-hidden="true"></i> 
				</h2>
			</footer>
		</article>
		@endforeach
	</section>
</div>
<footer id="site-footer">
	<div class="container clearfix">
		<div class="left">
			<h2 class="subtotal">Total: <span>{{ $final_amount }}</span>.00 <i class="fa fa-rub" aria-hidden="true"></i></h2>
		</div>
		<div class="right">
			<h1 class="total">Total:
				<span>
					<?php
						$for_checkout = $final_amount;
					?>
					{{ $for_checkout }}
				</span>
				<i class="fa fa-rub" aria-hidden="true"></i>
			</h1>
			<!-- PAYPAL PAYMENT -->
                <?php  $count = 0; ?>
                <form style="text-align: center;">
                    <input type="hidden" name="cmd" value="_cart">
                    <input type="hidden" name="upload" value="1">
                    <!-- The value property holds the business email -->
                    <input type="hidden" name="business" value="gadget-store@gmail.com">
                    
                    <!-- PRODUCT INFO -->
                    @foreach ($products as $product)
                        <?php $count ++; ?>
                        <input type="hidden" name="item_name_{{ $count }}" value="{{ $product -> name }}">
                        <input type="hidden" name="item_number_{{ $count }}" value="{{ $product -> barcode }}">
                        <input type="hidden" name="amount_{{ $count }}" value="{{ $product -> amount }}">
                        <input type="hidden" name="quantity_{{ $count }}" value="{{ $product -> quantity }}">

                        <input type="hidden" name="return" id="cancel_return" value="http://localhost:8000">
                        <input type="hidden" name="cancel_return" id="cancel_return" value="http://localhost:8000/cart/{{ Auth::user()->name.Auth::user()->user_id }}">
                    @endforeach
                    <br>
		</div>
	</div>
</footer>

@endsection