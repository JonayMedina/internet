@extends('layouts.app-page')

@section('content')
    <!-- slider Area Start-->
    <div class="slider-area">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-6 col-md-8 col-sm-10">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInUp" data-delay=".4s">No sufras retardo, obtén super Internet.</h1>
                                <P data-animation="fadeInUp" data-delay=".6s" >Adquiere alguno de nuestros servicios.</P>
                                <!-- Hero-btn -->
                                <div class="hero__btn">
                                <a href="#services" class="btn hero-btn mb-10"  data-animation="fadeInUp" data-delay=".8s">Ver Servicios</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-6 col-md-8 col-sm-10">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInUp" data-delay=".4s">Mas Tecnologia, Mayor Veocidad y Servicio Premium.</h1>
                                <P data-animation="fadeInUp" data-delay=".6s" >Conexión por Fibra o Radio enlace.</P>
                                <!-- Hero-btn -->
                                <div class="hero__btn">
                                    <a href="#services" class="btn hero-btn mb-10"  data-animation="fadeInUp" data-delay=".8s">Ver Servicios</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <!--? About 1 Start-->
    <section class="about-low-area section-padding2" id="about">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-5 col-lg-6 col-md-9">
                    <!-- about-img -->
                    <div class="about-img">
                        <img src="./img/gallery/about1.png" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-10">
                    <div class="about-caption mb-50">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-35">
                            <span></span>
                            <h2>Necesitas un internet que cubra tus necesidades?</h2>
                            <p> Contrata nuestros servicios y contaras con el mejor proveedor de internet en tu zona.</p>
                        </div>
                        <p>DISFRUTA DE LA MEJOR VELOCIDAD<span class="red"> SIN DEMORAS!</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About  End-->
     <!--? service Area Start -->
     <section class="service-area pb-bottom pb-top speed-pa" id="services">
        <div class="container">
            <div class="row justify-content-between pb-bottom">
                <div class="col-lg-4 col-md-9">
                    <!-- Section Tittle -->
                    <div class="section-tittle section-tittle2 mb-50">
                        <h2 class="mb-35">Intenet por Fibra Optica.</h2>
                        <p>Ofrece acceso dedicado a internet a través de fibra óptica.</p>
                        <a href="#pricing" class="btn  mt-30">ver paquete</a>
                    </div>
                </div>
                <div class="col-lg-8">
                   <div class="row">
                       <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-services mb-30 text-center">
                                <i class="flaticon-null"></i>
                                <p>Servicio de fibra óptica dedicado</p>
                            </div>
                       </div>
                       <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-services mb-30 text-center">
                                <i class="flaticon-null-1"></i>
                                <p>Ancho de banda desde 20Mb/s hasta 100Mb/s</p>
                            </div>
                       </div>
                       <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-services mb-30 text-center">
                                <i class="flaticon-null-2"></i>
                                <p>Mayor seguridad y confidencialidad</p>
                            </div>
                       </div>
                       <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-services mb-30 text-center">
                                <i class="flaticon-null-3"></i>
                                <p>Mayor estabilidad de conexión-conectividad</p>
                            </div>
                       </div>
                   </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-4 col-md-9">
                <!-- Section Tittle -->
                    <div class="section-tittle section-tittle2 mb-50">
                        <h2 class="mb-35">Intenet de Radio enlace.</h2>
                        <p>Acceso a internet mediante la instalacion de una Antena.</p>
                        <a href="#pricing" class="btn  mt-30">Ver paquete</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-services mb-30 text-center">
                                <i class="flaticon-null"></i>
                                <p>Servicio dedicado Simétrico o asimémetrico.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-services mb-30 text-center">
                                <i class="flaticon-null-1"></i>
                                <p>Velocidad de navegación como nunca antes has experimentado.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-services mb-30 text-center">
                                <i class="flaticon-null-2"></i>
                                <p>Disfrute de películas, juegos y descarga de contenido.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service Area End -->
    <!--? Pricing Card Start -->
    <section class="pricing-card-area section-padding3" id="pricing">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10 col-sm-10">
                    <div class="section-tittle text-center mb-100">
                        {{-- <p>Tenemos el plan de conexión que se adapta a tu modalidad de navegación.</p> --}}
                        <h2>Tenemos el mejor servicio que se adapta a tu modalidad de navegación.</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-10">
                    <div class="single-card text-center mb-30">
                        <div class="card-top">
                            <p>Instalación Fibra</p>
                            <h4>Desde 4 MB hasta 1 GB</h4>
                        </div>
                        <div class="card-mid">
                            <h4>Precios  $<span>/ mes</span></h4>
                        </div>
                        <div class="card-bottom">
                            <ul>
                                <li>Comprar Kit de instalación</li>
                                <li>Contrato por 12 meses</li>
                                <li>Sin Cargos por Activación</li>
                                <li>Seleccione desde 4mb a 100mb</li>
                            </ul>
                            <a href="#contact" class="borders-btn">Pedir Paquete</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-10">
                    <div class="single-card text-center mb-30">
                        <div class="card-top">
                            <p>Instalacion Inalámbrica</p>
                            <h4>Desde 4 MB hasta 100 MB</h4>
                        </div>
                        <div class="card-mid">
                            <h4>Precios  $<span>/ mes</span></h4>
                        </div>
                        <div class="card-bottom">
                            <ul>
                                <li>Comprar Kit de instalación</li>
                                <li>Contrato por 12 meses</li>
                                <li>Sin Cargos por Activación</li>
                                <li>Seleccione desde 4mb/2mb hasta 100mb/100mb</li>
                            </ul>
                            </ul>
                            <a href="#contact" class="borders-btn">Pedir Paquete</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-10">
                    <div class="single-card text-center mb-30">
                        <div class="card-top">
                            <p>Full  Package</p>
                            <h4>TV, Broadband And Phone</h4>
                        </div>
                        <div class="card-mid">
                            <h4>$29.00 <span>/ mo</span></h4>
                        </div>
                        <div class="card-bottom">
                            <ul>
                                <li>Line Rental Included</li>
                                <li>12 Month Contract</li>
                                <li>No Activation Charges</li>
                                <li>Up to 12Mbps average Speed</li>
                                <li>Enjoy family on weekends</li>
                            </ul>
                            <a href="#" class="borders-btn">View Packages</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Pricing Card End -->
    <!-- Latest Offers Start -->
    {{-- <div class="latest-wrapper">
        <div class="container">
            <div class="latest-area latest-height  section-bg2" data-background="./img/gallery/section_bg01.png">
                <div class="row  align-items-center justify-content-between">
                    <div class="col-xl-5 col-lg-7">
                        <div class="latest-caption">
                            <h2>Check our unbelievable super  fast Broadband availability in your area.</h2>
                        </div>
                    </div>
                     <div class="col-xl-5 col-lg-5 col-md-10 ">
                        <div class="latest-subscribe">
                            <form action="#">
                                <input type="email" placeholder="Enter Zipcode">
                                <button>Check Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Latest Offers End -->
    <!--? About-2 Area Start -->
    <section class="about-area2 testimonial-area section-padding3 fix">
        <div class="container">
            <div class="row align-items-center">
                <div class=" col-lg-6 col-md-9 col-sm-9">
                    <div class="about-caption">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-55">
                            <h2>Lo que nuestros clientes comentan sobre nuestros servicios!</h2>
                        </div>
                        <!-- Testimonial Start -->
                        <div class="h1-testimonial-active">
                            <!-- Single Testimonial -->
                            <div class="single-testimonial">
                                <div class="testimonial-caption">
                                    <p>Muy buyen soporte cuando hay fallas.</p>
                                    <div class="rattiong-caption">
                                        <span>Jose Alvarez<span>Programador</span> </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Testimonial -->
                            <div class="single-testimonial">
                                <div class="testimonial-caption">
                                    <p>Brook presents your services with flexible, convenient and cdpose layouts. You can select your favorite layouts & elements for cular ts with unlimited ustomization possibilities. Pixel-perfect replica;ition of thei designers ijtls intended csents your se.</p>
                                    <div class="rattiong-caption">
                                        <span>Jhon Smith<span>Gym Trainer</span> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial End -->
                    </div>
                </div>
                <div class="col-lg-5 col-md-11 col-sm-11">
                    <!-- about-img -->
                    <div class="about-img2">
                        <img src="./img/gallery/about2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="fibra-section image responsive"></section>
    <!-- About-2 Area End -->
    <!--? Blog Area Start -->
    <section class="home-blog-area section-padding3">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10 col-sm-10">
                    <div class="section-tittle text-center mb-90">
                        <span>Our pricing plan for you</span>
                        <h2>No hidden charges! choose your plan wisely.</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="./img/gallery/home-blog1.png" alt="">
                            </div>
                            <div class="blog-cap">
                                <h3><a href="blog_details.html">The purpose of lolght invera jgrlie.</a></h3>
                                <p>January 22, 2020</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="./img/gallery/home-blog2.png" alt="">
                            </div>
                            <div class="blog-cap">
                                <h3><a href="blog_details.html">The purpose of lolght invera jgrlie.</a></h3>
                                <p>January 22, 2020</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="./img/gallery/home-blog3.png" alt="">
                            </div>
                            <div class="blog-cap">
                                <h3><a href="blog_details.html">The purpose of lolght invera jgrlie.</a></h3>
                                <p>January 22, 2020</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Area End -->
    {{-- Contact section --}}
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Solicita nuestros servicios</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="" method="post" id="contactForm" novalidate="novalidate">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Escriba su mensaje de solicitud'" placeholder=" Escriba su mensaje de solicitud"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese su nombre completo'" placeholder="Ingrese su nombre completo">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese su Email'" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-8 col-lg-6">
                                <div class="form-group">

                                    <select class="form-control" name="subject" id="subject">
                                        <option value="">Elija una Opción</option>
                                        <option value="información">Solicitar información</option>
                                        <option value="fibra">Adquirir Servicio fibra</option>
                                        <option value="inalambrica">Adquirir Servicio Inalámbrico</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Solicitar</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>Buttonwood, California.</h3>
                            <p>Rosemead, Ecuador.</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>+1 253 565 2365</h3>
                            <p>Lunes a Viernes 9:00 am hasta 6:00 pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>contacto@internet.com.ec</h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
