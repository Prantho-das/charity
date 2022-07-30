@include('frontend.partial.header')

<!-- Carousel
================================================== -->
<div id="homeCarousel" class="carousel slide carousel-home" data-ride="carousel">

    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#homeCarousel" data-slide-to="1"></li>
        <li data-target="#homeCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner" role="listbox">

        <div class="item active">

            <img src="{{ asset('assets') }}/images/slider/home-slider1.jpg" alt="">

            <div class="container">

                <div class="carousel-caption">

                    <h2 class="carousel-title bounceInDown animated slow">Because they need your help</h2>
                    <h4 class="carousel-subtitle bounceInUp animated slow ">Do not let them down</h4>
                    {{-- <a href="{{ route('home.donate') }}"
                        class="btn btn-lg btn-secondary hidden-xs bounceInUp animated slow" data-toggle="modal"
                        data-target="#donateModal">DONATE NOW</a> --}}
                    <a href="{{ route('home.donate') }}" class="btn btn-lg btn-secondary hidden-xs">DONATE NOW</a>

                </div> <!-- /.carousel-caption -->

            </div>

        </div> <!-- /.item -->


        <div class="item ">

            <img src="{{ asset('assets') }}/images/slider/home-slider2.jpg" alt="">

            <div class="container">

                <div class="carousel-caption">

                    <h2 class="carousel-title bounceInDown animated slow">Together we can improve their lives</h2>
                    <h4 class="carousel-subtitle bounceInUp animated slow"> So let's do it !</h4>
                    <a href="{{ route('home.donate') }}" class="btn btn-lg btn-secondary hidden-xs">DONATE NOW</a>

                </div> <!-- /.carousel-caption -->

            </div>

        </div> <!-- /.item -->




        <div class="item ">

            <img src="{{ asset('assets') }}/images/slider/home-slider3.jpg" alt="">

            <div class="container">

                <div class="carousel-caption">

                    <h2 class="carousel-title bounceInDown animated slow">A penny is a lot of money, if you have not got
                        a penny.</h2>
                    <h4 class="carousel-subtitle bounceInUp animated slow">You can make the diffrence !</h4>
                    {{-- <a href="{{ route('home.donate') }}"
                        class="btn btn-lg btn-secondary hidden-xs bounceInUp animated slow" data-toggle="modal"
                        data-target="#donateModal">DONATE NOW</a> --}}
                    <a href="{{ route('home.donate') }}" class="btn btn-lg btn-secondary hidden-xs">DONATE NOW</a>

                </div> <!-- /.carousel-caption -->

            </div>

        </div> <!-- /.item -->

    </div>

    <a class="left carousel-control" href="#homeCarousel" role="button" data-slide="prev">
        <span class="fa fa-angle-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#homeCarousel" role="button" data-slide="next">
        <span class="fa fa-angle-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div><!-- /.carousel -->
<div class="container">
    <div class="card m-5">
        <div class="card-header">
            <h4>Role You Want To Join?</h4>
        </div>
        <div class="card-body">
            <a href="{{route('home.get-role-access',['role'=>'Volunteer'])}}" class="btn btn-success-outline">Join As
                Volunteer</a>
            <a href="{{route('home.get-role-access',['role'=>'Donor'])}}" class="btn btn-success-outline">Join As
                Donor</a>
        </div>
    </div>
</div>





<footer class="main-footer">

    <div class="footer-top">

    </div>


    <div class="footer-main">
        <div class="container">

            <div class="row">
                <div class="col-md-4">

                    <div class="footer-col">

                        <h4 class="footer-title">About us <span class="title-under"></span></h4>

                        <div class="footer-content">

                            <p>
                                <strong>Sadaka</strong> ipsum dolor sit amet, consectetur adipiscing elit. Ut at eros
                                rutrum turpis viverra elementum semper quis ex. Donec lorem nulla, aliquam quis neque
                                vel, maximus lacinia urna.
                            </p>

                            <p>
                                ILorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at eros rutrum turpis
                                viverra elementum semper quis ex. Donec lorem nulla, aliquam quis neque vel, maximus
                                lacinia urna.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="footer-col">

                        <h4 class="footer-title">LAST TWEETS <span class="title-under"></span></h4>

                        <div class="footer-content">
                            <ul class="tweets list-unstyled">
                                <li class="tweet">

                                    20 Surprise Eggs, Kinder Surprise Cars 2 Thomas Spongebob Disney Pixar
                                    http://t.co/fTSazikPd4

                                </li>

                                <li class="tweet">

                                    20 Surprise Eggs, Kinder Surprise Cars 2 Thomas Spongebob Disney Pixar
                                    http://t.co/fTSazikPd4

                                </li>

                                <li class="tweet">

                                    20 Surprise Eggs, Kinder Surprise Cars 2 Thomas Spongebob Disney Pixar
                                    http://t.co/fTSazikPd4

                                </li>

                            </ul>
                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="footer-col">

                        <h4 class="footer-title">Contact us <span class="title-under"></span></h4>

                        <div class="footer-content">

                            <div class="footer-form">

                                <div class="footer-form">

                                    <form action="php/mail.php" class="ajax-form">

                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Name"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="E-mail"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <textarea name="message" class="form-control" placeholder="Message"
                                                required></textarea>
                                        </div>

                                        <div class="form-group alerts">

                                            <div class="alert alert-success" role="alert">

                                            </div>

                                            <div class="alert alert-danger" role="alert">

                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-submit pull-right">Send
                                                message</button>
                                        </div>

                                    </form>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>
                <div class="clearfix"></div>



            </div>


        </div>


    </div>

    <div class="footer-bottom">

        <div class="container text-right">
            Sadaka @ copyrights 2015 - by <a href="http://www.ouarmedia.com" target="_blank">Ouarmedia</a>
        </div>
    </div>

</footer> <!-- main-footer -->






<!--  Scripts
================================================== -->

<!-- jQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    window.jQuery || document.write('<script src="{{ asset('assets') }}/js/jquery-1.11.1.min.js"><\/script>')
</script>
@if (Session::has('accept-success'))
<script>
    alert('{{ Session::get('accept-success') }}');
</script>
@endif
<!-- Bootsrap javascript file -->
<script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>

<!-- owl carouseljavascript file -->
<script src="{{ asset('assets') }}/js/owl.carousel.min.js"></script>

<!-- Template main javascript -->
<script src="{{ asset('assets') }}/js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function() {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = '//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X');
    ga('send', 'pageview');
</script>

</body>

</html>
