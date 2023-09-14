@extends('front_layout/index')
@section('layout')
@if(isset($homemeta->background_image))
<section class="banner-sec" style="background-image: url({{ asset('siteIMG/'.$homemeta->background_image) }});">
@else
    <section class="banner-sec" style="background-image: url({{ asset('front/img/banner-img.png') }});">
    @endif
        <div class="container">
            <div class="banner-text">
                @if(isset($homemeta->title))
                <h1 class="home-title"><?php echo $homemeta->title; ?></h1>
                @else
                <h1>LOVE WHERE <br>
                    YOU LIVE</h1>
                @endif
            </div>
        </div>
    </section>
    
    <section class="about-sec p-130 pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="about-text">
                        <span>About Us</span>
                        @if(isset($homemeta->about_us_title))
                        <h2 class="main-heading"><?php echo $homemeta->about_us_title; ?></h2>
                        @else
                        <h2>What <span class="blue">We</span> <span class="blue">Do</span></h2>
                        @endif
                        @if(isset($homemeta->about_us_subtitle))
                        <h4><?php echo $homemeta->about_us_subtitle; ?></h4>
                        @else
                        <h4>We custom manufacture the track for every job. This ensures the best colours and depths for
                            each
                            system.</h4>
                        @endif 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="about-img">
                        @if(isset($homemeta->about_us_image))
                        
                        <img src="{{ asset('siteIMG/'.$homemeta->about_us_image) }}" alt="">
                        @else
                        <img src="img/about-img.png" alt="">
                        @endif 
                    </div>
                </div>
            </div>
            @if(isset($homemeta->about_us_text))
            <div class="mt-5">
                <?php echo $homemeta->about_us_text; ?>
            </div>
            @else
            <p class="mt-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                leap
                into electronic typesetting, remaining essentially unchanged. </p>
            @endif
        </div>
    </section>
    <div class="divider">
        <div class="container">
            <span></span>
        </div>
    </div>
    <section class="filter-sec">
        <div class="container">
            <div class="filter-head text-center">
                <h3>See the Difference</h3>
                <p>Showcase your home and see the difference on any occasion with Home One Smart Lighting.</p>
            </div>
            <div class="filter-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach($galleries as $key => $gallery)
                        <li class="nav-item @if($key === 0) active @endif" id="list-{{ $gallery->slug ?? '' }}">
                            <a class="nav-link @if($key === 0) show active @endif" id="home-tab" data-toggle="tab" href="#gallery-{{ $gallery->slug ?? '' }}" role="tab"
                                aria-controls="home" aria-selected="true">{{ $gallery->gallery_title ?? ''}}</a>
                        </li>
                    @endforeach
                  
                </ul>
                <div class="tab-content" id="myTabContent">
                @foreach($galleries as $key => $gallery)
     
                    <div class="tab-pane fade  @if($key === 0) show active @endif" id="gallery-{{ $gallery->slug ?? '' }}" role="tabpanel" aria-labelledby="{{ $gallery->slug ?? '' }}-tab">
                        <div class="image-comparison" data-component="image-comparison-slider">
                            <div class="image-comparison__slider-wrapper">
                                <label for="image-comparison-range" class="image-comparison__label">Move image
                                    comparison slider</label>
                                <input type="range" min="0" max="100" value="50" class="image-comparison__range"
                                    id="image-compare-range" data-image-comparison-range="">

                                <div class="image-comparison__image-wrapper  image-comparison__image-wrapper--overlay"
                                    data-image-comparison-overlay="">
                                    <figure class="image-comparison__figure image-comparison__figure--overlay">
                                        <picture class="image-comparison__picture">
                                            <img src="{{ asset('galleryIMG/'.$gallery->featured_image) }}" alt=""
                                                class="image-comparison__image">
                                        </picture>
                                    </figure>
                                </div>

                                <div class="image-comparison__slider" data-image-comparison-slider="">
                                    <span class="image-comparison__thumb" data-image-comparison-thumb="">
                                        <svg class="image-comparison__thumb-icon" xmlns="http://www.w3.org/2000/svg"
                                            width="18" height="10" viewBox="0 0 18 10" fill="currentColor">
                                            <path class="image-comparison__thumb-icon--left"
                                                d="M12.121 4.703V.488c0-.302.384-.454.609-.24l4.42 4.214a.33.33 0 0 1 0 .481l-4.42 4.214c-.225.215-.609.063-.609-.24V4.703z">
                                            </path>
                                            <path class="image-comparison__thumb-icon--right"
                                                d="M5.879 4.703V.488c0-.302-.384-.454-.609-.24L.85 4.462a.33.33 0 0 0 0 .481l4.42 4.214c.225.215.609.063.609-.24V4.703z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>

                                <div class="image-comparison__image-wrapper">
                                    <figure class="image-comparison__figure">
                                        <picture class="image-comparison__picture">
                                            <img src="{{ asset('galleryIMG/'.$gallery->smart_lighting) }}" alt=""
                                                class="image-comparison__image">
                                        </picture>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="statement-sec p-130 pb-0">
            <div class="container">
                <div class="statement-head light">
                    <h3>Stand Out and Make a Statement</h3>
                    <p>Feature your home with HomeOne, the top decision for long-lasting home lighting. We've made a
                        brand that puts your experience first and where everything about painstakingly thought of.</p>
                </div>
            </div>
            <div class="container-fluid">
                <div class="statement-img">
                    <img src="img/statement-img.png" alt="">
                </div>
            </div>
        </div>
    </section>


    <section class="create-sec p-130 pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="create-slider">
                        @if(isset($homemeta->middle_section_image))
                        <?php $imagess = json_decode($homemeta->middle_section_image); ?>
                        @endif
                        @if(isset($imagess[0]))
                        @foreach($imagess as $img)
                        <div class="create-img">
                            <img src="{{ asset('siteIMG/'.$img) }}" alt="">
                        </div>
                        @endforeach
                        @else
                        <div class="create-img">
                            <img src="img/Screen-01.png" alt="">
                        </div>
                        <div class="create-img">
                            <img src="img/Screen-02.png" alt="">
                        </div>
                        <div class="create-img">
                            <img src="img/Screen-03.png" alt="">
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="create-text">
                        @if(isset($homemeta->middle_section_title))
                            <h3 class="main-heading"> <?php echo $homemeta->middle_section_title ?></h3>
                        @else
                            <h3>If You Can Think It, You Can <span class="blue">Create It</span></h3>
                        @endif
                        @if(isset($homemeta->middle_section_text))
                        <?php echo $homemeta->middle_section_text; ?>
                        
                        @else
                        <p>Fully customize your home from the app to whatever fits the occasion</p>
                        <div class="create-list">
                            <ul>
                                <li><a href="#">Lorem Ipsum has been the industry's</a></li>
                                <li><a href="#">The point of using Lorem Ipsum</a></li>
                                <li><a href="#">Any desktop publishing packages</a></li>
                                <li><a href="#">Various versions have evolved over</a></li>
                                <li><a href="#">There are many variations of passages</a></li>
                            </ul>
                        </div>
                        @endif
                        <a href="#" class="cta">Purchase What You Love!</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="divider">
        <div class="container">
            <span></span>
        </div>
    </div>

    <section class="light-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-9">
                    <div class="light-head">
                        @if(isset($homemeta->last_section_title))
                        <h3 class="main-heading"><?php echo $homemeta->last_section_title; ?></h3>
                        @else
                        <h3>Alter your lights to fit <span class="blue">the event</span> </h3>
                        @endif
                        <p>Whether you need to flaunt on game day, commend special times of year, or give an
                            enlightening feel, you'll have the option to alter your lights anyway you like, at whatever
                            point you like.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="#" class="cta">Explore The Gallery</a>
                </div>
            </div>
            <div class="light-slider">
                @foreach($galleries as $key => $gallery)
                    <div class="light-list">
                        <div class="light-box light">
                            <div class="light-img">
                                <img src="{{ asset('galleryIMG/'.$gallery->featured_image) }}" alt="">
                            </div>
                            <div class="light-text">
                                <h4>{{ $gallery->gallery_title ?? '' }}</h4>
                            </div>
                            <div class="light-btn">
                                <a href="{{ url('gallery')}}#{{$gallery->slug ?? '' }}" data-id="list-{{ $gallery->slug ?? '' }}" class="scroll-to-filter">View {{ $gallery->gallery_title ?? '' }} lighting photos<i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- <div class="light-list">
                    <div class="light-box light">
                        <div class="light-img">
                            <img src="{{ asset('front/img/light-2.png') }}" alt="">

                        </div>
                        <div class="light-text">
                            <h4>Security Lighting</h4>
                        </div>
                        <div class="light-btn">
                            <a href="#">View accent lighting photos<i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="light-list">
                    <div class="light-box light">
                        <div class="light-img">
                            <img src="{{ asset('front/img/light-3.png') }}" alt="">
                        </div>
                        <div class="light-text">
                            <h4>Security Lighting</h4>
                        </div>
                        <div class="light-btn">
                            <a href="#">View accent lighting photos<i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="light-list">
                    <div class="light-box light">
                        <div class="light-img">
                            <img src="{{ asset('front/img/light-1.png') }}" alt="">
                        </div>
                        <div class="light-text">
                            <h4>Holiday Lighting</h4>
                        </div>
                        <div class="light-btn">
                            <a href="#">View accent lighting photos<i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="light-list">
                    <div class="light-box light">
                        <div class="light-img">
                            <img src="{{ asset('front/img/light-3.png') }}" alt="">

                        </div>
                        <div class="light-text">
                            <h4>Game Day Lighting</h4>
                        </div>
                        <div class="light-btn">
                            <a href="#">View accent lighting photos<i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

   
    <script>
        $(document).ready(function() {
            $('.home-title').each(function() {
                var text = $(this).text();
                var halfLength = Math.ceil(text.length / 2); 
                var firstHalf = text.slice(0, halfLength);
                var secondHalf = text.slice(halfLength);
                
                $(this).html(firstHalf + '<br>' + secondHalf  );
            });
        });
    </script>
@endsection