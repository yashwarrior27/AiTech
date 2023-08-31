@include('Frontend.layouts.header')
<body>
    <video class="video_wrap" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
                            <source src="{{asset('assets/frontend/video.mp4')}}" type="video/mp4">
    </video>
        <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- logo -->
            <a class="navbar-brand" href="{{url("/")}}">
            <img src="{{asset('assets/frontend/img/logo.png')}}" alt="header-Logo" class="logo w-75"></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText2">
              <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <div class="collapse navbar-collapse2" id="navbarText2">
                <ul class="navbar-nav ml-auto line">
                 <li class="nav-item">
                        <a class="nav-link active" href="#" data-scroll-nav="1">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=#" data-scroll-nav="2">Ecosystem</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=#" data-scroll-nav="3">Futureverse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=#" data-scroll-nav="4">Technology</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=#" data-scroll-nav="5">Roadmap</a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url('/register')}}" class="btn btn2 ml-md-4 " >
                        Register Now
                      </a>
                    </li>
                    <li class="nav-item">
                       <a href="{{url('/login')}}" class="btn btn1 ml-3 " >Login</a>
                    </li>

                </ul>
            </div>

            </div>
        </nav> 
	<header class="home" id="home" data-scroll-index="1">
	 <div class="banner_content">
	 <div class="container">
	 <div class="row align-items-center">
	  <div class="col-md-6 wow fadeInUpBig mt-md-0 mt-5  order-md-2" data-wow-delay="1s">
          <img class="img-fluid" src="{{asset('assets/frontend/img/logo2.png')}}" alt="coin">
	 </div>
	  <div class="col-md-6 wow fadeInUpBig order-md-1" data-wow-delay="0.1s">

       <h1 class="fgd">AiTechPro - The solution of Decentralise Finance</h1>
	    <strong class="h5">Experience How Perfect Blend of AI and Blockchain Contributing to Crypto with AI Techpro </strong>
	   <p>
                       With the power of artificial intelligence and blockchain, we would be investing in various crypto projects to get huge returns and distributing our profit among our investors. Our major aim is to attract investments towards our client's businesses by using recent technological advancements. AI Techpro will assist you in getting higher returns on your investments. With our tech-friendly solutions, our clients will be able to manage their investments more smartly.
                    </p>
         <a href="{{url('/register')}}" class="btn btn2 " >
			Register Now
         </a>
		 <a href="{{url('/login')}}" class="btn btn1 ml-2 " >
			Login
       </a>

      </div>

      </div>

    </header>
    <!-- ====== END HEADER ======  -->
 </div>
 </header>
    <!-- Scroll to Top -->

