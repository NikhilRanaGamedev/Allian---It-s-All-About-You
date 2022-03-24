<?php
  ob_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Allian: All About You</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
    body {
    	background: radial-gradient(rgba(0, 0, 0, 0.5) 48%, rgba(0, 0, 0, 1) 100%), url("images/background.jpg") fixed no-repeat;
      background-position: center;
    	background-size: cover;
    	width: 100%;
    	min-height: 550px;
    	position: relative;
    	top: 0;
    }

    #navbar {
      background: transparent;
      margin-top: 15px;
    }

    #navbar .container .collapse ul li a:hover {
      color: #fff;
    }

    #navbar .container .collapse .navbar-form .form-group .fa-search {
    	position: relative;
    	top: 2px;
    	left: 30px;
      color: #fff;
    }
    </style>
  </head>
  <body>
    <?php
      include "connect.php";
    ?>

    <!-- Log In Modal -->
    <div id="log_in" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <div class="col-md-offset-2">
                  <h1>Login</h1>
                </div>
              </div>
              <div class="col-md-4 col-md-offset-4">
                <p>
                  Log into your account
                </p>
              </div>
              <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="col-md-6 col-md-offset-3">
                  <div class="form-group">
                    <input class="form-control" type="email" name="login_email" placeholder="Email" value="nightpredetor@gmail.com" required oninvalid="this.setCustomValidity('Email is Required')"
                    oninput="this.setCustomValidity('')"/>
                  </div>
                </div>
                <div class="col-md-6 col-md-offset-3">
                  <div class="form-group has-feedback">
                    <input id="login_password" class="form-control" type="password" name="login_password" placeholder="Password" value="Nikhiliscool123" required oninvalid="this.setCustomValidity('Password is Required')"
                    oninput="this.setCustomValidity('')"/>
                    <i class="fas fa-eye-slash form-control-feedback"></i>
                  </div>
                </div>
                <div class="col-md-6 col-md-offset-3">
                  <p><a href="#">Forgot Password?</a></p>
                </div>
                <div class="col-md-6 col-md-offset-3">
                  <button type="submit" name="btn_login" class="btn btn-primary">Login</button>
                </div>
            </form>
            <?php
              if($_SERVER["REQUEST_METHOD"]=="POST") {
                if(isset($_POST["btn_login"])) {
                  $login_email = $_REQUEST["login_email"];
                  $login_password = $_REQUEST["login_password"];
                  $sql = "SELECT * FROM user_info where email = '$login_email' && password = '$login_password'";
                  $log_in = mysqli_query($conn, $sql);

                  if(mysqli_num_rows($log_in) == 1) {
                    session_start();
                    $row = mysqli_fetch_assoc($log_in);
                    $user_id = $row['user_id'];
                    $username = $row['first_name']." ".$row['last_name'];
                    $_SESSION["user_id"] = $user_id;
                    $_SESSION["username"] = $username;
                    $_SESSION["status"] = "active";

                    header("Location: timeline.php", false);
                    exit();
                  } else {
                    //echo "<script type='text/javascript'>alert('Wrong Username or Password')</script>";
                  }
                }
              }
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navbar -->
    <nav id="navbar" class="nav navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <i class="icon-bar"></i>
            <i class="icon-bar"></i>
            <i class="icon-bar"></i>
          </button>
          <a class="navbar-brand" href="#"><img class="img-responsive" src="images/logo.jpg" /></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="#" data-toggle="modal" data-target="#log_in">Newsfeed</a>
            </li>
            <li>
              <a href="#" data-toggle="modal" data-target="#log_in">Timeline</a>
            </li>
            <li>
              <a href="#" data-toggle="modal" data-target="#log_in">Meet People</a>
            </li>
            <li>
              <a href="#">Contact</a>
            </li>
          </ul>
          <form class="navbar-form navbar-right hidden-sm">
            <div class="form-group">
              <i class="fas fa-search"></i>
              <input type="text" class="form-control" placeholder="Search friends, photos, videos">
            </div>
          </form>
        </div>
      </div>
    </nav>

    <!--Body -->
    <div class="content">
      <div class="inner">
        <div class="row">
          <div class="col-md-6">
            <div class="intro">
              <h1>Welcome to Allian!</h1>
              <br />
              <p>
                Allian is a social network template that can be used to connect people.
              </p>
              <p>
                The template offers Landing pages, News Feed, Image/Video Feed, Chat Box, Timeline and lot more.
              </p>
              <p>
                <br />
                <br />
                Already a member? <a href="#" data-toggle="modal" data-target="#log_in">Log In!</a>
              </p>
            </div>
          </div>
          <div class="col-md-6">
              <div class="tab">
                <h1>Register Now !!!</h1>
                <p>
                  Join the world and find yourself!
                </p>
                <div class="row">
                  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input class="form-control" type="text" name="first_name" placeholder="First Name" required pattern="[A-Za-z]{3,30}" title="Username can only contain letters" value="Nikhil" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input class="form-control" type="text" name="last_name" placeholder="Last Name" required pattern="[A-Za-z]{3,30}" value="Rana" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input class="form-control" type="email" name="signup_email" placeholder="Email" required oninvalid="this.setCustomValidity('Email is required')"
                        oninput="this.setCustomValidity('')" value="nightpredetor@gmail.com" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input id="signup_password" class="form-control" type="password" name="signup_password" placeholder="Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="Nikhiliscool123" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input id="signup_confirm_password" class="form-control" type="password" name="signup_confirm_password" placeholder="Confirm Password" required value="Nikhiliscool123" />
                      </div>
                    </div>
                    <script>
                      // Sign Up Patterns and Validations
                      var password = document.getElementById("signup_password")
                        , confirm_password = document.getElementById("signup_confirm_password");

                      function validatePassword(){
                        if(password.value != confirm_password.value) {
                          confirm_password.setCustomValidity("Passwords Don't Match");
                        } else {
                          confirm_password.setCustomValidity('');
                        }
                      }

                      password.onchange = validatePassword;
                      confirm_password.onkeyup = validatePassword;
                    </script>
                    <div class="col-md-12">
                      <input type= "date" class="form-control" name="dob" min="1900-01-01" max="2001-01-01" required oninvalid="this.setCustomValidity('Date of Birth is Required')"
                      oninput="this.setCustomValidity('')"value="1999-03-22" />
                    </div>
                  <div class="col-md-12">
                    <br />
                    <label class="radio-inline">
                     <input type="radio" name="gender" value="male" required checked="checked"><strong>Male</strong>
                   </label>
                   <label class="radio-inline">
                     <input type="radio" name="gender" value="female" required><strong>Female</strong>
                   </label>
                   <label class="radio-inline">
                     <input type="radio" name="gender" value="other" required><strong>Other</strong>
                   </label>
                   <br />
                   <br />
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" name="city" placeholder="Your city" required oninvalid="this.setCustomValidity('City must be specified')"
                      oninput="this.setCustomValidity('')" value="New Delhi" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="country" required oninvalid="this.setCustomValidity('Country must be specified')"
                    oninput="this.setCustomValidity('')">
                        <option value="" disabled selected>Country</option>
                        <option value="Afghanistan" title="Afghanistan">Afghanistan</option>
          							<option value="Åland Islands" title="Åland Islands">Åland Islands</option>
          							<option value="Albania" title="Albania">Albania</option>
          							<option value="Algeria" title="Algeria">Algeria</option>
          							<option value="American Samoa" title="American Samoa">American Samoa</option>
          							<option value="Andorra" title="Andorra">Andorra</option>
          							<option value="Angola" title="Angola">Angola</option>
          							<option value="Anguilla" title="Anguilla">Anguilla</option>
          							<option value="Antarctica" title="Antarctica">Antarctica</option>
          							<option value="Antigua and Barbuda" title="Antigua and Barbuda">Antigua and Barbuda</option>
          							<option value="Argentina" title="Argentina">Argentina</option>
          							<option value="Armenia" title="Armenia">Armenia</option>
          							<option value="Aruba" title="Aruba">Aruba</option>
          							<option value="Australia" title="Australia">Australia</option>
          							<option value="Austria" title="Austria">Austria</option>
          							<option value="Azerbaijan" title="Azerbaijan">Azerbaijan</option>
          							<option value="Bahamas" title="Bahamas">Bahamas</option>
          							<option value="Bahrain" title="Bahrain">Bahrain</option>
          							<option value="Bangladesh" title="Bangladesh">Bangladesh</option>
          							<option value="Barbados" title="Barbados">Barbados</option>
          							<option value="Belarus" title="Belarus">Belarus</option>
          							<option value="Belgium" title="Belgium">Belgium</option>
          							<option value="Belize" title="Belize">Belize</option>
          							<option value="Benin" title="Benin">Benin</option>
          							<option value="Bermuda" title="Bermuda">Bermuda</option>
          							<option value="Bhutan" title="Bhutan">Bhutan</option>
          							<option value="Bolivia, Plurinational State of" title="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
          							<option value="Bonaire, Sint Eustatius and Saba" title="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
          							<option value="Bosnia and Herzegovina" title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
          							<option value="Botswana" title="Botswana">Botswana</option>
          							<option value="Bouvet Island" title="Bouvet Island">Bouvet Island</option>
          							<option value="Brazil" title="Brazil">Brazil</option>
          							<option value="British Indian Ocean Territory" title="British Indian Ocean Territory">British Indian Ocean Territory</option>
          							<option value="Brunei Darussalam" title="Brunei Darussalam">Brunei Darussalam</option>
          							<option value="Bulgaria" title="Bulgaria">Bulgaria</option>
          							<option value="Burkina Faso" title="Burkina Faso">Burkina Faso</option>
          							<option value="Burundi" title="Burundi">Burundi</option>
          							<option value="Cambodia" title="Cambodia">Cambodia</option>
          							<option value="Cameroon" title="Cameroon">Cameroon</option>
          							<option value="Canada" title="Canada">Canada</option>
          							<option value="Cape Verde" title="Cape Verde">Cape Verde</option>
          							<option value="Cayman Islands" title="Cayman Islands">Cayman Islands</option>
          							<option value="Central African Republic" title="Central African Republic">Central African Republic</option>
          							<option value="Chad" title="Chad">Chad</option>
          							<option value="Chile" title="Chile">Chile</option>
          							<option value="China" title="China">China</option>
          							<option value="Christmas Island" title="Christmas Island">Christmas Island</option>
          							<option value="Cocos (Keeling) Islands" title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
          							<option value="Colombia" title="Colombia">Colombia</option>
          							<option value="Comoros" title="Comoros">Comoros</option>
          							<option value="Congo" title="Congo">Congo</option>
          							<option value="Congo, the Democratic Republic of the" title="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
          							<option value="Cook Islands" title="Cook Islands">Cook Islands</option>
          							<option value="Costa Rica" title="Costa Rica">Costa Rica</option>
          							<option value="Côte d'Ivoire" title="Côte d'Ivoire">Côte d'Ivoire</option>
          							<option value="Croatia" title="Croatia">Croatia</option>
          							<option value="Cuba" title="Cuba">Cuba</option>
          							<option value="Curaçao" title="Curaçao">Curaçao</option>
          							<option value="Cyprus" title="Cyprus">Cyprus</option>
          							<option value="Czech Republic" title="Czech Republic">Czech Republic</option>
          							<option value="Denmark" title="Denmark">Denmark</option>
          							<option value="Djibouti" title="Djibouti">Djibouti</option>
          							<option value="Dominica" title="Dominica">Dominica</option>
          							<option value="Dominican Republic" title="Dominican Republic">Dominican Republic</option>
          							<option value="Ecuador" title="Ecuador">Ecuador</option>
          							<option value="Egypt" title="Egypt">Egypt</option>
          							<option value="El Salvador" title="El Salvador">El Salvador</option>
          							<option value="Equatorial Guinea" title="Equatorial Guinea">Equatorial Guinea</option>
          							<option value="Eritrea" title="Eritrea">Eritrea</option>
          							<option value="Estonia" title="Estonia">Estonia</option>
          							<option value="Ethiopia" title="Ethiopia">Ethiopia</option>
          							<option value="Falkland Islands (Malvinas)" title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
          							<option value="Faroe Islands" title="Faroe Islands">Faroe Islands</option>
          							<option value="Fiji" title="Fiji">Fiji</option>
          							<option value="Finland" title="Finland">Finland</option>
          							<option value="France" title="France">France</option>
          							<option value="French Guiana" title="French Guiana">French Guiana</option>
          							<option value="French Polynesia" title="French Polynesia">French Polynesia</option>
          							<option value="French Southern Territories" title="French Southern Territories">French Southern Territories</option>
          							<option value="Gabon" title="Gabon">Gabon</option>
          							<option value="Gambia" title="Gambia">Gambia</option>
          							<option value="Georgia" title="Georgia">Georgia</option>
          							<option value="Germany" title="Germany">Germany</option>
          							<option value="Ghana" title="Ghana">Ghana</option>
          							<option value="Gibraltar" title="Gibraltar">Gibraltar</option>
          							<option value="Greece" title="Greece">Greece</option>
          							<option value="Greenland" title="Greenland">Greenland</option>
          							<option value="Grenada" title="Grenada">Grenada</option>
          							<option value="Guadeloupe" title="Guadeloupe">Guadeloupe</option>
          							<option value="Guam" title="Guam">Guam</option>
          							<option value="Guatemala" title="Guatemala">Guatemala</option>
          							<option value="Guernsey" title="Guernsey">Guernsey</option>
          							<option value="Guinea" title="Guinea">Guinea</option>
          							<option value="Guinea-Bissau" title="Guinea-Bissau">Guinea-Bissau</option>
          							<option value="Guyana" title="Guyana">Guyana</option>
          							<option value="Haiti" title="Haiti">Haiti</option>
          							<option value="Heard Island and McDonald Islands" title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
          							<option value="Holy See (Vatican City State)" title="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
          							<option value="Honduras" title="Honduras">Honduras</option>
          							<option value="Hong Kong" title="Hong Kong">Hong Kong</option>
          							<option value="Hungary" title="Hungary">Hungary</option>
          							<option value="Iceland" title="Iceland">Iceland</option>
          							<option value="India" title="India" selected>India</option>
          							<option value="Indonesia" title="Indonesia">Indonesia</option>
          							<option value="Iran, Islamic Republic of" title="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
          							<option value="Iraq" title="Iraq">Iraq</option>
          							<option value="Ireland" title="Ireland">Ireland</option>
          							<option value="Isle of Man" title="Isle of Man">Isle of Man</option>
          							<option value="Israel" title="Israel">Israel</option>
          							<option value="Italy" title="Italy">Italy</option>
          							<option value="Jamaica" title="Jamaica">Jamaica</option>
          							<option value="Japan" title="Japan">Japan</option>
          							<option value="Jersey" title="Jersey">Jersey</option>
          							<option value="Jordan" title="Jordan">Jordan</option>
          							<option value="Kazakhstan" title="Kazakhstan">Kazakhstan</option>
          							<option value="Kenya" title="Kenya">Kenya</option>
          							<option value="Kiribati" title="Kiribati">Kiribati</option>
          							<option value="Korea, Democratic People's Republic of" title="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
          							<option value="Korea, Republic of" title="Korea, Republic of">Korea, Republic of</option>
          							<option value="Kuwait" title="Kuwait">Kuwait</option>
          							<option value="Kyrgyzstan" title="Kyrgyzstan">Kyrgyzstan</option>
          							<option value="Lao People's Democratic Republic" title="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
          							<option value="Latvia" title="Latvia">Latvia</option>
          							<option value="Lebanon" title="Lebanon">Lebanon</option>
          							<option value="Lesotho" title="Lesotho">Lesotho</option>
          							<option value="Liberia" title="Liberia">Liberia</option>
          							<option value="Libya" title="Libya">Libya</option>
          							<option value="Liechtenstein" title="Liechtenstein">Liechtenstein</option>
          							<option value="Lithuania" title="Lithuania">Lithuania</option>
          							<option value="Luxembourg" title="Luxembourg">Luxembourg</option>
          							<option value="Macao" title="Macao">Macao</option>
          							<option value="Macedonia, the former Yugoslav Republic of" title="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
          							<option value="Madagascar" title="Madagascar">Madagascar</option>
          							<option value="Malawi" title="Malawi">Malawi</option>
          							<option value="Malaysia" title="Malaysia">Malaysia</option>
          							<option value="Maldives" title="Maldives">Maldives</option>
          							<option value="Mali" title="Mali">Mali</option>
          							<option value="Malta" title="Malta">Malta</option>
          							<option value="Marshall Islands" title="Marshall Islands">Marshall Islands</option>
          							<option value="Martinique" title="Martinique">Martinique</option>
          							<option value="Mauritania" title="Mauritania">Mauritania</option>
          							<option value="Mauritius" title="Mauritius">Mauritius</option>
          							<option value="Mayotte" title="Mayotte">Mayotte</option>
          							<option value="Mexico" title="Mexico">Mexico</option>
          							<option value="Micronesia, Federated States of" title="Micronesia, Federated States of">Micronesia, Federated States of</option>
          							<option value="Moldova, Republic of" title="Moldova, Republic of">Moldova, Republic of</option>
          							<option value="Monaco" title="Monaco">Monaco</option>
          							<option value="Mongolia" title="Mongolia">Mongolia</option>
          							<option value="Montenegro" title="Montenegro">Montenegro</option>
          							<option value="Montserrat" title="Montserrat">Montserrat</option>
          							<option value="Morocco" title="Morocco">Morocco</option>
          							<option value="Mozambique" title="Mozambique">Mozambique</option>
          							<option value="Myanmar" title="Myanmar">Myanmar</option>
          							<option value="Namibia" title="Namibia">Namibia</option>
          							<option value="Nauru" title="Nauru">Nauru</option>
          							<option value="Nepal" title="Nepal">Nepal</option>
          							<option value="Netherlands" title="Netherlands">Netherlands</option>
          							<option value="New Caledonia" title="New Caledonia">New Caledonia</option>
          							<option value="New Zealand" title="New Zealand">New Zealand</option>
          							<option value="Nicaragua" title="Nicaragua">Nicaragua</option>
          							<option value="Niger" title="Niger">Niger</option>
          							<option value="Nigeria" title="Nigeria">Nigeria</option>
          							<option value="Niue" title="Niue">Niue</option>
          							<option value="Norfolk Island" title="Norfolk Island">Norfolk Island</option>
          							<option value="Northern Mariana Islands" title="Northern Mariana Islands">Northern Mariana Islands</option>
          							<option value="Norway" title="Norway">Norway</option>
          							<option value="Oman" title="Oman">Oman</option>
          							<option value="Pakistan" title="Pakistan">Pakistan</option>
          							<option value="Palau" title="Palau">Palau</option>
          							<option value="Palestinian Territory, Occupied" title="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
          							<option value="Panama" title="Panama">Panama</option>
          							<option value="Papua New Guinea" title="Papua New Guinea">Papua New Guinea</option>
          							<option value="Paraguay" title="Paraguay">Paraguay</option>
          							<option value="Peru" title="Peru">Peru</option>
          							<option value="Philippines" title="Philippines">Philippines</option>
          							<option value="Pitcairn" title="Pitcairn">Pitcairn</option>
          							<option value="Poland" title="Poland">Poland</option>
          							<option value="Portugal" title="Portugal">Portugal</option>
          							<option value="Puerto Rico" title="Puerto Rico">Puerto Rico</option>
          							<option value="Qatar" title="Qatar">Qatar</option>
          							<option value="Réunion" title="Réunion">Réunion</option>
          							<option value="Romania" title="Romania">Romania</option>
          							<option value="Russian Federation" title="Russian Federation">Russian Federation</option>
          							<option value="Rwanda" title="Rwanda">Rwanda</option>
          							<option value="Saint Barthélemy" title="Saint Barthélemy">Saint Barthélemy</option>
          							<option value="Saint Helena, Ascension and Tristan da Cunha" title="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
          							<option value="Saint Kitts and Nevis" title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
          							<option value="Saint Lucia" title="Saint Lucia">Saint Lucia</option>
          							<option value="Saint Martin (French part)" title="Saint Martin (French part)">Saint Martin (French part)</option>
          							<option value="Saint Pierre and Miquelon" title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
          							<option value="Saint Vincent and the Grenadines" title="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
          							<option value="Samoa" title="Samoa">Samoa</option>
          							<option value="San Marino" title="San Marino">San Marino</option>
          							<option value="Sao Tome and Principe" title="Sao Tome and Principe">Sao Tome and Principe</option>
          							<option value="Saudi Arabia" title="Saudi Arabia">Saudi Arabia</option>
          							<option value="Senegal" title="Senegal">Senegal</option>
          							<option value="Serbia" title="Serbia">Serbia</option>
          							<option value="Seychelles" title="Seychelles">Seychelles</option>
          							<option value="Sierra Leone" title="Sierra Leone">Sierra Leone</option>
          							<option value="Singapore" title="Singapore">Singapore</option>
          							<option value="Sint Maarten (Dutch part)" title="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
          							<option value="Slovakia" title="Slovakia">Slovakia</option>
          							<option value="Slovenia" title="Slovenia">Slovenia</option>
          							<option value="Solomon Islands" title="Solomon Islands">Solomon Islands</option>
          							<option value="Somalia" title="Somalia">Somalia</option>
          							<option value="South Africa" title="South Africa">South Africa</option>
          							<option value="South Georgia and the South Sandwich Islands" title="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
          							<option value="South Sudan" title="South Sudan">South Sudan</option>
          							<option value="Spain" title="Spain">Spain</option>
          							<option value="Sri Lanka" title="Sri Lanka">Sri Lanka</option>
          							<option value="Sudan" title="Sudan">Sudan</option>
          							<option value="Suriname" title="Suriname">Suriname</option>
          							<option value="Svalbard and Jan Mayen" title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
          							<option value="Swaziland" title="Swaziland">Swaziland</option>
          							<option value="Sweden" title="Sweden">Sweden</option>
          							<option value="Switzerland" title="Switzerland">Switzerland</option>
          							<option value="Syrian Arab Republic" title="Syrian Arab Republic">Syrian Arab Republic</option>
          							<option value="Taiwan, Province of China" title="Taiwan, Province of China">Taiwan, Province of China</option>
          							<option value="Tajikistan" title="Tajikistan">Tajikistan</option>
          							<option value="Tanzania, United Republic of" title="Tanzania, United Republic of">Tanzania, United Republic of</option>
          							<option value="Thailand" title="Thailand">Thailand</option>
          							<option value="Timor-Leste" title="Timor-Leste">Timor-Leste</option>
          							<option value="Togo" title="Togo">Togo</option>
          							<option value="Tokelau" title="Tokelau">Tokelau</option>
          							<option value="Tonga" title="Tonga">Tonga</option>
          							<option value="Trinidad and Tobago" title="Trinidad and Tobago">Trinidad and Tobago</option>
          							<option value="Tunisia" title="Tunisia">Tunisia</option>
          							<option value="Turkey" title="Turkey">Turkey</option>
          							<option value="Turkmenistan" title="Turkmenistan">Turkmenistan</option>
          							<option value="Turks and Caicos Islands" title="Turks and Caicos Islands">Turks and Caicos Islands</option>
          							<option value="Tuvalu" title="Tuvalu">Tuvalu</option>
          							<option value="Uganda" title="Uganda">Uganda</option>
          							<option value="Ukraine" title="Ukraine">Ukraine</option>
          							<option value="United Arab Emirates" title="United Arab Emirates">United Arab Emirates</option>
          							<option value="United Kingdom" title="United Kingdom">United Kingdom</option>
          							<option value="United States" title="United States">United States</option>
          							<option value="United States Minor Outlying Islands" title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
          							<option value="Uruguay" title="Uruguay">Uruguay</option>
          							<option value="Uzbekistan" title="Uzbekistan">Uzbekistan</option>
          							<option value="Vanuatu" title="Vanuatu">Vanuatu</option>
          							<option value="Venezuela, Bolivarian Republic of" title="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
          							<option value="Viet Nam" title="Viet Nam">Viet Nam</option>
          							<option value="Virgin Islands, British" title="Virgin Islands, British">Virgin Islands, British</option>
          							<option value="Virgin Islands, U.S." title="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
          							<option value="Wallis and Futuna" title="Wallis and Futuna">Wallis and Futuna</option>
          							<option value="Western Sahara" title="Western Sahara">Western Sahara</option>
          							<option value="Yemen" title="Yemen">Yemen</option>
          							<option value="Zambia" title="Zambia">Zambia</option>
          							<option value="Zimbabwe" title="Zimbabwe">Zimbabwe</option>
                      </select>
                  </div>
                  <div class="col-md-12">
                    <p><a href="#" data-toggle="modal" data-target="#log_in">Already have an account?</a></p>
                  </div>
                  <div class="col-md-12">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="t&c" value="agree" required oninvalid="this.setCustomValidity('Terms and Condition must be accepted')"
                        oninput="this.setCustomValidity('')" checked="checked" />
                        <p>
                          By clicking Sign Up, you agree to our <a href="#">Terms, Data Policy and Cookie Policy.</a> You may receive SMS notifications from us and can opt out at any time.
                        </p>
                      </label>
                    </div>
                    </div>
                  <div class="col-md-12">
                    <button type="submit" name="btn_signup" class="btn btn-primary">Register Now</button>
                  </div>
                  </form>
                  <?php
                    if($_SERVER["REQUEST_METHOD"]=="POST") {
                      if(isset($_POST["btn_signup"])) {
                        $first_name = $_REQUEST["first_name"];
                        $last_name = $_REQUEST["last_name"];
                        $email = $_REQUEST["signup_email"];
                        $password = $_REQUEST["signup_password"];
                        $dob = $_REQUEST["dob"];
                        $gender = $_REQUEST["gender"];
                        $city = $_REQUEST["city"];
                        $country = $_REQUEST["country"];
                        $pic_path = "images/profile.png";
                        $profile_cover = "images/cover.png";

                        $user_path = "C:\wamp64\www\Allian\users/$email";
                        mkdir($user_path, 0700);

                        $profile_pic_path = "C:\wamp64\www\Allian\users/$email\profile_pics";
                        mkdir($pic_path, 0700);

                        $post_path = "C:\wamp64\www\Allian\users/$email\posts_pics";
                        mkdir($post_path, 0700);

                        $register = mysqli_query($conn, "INSERT INTO `user_info`(`first_name`, `last_name`, `email`, `password`, `dob`, `gender`, `city`, `country`, `profile_pic`, `profile_cover`) VALUES ('$first_name', '$last_name', '$email', '$password', '$dob', '$gender', '$city', '$country', '$pic_path', '$profile_cover')");

                        $education = mysqli_query($conn, "INSERT INTO education_info(`user_id`, `education_university`, `education_from`, `education_to`, `education_description`, `graduated`) VALUES (LAST_INSERT_ID(), null, null, null, null, null)");

                        $company = mysqli_query($conn, "INSERT INTO work_info(`user_id`, `company_name`, `company_designation`, `company_from`, `company_to`, `company_place`, `company_description`) VALUES (LAST_INSERT_ID(), null, null, null, null, null, null)");

                        $notification = mysqli_query($conn, "INSERT INTO account_settings(`user_id`, `enable_follow_me`, `send_me_notifications`, `text_messages`, `enable_tagging`, `enable_sound`) VALUES (LAST_INSERT_ID(), true, true, false, true, false)");

                        $sql = "SELECT * FROM user_info WHERE `email` = '$email' && `password` = '$password'";
                        $log_in = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($log_in) == 1) {
                          session_start();
                          $row = mysqli_fetch_assoc($log_in);
                          $user_id = $row['user_id'];
                          $username = $row['first_name']." ".$row['last_name'];
                          $_SESSION["user_id"] = $user_id;
                          $_SESSION["username"] = $username;
                          $_SESSION["status"] = "active";

                          header("Location: timeline.php", false);
                          mysqli_close($conn);
                        }
                      }
                    }
                  ?>
                  <div class="col-md-12">
                    <div class="container">
                      <ul>
                        <li>
                          <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fab fa-google-play"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fab fa-instagram"></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Preloader -->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>

    <!--Scripts
    ============================================================-->
		<script src="js/jquery.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
