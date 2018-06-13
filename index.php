<?php
require_once("connection.php");
require_once("PHPMailer/mail.php");
session_start();
if(isset($_REQUEST['contactName']) && ($_REQUEST['contactName']<>""))	{
	$query = "Insert into contact(name,contactNumber,subject,message,email) values('".$_REQUEST['contactName']."','".$_REQUEST['contactNumber']."','".mysqli_real_escape_string($con, $_REQUEST['contactSubject'])."','".mysqli_real_escape_string($con, $_REQUEST['contactMessage'])."','".$_REQUEST['contactEmail']."')";
	$insertRes = mysqli_query($con,$query);

	if (!$insertRes) {
		printf("Errormessage: %s\n", $con->error);
	}
	else
	{
		$mail->AddAddress("support@onlineitfiling.in", "OnlineITFiling");
		//$mail->AddAddress("nalawadevijay@gmail.com", "OnlineITFiling");
		$mail->Subject = "Enquiry from ".$_REQUEST['contactName'];
		$body = file_get_contents('PHPMailer/templates/contact.txt');
		$body = str_replace("{name}",$_REQUEST['contactName'],$body);
		$body = str_replace("{subject}",$_REQUEST['contactSubject'],$body);
		$body = str_replace("{email}",$_REQUEST['contactEmail'],$body);
		$body = str_replace("{contact}",$_REQUEST['contactNumber'],$body);
		$body = str_replace("{message}",$_REQUEST['contactMessage'],$body);

		$mail->Body = $body;

		if(!$mail->Send())
		{
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . $mail->ErrorInfo;
		   //exit;
		}
		else
		{
			//echo "Mail sent";
		}

		echo "<script>alert('Thank you for contacting us. We will get back to you shortly');</script>";
	}
}
?>
<!DOCTYPE html>
  <html>
    <head>
      <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	    <meta name="description" content="OnlineITFiling Filing">
	    <meta name="keywords" content="OnlineITFiling,Filing">
	    <meta name="author" content="Jeet Chandwani">

      <title>Online IT Filing : Home</title>

       <!-- CSS  -->
      <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <!-- Font Awesome -->
      <link href="css/font-awesome.css" rel="stylesheet">
      <!-- Skill Progress Bar -->
      <link href="css/pro-bars.css" rel="stylesheet" type="text/css" media="all" />
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="css/owl.carousel.css">
      <!-- Default Theme CSS File-->
      <link id="switcher" href="css/themes/blue-theme.css" type="text/css" rel="stylesheet" media="screen,projection"/>     
      <!-- Main css File -->
      <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

	  <script src="js/jquery-1.9.1.js"></script>
      <!-- Extra css & JS File -->
      <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	  <script src="js/validation.js"></script>
	  <script src="js/additional-methods.js"></script>

      <!-- Font -->
      <!--<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->

	  <style type="text/css">	  
	  table, th, td {
		border: medium;	!important;
	  }
	  </style>
    
	<script>
	var message = false;
	(function($,W,D)
	{
		var JQUERY4U = {};

		JQUERY4U.UTIL =
		{
			setupFormValidation: function()
			{	
				//form validation rules
				$("#contactForm").validate({
					rules: {
						contactName: {
							required: true,
							lettersonly: true
						},
						contactEmail: {
							required: true,
							email: true
						},
						contactMessage: {
							required: true
						}
					},
					messages: {
						contactName: "Please enter your Name",
						contactEmail: "Please enter a valid Email Address",
						contactMessage: "Please enter Message"
					},
					submitHandler: function(form) {
						form.submit();
					}
				});
			}
		}

		//when the dom has loaded setup form validation rules
		$(D).ready(function($) {
			JQUERY4U.UTIL.setupFormValidation();
		});

	})(jQuery, window, document);
	</script>
	</head>

    <body>
      <!-- BEGAIN PRELOADER -->         
      <div id="preloader">        
        <div class="progress">
          <div class="indeterminate"></div>
        </div>        
      </div>
      <!-- END PRELOADER -->
      <header id="header" role="banner">
        <div class="navbar-fixed">
          <nav>
            <div class="container">
              <div class="nav-wrapper">

                <!-- LOGO -->

                <!-- TEXT BASED LOGO -->
                <a href="index.php" class="brand-logo" style="left:-4.5rem"><img src="img/logo.jpg" width="70px" height="70px;"></a>

                <!-- Image Based Logo -->                
                 <!-- <a href="index.html" class="brand-logo"><img src="img/logo.jpg" alt="logo img"></a>  -->
                <ul class="right hide-on-med-and-down custom-nav menu-scroll">
                  
				  <li><a href="GSTInfo.php">GST FILING/REGISTRATION</a></li>
                  <li><a href="personalInformation.php">Upload Income Tax Details</a></li>
				  <li><a href="#about">About Us</a></li>
                  <li><a href="#filing-procedure">Filing Procedure</a></li>
                  <li><a href="#fee-structure">Fee Structure</a></li>
                  <li><a href="#testimonial">Testimonial</a></li>
                  <!--<li><a href="#blog">Blog</a></li>-->
                  <li><a href="#footer">Contact</a></li>
                </ul>
                <!-- For Mobile View -->
                <ul id="slide-out" class="side-nav menu-scroll">
                  <li><a href="personalInformation.php">Upload Income Tax Details / Proofs</a></li>
                  <li><a href="#about">About Us</a></li>
                  <li><a href="#filing-procedure">Filing Procedure</a></li>
                  <li><a href="#fee-structure">Fee Structure</a></li>
                  <li><a href="#testimonial">Testimonial</a></li>
                  <!--<li><a href="#blog">Blog</a></li>-->
                  <li><a href="#footer">Contact</a></li>
                </ul>
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
              </div>
            </div>
          </nav>
        </div>  
      </header>
      <div class="main-wrapper">
        <main role="main">
          <!-- START HOME SECTION -->
          <section id="home">
            <div class="overlay-section">
              <div class="container">
                <div class="row">
                  <div class="col s12">
                    <div class="home-inner">
                      <h1 class="home-title">Welcome</h1>
                      <p><font color="#78adc9"><strong>We help to file Income Tax returns</strong></font></p>
                      <a class="btn waves-effect waves-light btn-large" href="personalInformation.php"><strong>Upload Income Tax Details</strong></a> 
					  <a class="btn waves-effect waves-light btn-large" href="GSTInfo.php"><strong>GST FILING/REGISTRATION</strong></a><br><br>
					  <strong><font color="#78adc9">Need Assistance? <br><a href="mailto:Support@OnlineITFiling.in">Support@OnlineITFiling.in</a><br>(What’s App) 9130132056 / 59; 0712-2721026</font></strong>

                      <!-- Call to About Button -->
                      <!--<button class="btn btn-floating waves-effect waves-light btn-large white call-to-about"><i class="material-icons">play_for_work</i></button>-->
                    </div>
                  </div>  
                </div>
              </div>
            </div>
          </section>

          <!-- START ABOUT SECTION -->
          <section id="about">
            <div class="container">
				<div class="about-inner">
					<div class="row">
                      <!--<div class="col s12 m4 l3">
                        <div class="about-inner-left">
                          <img class="profile-img" src="img/profile-img1.jpg" alt="Profile Image">
                        </div>
                      </div>-->
					  <h2 class="title">About Us</h2>
                      <div class="col s12 m8 l9">
                        <div class="about-inner-right">
                          <p>In 2014 we setup our self a vision to conquer and we are striving to accomplish that. 2014 was the year we started LnS Systems and Services with focus on Indian taxation and financial services.  LnS Infotech formed in Sep 2017 is a sister company of LnS Systems and Services with focus on software services and 
						  solutions, international tax, staffing services, training and contractual work.</p>

						<p>Online Income Tax Filing - www.OnlineITFiling.in - is managed by LnS Systems and Services.  It is formed by group of people having vast experience in taxation, accounting, auditing, financial consultation. We come from the background of 16 years industry experience. 
						We are registered at Income Tax Department, 
						Government of India under Sushil Chandwani & Co. 
						(A Chartered Accountant firm).</p>
						<p>OnlineITFiling.in has made your IT return filing on just ONE CLICK. It is very easy and user friendly process. All you need to do is to provide your details, upload your income details/proofs, expenses, 
						investments and our expert team will file your return. You will receive filing acknowledgement on your email ID provided.

                       </p>

						<h3>The Mission:</h3>
						<p>We strive to do better every day.  Also aim to provide the highest level of client satisfaction while maintaining a high standard of ethics, integrity and objectivity.