<div class=" p60 automobiles_man pos-rel pb-0" data-scroll-index="2">
 <div class="container">
  <h2 class="hadding  wow fadeInUpBig" data-wow-delay="0.3s">Wide Range of Industries in<br/>Which We Are Doing Crypto Trading</h2>
    <div class="owl-carousel owl-theme">
    <div class="item wow fadeInUpBig" data-wow-delay="0.1s">
    <div class="ecosystem_box">
	    <img class="img-fluid mb-3" src="{{asset('assets/frontend/img/automobiles.png')}}" alt="futureverse">
	    <h4>Automobiles</h4>
         <p>We are experts in crypto trading by investing in blockchain projects related to the automobile sector.</p>
     </div>
    </div>
 <div class="item wow fadeInUpBig" data-wow-delay="0.1s">
    <div class="ecosystem_box">
	    <img class="img-fluid mb-3" src="{{asset('assets/frontend/img/manufacturing.png')}}" alt="Manufacturing">
	    <h4>Manufacturing </h4>
         <p>Crypto projects in the manufacturing sector are the new talk of the town and we are trying to thrive all the potential of this sector with AI & blockchain</p>
     </div>
    </div>
    <div class="item wow fadeInUpBig" data-wow-delay="0.1s">
    <div class="ecosystem_box">
	    <img class="img-fluid mb-3" src="{{asset('assets/frontend/img/business.png')}}" alt="futureverse">
	    <h4>Business</h4>
         <p>By enabling artificial intelligence and blockchain technology in the business sector, we do crypto trading to get maximum returns.</p>
     </div>
    </div>
	 <div class="item wow fadeInUpBig" data-wow-delay="0.1s">
    <div class="ecosystem_box">
	    <img class="img-fluid mb-3" src="{{asset('assets/frontend/img/gaming.png')}}" alt="Gaming">
	    <h4>Gaming </h4>
         <p>Online gaming continues to see major growth and we have already analyzed the bright future of this sector, hence investing in this industry.</p>
     </div>
    </div>
	 <div class="item wow fadeInUpBig" data-wow-delay="0.1s">
    <div class="ecosystem_box">
	    <img class="img-fluid mb-3" src="{{asset('assets/frontend/img/education.png')}}" alt="Education">
	    <h4>Education </h4>
         <p>By investing in the education sector’s crypto project, we try to maximize our returns over our investments as this is a booming sector.</p>
     </div>
    </div>
	 <div class="item wow fadeInUpBig" data-wow-delay="0.1s">
    <div class="ecosystem_box">
	    <img class="img-fluid mb-3" src="{{asset('assets/frontend/img/government.png')}}" alt="Government">
	    <h4>Government </h4>
         <p>We are investing in various crypto projects initiated by the government at the global level as the possibility of such projects will be higher. </p>
     </div>
    </div>
	<div class="item wow fadeInUpBig" data-wow-delay="0.1s">
    <div class="ecosystem_box">
	    <img class="img-fluid mb-3" src="{{asset('assets/frontend/img/finance.png')}}" alt="Finance">
	    <h4>Finance </h4>
         <p>We invest in the crypto projects running in the finance sector as this industry is one of the fastest growing and can give high RoI.</p>
     </div>
    </div>
	<div class="item wow fadeInUpBig" data-wow-delay="0.1s">
    <div class="ecosystem_box">
	    <img class="img-fluid mb-3" src="{{asset('assets/frontend/img/healthcare.png')}}" alt="Healthcare">
	    <h4>Healthcare </h4>
         <p>Healthcare is one of the major sectors, where crypto projects are on boom and by doing crypto trading in this sector, we are getting huge returns. </p>
     </div>
    </div>
	     </div>
        </div>
</div>
</div>

<div class=" p60 work-section2 fs20" data-scroll-index="3">
 <div class="container">
   <div class="row align-items-end">
    <div class="col-md-4 wow fadeInUpBig text-center" data-wow-delay="0.4s">
       <img class="img-fluid" src="{{asset('assets/frontend/img/logo3.png')}}" alt="logo">
	 </div>
     <div class="col-md-8 ">
       <h2 class=" hadding mb-4 wow fadeInUpBig" data-wow-delay="0.1s">Benefits of Combining <br/>AI & Blockchain</h2>
	    <div class="row" >
			<div class="col-sm-6 wow fadeInUpBig" data-wow-delay="0.2s">
			     <div class="bte_box">
                    <div class="">
					    <img class="mb-3" src="{{asset('assets/frontend/img/security.png')}}" alt="security">
					 </div>
                      <div class="box-body">
                         <div class="elementskit-info-box-title">Greater Security</div>
                         <p>Users can be able to complete their transactions with better security to eliminate any possibility of hacking.</p>
                      </div>
                </div>
			</div>

			<div class="col-sm-6 wow fadeInUpBig" data-wow-delay="0.2s">
			     <div class="bte_box">
                    <div class="">
					    <img class="mb-3" src="{{asset('assets/frontend/img/edm.png')}}" alt="Enhanced Data Management">
					 </div>
                      <div class="box-body">
                         <div class="elementskit-info-box-title">Enhanced Data Management</div>
                         <p>Blockchain technology and artificial intelligence both will be helping in the systematic data management properly.</p>
                      </div>
                </div>
			</div>
			<div class="col-sm-6 wow fadeInUpBig" data-wow-delay="0.2s">
			     <div class="bte_box">
                    <div class="">
					    <img class="mb-3" src="{{asset('assets/frontend/img/eds.png')}}" alt="Efficient Data Storage">
					 </div>
                      <div class="box-body">
                         <div class="elementskit-info-box-title">Efficient Data Storage</div>
                         <p>By combining AI & blockchain while completing the transactions, you would be able to store data efficiently.</p>
                      </div>
                </div>
			</div>
			<div class="col-sm-6 wow fadeInUpBig" data-wow-delay="0.2s">
			     <div class="bte_box">
                    <div class="">
					    <img class="mb-3" src="{{asset('assets/frontend/img/atdm.png')}}" alt="Market">
					 </div>
                      <div class="box-body">
                         <div class="elementskit-info-box-title">Access to the Data Market</div>
                         <p>With AI & blockchain technology, we can have easy access to the relevant data for our business.</p>
                      </div>
                </div>
			</div>
		 </div>
	 </div>
    </div>
