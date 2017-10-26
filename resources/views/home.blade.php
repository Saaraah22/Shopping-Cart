@extends('layouts.app')

<style>
    .product_view .modal-dialog{max-width: 800px; width: 100%;}
    .pre-cost{text-decoration: line-through; color: #a5a5a5;}
    .space-padding{padding: 20px 0;}   
</style>

@section('content')
<div class="container">
    <div class="row">
        <?php $x=1; ?>
        @foreach ($products as $product)
        <div class="col-md-5">
          <div class="thumbnail">
            <img src="{{ $product -> path }}" alt="" class="img-responsive">
            <div class="caption">
              <h4 class="pull-right">{{ $product -> price }}.00 <i class="fa fa-rub" aria-hidden="true"></i> </h4>
              <h3><a href="#">{{ $product -> name }}</a></h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris neque quam, placerat facilisis lacinia eget, feugiat at dui. Aliquam blandit id quam id condimentum. Pellentesque gravida purus in dictum hendrerit. Fusce eget fermentum odio. Sed et vestibulum purus. Vivamus egestas odio mi, quis faucibus diam suscipit id. Cras aliquam, eros eget sollicitudin sodales, est mauris elementum dolor, quis pharetra elit augue eget mauris. Etiam porttitor tellus sed nibh semper, sit amet elementum felis commodo. Fusce vitae egestas metus. Sed id nulla libero. Morbi varius hendrerit lorem, eu commodo ipsum posuere sed.</p>
            </div>
            <div class="space-padding"></div>
            <div class="btn-ground text-center">
                <form action="/home/add" method="POST" accept-charset="utf-8" style="display: inline;">
                    {{ csrf_field() }}
                    <input type="hidden" name="product_id" value="{{ $product -> id }}">
                    <input type="hidden" name="name" value="{{ $product -> name }}">
                    <input type="hidden" name="path" value="{{ $product -> path }}">
                    <input type="hidden" name="category_id" value="{{ $product -> category_id }}">
                    <input type="hidden" name="quantity" value="{{ $product -> quantity }}">
                    <input type="hidden" name="amount" value="{{ $product -> price }}">
                    <input type="hidden" name="barcode" value="{{ $product -> barcode }}">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add To Cart</button>
                </form>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#product_view{{ $x }}"><i class="fa fa-search"></i> Quick View</button>
            </div>
            <div class="space-padding"></div>
          </div>
        </div>
        <?php $x++; ?>
        @endforeach
    </div>
</div>
<?php $y=1; ?>
@foreach ($products as $product)
<div class="modal fade product_view" id="product_view{{ $y }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-remove fa-lg"></span></a>
                <h3 class="modal-title">{{ $product -> name }}</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 product_img" style="margin: 25px 0;">
                        <img src="{{ $product -> path }}" class="img-responsive" width="100%">
                    </div>
                    <div class="col-md-6 product_content">
                        <h4>Product Id: <span>{{ $product -> barcode }}</span></h4>
                        <div class="rating">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            (15 reviews)
                        </div><br>
                        <p> {{ $product -> description }} </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris neque quam, placerat facilisis lacinia eget, feugiat at dui. Aliquam blandit id quam id condimentum. Pellentesque gravida purus in dictum hendrerit. Fusce eget fermentum odio. Sed et vestibulum purus. Vivamus egestas odio mi, quis faucibus diam suscipit id. Cras aliquam, eros eget sollicitudin sodales, est mauris elementum dolor, quis pharetra elit augue eget mauris. Etiam porttitor tellus sed nibh semper, sit amet elementum felis commodo. Fusce vitae egestas metus. Sed id nulla libero. Morbi varius hendrerit lorem, eu commodo ipsum posuere sed.</p>
                        <h3 class="cost">{{ $product -> price }}.00 <span class="fa fa-rub"></span>&nbsp;&nbsp;<small class="pre-cost">60.00 <span class="fa fa-rub"></span></small></h3>
                        <div class="space-padding"></div>
                        <div class="btn-ground" style="text-align: center">
                            <form action="/home/add" method="POST" accept-charset="utf-8" style="display: inline;">
                                {{ csrf_field() }}
                                <input type="hidden" name="product_id" value="{{ $product -> id }}">
                                <input type="hidden" name="name" value="{{ $product -> name }}">
                                <input type="hidden" name="path" value="{{ $product -> path }}">
                                <input type="hidden" name="category_id" value="{{ $product -> category_id }}">
                                <input type="hidden" name="quantity" value="{{ $product -> quantity }}">
                                <input type="hidden" name="amount" value="{{ $product -> price }}">
                                <input type="hidden" name="barcode" value="{{ $product -> barcode }}">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add To Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $y++; ?>
@endforeach
@endsection