</p>

						<h3>The Important:</h3>
						<p> * Income Tax Department has made mandatory to provide Aadhaar card, address and bank details. Provide all relevant information asked.

</p>

						<h3>The Commitment:</h3>
						<br>*** Return will be filed in 5 working days (excluding Sat, Sun and Public holidays).
                          <!--<div class="resume-download col s12 m12 l6">
                            <a href="#" class="waves-effect waves-light btn-large resume-btn"><i class="mdi-content-archive left"></i> Download Resume</a>
                          </div>-->
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </section>
          <!-- Start Resume -->
          <section id="filing-procedure">
              <div class="container">
                <div class="skill-inner">
                  <h2 class="title">Filing Procedure</h2>
				  <h5>Step by step procedure to file return</h5>
                  <p> 
					<ol><li>Click on the button or tab "Upload Income Details / Proofs"</li>
					<li>Enter your PAN card details.</li>
					<li>Provide permanent and present address for communications (if any) from IT department.</li>
					<li>Upload income details/proofs like Form-16 (upload all forms; one or more), other income from property, rent etc. Also investments and claims not mentioned in From 16.</li>
					<li>Provide bank account details with bank branch IFSC code.</li>
					<li>Read Terms & Conditions and Accept.</li>
					<li>Make the processing fee payment for www.OnlineITFiling.in.</li>
					<li>Once ITR acknowledgement email received from Income Tax department, you need to sign the document and send to (via post or speed post) the address mentioned on the document.</li>
					</ol>
				  </p>

				  <p>
					<h5>Please note:</h5>
					<ol><li>At any moment of time for clarification or query please contact us on support email ID or contact numbers.</li>
					<li>Once the payment has been made our reference ID will be sent on an email ID provided.</li>
					<li>We require 5 working days to file the return.</li>
					<li>Once the return is filed with Income Tax Department (ITD); the Income Tax acknowledgement will be sent by ITD on the email ID.</li>
					<li>For amendment of return please contact support <a href="mailto:support@OnlineITFiling.in">support@OnlineITFiling.in</a>.</li> 
				  </p>

                  <!-- Start skills progress bar -->

                  <!--<div class="skill-progress-bar">
                    <span>Html5</span>
                    <div class="pro-bar-container color-wisteria">
                      <div class="pro-bar bar-100 color-amethyst" data-pro-bar-percent="100"></div>
                    </div>
                    <span>css</span>
                    <div class="pro-bar-container color-wisteria">
                      <div class="pro-bar bar-90 color-amethyst" data-pro-bar-percent="90" data-pro-bar-delay="100"></div>
                    </div>
                    <span>Photoshop</span>
                    <div class="pro-bar-container color-wisteria">
                      <div class="pro-bar bar-80 color-amethyst" data-pro-bar-percent="80" data-pro-bar-delay="200"></div>
                    </div>
                    <span>Illustrator</span>
                    <div class="pro-bar-container color-wisteria">
                      <div class="pro-bar bar-70 color-amethyst" data-pro-bar-percent="70" data-pro-bar-delay="300"></div>
                    </div>
                    <span>Wordpress</span>
                    <div class="pro-bar-container color-wisteria">
                      <div class="pro-bar bar-60 color-amethyst" data-pro-bar-percent="60" data-pro-bar-delay="400"></div>
                    </div>
                    <span>jQuery</span>
                    <div class="pro-bar-container color-wisteria">
                      <div class="pro-bar bar-50 color-amethyst" data-pro-bar-percent="50" data-pro-bar-delay="500"></div>
                    </div>
                  </div>-->
                </div>
              </div>
            </section>
			
          <section id="fee-structure">
              <div class="container">
                <div class="skill-inner">
                  <h2 class="title">Fee Structure</h2>
				  <p><strong>Form Charges</strong></p>
				  <?php	
					$query = "SELECT * FROM filingcharges where active=1";
					$res = mysqli_query($con,$query);
					$data=mysqli_fetch_array($res,MYSQLI_ASSOC);
					$year1 = $data['year1'];
					$year2 = $data['year2'];
					$one1 = $data['one1'];
					$one2 = $data['one2'];
					$two1 = $data['two1'];
					$two2 = $data['two2'];
					$three1 = $data['three1'];
					$three2 = $data['three2'];
					$four1 = $data['four1'];
					$four2 = $data['four2'];
					$five1 = $data['five1'];
					$five2 = $data['five2'];
					$six1 = $data['six1'];
					$six2 = $data['six2'];
				?>
				  <table border='1' align="center" style="border-style: solid;">
				  <tr><th>No. of forms</th><th align="center"><?=$year2?></th>
				  <!-- <th><=$year1></th> --></tr>
				  <?php
				  /*echo "<tr><td>One</td><td>".$one2."</td><td>".$one1."</td></tr>
				  <tr><td>Two</td><td>".$two2."</td><td>".$two1."</td></tr>
				  <tr><td>Three</td><td>".$three2."</td><td>".$three1."</td></tr>
				  <tr><td>Four</td><td>".$four2."</td><td>".$four1."</td></tr>
				  <tr><td>Five</td><td>".$five2."</td><td>".$five1."</td></tr>
				  <tr><td>Six</td><td>".$six2."</td><td>".$six1."</td></tr>";*/	
				  
				  echo "<tr><td>One</td><td>".$one2."</td></tr>
				  <tr><td>Two</td><td>".$two2."</td></tr>
				  <tr><td>Three</td><td>".$three2."</td></tr>
				  <tr><td>Four</td><td>".$four2."</td></tr>
				  <tr><td>Five</td><td>".$five2."</td></tr>
				  <tr><td>Six</td><td>".$six2."</td></tr>";	?>
				  
				  </table>
				  <p>&nbsp;</p>
				  <p><strong>Additional Document Charges</strong></p>
				  <table border='1' align="center" style="border-style: solid;">
				  <tr><th>No of Documents</th><th>Fees</th></tr>
				  <tr><td>One</td><td>120</td></tr>
				  <tr><td>Two</td><td>220</td></tr>
				  <tr><td>Three</td><td>300</td></tr>
				  <tr><td>Four</td><td>375</td></tr>
				  <tr><td>Five</td><td>450</td></tr>
				  <tr><td>Six</td><td>500</td></tr>
				  </table>
				  <p>&nbsp;</p>
				  <p>
				  <ul>
				  <li>&bull;&nbsp;&nbsp;The above fee structure is for online upload of documents</li>
				  <li>&bull;&nbsp;&nbsp;To apply online discount 8% use discount code - ONLINEUP</li>
				  <li>&bull;&nbsp;&nbsp;Additional documents apart from form 16s / income proofs will cost extra</li>
				  <li>&bull;&nbsp;&nbsp;Documents shared via Email, WhatsApp or other media will cost 5% extra</li>
				  <li>&bull;&nbsp;&nbsp;Multiple computations per return will cost extra</li>
				  <li>&bull;&nbsp;&nbsp;Consultation (if required) charges for tax saving would be applied 
				  and to be paid apart from filing fee</li>				  
				   <li>&bull;&nbsp;&nbsp;Revised / Amended returns will be charged at different fees</li>
				   <li>&bull;&nbsp;&nbsp;Notice management will be charged at different fees</li>
				   <li>&bull;&nbsp;&nbsp;Extra fees mentioned above will vary on case to case basis</li>
				  </ul>
                </div>
              </div>
            </section>

			<!-- Testimonial -->
			<section id="testimonial">
            <div class="container">
              <div class="row">
               <div class="col s12">
                 <div class="testimonial-inner">
                   <h2 class="title">Testimonial</h2>
                   <font size="4" color="white">What clients say about us - </font>
                    <!-- Start Testimonial Slider -->
                    <div class="testimonial-slider-area">
                      <div id="owl-carousel2" class="testimonial-slider row">
                        <div class="col s12">
                          <div class="single-testimonial">
                            <div class="testimonial-img">
                              <img src="img/RajivPanjwani.jpg" alt="img">
                            </div>
                            <div class="testimonial-content">
                              <h3>Rajiv Panjwani</h3>
                              <span>Indore</span>
                              <p style="height: 200px;">"100% authenticated & too good service at very economical fee. Team carries versatile & excellent knowledge in all fields of IT filing. Overall 100% satisfaction. Additional remarks - I would like to quote one appreciable event which was successfully accomplish because of them only. I sold one property and buyer had wrongly put the year while depositing TDS, but they not only suggested the way out but resolved my problem with commendable job at court and IT office."</p>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="single-testimonial">
                            <div class="testimonial-img">
                              <img src="img/PrasanthPottekatt.JPG" alt="img">
                            </div>
                            <div class="testimonial-content">
                              <h3>Prasanth Pottekatt</h3>
                              <span>Pune</span>
                              <p style="height: 200px;">"OnlineITFiling offer very good service at very nominal fee. 100% dedication for the work undertaken. Team has vast knowledge about the procedures and requirements. They are very customer oriented and focused on the goals. I will recommend others to approach as the service rendered is excellent."
							  </p>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="single-testimonial">
                            <div class="testimonial-img">
                              <img src="img/SunilSharma.jpg" alt="img">
                            </div>
                            <div class="testimonial-content">
                              <h3>Sunil Sharma</h3>
                              <span>Mumbai</span>
                              <p style="height: 200px;">"I found OnlineITFiling a true team of professionals who evaluates each minor & major part of your hard earned money. I have an excellent experience with them. They consider you like a family member. They deliver their services without fuss and never keep any small IT suggestion un-turn. Also, I have an example of my own father's old deducted tax which is recovered by "onlineitfiling" team. Single person I name one and only Mr. Girish for his so nice and highly dense professional services year on year."</p>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="single-testimonial">
                            <div class="testimonial-img">
                              <img src="img/SachinYargattikar.jpg" alt="img">
                            </div>
                            <div class="testimonial-content">
                              <h3>Sachin Yargattikar</h3>
                              <span>Kolhapur</span>
                              <p style="height: 200px;">"Since 2 years I am availing best in class service of OnlineITFiling. Timely follow-ups. Tax filling has never been so hassle free before. I don't have to look beyond this team for any of my Tax filling issues. Hope to continue for coming years.  Their fees is worth every penny.  This team is a client centric with sound knowledge & proven track record. Very impressed with the team knowledge regarding all IT complexities. It's a one stop solution for all worries; and I safely, confidentially recommend them."</p>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="single-testimonial">
                            <div class="testimonial-img">
                              <img src="img/AmitMehta.jpg" alt="img">
                            </div>
                            <div class="testimonial-content">
                              <h3>Amit Mehta</h3>
                              <span>Magarpatta, Pune</span>
                              <p style="height: 200px;">"Absolutely amazing service. They are available anytime for help and their advises are right on the money. The best in the business. Fees is quite nominal. It's value for money. They know what they are doing and explains you in simplified manner that any Layman can understand. I must say they have lots of patience, they listens to your queries and address them to resolve it from root. I can trust them anytime. They are like family to me. I wish them all the best to attain great heights in this field."</p>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="single-testimonial">
                            <div class="testimonial-img">
                              <img src="img/GajananChaudhari.jpg" alt="img">
                            </div>
                            <div class="testimonial-content">
                              <h3>Gajanan Chaudhari</h3>
                              <span>Magarpatta, Pune</span>
                              <p style="height: 200px;">"Service - quality, timely and round the clock service. Filing fee cost - reasonable, special fees should be little low. Team knowledge - experienced team to sort out all kind of issues. Glad to associate with the firm for opting timely quality IT services. Looking forward to continue association in future too. Overall remarks - very much satisfied."
							  </p>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="single-testimonial">
                            <div class="testimonial-img">
                              <img src="img/AyagSutar.png" alt="img">
                            </div>
                            <div class="testimonial-content">
                              <h3>Ayaj Sutar</h3>
                              <span>Pune</span>
                              <p style="height: 200px;">"About service, it is excellent, fast &amp; on time.  Fee is very low compared to the current daily expenditures, which can be paid by NEFT also and I paid through NEFT only. OnlineITFiling team is very competitive. Filling was done with an ease from office/ home and really felt relaxed. Thus saves time of a busy person.  Team people are very co-operative &amp; always ready with updates. So, I really not needed to call now & then."
							  </p>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="single-testimonial">
                            <div class="testimonial-img">
                              <img src="img/AmolAher.jpg" alt="img">
                            </div>
                            <div class="testimonial-content">
                              <h3>Amol Aher</h3>
                              <span>Nagpur</span>
                              <p style="height: 200px;">"Overall feedback very happy.  Good service, good knowlegable team.  Cost is very low compared to other expenditures.  Also like the process of follow up.  Best of luck OnlineITFiling.in. I support this firm."
							  </p>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="single-testimonial">
                            <div class="testimonial-img">
                              <img src="img/GaneshDange.jpg" alt="img">
                            </div>
                            <div class="testimonial-content">
                              <h3>Ganesh Dange</h3>
                              <span>Mumbai</span>
                              <p style="height: 200px;">"OnlineITFiling have excellent service.  Filing fee is very reasonable.  Team possesses good knowledge.  They offer very fast and prompt service as per convenience. No document exchange hassle as well, almost online.   They should also think to take up good and secured investment plan options helping people to invest right at office doorstep."
							  </p>
                            </div>
                          </div>
                        </div> 
                      </div>
                      <div class="customNavigation">
                        <a class="btn prev2 btn-floating waves-effect waves-light btn-large white"><i class="mdi-navigation-chevron-left brand-text"></i></a>
                        <a class="btn next2 btn-floating waves-effect waves-light btn-large white"><i class="mdi-navigation-chevron-right brand-text"></i></a>
                      </div>                  
                    </div>
                 </div>
               </div>
               </div> 
            </div>
          </section>
          <!-- Start Blog -->
          <!-- <section id="blog">
            <div class="container">
              <div class="row">
               <div class="col s12">
                 <div class="blog-inner">
                   <h2 class="title">Blog</h2>
                   <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>

                  <!-- Start Blog area -- >
                  <div class="blog-area">
                    <div class="row">
                      <!-- Start single blog post -- >
                      <div class="col s12 m4 l4">
                        <div class="blog-post">
                          <div class="card">
                            <div class="card-image">
                              <img src="img/blog1.jpg">     
                            </div>
                            <div class="card-content blog-post-content">
                              <h2><a href="blog-single.html">Awesome Post Title</a></h2>
                              <div class="meta-media">
                                <div class="single-meta">
                                  Post By <a href="#">Admin</a>
                                </div>
                                <div class="single-meta">
                                  Category : <a href="#">Web/Design</a>
                                </div>
                              </div>
                              <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here.</p>
                            </div>
                            <div class="card-action">
                              <a class="post-comment" href="#"><i class="material-icons">comment</i><span>15</span></a>
                              <a class="readmore-btn" href="blog-single.html">Read More</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Start single blog post -- >
                      <div class="col s12 m4 l4">
                        <div class="blog-post">
                          <div class="card">
                            <div class="card-image">
                              <img src="img/blog2.jpg">     
                            </div>
                            <div class="card-content blog-post-content">
                              <h2><a href="blog-single.html">Awesome Post Title</a></h2>
                              <div class="meta-media">
                                <div class="single-meta">
                                  Post By <a href="#">Admin</a>
                                </div>
                                <div class="single-meta">
                                  Category : <a href="#">Web/Design</a>
                                </div>
                              </div>
                              <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here.</p>
                            </div>
                            <div class="card-action">
                              <a class="post-comment" href="#"><i class="material-icons">comment</i><span>10</span></a>
                              <a class="readmore-btn" href="blog-single.html">Read More</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Start single blog post -- >
                      <div class="col s12 m4 l4">
                        <div class="blog-post">
                          <div class="card">
                            <div class="card-image">
                              <img src="img/blog3.jpg">     
                            </div>
                            <div class="card-content blog-post-content">
                              <h2><a href="blog-single.html">Awesome Post Title</a></h2>
                              <div class="meta-media">
                                <div class="single-meta">
                                  Post By <a href="#">Admin</a>
                                </div>
                                <div class="single-meta">
                                  Category : <a href="#">Web/Design</a>
                                </div>
                              </div>
                              <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here.</p>
                            </div>
                            <div class="card-action">
                              <a class="post-comment" href="#"><i class="material-icons">comment</i><span>15</span></a>
                              <a class="readmore-btn" href="blog-single.html">Read More</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- All Post Button -- >
                    <a class="waves-effect waves-light btn-large allpost-btn" href="blog-archive.html">All Post</a>
                  </div>                    
                 </div>
                </div>
              </div> 
            </div>
          </section>	-->
          <!-- Start Footer -->
          <footer id="footer" role="contentinfo">
            <!-- Start Footer Top -->
            <div class="footer-top">
              <div class="container">
                <div class="row">
                  <div class="col s12">
                    <div class="footer-top-inner">
                      <h2 class="title"><font color="black"><strong>Contact</strong><font></h2>
                      <!--<p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>-->
                      <div class="contact">

                        <div class="row">
                          <div class="col s12 m6 l6">
                            <!--<div class="contact-map">
                              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3281.297314036103!2d-86.74954699999999!3d34.672444999999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88626565a94cdb25%3A0x74c206053b6a97c9!2s305+Intergraph+Way%2C+Madison%2C+AL+35758%2C+USA!5e0!3m2!1sen!2sbd!4v1431591462160" width="100%" height="100%" frameborder="0" style="border:0"></iframe>
                            </div>-->
						<strong>Email ID – <a href="mailto:support@OnlineITFiling.in">support@OnlineITFiling.in</a><br> Number – 0712-2721026; 9130132056 / 59 <br>
						What’s App number – 9130132056<br>
						<p>Address - <br>
						Block #33, Near M. G. High School, Jaripatka, Nagpur – 440014<br>
						<p>Address - <br>
						Sushil Chandwani &amp; Co. <br>2nd Floor, DF Palace, Opp Haldirams, Gandhibaugh, Nagpur – 440002</p></strong>
                          </div>
                          <div class="col s12 m6 l6">
							<p><font size="4"><strong>Write us for queries - </strong></font></p>
                            <div class="contact-form">
                              <form name="contactForm" id="contactForm" method="POST">
                                <div class="input-field">
                                  <input type="text" class="input-box" name="contactName" id="contact-name" maxlength="60">
                                  <label class="input-label" for="contact-name">* Name</label>
                                </div>
                                <div class="input-field">
                                  <input type="text" class="input-box" name="contactEmail" id="email" maxlength="100">
                                  <label class="input-label" for="email">* Email</label>
                                </div>
                                <div class="input-field">
                                  <input type="text" class="input-box" name="contactNumber" id="subject" maxlength="100">
                                  <label class="input-label" for="subject">Contact Number</label>
                                </div>
                                <div class="input-field">
                                  <input type="text" class="input-box" name="contactSubject" id="subject" maxlength="100">
                                  <label class="input-label" for="subject">Subject</label>
                                </div>
                                <div class="input-field textarea-input">
                                  <textarea class="materialize-textarea" name="contactMessage" id="textarea1" maxlength="150"></textarea>
                                  <label class="input-label" for="textarea1">* Message</label>
                                </div>
                                <button class="left waves-effect btn-flat brand-text submit-btn" type="submit">send message</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Start Footer Bottom -->
            <div class="footer-bottom">
              <div class="container">
                <div class="row">
                  <div class="col s12">
                    <div class="footer-inner">
                      <!-- Bottom to Up Btn -->
                      <button class="btn-floating btn-large up-btn"><i class="mdi-navigation-expand-less"></i></button>
                      <p align="center">
					  <img src="img/ERI Authorized1.png">&nbsp;&nbsp;<img src="img/ERIAuthorized.png"> &nbsp;&nbsp;&nbsp;
					  <a href="privacyPolicy.html" target="_blank">Privacy Policy</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="refundPolicy.html" target="_blank">Refund Policy</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="termsandconditions.html" target="_blank">General Terms & Conditions</a></p>
					  <p><font size="1">Designed By <a href="http://www.markups.io/">MarkUps.io</a></font></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </footer>
        </main>
      </div>
      <!-- jQuery Library -->
      <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
      <!-- Materialize js -->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <!-- Skill Progress Bar -->
      <script src="js/appear.min.js" type="text/javascript"></script>
      <script src="js/pro-bars.min.js" type="text/javascript"></script>
      <!-- Owl slider -->      
      <script src="js/owl.carousel.min.js"></script>    
      <!-- Mixit slider  -->
      <script src="js/jquery.mixitup.min.js"></script>
      <!-- counter -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>     

      <!-- Custom Js -->
      <script src="js/custom.js"></script>      
    </body>
  </html>