</div>
</div>

<div class="dw_deposits  p60 pb-3" data-scroll-index="4">
 <div class="container">
 <div class="row align-items-center">
  <div class="col-md-7">
   <h2 class="hadding  mb-md-4 wow fadeInUpBig" data-wow-delay="0.3s">How Artificial Intelligence And Blockchain Technology Combination Is Perfect For Crypto Trading</h2>
   <p>The combination of artificial intelligence (AI) and blockchain technology is particularly advantageous for crypto trading. AI algorithms can analyze vast amounts of data, including historical price patterns, market trends, and news sentiment, to identify trading opportunities and make informed decisions in real time. By integrating AI with blockchain, the transparency and immutability of the distributed ledger ensure the integrity of trading data, making it reliable and trustworthy.


</p><p>Additionally, smart contracts on the blockchain can automate trade execution, settlement, and other processes, eliminating intermediaries and reducing transaction costs. This powerful combination enhances the efficiency, security, and profitability of crypto trading, empowering traders with advanced analytics and decentralized trading infrastructure.


</p>
   </div>
 <div class="col-md-5  wow fadeInUpBig" data-wow-delay="0.1s">
	      <img class="img-fluid" src="{{asset('assets/frontend/img/herorobot.png')}}" alt="herorobot">
	  </div>


  </div>
  </div>
  </div>


  <div class="  p60 " >
 <div class="container">
  <h2 class="hadding  mb-2 text-center wow fadeInUpBig" data-wow-delay="0.3s">Token details</h2>
   <p class="text-center h5 mb-4">AITP is the backbone of AITechPro Ecosystem. AITP is used everywhere in AITechPro Components and <br/>All the transaction will be done using AITP only  </p>


    <div class="chart_box  wow fadeInUpBig" data-wow-delay="0.1s">
	      <img class="img-fluid" src="{{asset('assets/frontend/img/chart.png')}}" alt="chart">
		  <ul>
		    <li><span>50$</span>Launching Price</li>
		    <li><span>June 2025</span>Launching Date</li>
		    <li><span>AITP</span>Short Name</li>
		    <li><span>2 Million</span>Quantity</li>
		    <li><span>Bep20</span>Network</li>
		  </ul>
  </div>
  </div>
  </div>
  </div>

  <div class="logo_box text-center p60 " data-scroll-index="4">
 <div class="container">
 <div class="row align-items-center">
  <div class="col-md-8 m-auto">
   <img class="img-fluid wow fadeInUpBig mb-4" data-wow-delay="0.3s" src="{{asset('assets/frontend/img/logo_large.png')}}"  alt="coin">
        <p class="wow fadeInUpBig" data-wow-delay="0.6s">
                       AI Techpro is the leading crypto trading company that ensures that their trading activities must be equipped with a combination of Artificial Intelligence and Blockchain Technology. We are a German based company having our decentralized blockchain platform for crypto trading possessing the advanced technological advancements. AI Techpro is the world’s first such crypto trader that offers the finest tech-friendly solutions to their investors. We are working towards being the best by trading in various sectors to enhance our profit. With our investor's money, we do crypto trading in the best projects in the market by using artificial intelligence to increase the chances of increasing our business revenue and sharing business profit with our investors.

         </p>
   </div>
  </div>
  </div>
  </div>


