@extends('layouts.template')

@section('title')
    Cart
@endsection

@section('css')
@endsection

@section('content')
<main class="site-main">
<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Shopping Cart</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->

<!--================Cart Area =================-->
<section class="cart_area">
  <div class="container">
      <div class="cart_inner">
          <div class="table-responsive">
              <table class="table">
                <form action="{{ route('guest.update_cart') }}" method="post">
                    @csrf
                  <thead>
                      <tr>
                          <th scope="col">Product</th>
                          <th scope="col">Price</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Total</th>
                      </tr>
                  </thead>
                  <tbody>
                    @forelse ($carts as $row)
                    <tr>
                        <td>
                            <div class="media">
                                <div class="d-flex">
                                    <img class="img-fluid img-thumbnail" width="100px" height="100px" src="{{ asset('storage/products/' . $row['product_image']) }}" alt="{{ $row['product_name'] }}">
                                </div>
                                <div class="media-body">
                                    <p>{{ $row['product_name'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h5>Rp.{{ number_format($row['product_price']) }}</h5>
                        </td>
                        <td>
                            <div class="product_count">
                              <input type="text" name="qty[]" id="sst{{ $row['product_id'] }}" maxlength="12" value="{{ $row['qty'] }}" title="Quantity:" class="input-text qty">
                              <input type="hidden" name="product_id[]" value="{{ $row['product_id'] }}" class="form-control">
                              <button onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                               class="increase items-count" type="button">
                                  <i class="lnr lnr-chevron-up"></i>
                              </button>
                              <button onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                               class="reduced items-count" type="button">
                                  <i class="lnr lnr-chevron-down"></i>
                              </button>
                            </div>
                        </td>
                        <td>
                            <h5>Rp.{{ number_format($row['product_price'] * $row['qty']) }}</h5>
                        </td>
                    </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <h3 style="color: #ffb19d">Keranjang masih kosong</h3>
                            </td>
                        </tr>
                    @endforelse
                      <tr class="bottom_button">
                            <td>
                                <button class="button" type="submit">Update Cart</button>
                            </td>
                            <td>
                            </td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>Rp {{ number_format($subtotal) }}</h5>
                            </td>
                      </tr>
                      <tr class="out_button_area">
                          <td class="d-none-l">
                          </td>
                          <td class="">
                          </td>
                          <td>
                          </td>
                          <td>
                              <div class="checkout_btn_inner d-flex align-items-center">
                                  <a class="gray_btn" href="{{ route('guest.shop') }}">Continue Shopping</a>
                                  <a class="primary-btn ml-2" href="{{ route('guest.checkout') }}">Proceed to checkout</a>
                              </div>
                          </td>
                      </tr>
                  </tbody>
                </form>
              </table>
          </div>
      </div>
  </div>
</section>
<!--================End Cart Area =================-->
</main>
@endsection

@section('js')
@endsection
