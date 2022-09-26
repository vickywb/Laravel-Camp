<section class="pricing">
    <div class="container">
        <div class="row pb-50">
            <div class="col-lg-5 col-12 header-wrap copywriting">
                <p class="story">
                    GOOD INVESTMENT
                </p>
                <h2 class="primary-header text-white">
                    Start Your Journey
                </h2>
                <p class="support">
                    Learn how to speaking in public to demonstrate your <br> final project and receive the important feedbacks
                </p>
                <p class="mt-5">
                    <a href="#" class="btn btn-master btn-thirdty me-3">
                        View Syllabus
                    </a>
                </p>
            </div>
            <div class="col-sm-7 col-12">
                <div class="row">
                    @foreach ($camps as $camp)
                    <div class="col-md-4 col-8 mb-5">
                        <div class="table-pricing paket-biasa px-2">
                                <p class="story text-center text-success">
                                    {{ $camp->title }}
                                </p>
                            <h1 class="price text-center">
                               Rp.{{ number_format($camp->price, 0, ', ', '.') }}
                            </h1>
                            <div class="item-benefit-pricing mb-4">
                            @foreach ($camp->campBenefits as $benefit)
                                <img src="{{ asset('images/ic_check.svg') }}" alt="">
                                <p>
                                    {{ $benefit->name }}
                                </p>
                                <div class="clear"></div>
                                <div class="divider"></div>
                            @endforeach
                             
                            </div>
                            <p>
                                <a href="{{ route('checkout.create', $camp->slug) }}" class="btn btn-master btn-success w-100 mt-3">
                                    Start With This Plan
                                </a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row pb-70 mt-5">
            <div class="col-lg-12 col-12 text-center">
                <img src="{{ asset('images/brands.png') }}" height="30" alt="">
            </div>
        </div>
    </div>
</section>