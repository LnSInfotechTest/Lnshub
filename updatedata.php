<?php
require_once("connection.php");
session_start();

//print_r($_REQUEST);

if(!isset($_SESSION['admin']) || $_SESSION['admin']=="")
{
	//print_r($_REQUEST);
	echo "<script>window.location='login.php';</script>";
}
  
  if(isset($_REQUEST['submit']) && ($_REQUEST['submit']=='submit'))
      {
        if(isset($_REQUEST['FieldName']))
        {
          $field = str_replace(' ', '', ($_REQUEST['FieldName']));          
          $updateQry="UPDATE personalinformation set ".$field."='".$_REQUEST['NData']."'WHERE PAN='".$_REQUEST['PAN']."';";
          $selectRes = mysqli_query($con,$updateQry);
    
          if(!$selectRes)
          {
            printf("Errormessage: %s\n", $con->error);
          }
          else
          {
            echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
            echo "<script>window.location='updatedata.php';</script>";

          }
        }

       elseif (isset($_REQUEST['fieldupdate'])&& isset($_REQUEST['PAN']))
        { 
               
          $selectQry="SELECT * from personalinformation where PAN='".$_REQUEST['PAN']."'";
          $selectRes = mysqli_query($con,$selectQry);
    
          if(!$selectRes)
          {
            printf("Errormessage: %s\n", $con->error);
          }
          else
          {
            $userData=mysqli_fetch_array($selectRes,MYSQLI_ASSOC);
          }
        }
 
        elseif(isset($_REQUEST['PAN']))
          {
            //echo $_REQUEST['PAN'];
            $selectQry="SELECT * from personalinformation where PAN='".$_REQUEST['PAN']."'";
            $selectRes = mysqli_query($con,$selectQry);
      
            if(!$selectRes)
            {
              printf("Errormessage: %s\n", $con->error);
            }
            else
            {
              $userData=mysqli_fetch_array($selectRes,MYSQLI_ASSOC);
            }
          }
        }



?>

