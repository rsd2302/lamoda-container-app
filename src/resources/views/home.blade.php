@extends('layout')

@section('content')
    <div class="banner-text-w3ls">
        <div class="container">
            <div class="mx-auto text-center">
                <h1>Решение головоломки Lamoda quest</h1>
                <a class="btn btn-primary mt-lg-5 mt-3 agile-link-bnr" href="/info" role="button">Подробнее</a>
            </div>
        </div>
    </div>
     <section class="wedo" id="contact">
            <h3 class="w3_head mb-5">Contact </h3>
           <p class="main_p mb-5  text-center mx-auto">Nulla pellentesque mi non laoreet eleifend. Integer porttitor mollisar curae suspendisse mauris posuere accumsan massa posuere lacus convallis tellus interdum. Amet nullam fringilla nibh nulla convallis ut venenatis purus sit arcu sociis.</p>
           <div class="contact_grid_right mt-5 mx-auto text-center">
                <form action="#" method="post">
                    <div class="row contact_top">
                        <div class="col-sm-6">
                            <input type="text" name="Name" placeholder="Name" required="">
                        </div>
                        <div class="col-sm-6">
                            <input type="email" name="Email" placeholder="Email" required="">
                        </div>
                    </div>  
                        <input type="text" name="Name" placeholder="Name" required="">
                        <textarea name="Message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
                        <input type="submit" value="Send Message">
                </form>
            </div>
            <div class="cpy-right text-center">
            <div class="follow">
                <ul class="social_section_1info">
                    <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                    <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                    <li><a href="#"><span class="fa fa-dribbble"></span></a></li>
                    
                    <li><a href="#"><span class="fa fa-vimeo"></span></a></li>
                    <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
                </ul>
            </div>
                <p>© 2018 Polaroid. All rights reserved | Design by
                    <a href="http://w3layouts.com"> W3layouts.</a>
                </p>
            </div>
    </section>
@endsection