<section id="timeline" class="dw_deposits  p60 pb-0" data-scroll-index="5">

   <div class="timeline_top text-light position-relative">

    <h2 class="hadding yellowspan text-center text-md-left  timeline_header blueback mb-0" data-wow-delay="0.3s">Roadmap</h2>

      <div class="timeline_nav">
         <button aria-label="timeline navigation previous" class="transition-fast timeline_nav_prev left">
         <span class="blueback  material-symbols-outlined material-icons">
           <i class="fa fa-angle-left"></i>
         </span>
         </button>
         <button aria-label="timeline navigation next" class="transition-fast timeline_nav_next right">
         <span class="blueback  material-symbols-outlined material-icons">
          <i class="fa fa-angle-right"></i>
         </span>
         </button>
      </div>
   </div>
   <div class="timeline_bottom bg-cover" >
      <div class="green_overlay">
         <div class="py-5 timeline_content position-relative">
            <div class="timeline_fadebox d-none d-md-block" aria-hidden="true">
            </div>
            <div class="timeline_wrap">

               <div class="timeline_line" aria-hidden="true">
               </div>
               <div id="timeline_slider">
                  <!--------------------------------------->


                  <!--------------------------------------->
                  <div class="timeline_slide px-4">
                     <p class="yellow timeline_date text-center m-0 h4">
                       Q3-Q4 2023
                     </p>
                     <div class="timeline_dot flex-center" aria-hidden="true">
                        <div class="timeline_dot_center">
                        </div>
                     </div>
                     <p class="timeline_item_content text-light mt-3">
                       Airdrop program for community.
                     </p>
                  </div>
                  <!--------------------------------------->
                  <div class="timeline_slide px-4">
                     <p class="yellow timeline_date text-center m-0 h4">
                        Q1-Q2 2024
                     </p>
                     <div class="timeline_dot flex-center" aria-hidden="true">
                        <div class="timeline_dot_center">
                        </div>
                     </div>
                      <p class="timeline_item_content text-light mt-3">
                       AI trading bot(crypto and Forex)
                     </p>
                  </div>
                  <!--------------------------------------->
                  <div class="timeline_slide px-4">
                     <p class="yellow timeline_date text-center m-0 h4">
                        Q3-Q4 2024
                     </p>
                     <div class="timeline_dot flex-center" aria-hidden="true">
                        <div class="timeline_dot_center">
                        </div>
                     </div>
                     <p class="timeline_item_content text-light mt-3">
                        Decentralise multichain wallet and own blockchain.
                     </p>
                  </div>
                  <!--------------------------------------->
                  <div class="timeline_slide px-4">
                     <p class="yellow timeline_date text-center m-0 h4">
                        Q1-Q2 2025
                     </p>
                     <div class="timeline_dot flex-center" aria-hidden="true">
                        <div class="timeline_dot_center">
                        </div>
                     </div>
                     <p class="timeline_item_content text-light mt-3">
                        AiDex(swap exchange)
                     </p>
                  </div>
                  <!--------------------------------------->
                  <div class="timeline_slide px-4">
                     <p class="yellow timeline_date text-center m-0 h4">
                        Q3-Q4 2025
                     </p>
                     <div class="timeline_dot flex-center" aria-hidden="true">
                        <div class="timeline_dot_center">
                        </div>
                     </div>
                     <p class="timeline_item_content text-light mt-3">
                        Lisiting AITP on top CeX exhanges.
                     </p>
                  </div>
                  <!--------------------------------------->
                  <div class="timeline_slide px-4">
                     <p class="yellow timeline_date text-center m-0 h4">
                        2026
                     </p>
                     <div class="timeline_dot flex-center" aria-hidden="true">
                        <div class="timeline_dot_center">
                        </div>
                     </div>
                     <p class="timeline_item_content text-light mt-3">
                        D.A.O.(Web3.0)
                     </p>
                  </div>
                  <!--------------------------------------->
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

  <div class="logo_box text-center p60 " data-scroll-index="4">
 <div class="container">
 <h2 class="hadding mb-md-5 wow fadeInUpBig animated" data-wow-delay="0.3s" >Creating the future with the best of the best</h2>
  <marquee direction = "right">
     <div class="media_box wow fadeInUpBig" data-wow-delay="0.3s">
         <img src="{{asset('assets/frontend/img/m1.png')}}"  alt="coin">
      </div>
     <div class="media_box wow fadeInUpBig" data-wow-delay="0.3s">
         <img src="{{asset('assets/frontend/img/m2.png')}}"  alt="coin">
      </div>
     <div class="media_box wow fadeInUpBig" data-wow-delay="0.3s">
         <img src="{{asset('assets/frontend/img/m3.png')}}"  alt="coin">
      </div>
     <div class="media_box wow fadeInUpBig" data-wow-delay="0.3s">
         <img src="{{asset('assets/frontend/img/m4.png')}}"  alt="coin">
      </div>
   </marquee>
     <marquee>
     <div class="media_box wow fadeInUpBig" data-wow-delay="0.3s">
         <img src="{{asset('assets/frontend/img/m5.png')}}"  alt="coin">
      </div>
     <div class="media_box wow fadeInUpBig" data-wow-delay="0.3s">
         <img src="{{asset('assets/frontend/img/m6.png')}}"  alt="coin">
      </div>
     <div class="media_box wow fadeInUpBig" data-wow-delay="0.3s">
         <img src="{{asset('assets/frontend/img/m7.png')}}"  alt="coin">
      </div>

     <div class="media_box wow fadeInUpBig" data-wow-delay="0.3s">
         <img src="{{asset('assets/frontend/img/m8.png')}}"  alt="coin">
      </div>
    </marquee>
  </div>
  </div>

 <section class="contact padding footer" id="contact" data-scroll-index="6">
        <div class="container">
            <div class="row">
				<div class="col-md-5">
               <img src="{{asset('assets/frontend/img/logo.png')}}" alt="header-Logo" class="mb-3">
		      <p>AI Techpro is the best crypto trader in the market that do trading by combining artificial intelligence with blockchain technology. We would be sharing the profits with our investors that we will accrue by investing in different crypto projects running in various sectors.

