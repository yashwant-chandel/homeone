$(document).ready(function () {
  function setSliderState(sliderRange, e) {
    if (e.type === "input") {
      sliderRange.addClass("image-comparison__range--active");
      return;
    }

    sliderRange.removeClass("image-comparison__range--active");
    $(document).off("mousemove", moveSliderThumb);
  }

  function moveSliderThumb(e) {
    const sliderRange = $("[data-image-comparison-range]");
    const thumb = $("[data-image-comparison-thumb]");
    let position = e.pageY - thumb.height() / 2;

    if (e.pageY <= sliderRange.offset().top) {
      position = sliderRange.offset().top - thumb.height() / 2;
    }

    if (e.pageY >= sliderRange.offset().top + sliderRange.height()) {
      position =
        sliderRange.offset().top + sliderRange.height() - thumb.height() / 2;
    }
    thumb.css("top", `${position}px`);
  }

  function moveSliderRange(e) {
    const value = e.target.value;
    const slider = $("[data-image-comparison-slider]");
    const imageWrapperOverlay = $("[data-image-comparison-overlay]");
    slider.css("left", `${value}%`);
    imageWrapperOverlay.css("width", `${value}%`);

    $(document).on("mousemove", moveSliderThumb);
    setSliderState($(this), e);
  }

  function initSlider(element) {
    const sliderRange = element.find("[data-image-comparison-range]");
    if (!("ontouchstart" in window)) {
      sliderRange.on("mouseup", (e) => setSliderState(sliderRange, e));
      sliderRange.on("mousedown", moveSliderThumb);
    }

    sliderRange.on("input", moveSliderRange);
    sliderRange.on("change", moveSliderRange);
  }

  // Initialize the sliders for each tab
  $('[data-component="image-comparison-slider"]').each(function () {
    initSlider($(this));
  });

  // Handle tab switch to teardown and initialize sliders
  $(".tab-button").on("click", function () {
    $(document).off("mousemove", moveSliderThumb);
    $("[data-image-comparison-range]").each(function () {
      setSliderState($(this));
    });
  });
});





$(document).ready(function () {
  $(".create-slider").slick({
    infinite: true,
    nav: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
  });
  $(".light-slider").slick({
    infinite: true,
    nav: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  $(".navbar-toggler").click(function () {
    $(this).toggleClass("open");
  });
});



function increaseValue() {
  var inputElement = document.getElementById("number");
  var value = parseInt(inputElement.value, 10);
  value = isNaN(value) ? 0 : value;
  
  // Set the maximum length for the value (e.g., 10 in this case)
  var maxLength = inputElement.maxLength;

  // Check if the current value plus one exceeds the maximum length
  if (value + 1 <= maxLength) {
    value++;
    inputElement.value = value;
  }
}


function decreaseValue() {
  var inputElement = document.getElementById("number");
  var value = parseInt(inputElement.value, 10);
  value = isNaN(value) ? 1 : value; // Ensure it's at least 1
  value = Math.max(1, value - 1); // Decrease value but not below 1
  inputElement.value = value;
}



$(".slider-for").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  adaptiveHeight: true,
  asNavFor: ".slider-nav",
  centerMode: false,
});
var imgVal = $('#imgCount').attr('data-val');
$(".slider-nav").slick({
  slidesToShow: imgVal,
  slidesToScroll: 1,
  asNavFor: ".slider-for",
  dots: true,
  focusOnSelect: true,
  centerMode: false,
});

$("a[data-slide]").click(function (e) {
  e.preventDefault();
  var slideno = $(this).data("slide");
  $(".slider-nav").slick("slickGoTo", slideno - 1);
});

