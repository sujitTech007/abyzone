@include('include.header')

        <main class="fix">

            <section class="breadcrumb__area breadcrumb__bg position-relative"

                style="background-image: url('assets/images/bg/breadcrumb_bg.jpg');">



                <!-- Gradient Overlay -->

                <div class="breadcrumb-overlay position-absolute top-0 start-0 w-100 h-100"></div>



                <div class="container position-relative z-1">

                    <div class="row">

                        <div class="col-12">

                            <div class="breadcrumb__content">

                                <h1 class="title"> Service Details</h1>

                                <nav class="breadcrumb">

                                    <span property="itemListElement" typeof="ListItem"><a

                                            href="{{ route('home') }}">Home</a></span>

                                    <span class="breadcrumb-separator"><i class="flaticon-right-arrow"></i></span>

                                    <span property="itemListElement" typeof="ListItem">Service Details</span>

                                </nav>

                            </div>

                        </div>

                    </div>

                </div>

            </section>



            <section class="services__details-area section-py-130">

                <div class="container">

                    <div class="services__details-inner">

                        <div class="row d-flex justify-content-center">

                            <div class="col-md-12 col-lg-10 order-0 order-lg-2">

                                <div class="services__details-thumb"><img alt="img" loading="lazy" width="1000"

                                        height="560" decoding="async" data-nimg="1" style="color:transparent"

                                        src="{{ asset($service->image)}}">

                                </div>

                                <div class="services__details-content">

                                <h2>{{ $service->title}}</h2>

                                    <p>{{ $service->description }} </p>

                                

                                    

                                </div>

                            </div>

                            <!-- <div class="col-30">

                                <aside class="services__sidebar">

                                    <div class="services__widget">

                                        <div class="services__cat-list">

                                            <div class="warehouse-card">

                                                <ul class="list-wrap">

                                              

                                               

                                                  <li><a href="#"><span class="main-heading"><h5>Warehouse Requirements</h5></span></a></li>

                                              

                                                 

                                                  <li class="section-header section-size"><a href="javascript:void(0)">

                                                    <strong>Size Required</strong> <i class="flaticon-down-arrow"></i></a>

                                                  </li>

                                                  <li class="section-size-option"><a href="#"><span class="disc">500–1,000 sq. ft</span> <input type="checkbox"></a></li>

                                                  <li class="section-size-option"><a href="#"><span class="disc">1,000–5,000 sq. ft.</span> <input type="checkbox"></a></li>

                                                  <li class="section-size-option"><a href="#"><span class="disc">5,000–10,000 sq. ft.</span> <input type="checkbox"></a></li>

                                                  <li class="section-size-option"><a href="#"><span class="disc">More than 10,000 sq. ft.</span> <input type="checkbox"></a></li>

                                              

                                                 
                                                  <li class="section-header section-tat"><a href="javascript:void(0)">

                                                    <strong>Turn Around Time (TAT)</strong> <i class="flaticon-down-arrow"></i></a>

                                                  </li>

                                                  <li class="section-tat-option"><a href="#"><span class="disc">1–3 Days.</span> <input type="checkbox"></a></li>

                                                  <li class="section-tat-option"><a href="#"><span class="disc">1–2 Months</span> <input type="checkbox"></a></li>

                                                  <li class="section-tat-option"><a href="#"><span class="disc">5–8 Months</span> <input type="checkbox"></a></li>

                                                  <li class="section-tat-option"><a href="#"><span class="disc">1–2 Years</span> <input type="checkbox"></a></li>

                                              

                                                 

                                                  <li class="section-header section-labor"><a href="javascript:void(0)">

                                                    <strong>Labor Required</strong> <i class="flaticon-down-arrow"></i></a>

                                                  </li>

                                                  <li class="section-labor-option"><a href="#"><span class="disc">None (Self-Managed)</span> <input type="checkbox"></a></li>

                                                  <li class="section-labor-option"><a href="#"><span class="disc">Minimal Labor (1–3 workers)</span> <input type="checkbox"></a></li>

                                                  <li class="section-labor-option"><a href="#"><span class="disc">Moderate Labor (4–10 workers)</span> <input type="checkbox"></a></li>

                                                  <li class="section-labor-option"><a href="#"><span class="disc">High Labor (10+ workers)</span> <input type="checkbox"></a></li>

                                              

                                                </ul>

                                              </div>



                                              



                                              <style>

                                                                       </style>

                                        </div>

                                        

                                    </div>





                                </aside>

                            </div> -->

                        </div>

                    </div>

                </div>

            </section>

        </main>



     

          

      @include('include.footer')