</p>

			 </div>
			 <div class="col-md-4">
			     <div class="nav_link pl-md-5">
				 <h4>Company</h4>
				<ul class="">

               <li class="">
                    <a class="" href="#" data-scroll-nav="1">Home</a>
                </li>
				<li class="">
                    <a class="" href=#" data-scroll-nav="2">Ecosystem</a>
                </li>
				<li class="">
                    <a class="" href=#" data-scroll-nav="3">Futureverse</a>
                </li>
				<li class="">
                    <a class="" href=#" data-scroll-nav="4">Technology</a>
                </li>
				<li class="">
                    <a class="" href=#" data-scroll-nav="5">Roadmap</a>
                </li>
            </ul>
             </div>
			 </div>


			  <div class="col-md-3">
			     <div class="nav_link">
				 <h4>Social Media</h4>
			    <div class="vertical-social wow fadeInDown  animated" data-wow-delay="0.1s">
				<ul>
				<li><a target="_blank" href="#"><i class="fa fa-telegram" ></i></a></li>
				<li><a target="_blank" href="#"><i class="fa fa-facebook" ></i></a></li>
				<br/>
				<li><a target="_blank" href="#"> <i class="fa fa-twitter" ></i></a></li>
				<li><a target="_blank" href="#"><i class="fa fa-instagram" ></i></a></li>

				</ul>
             </div>
             </div>
			 </div>

            </div>
        </div>


	<div class="copyright text-center">
                       &copy; 2023 AI Techpor. All Rights Reserved
                    </div>
    </section>

<div class="socmed-block">
 <a href="#" target="_blank" class="socmed-links w-inline-block"><img src="{{asset('assets/frontend/img/group-1209.png')}}" loading="lazy" alt="" ></a>
    <a href="#" target="_blank" class="socmed-links w-inline-block"><img src="{{asset('assets/frontend/img/group-1213.png')}}" loading="lazy" alt="" ></a>
    <a href="#" target="_blank" class="socmed-links w-inline-block"><img src="{{asset('assets/frontend/img/group-1212.png')}}" loading="lazy" alt="" ></a>
    <a href="#" target="_blank" class="socmed-links w-inline-block"><img src="{{asset('assets/frontend/img/group-1210.png')}}" loading="lazy" alt="" ></a>
</div>

    <div id="scroll-to-top"><i class="fa fa-arrow-up fa-fw"></i></div>


    {{-- <div class="modal fade" id="timer">
  <div class="modal-dialog">
    <div class="modal-content">


      <!-- Modal body -->
      <div class="modal-body text-center"> 
	  <button type="button" class="close" data-dismiss="modal">&times;</button>
       
	   <h3>Airdrop Start</br>on 10am GMT time</h3>
	   <div id="clockdiv" >
		<div class="t_box">
			<span class="days" id="day"></span>
			<div class="smalltext">Days</div>
		</div>
		<div class="t_box">
			<span class="hours" id="hour"></span>
			<div class="smalltext">Hours</div>
		</div>
		<div class="t_box">
			<span class="minutes" id="minute"></span>
			<div class="smalltext">Minutes</div>
		</div>
		<div class="t_box">
			<span class="seconds" id="second"></span>
			<div class="smalltext">Seconds</div>
		</div>
		</div>
      </div>

    </div>
  </div>
</div> --}}

    </body>
 @include('Frontend.layouts.footer')
