<footer class="footer">
    <div class="footer-area">
        <div class="container">
            <div class="row section_gap">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget tp_widgets">
                        <h4 class="footer_title large_title">Misi Kita</h4>
                        <p class="text-dark">
                            LS Skincare, akan terus berkomitmen dan berinovasi memberikan pelayanan dan kualitas yang terbaik kepada semua customer setia LS Skincare.
                        </p>
                        <p class="text-dark">
                            Karena sebagai brand skincare yang sangat belia LS Skincare harus bisa memberikan manfaat dan membantu menyelesaikan keresahan semua perempuan di Indonesia.
                        </p>
                    </div>
                </div>
                <div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget tp_widgets">
                        <h4 class="footer_title">Quick Links</h4>
                        <ul class="list">
                            <li><a class="text-dark" href="{{ route('guest.index') }}">Home</a></li>
                            <li><a class="text-dark" href="{{ route('guest.shop') }}">Shop</a></li>
                            <li><a class="text-dark" href="{{ route('guest.contact') }}">Contact</a></li>
                            <li><a class="text-dark" href="{{ route('guest.list_cart') }}">Cart</a></li>
                            <li><a class="text-dark" href="{{ route('customer.logout') }}">Login</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget instafeed">
                        <h4 class="footer_title">Gallery</h4>
                        <ul class="list instafeed d-flex flex-wrap">
                            @foreach ($product as $row)
                                <li><img src="{{ asset('storage/products/' . $row->image) }}" class="img-fluid" style="height: 70px;" alt=" {{$row->name}} "></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget tp_widgets">
                        <h4 class="footer_title">Contact Us</h4>
                        <div class="ml-40">
                            <strong class="sm-head text-dark">
                                <span class="fa fa-location-arrow"></span>
                                PT LAROSSA SUKSESTAMA
                            </strong>
                            <p class="text-dark">Blok Mekarmulya, Rt/Rw 01/01, Ds. Tenjolayar, Kec. Cigasong, Kab. Majalengka.</p>

                            <strong class="sm-head text-dark">
                                <span class="fa fa-phone"></span>
                                Nomor Telepon
                            </strong>
                            <p class="text-dark">
                                085289654321
                            </p>

                            <strong class="sm-head text-dark">
                                <span class="fa fa-envelope"></span>
                                Email
                            </strong>
                            <p class="text-dark">
                                lsastarisukses@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row d-flex">
                <p class="col-lg-12 footer-text text-center">
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> PT LAROSSA SUKSESTAMA | MAJALENGKA
                </p>
            </div>
        </div>
    </div>
</footer>
