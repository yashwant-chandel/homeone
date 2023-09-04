@extends('front_layout/index')
@section('layout')
<section class="banner-sec" style="background-image: url({{ asset('front/img/gall-img.png') }});">
        <div class="container">
            <div class="banner-text">
                <h1>gallery</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="gallery-sec p-130">
        <div class="container">
            <div class="gallery-head">
                <h3>Gallery</h3>
                <p>Whether you need to flaunt on game day, commend special times of year, or give an enlightening feel,
                    you'll have the option to alter your lights anyway you like, at whatever point you like.</p>
            </div>
            <div class="tablist_wrapp">
                <ul class="nav nav-tabs" role="tablist">
                   <?php $first = true; ?>
                    @foreach($gallery as $gall)
                    <li class="nav-item"><a class="nav-link @if($first == true) active @endif" data-toggle="tab" href="#{{ $gall->slug }}"
                            role="tab">{{ $gall->gallery_title }}</a></li>
                            <?php $first = false; ?>
                    @endforeach
                </ul>
                <div class="tab-content">
                    <?php $first = true; ?>
                @foreach($gallery as $g)
                    <div class="tab-pane @if($first == true) active @endif" id="{{ $g->slug ?? '' }}" role="tabpanel">
                    <?php $first = false; ?>    
                    <div class="images-box">
                            <h5>{{ $g->gallery_title ?? '' }}</h5>
                            <div class="row">
                                <?php $num = 0; ?>
                                @foreach($g->images as $image)
                                <?php $num++; ?>
                                <div class="col-md-4 @if($num > 9) d-none @endif {{ $g->slug ?? '' }}" >
                                    <div class="tab-img"><img src="{{ asset($image->image_path) }}" alt=""></div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @if(count($g->images) > 10)
                        <div class="more-ct">
                          <a href="" class="cta" slug="{{ $g->slug ?? '' }}">View More</a>
                        </div>
                        @endif
                    </div>
                   
                    @endforeach
                </div>
            </div>
           
        </div>
    </section>
    <section class="gallery-detail p-130">
        <div class="container">
            <div class="contact-head text-center">
                <h3>Let's Chat Details And <span class="blue"> Information</span></h3>
                <p>Leave us your info and we will get back to you </p><a href="#" class="cta">Contact Us</a>
            </div>
        </div>
    </section>
   
    <script>
        $(document).ready(function(){
            $('.cta').click(function(e){
                e.preventDefault();
                slug = $(this).attr('slug');
                $('.'+slug).removeClass('d-none')
            })
        })
    </script>
@endsection