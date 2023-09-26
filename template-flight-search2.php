<?php
/** Template name: Template Flight Search */
get_header();

global $wp;
?>

<!-- Make An API Request to get data of flights -->
<?php
    $queryArr = array();
    $flightType = isset($_GET['flightType'])?$_GET['flightType'] : '';
    $originSkyId = isset($_GET['originSkyId'])?$_GET['originSkyId'] : '';
    $originEntityId = isset($_GET['originEntityId'])?$_GET['originEntityId'] : '';
    $fromPlace = isset($_GET['fromPlace'])?$_GET['fromPlace'] : '';
    $destinationSkyId = isset($_GET['destinationSkyId'])?$_GET['destinationSkyId'] :'';
    $destinationEntityId = isset($_GET['destinationEntityId'])?$_GET['destinationEntityId'] : '' ;
    $toPlace = isset($_GET['toPlace'])?$_GET['toPlace'] : '';
    $onDate = null;
    $returnDate = null;
    if(isset($_GET['onDate'])){
      $inputFormats = ["d/m/Y", "m/d/Y", "Y-m-d", "Y/m/d", "d-m-Y", "d.m.Y"];
      foreach ($inputFormats as $format) {
        $onDateObj = DateTime::createFromFormat($format, $_GET['onDate']);
        if ($onDateObj !== false) {
            $onDate = $onDateObj->format("Y-m-d");
            break;
        }
      }
    }
    if(isset($_GET['returnDate'])){
      $inputFormats = ["d/m/Y", "m/d/Y", "Y-m-d", "Y/m/d", "d-m-Y", "d.m.Y"];
      foreach ($inputFormats as $format) {
        $returnDateObj = DateTime::createFromFormat($format, $_GET['returnDate']);
        if ($returnDateObj !== false) {
            $returnDate = $returnDateObj->format("Y-m-d");
            break;
        }
      }
    }

    // $onDate = isset($_GET['onDate'])?$_GET['onDate']  : '';
    // $returnDate = isset($_GET['returnDate'])?$_GET['returnDate']  : '';
    // echo $onDate  . ' return date ' . $returnDate;
    
    $guest = isset($_GET['guest'])?$_GET['guest'] : '1';
    $adult = isset($_GET['adult'])?$_GET['adult'] : '1';
    $children = isset($_GET['children'])?$_GET['children'] : '0';
    
    $queryArr = array(
        'originSkyId' => $originSkyId ,
        'destinationSkyId' => $destinationSkyId,
        'originEntityId' => $originEntityId,
        'destinationEntityId' => $destinationEntityId,
        'date' => $onDate,
        'adults' => 1,
    );
    $queryParam = http_build_query($queryArr);

	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://sky-scrapper.p.rapidapi.com/api/v1/flights/searchFlights?".$queryParam."&currency=EUR&market=en-US",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"X-RapidAPI-Host: sky-scrapper.p.rapidapi.com",
			"X-RapidAPI-Key: 0e7e9fe9ffmsh4d816e517cf1950p1e8b64jsn8e779e6f2841"
		],
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		// echo $response;
	}
	$flightSearch = json_decode($response);

	// echo "<pre>";
	// print_r($flightSearch);
	// echo "</pre>";
  /////////////////// Session Id is important for search flight details page  /////////////////////////

  $sessionID = isset($flightSearch->sessionId)?$flightSearch->sessionId : '';

  ////////////////////////////////////////////////////////////////////////////////////////////////////

  //////////////////////////////////  itineraries ///////////////////////////////////////////////////
  $itineraries = $flightSearch->data->itineraries;
  // echo "<pre>";
  // print_r($itineraries);
  // echo "</pre>";
?>
<!-- code by yashu -->
<!-- code for min price -->
<?php 
if((isset($itineraries) || !empty($itineraries)) && is_array($itineraries)){

foreach($itineraries as $itiner){
 $price[] = $itiner->price->raw;
}
$minprice = min($price);
$keysWithMinValue = array_keys($price, $minprice);

// code for get min time 

foreach($itineraries as $itiner){
 $durations[] = $itiner->legs[0]->durationInMinutes;
}
$minduration = min($durations);
$maxduration = max($durations);
$keyswithminduration = array_keys($durations,$minduration);
$keyswithmaxduration = array_keys($durations,$maxduration);

//code of max score
foreach($itineraries as $itiner){
  $score[] =  $itiner->score;
}
$maxscore = max($score);
$keyofmaxscore = array_keys($score,$maxscore);

print_r($minduration);
print_r($maxduration);


//new code by yashu 18 sept
// $num = 0;
foreach($itineraries as $itiner){
  // echo '<pre>';
  // print_r($itiner->legs[0]->stopCount);
  // echo $num++;
  // echo '</pre>';
  if($itiner->legs[0]->stopCount == 0){
    $directflights[] = $itiner;
    $directstopprice[] = $itiner->price->raw;
  }elseif($itiner->legs[0]->stopCount == 1){
    $singlestopflight[] = $itiner;
    $singlestopprice[] = $itiner->price->raw;
  }else{
    $multistopflight[] = $itiner;
    $multistopprice[] = $itiner->price->raw;
  }
  // $stopcount[] = $itiner['stopCount'];
 }
//  echo '<pre>';
//  print_r($multistopprice);
//  echo '</pre>';
if(isset($directflights)){
$directWithMinValue = array_keys( $directstopprice ,min($directstopprice));
}
if(isset($singlestopprice)){
$singleWithMinValue = array_keys( $singlestopprice ,min($singlestopprice));
}
if(isset($multistopflight)){
$multiWithMinValue = array_keys( $multistopprice ,min($multistopprice));
}

// print_r($directflights[$directWithMinValue[0]]);
foreach($itineraries as $flights){
 
 $flightsid[] = $flights->legs[0]->carriers->marketing[0]->id;
  
}
$random_airlines = array_unique($flightsid);


foreach($itineraries as $itiner){
  if(isset($itiner->legs[0]->segments)){
    foreach($itiner->legs[0]->segments as $airport){
      // $airports[] = $airport;
      $airports[] =  $airport->origin->name;
      $airports[] =  $airport->destination->name;
      $airportscode[] = $airport->origin->displayCode;
      $airportscode[] = $airport->destination->displayCode;
    }
  }
 
  
}
    $uniqueairpotscode = array_unique($airportscode);
}


