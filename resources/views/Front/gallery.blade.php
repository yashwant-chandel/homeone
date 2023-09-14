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
                    <li class="nav-item" id="{{ $gall->slug }}-gallery"><a class="nav-link @if($first == true) active @endif" data-toggle="tab" href="#{{ $gall->slug }}"
                            role="tab">{{ $gall->gallery_title }}</a></li>
                            <?php $first = false; ?>
                    @endforeach
                </ul>
                <div class="tab-content">
                    <?php $first = true; ?>
                @foreach($gallery as $g)
                    <div class="tab-pane @if($first == true) active @endif" id="{{ $g->slug ?? '' }}" role="tabpanel">
                    <?php $first = false; ?>    
                    <div class="images-box images-box{{ $g->slug ?? '' }}">
                            <h5>{{ $g->gallery_title ?? '' }}</h5>
                            <div class="row">
                                <?php $num = 0; ?>
                                @foreach($g->images as $image)
                                <?php $num++; ?>
                                <div class="col-md-4 @if($num > 9) d-none {{ $g->slug ?? '' }} @endif" >
                                    <div class="tab-img"><img src="{{ asset($image->image_path) }}" alt=""></div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @if(count($g->images) > 10)
                        <div class="more-ct">
                          <a href="" class="cta view-more" slug="{{ $g->slug ?? '' }}">View More</a>
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
                <p>Leave us your info and we will get back to you </p><a href="{{ url('contact') }}" class="cta">Contact Us</a>
            </div>
        </div>
    </section>
   
    <script>
        $(document).ready(function(){
           let status = true;
            $('.view-more').click(function(e){
                e.preventDefault();
                slug = $(this).attr('slug');
                if(status === true){
                $('.'+slug).removeClass('d-none');
                $(this).html('View Less');
                status = false;
                }else{
                $('.'+slug).addClass('d-none');
                status = true;
                $(this).html('View More');
                }
                var targetDiv = $(".images-box"+slug);
            $('html, body').animate({
                scrollTop: targetDiv.offset().top
            }, 1000);
                
   
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            var hash = window.location.href.split('#').pop();;
            console.log(hash);
            if(hash){
                var targetOffset = $("#"+hash+"-gallery").offset().top; 
                $('html, body').animate({ scrollTop: targetOffset }, 1000); 

                $('#'+hash+"-gallery a").click();
            }
            // if (window.location.hash === "#holiday") {
            //     var targetElement = $('#holiday');

            //     if (targetElement.length) {
            //         $('html, body').animate({
            //             scrollTop: targetElement.offset().top
            //         }, 1000); 
            //     }
            // }
        });
</script>

@endsection