<!DOCTYPE html>
  <html>
    <head>  
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	  <meta name="description" content="OnlineITFiling Filing">
	  <meta name="keywords" content="OnlineITFiling,Filing">
	  <meta name="author" content="Jeet Chandwani">
      <title>Online IT Filing : Filing Status</title>

	  <script src="js/jquery-1.9.1.js"></script>
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
	  <!-- For datePicker	-->
    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	  <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js"></script -->
	  <link rel="stylesheet" href="css/jquery-ui.css">
	  <script src="js/jquery-ui.js"></script>
    

      <!-- Extra css & JS File -->
      <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	  <script src="js/validation.js"></script>
    <script src="js/additional-methods.js"></script>

      <!-- Font -->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <script>
	var $j = jQuery.noConflict();

	function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
		
		if($("#txtMobileNo").val().length ==0)
		{
			if(charCode == 48)
				return false;
			else
				return true;
		}
		else if($("#txtMobileNo").val().length > 0)
		{
			if($("#txtMobileNo").val().charAt(0)==0)
			{
				while($("#txtMobileNo").val().charAt(0) === '0')
				{
					$("#txtMobileNo").val() = $("#txtMobileNo").val().substr(1);
				}
			}
		}
	}
	$j(function() {
		$j("#datePicker").datepicker({
			changeMonth: false,
			changeYear: true,
			yearRange: "1910:2018",
			autoSize: true,
			dateFormat: 'dd-mm-yy' 
		});
	});

	(function($,W,D)
	{
		var JQUERY4U = {};

		JQUERY4U.UTIL =
		{
			setupFormValidation: function()
			{	
				//form validation rules
				$("#dataUpdate").validate({
					rules: {
						PAN: {
							pan: true,
							required: true,
							minlength: 10,
							maxlength:10
            }
            <?php
            if(isset($_REQUEST['fieldupdate']) && isset($_REQUEST['PAN']) && !isset($_REQUEST['FieldName']))
            {
            
              switch($_REQUEST['fieldupdate'])
               {
                 case 'Birth Date':
            echo ",
            NData:'required'";
            break;
            
            case 'First Name':
            echo ",
						NData: {
							required: true,
							lettersonly: true,
							maxlength:30
            }";
            break;
            case 'Middle Name':
            echo ",
						NData: {
							lettersonly: true,
							maxlength:30
            }";
            break;
            case 'Father Name':
            echo",
						NData: {
							required: true,
							lettersonly: true,
							maxlength:50
            }";
            break;
            case 'Last Name':
            echo",
						NData: {
							required: true,
							lettersonly: true,
							maxlength:30
            }";
            break;
            case 'Mobile':
            echo",
						NData: {
							required:true, 
							integer: true,
                            minlength:10,
                            maxlength:10
            }";
            break;
            case 'Contact Number':
            echo ",
						NData: {
							integer: true,
                            minlength:10,
                            maxlength:10
            }";
            break;
            case 'Aadhaar Number':
            echo ",
						NData: {
							required:true,
							integer: true,
                            minlength:12,
                            maxlength:12
            }";
            break;
            case 'Email':
            echo ",
						NData: {
							required: true,
							email: true
            }";
            break;
            case 'Gender':
            echo ",
						NData: {
							required: true
            }";
            break;
          }
        }
            ?>
					},
					messages: {
						PAN: 'Please enter valid PAN card number'
           <?php if(isset($_REQUEST['fieldupdate']) && isset($_REQUEST['PAN']) && !isset($_REQUEST['FieldName']))
                {
                  switch($_REQUEST['fieldupdate'])
                  {
                    case 'Birth Date':
                    echo ",
                    NData: 'Please enter your Date of birth'";
                    break;
                    case 'First Name':
                    echo ",            
                    NData: 'Please enter your valid First Name'";
                    break;
                    case 'Father Name':
                    echo ",
                    NData: 'Please enter your valid Father\'s name'";
                    break;
                    case 'Last Name':
                    echo ",
                    NData: 'Please enter your valid Last Name'";
                    break;
                    case 'Email':
                    echo ",
                    NData: 'Please enter a valid Email Address'";
                    break;
                    case 'Mobile':
                    echo ",
                    NData: 'Please enter 10 digit Mobile Number'";
                    break;
                    case 'Contact Number':
                    echo ",
                    NData: 'Please enter 10 digit Number'";
                    break;
                    case 'Aadhaar Number':
                    echo ",
                    NData: 'Please enter 12 digit Number'";
                    break;
                    case 'Gender':
                    echo ",
                    NData: 'Please select Gender'";
                    break;
                  }
                }
            ?>
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
                <a href="index.php" class="brand-logo"><img src="img/logo.gif"></a>
                
                <!-- Image Based Logo -->                
                 <!-- <a href="index.html" class="brand-logo"><img src="img/logo.jpeg" alt="logo img"></a>  -->
                <ul class="right hide-on-med-and-down custom-nav">
				  <?php if(strtolower($_SESSION['adminType']) == "admin")	{	?>
				  <li><a href="filingCharges.php">Filing Charges</a></li>
				  <li><a href="updatedata.php">updatedata</a></li>
				  <li><a href="adminUser.php">Users</a></li>
				  <?php	}	?>
                  <li><a href="filingStatus.php">Filing Status</a></li>
                  <li><a href="logout.php">Logout</a></li>
                </ul>
                <!-- For Mobile View -->
                <ul id="slide-out" class="side-nav menu-scroll">
				  <?php if(strtolower($_SESSION['adminType']) == "admin")	{	?>
				  <li><a href="filingCharges.php">Filing Charges</a></li>
				  <li><a href="updatedata.php">updatedata</a></li>
				  <li><a href="adminUser.php">Users</a></li>
				  <?php	}	?>
                  <li><a href="filingStatus.php">Filing Status</a></li>
                  <li><a href="logout.php">Logout</a></li>
				</ul>
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
              </div>
            </div>
          </nav>
        </div>
      </header>


      <section id="blog-details">
            <div class="container">
              <div class="row">
                <div class="col s28 m18 28">
                  <div class="blog-content">

<div class="main-wrapper">
 <form name="dataUpdate" id="dataUpdate" method="POST">
 				<p><table>
         
                <tr><td>PAN NUMBER:</td><td><input id="PAN" type="text" name="PAN" <?php if(isset($_REQUEST['PAN'])){echo "value=".$_REQUEST['PAN']." readonly='true'";}?>></td></tr>
                <?php
                if(isset($_REQUEST['PAN']) && !isset($_REQUEST['fieldupdate']) && !isset($_REQUEST['FieldName'])){
                echo "<tr><td>First Name:</br></td><td><input type='text' name='FirstName' id='FirstName' readonly='true' value='".$userData['FirstName']."'></br></td>
                 <td>&nbsp&nbsp&nbsp&nbsp Middle Name: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</br></td><td><input type='text' name='MiddleName' id='MiddleName' readonly='true' value='".$userData['MiddleName']."'></td></tr>
                 <tr><td>Last Name:</br></td><td><input type='text' name='LastName' id='LastName' readonly='true' value='".$userData['LastName']."'></br></td>
                 <td>&nbsp&nbsp&nbsp&nbsp Father Name: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</br></td><td><input type='text' name='FatherName' id='FatherName' readonly='true' value='".$userData['FatherName']."'></td></tr>
                 <tr><td>Mobile:</br></td><td><input type='text' name='Mobile' id='Mobile' readonly='true' value='".$userData['Mobile']."'></br></td>
                 <td>&nbsp&nbsp&nbsp&nbsp Contact Number: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</br></td><td><input type='text' name='PContactNumber' id='ContactNumber' readonly='true' value='".$userData['ContactNumber']."'></td></tr>
                 <tr><td>Birth Date:</br></td><td><input type='text' name='BirthDate' id='BirthDate' readonly='true' value='".$userData['BirthDate']."'></br></td>
                 <td>&nbsp&nbsp&nbsp&nbsp Email: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</br></td><td><input type='text' name='Email' id='Email' readonly='true' value='".$userData['Email']."'></td></tr>
                 <tr><td>Gender:</br></td><td><input type='text' name='Gender' id='Gender' readonly='true' value='".$userData['Gender']."'></br></td>
                 <td>&nbsp&nbsp&nbsp&nbsp Aadhaar Number: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</br></td><td><input type='text' name='AadhaarNumber' id='AadhaarNumber' readonly='true' value='".$userData['AadhaarNumber']."'></td></tr>
                 <tr><td>Select Field to Update:</br></td><td><select name='fieldupdate' id='fieldupdate'>
                <option name=''>Select Field to Update</option>
                <option name='FirstName'>First Name</option>
                <option name='MiddleName'>Middle Name</option>
                <option name='LastName'>Last Name</option>
                <option name='FatherName'>Father Name</option>
                <option name='Mobile'>Mobile</option>
                <option name='ContactNumber'>Contact Number</option
                ><option name='BirthDate'>Birth Date</option>
                <option name='Email'>Email</option>
                <option name='Gender'>Gender</option>
                <option name='AadhaarNumber'>Aadhaar Number</option></td></tr>";
                }
                if(isset($_REQUEST['fieldupdate']) && isset($_REQUEST['PAN']) && !isset($_REQUEST['FieldName']))
                {
                 echo "<input type='hidden' name='FieldName' id='FieldName' value='".$_REQUEST['fieldupdate']."'>";
                  switch($_REQUEST['fieldupdate'])
                   {
                     case 'First Name':
                     echo "<tr><td>First Name<td></td></td></tr><tr><td>Current:</td><td><input type='text' name='FirstName' id='FirstName' value='".$userData['FirstName']."'>
                     </td></tr><tr><td>New:</td><td><input type='text' name='NData' id='NData'></td></tr>";
                     break;
                     case 'Middle Name':
                     echo "<tr><td>Middle Name<td></td></td></tr><tr><td>Current:</td><td><input type='text' name='MiddleName' id='Middle Name' value='".$userData['MiddleName']."'>
                     </td></tr><tr><td>New:</td><td><input type='text' name='NData' id='NData'></td></tr>";
                     break;
                     case 'Last Name':
                     echo "<tr><td>Last Name<td></td></td></tr><tr><td>Current:</td><td><input type='text' name='LastName' id='LastName' value='".$userData['LastName']."'>
                     </td></tr><tr><td>New:</td><td><input type='text' name='NData' id='NData'></td></tr>";
                     break;
                     case 'Father Name':
                     echo "<tr><td>Father Name<td></td></td></tr><tr><td>Current:</td><td><input type='text' name='FatherName' id='FatherName' value='".$userData['FatherName']."'>
                     </td></tr><tr><td>New:</td><td><input type='text' name='NData' id='NData'></td></tr>";
                     break;
                     case 'Mobile':
                     echo "<tr><td>Mobile<td></td></td></tr><tr><td>Current:</td><td><input type='text' name='Mobile' id='Mobile' value='".$userData['Mobile']."'>
                     </td></tr><tr><td>New:</td><td><input type='text' name='NData' id='NData'></td></tr>";
                     break;
                     case 'Contact Number':
                     echo "<tr><td>Contact Number<td></td></td></tr><tr><td>Current:</td><td><input type='text' name='ContactNumber' id='ContactNumber' value='".$userData['ContactNumber']."'>
                     </td></tr><tr><td>New:</td><td><input type='text' name='NData' id='NData'></td></tr>";
                     break;
                     case 'Birth Date':
                     echo "<tr><td>Birth Date<td></td></td></tr><tr><td>Current:</td><td><input type='text' name='BirthDate' id='BirthDate' value='".$userData['BirthDate']."'>
                     </td></tr><tr><td>New:</td><td><input type='text' id='datePicker' placeholder='dd-mm-yyyy' name='NData' width='100px' readonly='true'/>";
                     break;
                     case 'Email':
                     echo "<tr><td>Email<td></td></td></tr><tr><td>Current:</td><td><input type='text' name='Email' id='Email' value='".$userData['Email']."'>
                     </td></tr><tr><td>New:</td><td><input type='text' name='NData' id='NData'></td></tr>";
                     break;
                     case 'Gender':
                     echo "<tr><td>Gender<td></td></td></tr><tr><td>Current:</td><td><input type='text' name='Gender' id='Gender' value='".$userData['Gender']."'>
                     </td></tr><tr><td>New:</td><td>	<input type='radio' id='NData' name='NData' value='Male' /> Male

                     <input type='radio' id='NData' name='NData' value='Female'/> Female</td></tr>";
                     break;
                     case 'Aadhaar Number':
                     echo "<tr><td>Aadhaar Number<td></td></td></tr><tr><td>Current:</td><td><input type='text' name='NAadhaarNumber' id='NAadhaarNumber' value='".$userData['AadhaarNumber']."'>
                     </td></tr><tr><td>New:</td><td><input type='text' name='NData' id='NData'></td></tr>";
                     break;
                     default:
                     echo "No value is selected";
                   }
                }
                ?>
                </table>
                <tr><td>

<p>
            <div align="center" style="margin-left:25px">
						<button class="left waves-effect btn-flat brand-text submit-btn" type="submit" name="submit" value="submit">Submit</button>
						<button class="left waves-effect btn-flat brand-text submit-btn" type="Reset" style="margin-left:5px">Reset</button>
					</div>
				</p>
				  </form>

</div>
</div></div></div></div></section>

      <?php
		   require_once("footer.html");
		  ?>
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