?>
<!-- end code by yashu -->

<section class="breadcrumb-sec">
      <div class="breadcrumb-content mobile-hidden">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="/">Flights</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Search</li>
          </ol>
        </nav>
      </div>
    </section>
    <section class="filter-sec">
      <div class="filter-popup">
        <button
          type="button"
          class="btn btn-primary"
          data-toggle="modal"
          data-target="#exampleModalLong"
        >
          <i class="fa-solid fa-magnifying-glass"></i>
          <span>DEL - SYD, 11 Aug 2023, 1 adult</span>
        </button>
        <button
          type="button"
          class="btn btn-primary"
          data-toggle="modal"
          data-target="#exampleModalLong2"
        >
          <span><i class="fa-solid fa-sliders"></i></span>
        </button>
      </div>

      <section class="form-sec tabs-content">
    <div form_ty="fli_search" class="flight_search se_co" style="display:block !important;">
				<form id="fli_form">
					<div class="flight-type row">
						<div class="rtrn">
							<input type="radio" id="typeReturn" name="flightType" class="checkFlightType"  dataAttr="returnAlso" <?php echo ($flightType == 'oneWay') ? '' : 'checked'; ?> > <label for="typeReturn" class="text-light"> Return </label>
						</div>
						<div class="oneway">
							<input type="radio" id="onSide" name="flightType" class="text-light checkFlightType" dataAttr="oneWay" <?php echo ($flightType == 'oneWay') ? 'checked' : ''; ?> > <label for="onSide" class="text-light"> One Way </label>
						</div>
					</div>
					<div class="search_filter">
						<div class="placeBox">
							<div class="search_checkin search_from_place search_box">
								<!-- <label for="fromPlace">From city</label> -->
								<input id="fromPlace" type="text" name="fromPlace" Placeholder="From city or airport" value="<?php echo $fromPlace; ?>"
                 skyid="<?php echo $originSkyId ?>" entityid="<?php echo $originEntityId ?>" />
								<div class="loader" ></div>
								<div id="fromResponse" class="fromResponseBox"></div>
							</div>
							<i class="swapLoc fa-solid fa-right-left"></i>
							<div class="search_checkin search_to_place search_box">
								<!-- <label for="toPlace">To city</label> -->
								<input id="toPlace" type="text" name="toPlace" placeholder="To city or airport" value="<?php echo $toPlace; ?>"
                        skyid="<?php echo $destinationSkyId ?>" entityid="<?php echo $destinationEntityId ?>" />
								<div class="loader" ></div>
								<div id="toResponse" class="fromResponseBox"></div>
							</div>
						</div>
						<div class="dateBox">
							<div class="search_checkin search_on_date search_box">
								<label for="on_date" class="onDate"  style="display:<?php echo ($flightType == 'returnAlso') ? 'none' : 'block'; ?>;">On Date</label>
								<input id="on_date" type="text" name="onDate"  placeholder="dd/mm/yyyy" value="<?php echo isset($_GET['onDate'])?$_GET['onDate']  : ''; ?>" />
							</div>
							<div class="search_checkin search_return_date search_box" style="display:<?php echo ($flightType == 'oneWay') ? 'none' : 'block'; ?>;">
								<!-- <label for="return_date"></label> -->
								<input id="return_date" type="text" name="returnDate"  placeholder="dd/mm/yyyy" value="<?php echo isset($_GET['returnDate'])?$_GET['returnDate']  : ''; ?>" />
							</div>
						</div>
						<!--  Custom Select Box for number of passenger  -->
						<div class="search_guest search_box fli_search_box bg-light">
							<span class="gusest_arrow" id="passenger_num">
								<input type="hidden" name="guest" value="<?php echo $guest; ?>"/>
							<span class="guest-num "><?php echo $guest; ?></span> Guests <i class="fa-solid fa-chevron-down"></i></span>
							<div class="guest_input passenger_list">
								<div class="g_m_p fli_g_m_p">
									<div class="pass_num_box">
										<div class="passenger-text">
											<p>Adults</p>
											<span>12+ years</span>
										</div>
										<div class="passe_num" style="height: 43px;">
											<span class="min button">-</span>
											<input type="number" class="guestData" name="adult" value="<?php echo $adult ?>" min="1" max="5" disabled/>
											<span class="plus button">+</span>
										</div>
									</div>
									<div class="pass_num_box">
										<div class="passenger-text">
											<p>Children</p>
											<span>0-17 years</span>
										</div>
										<div class="passe_num"  style="height: 43px;">
											<span class="min button clidrenInput" data-for="min">-</span>
											<input type="number" class="guestData" name="children" value="<?php echo $children ?>" min="0" max="4" disabled/>
											<span class="plus button clidrenInput" data-for="plus">+</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Select Box end  -->
						<div class="search_btn search_box">
							<input type="submit" name="submit" id="searchFlight" value="Search">
						</div>
					</div>
				</form>
			</div>
    </section>
      <section class="flight-list">
        <div class="container">
          <div class="flight-list-content">
            <div class="row">
              <div class="col-lg-3 mobile-hidden">
                <div class="filter-box">
                  <div class="result">
                    <div class="result-box">
                      <p>Showing 12 results</p>
                      <a href="javascript:void(0)">Reset</a>
                    </div>
                  </div>
                  <div class="filter-option">
                    <div class="options">
                      <p>Stops</p>
                      <div class="flight-details toggl-btn">
                        <a
                          href="javascript:void(0)"
                          class="arrow-down"
                          onclick="this.classList.toggle('active')"
                        ></a>
                      </div>
                    </div>
                    <div class="check-box">
                      <div class="form-block">
                        <form class="form-box">
                          <?php if(isset($directflights[$directWithMinValue[0]])){ ?>
                          <div class="form-check">
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="customCheck111" name="stop[]" value="0"
                              />
                              <label
                                class="custom-control-label"
                                for="customCheck111"
                                ><span>Direct</span>
                                <span><?php echo $directflights[$directWithMinValue[0]]->price->raw;  ?> EUR</span></label
                              >
                            </div>
                          </div>
                           <?php } ?>
                           <?php if(isset($singlestopflight[$singleWithMinValue[0]])){ ?>
                          <div class="form-check">
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="customCheck112" name="stop[]" value="1"
                              />
                              <label
                                class="custom-control-label"
                                for="customCheck112"
                                ><span>1 stop</span>
                                <span><?php echo $singlestopflight[$singleWithMinValue[0]]->price->raw;  ?> EUR</span></label
                              >
                            </div>
                          </div>
                           <?php } ?>
                           <?php if(isset($multistopflight[$multiWithMinValue[0]])){ ?>
                          <div class="form-check">
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="customCheck113"
                                name="stops[]" value="2"
                              />
                              <label
                                class="custom-control-label"
                                for="customCheck113"
                                ><span>2+ stop</span>
                                <span><?php echo $multistopflight[$multiWithMinValue[0]]->price->raw;  ?> EUR</span></label
                              >
                            </div>
                          </div>
                           <?php } ?>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="filter-box">
                  <div class="filter-option">
                    <div class="options">
                      <p>Times</p>
                      <div class="flight-details toggl-btn">
                        <a
                          href="javascript:void(0)"
                          class="arrow-down"
                          onclick="this.classList.toggle('active')"
                        ></a>
                      </div>
                    </div>
                    <div class="check-box">
                      <div
                        class="btn-group filter-btn"
                        role="group"
                        aria-label="..."
                      >
                        <a
                          href="javascript:void(0)"
                          class="btn btn-primary button-class1"
                          >Take Off</a
                        >
                        <a
                          href="javascript:void(0)"
                          class="btn btn-default button-class2"
                          >Landing</a
                        >
                      </div>
                      <div class="range-block">
                        <p>Take off time</p>
                        <p>VNS - Lal Bahadur Shastri Airport</p>
                        <div class="d-flex justify-content-between">
                          <input type="text" class="sliderValue2 col-md-6" style="border:none;" data-index="0" value="00:00"  />
                          <input type="text" class="sliderValue2 col-md-6" style="border:none;" data-index="1" value="24:00" />
                        </div>
                        <div class="mt-3" id="slider3"></div>
                        <!-- <input
                          type="text"
                          class="js-range-slider"
                          name="my_range"
                          value=""
                          data-skin="round"
                          data-type="double"
                          data-min="0"
                          data-max="24"
                          data-grid="false"
                        /> -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="filter-box">
                  <div class="filter-option">
                    <div class="options">
                      <p>Durations</p>
                      <div class="flight-details toggl-btn">
                        <a
                          href="javascript:void(0)"
                          class="arrow-down"
                          onclick="this.classList.toggle('active')"
                        ></a>
                      </div>
                    </div>
                    <div class="check-box">
                      <div class="range-block">
                        <p>Total flight duration</p>
                        <div class="d-flex justify-content-between">
                          <input type="text" class="sliderValue col-md-5" style="border:none;" data-index="0" value="00:00"  />
                          <input type="text" class="sliderValue col-md-5" style="border:none;" data-index="1" value="24:00" />
                        </div>
                        <div class="mt-3" id="slider"></div>
                        <!-- <input
                          type="text"
                          class="js-range-slider"
                          name="my_range"
                          value=""
                          data-skin="round"
                          data-type="double"
                          data-min="7"
                          data-max="19"
                          data-grid="false"
                        /> -->
                      </div>
                      <div class="range-block">
                        <p>Stop over duration</p>
                        <div class="d-flex justify-content-between">
                          <input type="text" class="sliderValue1 col-md-5" style="border:none;" data-index="0" value="00:00"  />
                          <input type="text" class="sliderValue1 col-md-5" style="border:none;" data-index="1" value="24:00" />
                        </div>
                        <div class="mt-3" id="slider2"></div>
                        <!-- <input
                          type="text"
                          class="js-range-slider"
                          name="my_range"
                          value=""
                          data-skin="round"
                          data-type="double"
                          data-min="2"
                          data-max="14"
                          data-grid="false"
                        /> -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="filter-box">
                <div class="filter-option">
                    <div class="options">
                      <p>Airlines</p>
                      <div class="flight-details toggl-btn">
                        <a
                          href="javascript:void(0)"
                          class="arrow-down"
                          onclick="this.classList.toggle('active')"
                        ></a>
                      </div>
                    </div>
                    <div class="check-box">
                      <div class="form-block">
                        <form class="form-box">
                          <?php 
                          if(isset($random_airlines)){ 
                            foreach($random_airlines as $key=>$value){
                            ?>
                          <div class="form-check">
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="customCheck9<?php echo $key; ?>" value=""
                              />
                              <label
                                class="custom-control-label"
                                for="customCheck9<?php echo $key; ?>"
                                ><span><?php if(isset($itineraries[$key]->legs[0]->carriers->marketing[0]->name)){ echo $itineraries[$key]->legs[0]->carriers->marketing[0]->name; }  ?> </span>
                                <span><?php  if(isset($itineraries[$key]->price->raw)){ echo $itineraries[$key]->price->raw; }  ?> EUR</span>
                            </label>
                          </div>
                          </div>
                      <?php 
                           }
                        }
                         ?>
                        
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="filter-box">
                <div class="filter-option">
                    <div class="options">
                      <p>Airports</p>
                      <div class="flight-details toggl-btn">
                        <a
                          href="javascript:void(0)"
                          class="arrow-down"
                          onclick="this.classList.toggle('active')"
                        ></a>
                      </div>
                    </div>
                    <div class="check-box">
                      <div class="form-block">
                        <form class="form-box">
                          <?php
                          if(isset($uniqueairpotscode)){
                           foreach($uniqueairpotscode as $key=>$value){ ?>
                          <div class="form-check">
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="customCheck3<?php echo $key; ?>" name="airports[]" value="<?php echo $value; ?>"
                              />
                              <label
                                class="custom-control-label"
                                for="customCheck3<?php echo $key; ?>"
                                ><span><?php echo $value; ?></span>
                                <span>
                                  <?php if(isset($airports[$key])){ echo $airports[$key]; } ?>
                                </span></label
                              >
                            </div>
                          </div>
                          <?php } } ?>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-9 col-md-12">
                <div class="flight-tabs">
                  <span>Sort by</span>
                  <!-- code by yashu -->
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a
                        class="nav-item nav-link active"
                        id="nav-cheapest-tab1"
                        data-toggle="tab"
                        href="#nav-cheapest"
                        role="tab"
                        aria-controls="nav-cheapest"
                        aria-selected="true"
                        ><p>Cheapest</p>
                        <span><?php if(isset($itineraries[$keysWithMinValue[0]]->price->raw)){ echo $itineraries[$keysWithMinValue[0]]->price->raw;  } ?> EUR (~<?php if($itineraries[$keysWithMinValue[0]]->legs[0]->durationInMinutes){ 
                          $minvaluetime = (int)$itineraries[$keysWithMinValue[0]]->legs[0]->durationInMinutes;
                          $minvaluehours = floor($minvaluetime / 60); // Get the whole hours
                          $minvalueminutes = $minvaluetime % 60; // Get the remaining minutes
                          echo $minvaluehours.'h'.$minvalueminutes; 
                          }  ?>m)<?php ?></span></a
                      >
                      <a
                        class="nav-item nav-link"
                        id="nav-quickest-tab"
                        data-toggle="tab"
                        href="#nav-quickest"
                        role="tab"
                        aria-controls="nav-quickest"
                        aria-selected="false"
                        ><p>Quickest</p>
                        <span><?php if(isset($itineraries[$keyswithminduration[0]]->price->raw)){ echo $itineraries[$keyswithminduration[0]]->price->raw;  } ?> EUR (~<?php if($itineraries[$keyswithminduration[0]]->legs[0]->durationInMinutes){
                           $timeinminutes = (int)$itineraries[$keyswithminduration[0]]->legs[0]->durationInMinutes;
                           $time_hours = floor($timeinminutes / 60); // Get the whole hours
                           $time_remainingMinutes = $timeinminutes % 60; // Get the remaining minutes
                           echo  $time_hours.'h'.$time_remainingMinutes;
                            }  ?>m)</span></a
                      >
                      <a
                        class="nav-item nav-link"
                        id="nav-best-tab"
                        data-toggle="tab"
                        href="#nav-best"
                        role="tab"
                        aria-controls="nav-best"
                        aria-selected="false"
                        ><p>Best</p>
                        <span><?php if(isset($itineraries[$keyofmaxscore[0]]->price->raw)){ echo $itineraries[$keyofmaxscore[0]]->price->raw;  } ?>  EUR (~<?php if($itineraries[$keyofmaxscore[0]]->legs[0]->durationInMinutes){ 
                            $besttime = (int)$itineraries[$keyofmaxscore[0]]->legs[0]->durationInMinutes;
                            $besthours = floor($besttime / 60); // Get the whole hours
                            $bestminutes = $besttime % 60; // Get the remaining minutes
                            echo $besthours.'h'.$bestminutes;
                           }  ?>m)</span></a
                      >
                    </div>
                  </nav>
                </div>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-cheapest" role="tabpanel" aria-labelledby="nav-cheapest-tab">

                    <!-- ||||||||||||||||||||||||||   Itineraries  List  |||||||||||||||||||||||||||||| -->

                    <?php if((isset($itineraries) || !empty($itineraries)) && is_array($itineraries)){  ?>
                      <!-- add key here : -->
                      <?php foreach($itineraries as $key => $itinerary){ ?>
                        <div class="flight-list">
                          <div class="flight-table">
                            <img src="<?php echo get_template_directory_uri();  ?>/assets/img/flightimg.png" alt="" class="img-fluid" />
                            <div class="flight-time">
                              <div>
                                <?php if(isset($itinerary->legs[0]->departure)){ ?>
                                <?php   
                                  $timestamp = strtotime($itinerary->legs[0]->departure); 
                                  $departureDate =  date('H:i', $timestamp);
                                ?>
                                <h5><?php echo $departureDate; ?></h5>
                                <?php } ?>
                                <?php if(isset($itinerary->legs[0]->origin->id)){  ?>
                                <p><?php echo $itinerary->legs[0]->origin->id; ?></p>
                                <?php } ?>
                              </div>
                              <div class="time">
                                <?php if(isset($itinerary->legs[0]->durationInMinutes)){ ?>
                                <?php 
                                  $durationInMin = (int)$itinerary->legs[0]->durationInMinutes;
                                  $hours = floor($durationInMin / 60); // Get the whole hours
                                  $remainingMinutes = $durationInMin % 60; // Get the remaining minutes
                                ?>
                                <p><?php echo $hours .'h '.$remainingMinutes.'m';  ?></p>
                                <?php } ?>
                                <!--  Stop Count and stay Airport Code -->
                                <?php 
                                if($itinerary->legs[0]->stopCount > 0){
                                ?>
                                <div><span><?php echo $itinerary->legs[0]->stopCount; ?> Stop(s)</span><?php foreach($itinerary->legs[0]->segments as $ind => $val){ if($ind < (count($itinerary->legs[0]->segments) - 1) ){echo "<span>" .$val->origin->displayCode."</span>" ; if($ind < (count($itinerary->legs[0]->segments) - 2)){echo ',';} }} ?></div>
                                <?php }else{  ?>
                                <div><span>Direct</span></div>
                                <?php } ?>
                                
                              </div>
                              <img src="<?php echo get_template_directory_uri();  ?>/assets/img/flighticon.png" alt="" class="img-fluid"/>
                              <div>
                                <?php if(isset($itinerary->legs[0]->arrival)){ ?>
                                  <?php   
                                    $timestamp = strtotime($itinerary->legs[0]->arrival); 
                                    $arrivalDate =  date('H:i', $timestamp);
                                  ?>
                                <h5><?php echo $arrivalDate; ?></h5>
                                <?php } ?>
                                <?php if(isset($itinerary->legs[0]->destination->id)){  ?>
                                <p><?php echo $itinerary->legs[0]->destination->id; ?></p>
                                <?php } ?>
                              </div>
                            </div>
                            <div class="price">
                              <div>
                                <?php if(isset($itinerary->price->raw)){ ?>
                                <h5>€ <?php echo $itinerary->price->raw; ?> </h5>
                                <?php } ?>
                                <p>for 1 adult</p>
                              </div>
                              <div class="search">
                                <a href="javascript:void(0)" class="btnn" flight-id="<?php echo $itinerary->id; ?>">Select</a>
                              </div>
                              <div class="flight-details toggl-btn">
                                <a
                                  id="select-<?php echo isset($key) ? $key : ''; ?>"
                                  href="javascript:void(0)"
                                  class="arrow-down"
                                  onclick="this.classList.toggle('active')"
                                ></a>
                              </div>
                            </div>
                          </div>
                          <div class="flight-info">
                          <!-- Drop down to get flight info  -->
                          <?php 
                          $stopTimeArr = array();
                          foreach($itinerary->legs[0]->segments as  $segment){
                            $stopTimeArr[] = array('arrival' => $segment->arrival , 'departure' => $segment->departure);
                          }
                          ?>
                          <?php
                            if(isset($itinerary->legs[0]->segments)){
                              foreach($itinerary->legs[0]->segments as $ind => $segment){ ?>
                              <div class="info-block">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="flight-name start-from">
                                      <div class="side-line">
                                        <div class="flight-circle"></div>
                                        <div class="verticle-line"></div>
                                        <div class="flight-circle2"></div>
                                      </div>
                                      <?php if(isset($segment->origin->displayCode) || isset($segment->origin->name)){ ?>
                                      <h5><?php echo isset($segment->origin->name)?$segment->origin->name : ''; ?> <?php echo isset($segment->origin->displayCode)?'('.$segment->origin->displayCode.')':''; ?></h5>
                                      <?php } ?>
                                      <?php if(isset($segment->departure)){ 
                                        $timestamp = strtotime($segment->departure); 
                                        $departureDate =  date('D, d M Y - H:i a', $timestamp);
                                      ?>
                                      <?php echo '<p>'.$departureDate .'</p>';  ?>
                                      <?php } ?>
                                      <?php if(isset($segment->origin->name)){ 
                                        echo "<p>" . $segment->origin->name . ' ' . $segment->origin->type ."</p>";
                                      } ?>
                                    </div>
                                    <div class="flight-name end-point">
                                      <?php if(isset($segment->destination->displayCode) || isset($segment->destination->name)){ ?>
                                      <h5><?php echo isset($segment->destination->name) ? $segment->destination->name : ''; ?> <?php echo isset($segment->destination->displayCode) ? '('.$segment->destination->displayCode.')':''; ?></h5>
                                      <?php } ?>
                                      <?php if(isset($segment->arrival)){ 
                                        $timestamp = strtotime($segment->arrival); 
                                        $arriavalTime =  date('D, d M Y - H:i a', $timestamp);
                                        echo '<p>' . $arriavalTime . '</p>';
                                        }
                                      ?>
                                      <?php if(isset($segment->destination->name)){  
                                        echo "<p>" . $segment->destination->name . ' ' . $segment->destination->type  . "</p>";
                                      } ?>
                                    </div>
                                  </div>
                                  <!-- Meta info -->
                                  <div class="col-md-6">
                                    <p>Malindo Air</p>
                                    <p>OD - 206</p>
                                    <p>Boeing 737-800</p>
                                    <p>Economy</p>
                                    <p>Checked baggage: 20 Kg (Per person)</p>
                                    <div class="rule"><p>Fare rules</p></div>
                                  </div>
                                </div>
                              </div>
                              <?php  
                                for($i = 0; $i <= count($stopTimeArr); $i++){
                                  if($i == $ind){
                                    for($j = 0; $j <= count($stopTimeArr); $j++){
                                      if($j == $i + 1){
                                        $oldDate = $stopTimeArr[$i]['arrival'];
                                        $newDate = $stopTimeArr[$j]['departure'];
                                        if(isset($newDate)){
                                          $oldTime = strtotime($oldDate);
                                          $newTime = strtotime($newDate);
                                          $diffInSeconds = $newTime - $oldTime;
                                          // Convert the difference to appropriate units
                                          $minutes = floor($diffInSeconds / 60);
                                          $hours = floor($minutes / 60) ;
                                          $remainMinute = $minutes % 60;
                                          $days = floor($hours / 24);
                                          echo ($days > 0)?"<span>Stop Duration : {$days}d {$hours}h {$remainMinute}m </span>" : "<span>Stop Duration : {$hours}h {$remainMinute}m </span>";
                                        }
                                      }
                                    }
                                  }
                                }
                              ?>
                            <?php }} ?>
                            <div class="hide-btn">
                            <a href="javascript:void(0)" data-id="<?php echo isset($key) ? $key : ''; ?>
                              " class="hide btnn">Hide Details</a>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    <?php } ?>

                    <!-- Flight list box html start -->

                    <!-- <div class="flight-list">
                      <div class="flight-table">
                        <img src="img/flightimg.png" alt="" class="img-fluid" />
                        <div class="flight-time">
                          <div>
                            <h5>13:25</h5>
                            <p>VNS</p>
                          </div>
                          <div class="time">
                            <p>12h 35m</p>
                            <div><span>1 Stop(s)</span><span>BOM</span></div>
                          </div>
                          <img
                            src="img/flighticon.png"
                            alt=""
                            class="img-fluid"
                          />
                          <div>
                            <h5>00:30</h5>
                            <p>AUH</p>
                          </div>
                        </div>
                        <div class="price">
                          <div>
                            <h5>996.62 EUR</h5>
                            <p>for 1 adult</p>
                          </div>
                          <div class="search">
                            <a href="javascript:void(0)" class="btnn">Select</a>
                          </div>
                          <div class="flight-details toggl-btn">
                            <a
                              href="javascript:void(0)"
                              class="arrow-down"
                              onclick="this.classList.toggle('active')"
                            ></a>
                          </div>
                        </div>
                      </div>
                      <div class="flight-info">
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>

                        <span>Stop duration: 11h 40m </span>
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>
                        <div class="hide-btn">
                          <a href="javascript:void(0)" class="hide btnn"
                            >Hide Details</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="flight-list">
                      <div class="flight-table">
                        <img src="img/flightimg.png" alt="" class="img-fluid" />
                        <div class="flight-time">
                          <div>
                            <h5>13:25</h5>
                            <p>VNS</p>
                          </div>
                          <div class="time">
                            <p>12h 35m</p>
                            <div><span>1 Stop(s)</span><span>BOM</span></div>
                          </div>
                          <img
                            src="img/flighticon.png"
                            alt=""
                            class="img-fluid"
                          />
                          <div>
                            <h5>00:30</h5>
                            <p>AUH</p>
                          </div>
                        </div>
                        <div class="price">
                          <div>
                            <h5>996.62 EUR</h5>
                            <p>for 1 adult</p>
                          </div>
                          <div class="search">
                            <a href="javascript:void(0)" class="btnn">Select</a>
                          </div>
                          <div class="flight-details toggl-btn">
                            <a
                              href="javascript:void(0)"
                              class="arrow-down"
                              onclick="this.classList.toggle('active')"
                            ></a>
                          </div>
                        </div>
                      </div>
                      <div class="flight-info">
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>

                        <span>Stop duration: 11h 40m </span>
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>
                        <div class="hide-btn">
                          <a href="javascript:void(0)" class="hide btnn"
                            >Hide Details</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="flight-list">
                      <div class="flight-table">
                        <img src="img/flightimg.png" alt="" class="img-fluid" />
                        <div class="flight-time">
                          <div>
                            <h5>13:25</h5>
                            <p>VNS</p>
                          </div>
                          <div class="time">
                            <p>12h 35m</p>
                            <div><span>1 Stop(s)</span><span>BOM</span></div>
                          </div>
                          <img
                            src="img/flighticon.png"
                            alt=""
                            class="img-fluid"
                          />
                          <div>
                            <h5>00:30</h5>
                            <p>AUH</p>
                          </div>
                        </div>
                        <div class="price">
                          <div>
                            <h5>996.62 EUR</h5>
                            <p>for 1 adult</p>
                          </div>
                          <div class="search">
                            <a href="javascript:void(0)" class="btnn">Select</a>
                          </div>
                          <div class="flight-details toggl-btn">
                            <a
                              href="javascript:void(0)"
                              class="arrow-down"
                              onclick="this.classList.toggle('active')"
                            ></a>
                          </div>
                        </div>
                      </div>
                      <div class="flight-info">
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>

                        <span>Stop duration: 11h 40m </span>
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>
                        <div class="hide-btn">
                          <a href="javascript:void(0)" class="hide btnn"
                            >Hide Details</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="flight-list">
                      <div class="flight-table">
                        <img src="img/flightimg.png" alt="" class="img-fluid" />
                        <div class="flight-time">
                          <div>
                            <h5>13:25</h5>
                            <p>VNS</p>
                          </div>
                          <div class="time">
                            <p>12h 35m</p>
                            <div><span>1 Stop(s)</span><span>BOM</span></div>
                          </div>
                          <img
                            src="img/flighticon.png"
                            alt=""
                            class="img-fluid"
                          />
                          <div>
                            <h5>00:30</h5>
                            <p>AUH</p>
                          </div>
                        </div>
                        <div class="price">
                          <div>
                            <h5>996.62 EUR</h5>
                            <p>for 1 adult</p>
                          </div>
                          <div class="search">
                            <a href="javascript:void(0)" class="btnn">Select</a>
                          </div>
                          <div class="flight-details toggl-btn">
                            <a
                              href="javascript:void(0)"
                              class="arrow-down"
                              onclick="this.classList.toggle('active')"
                            ></a>
                          </div>
                        </div>
                      </div>
                      <div class="flight-info">
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>

                        <span>Stop duration: 11h 40m </span>
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>
                        <div class="hide-btn">
                          <a href="javascript:void(0)" class="hide btnn"
                            >Hide Details</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="flight-list">
                      <div class="flight-table">
                        <img src="img/flightimg.png" alt="" class="img-fluid" />
                        <div class="flight-time">
                          <div>
                            <h5>13:25</h5>
                            <p>VNS</p>
                          </div>
                          <div class="time">
                            <p>12h 35m</p>
                            <div><span>1 Stop(s)</span><span>BOM</span></div>
                          </div>
                          <img
                            src="img/flighticon.png"
                            alt=""
                            class="img-fluid"
                          />
                          <div>
                            <h5>00:30</h5>
                            <p>AUH</p>
                          </div>
                        </div>
                        <div class="price">
                          <div>
                            <h5>996.62 EUR</h5>
                            <p>for 1 adult</p>
                          </div>
                          <div class="search">
                            <a href="javascript:void(0)" class="btnn">Select</a>
                          </div>
                          <div class="flight-details toggl-btn">
                            <a
                              href="javascript:void(0)"
                              class="arrow-down"
                              onclick="this.classList.toggle('active')"
                            ></a>
                          </div>
                        </div>
                      </div>
                      <div class="flight-info">
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>

                        <span>Stop duration: 11h 40m </span>
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>
                        <div class="hide-btn">
                          <a href="javascript:void(0)" class="hide btnn"
                            >Hide Details</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="flight-list">
                      <div class="flight-table">
                        <img src="img/flightimg.png" alt="" class="img-fluid" />
                        <div class="flight-time">
                          <div>
                            <h5>13:25</h5>
                            <p>VNS</p>
                          </div>
                          <div class="time">
                            <p>12h 35m</p>
                            <div><span>1 Stop(s)</span><span>BOM</span></div>
                          </div>
                          <img
                            src="img/flighticon.png"
                            alt=""
                            class="img-fluid"
                          />
                          <div>
                            <h5>00:30</h5>
                            <p>AUH</p>
                          </div>
                        </div>
                        <div class="price">
                          <div>
                            <h5>996.62 EUR</h5>
                            <p>for 1 adult</p>
                          </div>
                          <div class="search">
                            <a href="javascript:void(0)" class="btnn">Select</a>
                          </div>
                          <div class="flight-details toggl-btn">
                            <a
                              href="javascript:void(0)"
                              class="arrow-down"
                              onclick="this.classList.toggle('active')"
                            ></a>
                          </div>
                        </div>
                      </div>
                      <div class="flight-info">
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>

                        <span>Stop duration: 11h 40m </span>
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>
                        <div class="hide-btn">
                          <a href="javascript:void(0)" class="hide btnn"
                            >Hide Details</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="flight-list">
                      <div class="flight-table">
                        <img src="img/flightimg.png" alt="" class="img-fluid" />
                        <div class="flight-time">
                          <div>
                            <h5>13:25</h5>
                            <p>VNS</p>
                          </div>
                          <div class="time">
                            <p>12h 35m</p>
                            <div><span>1 Stop(s)</span><span>BOM</span></div>
                          </div>
                          <img
                            src="img/flighticon.png"
                            alt=""
                            class="img-fluid"
                          />
                          <div>
                            <h5>00:30</h5>
                            <p>AUH</p>
                          </div>
                        </div>
                        <div class="price">
                          <div>
                            <h5>996.62 EUR</h5>
                            <p>for 1 adult</p>
                          </div>
                          <div class="search">
                            <a href="javascript:void(0)" class="btnn">Select</a>
                          </div>
                          <div class="flight-details toggl-btn">
                            <a
                              href="javascript:void(0)"
                              class="arrow-down"
                              onclick="this.classList.toggle('active')"
                            ></a>
                          </div>
                        </div>
                      </div>
                      <div class="flight-info">
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>

                        <span>Stop duration: 11h 40m </span>
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>
                        <div class="hide-btn">
                          <a href="javascript:void(0)" class="hide btnn"
                            >Hide Details</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="flight-list">
                      <div class="flight-table">
                        <img src="img/flightimg.png" alt="" class="img-fluid" />
                        <div class="flight-time">
                          <div>
                            <h5>13:25</h5>
                            <p>VNS</p>
                          </div>
                          <div class="time">
                            <p>12h 35m</p>
                            <div><span>1 Stop(s)</span><span>BOM</span></div>
                          </div>
                          <img
                            src="img/flighticon.png"
                            alt=""
                            class="img-fluid"
                          />
                          <div>
                            <h5>00:30</h5>
                            <p>AUH</p>
                          </div>
                        </div>
                        <div class="price">
                          <div>
                            <h5>996.62 EUR</h5>
                            <p>for 1 adult</p>
                          </div>
                          <div class="search">
                            <a href="javascript:void(0)" class="btnn">Select</a>
                          </div>
                          <div class="flight-details toggl-btn">
                            <a
                              href="javascript:void(0)"
                              class="arrow-down"
                              onclick="this.classList.toggle('active')"
                            ></a>
                          </div>
                        </div>
                      </div>
                      <div class="flight-info">
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>

                        <span>Stop duration: 11h 40m </span>
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>
                        <div class="hide-btn">
                          <a href="javascript:void(0)" class="hide btnn"
                            >Hide Details</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="flight-list">
                      <div class="flight-table">
                        <img src="img/flightimg.png" alt="" class="img-fluid" />
                        <div class="flight-time">
                          <div>
                            <h5>13:25</h5>
                            <p>VNS</p>
                          </div>
                          <div class="time">
                            <p>12h 35m</p>
                            <div><span>1 Stop(s)</span><span>BOM</span></div>
                          </div>
                          <img
                            src="img/flighticon.png"
                            alt=""
                            class="img-fluid"
                          />
                          <div>
                            <h5>00:30</h5>
                            <p>AUH</p>
                          </div>
                        </div>
                        <div class="price">
                          <div>
                            <h5>996.62 EUR</h5>
                            <p>for 1 adult</p>
                          </div>
                          <div class="search">
                            <a href="javascript:void(0)" class="btnn">Select</a>
                          </div>
                          <div class="flight-details toggl-btn">
                            <a
                              href="javascript:void(0)"
                              class="arrow-down"
                              onclick="this.classList.toggle('active')"
                            ></a>
                          </div>
                        </div>
                      </div>
                      <div class="flight-info">
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>

                        <span>Stop duration: 11h 40m </span>
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>
                        <div class="hide-btn">
                          <a href="javascript:void(0)" class="hide btnn"
                            >Hide Details</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="flight-list">
                      <div class="flight-table">
                        <img src="img/flightimg.png" alt="" class="img-fluid" />
                        <div class="flight-time">
                          <div>
                            <h5>13:25</h5>
                            <p>VNS</p>
                          </div>
                          <div class="time">
                            <p>12h 35m</p>
                            <div><span>1 Stop(s)</span><span>BOM</span></div>
                          </div>
                          <img
                            src="img/flighticon.png"
                            alt=""
                            class="img-fluid"
                          />
                          <div>
                            <h5>00:30</h5>
                            <p>AUH</p>
                          </div>
                        </div>
                        <div class="price">
                          <div>
                            <h5>996.62 EUR</h5>
                            <p>for 1 adult</p>
                          </div>
                          <div class="search">
                            <a href="javascript:void(0)" class="btnn">Select</a>
                          </div>
                          <div class="flight-details toggl-btn">
                            <a
                              href="javascript:void(0)"
                              class="arrow-down"
                              onclick="this.classList.toggle('active')"
                            ></a>
                          </div>
                        </div>
                      </div>
                      <div class="flight-info">
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>

                        <span>Stop duration: 11h 40m </span>
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>
                        <div class="hide-btn">
                          <a href="javascript:void(0)" class="hide btnn"
                            >Hide Details</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="flight-list">
                      <div class="flight-table">
                        <img src="img/flightimg.png" alt="" class="img-fluid" />
                        <div class="flight-time">
                          <div>
                            <h5>13:25</h5>
                            <p>VNS</p>
                          </div>
                          <div class="time">
                            <p>12h 35m</p>
                            <div><span>1 Stop(s)</span><span>BOM</span></div>
                          </div>
                          <img
                            src="img/flighticon.png"
                            alt=""
                            class="img-fluid"
                          />
                          <div>
                            <h5>00:30</h5>
                            <p>AUH</p>
                          </div>
                        </div>
                        <div class="price">
                          <div>
                            <h5>996.62 EUR</h5>
                            <p>for 1 adult</p>
                          </div>
                          <div class="search">
                            <a href="javascript:void(0)" class="btnn">Select</a>
                          </div>
                          <div class="flight-details toggl-btn">
                            <a
                              href="javascript:void(0)"
                              class="arrow-down"
                              onclick="this.classList.toggle('active')"
                            ></a>
                          </div>
                        </div>
                      </div>
                      <div class="flight-info">
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>

                        <span>Stop duration: 11h 40m </span>
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>
                        <div class="hide-btn">
                          <a href="javascript:void(0)" class="hide btnn"
                            >Hide Details</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="flight-list">
                      <div class="flight-table">
                        <img src="img/flightimg.png" alt="" class="img-fluid" />
                        <div class="flight-time">
                          <div>
                            <h5>13:25</h5>
                            <p>VNS</p>
                          </div>
                          <div class="time">
                            <p>12h 35m</p>
                            <div><span>1 Stop(s)</span><span>BOM</span></div>
                          </div>
                          <img
                            src="img/flighticon.png"
                            alt=""
                            class="img-fluid"
                          />
                          <div>
                            <h5>00:30</h5>
                            <p>AUH</p>
                          </div>
                        </div>
                        <div class="price">
                          <div>
                            <h5>996.62 EUR</h5>
                            <p>for 1 adult</p>
                          </div>
                          <div class="search">
                            <a href="javascript:void(0)" class="btnn">Select</a>
                          </div>
                          <div class="flight-details toggl-btn">
                            <a
                              href="javascript:void(0)"
                              class="arrow-down"
                              onclick="this.classList.toggle('active')"
                            ></a>
                          </div>
                        </div>
                      </div>
                      <div class="flight-info">
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>

                        <span>Stop duration: 11h 40m </span>
                        <div class="info-block">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                              <div class="flight-name">
                                <div class="side-line">
                                  <div class="flight-circle"></div>
                                  <div class="verticle-line"></div>
                                  <div class="flight-circle2"></div>
                                </div>
                                <h5>Delhi (DEL)</h5>
                                <p>Tue, 8 Aug 2023 - 22:05 pm</p>
                                <p>Indira Gandhi International Airport</p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <p>Malindo Air</p>
                              <p>OD - 206</p>
                              <p>Boeing 737-800</p>
                              <p>Economy</p>
                              <p>Checked baggage: 20 Kg (Per person)</p>

                              <div class="rule"><p>Fare rules</p></div>
                            </div>
                          </div>
                        </div>
                        <div class="hide-btn">
                          <a href="javascript:void(0)" class="hide btnn"
                            >Hide Details</a
                          >
                        </div>
                      </div>
                    </div> -->
                    <!-- Flight list box html end -->
                  </div>
                  <div
                    class="tab-pane fade"
                    id="nav-quickest"
                    role="tabpanel"
                    aria-labelledby="nav-quickest-tab"
                  >
                    ...
                  </div>
                  <div
                    class="tab-pane fade"
                    id="nav-best"
                    role="tabpanel"
                    aria-labelledby="nav-best-tab"
                  >
                    ...
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </section>
<script>
  var onDate = $("#on_date").datepicker({
			dateFormat: "dd/mm/yy",
			minDate: 1
		});
		var onDate = $("#return_date").datepicker({
			dateFormat: "dd/mm/yy",
			minDate: 2
		});
		
</script>

<!-- range slider -->
<script>
      $("#slider").slider({
        min: 0,
            max: (24*60),
            step: 1,
            values: [0, (24*60)],
            slide: function(event, ui) {
              
              //  final_date = new Date(hours+':'+minutes);
              // console.log(final_date);
              for (var i = 0; i < ui.values.length; ++i) {
                  time = ui.values[i];
              // console.log(ui.value);
              hours = parseInt(Math.floor(time/60),10);
              minutes = parseInt(Math.floor(time%60),10);
              if(hours < 10){
                hours = '0'+hours;
              }
              if(minutes < 10){
                minutes = '0'+minutes;
              }
                    $("input.sliderValue[data-index=" + i + "]").val(hours+':'+minutes);

                }
            }
        });

        $("input.sliderValue").on("keyup",function() {
            var $this = $(this);
            $("#slider").slider("values", $this.data("index"), $this.val());
      });
      $("#slider2").slider({
            
            min: 0,
            max: (24*60),
            step: 1,
            values: [0, (24*60)],
            slide: function(event, ui) {
              
              //  final_date = new Date(hours+':'+minutes);
              // console.log(final_date);
              for (var i = 0; i < ui.values.length; ++i) {
                  time = ui.values[i];
              // console.log(ui.value);
              hours = parseInt(Math.floor(time/60),10);
              minutes = parseInt(Math.floor(time%60),10);
              if(hours < 10){
                hours = '0'+hours;
              }
              if(minutes < 10){
                minutes = '0'+minutes;
              }
                    $("input.sliderValue1[data-index=" + i + "]").val(hours+':'+minutes);

                }
            }
        });

        $("input.sliderValue1").on("keyup",function() {
            var $this = $(this);
            $("#slider2").slider("values", $this.data("index"), $this.val());
      });
      $("#slider3").slider({
            
            min: 0,
            max: (24*60),
            step: 1,
            values: [0, (24*60)],
            slide: function(event, ui) {
              
              //  final_date = new Date(hours+':'+minutes);
              // console.log(final_date);
              for (var i = 0; i < ui.values.length; ++i) {
                  time = ui.values[i];
              // console.log(ui.value);
              hours = parseInt(Math.floor(time/60),10);
              minutes = parseInt(Math.floor(time%60),10);
              if(hours < 10){
                hours = '0'+hours;
              }
              if(minutes < 10){
                minutes = '0'+minutes;
              }
              // console.log(i);
              
              // console.log(time);
                    $("input.sliderValue2[data-index=" + i + "]").val(hours+':'+minutes);

                }
            }
        });

        $("input.sliderValue2").on('keyup',function() {
            var $this = $(this);
            $("#slider3").slider("values", $this.data("index"), $this.val());
      });
    </script>


<?php
  get_footer();
 ?>