<?php
// Custom simple signup snippet for wordpress
//..
//..
//Must be added at the last of functions.php in current theme
// short code [signup]
//
//
function signup() {
  ?>
  <!-- Custom form css -->
  <style>
      
     form, input, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 16px;
      color: #666;
      }
     form div{display:flex; flex-direction:column; justify-content:space-evenly;}
      form {
      margin: 0 30px;
      }
      .account-type, .gender {
      margin: 15px 0;
      }
      input[type=radio] {
      display: none;
      }
      label#icon {
      margin: 0;
      border-radius: 5px 0 0 5px;
      }
      label.radio {
      position: relative;
      display: inline-block;
      padding-top: 4px;
      margin-right: 20px;
      text-indent: 30px;
      overflow: visible;
      cursor: pointer;
      }
      label.radio:before {
      content: "";
      position: absolute;
      top: 2px;
      left: 0;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #1c87c9;
      }
      label.radio:after {
      content: "";
      position: absolute;
      width: 9px;
      height: 4px;
      top: 8px;
      left: 4px;
      border: 3px solid #fff;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      input[type=text], input[type=password],select {
      width: 40%;
  padding:1%;
  margin:1%;
  align-content:center;
      height: 6vh;
      border-radius: 0 5px 5px 0;
      border: solid 1px #cbc9c9; 
      box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
      background: #fff; 
      }
      input[type=password] {
      margin-bottom: 15px;
      }
      #icon {
      display: inline-block;
      padding: 9.3px 15px;
      box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
      background: #1c87c9;
      color: #fff;
      text-align: center;
      }
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 20%;
      padding: 10px 0;
      margin: 10px auto;
      border-radius: 5px; 
      border: none;
      background: #1c87c9; 
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      }
      button:hover {
      background: #26a9e0;
      }
    </style>
  <!--Custom form-->
<form method='post' action='' style='border:1px solid #ccc'>
  <div class='container'>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <label for='username'><b>Username</b></label>
    <input type='text' placeholder='Enter username' name='username' required>

    <label for='email'><b>Email</b></label>
    <input type='text' placeholder='Enter Email' name='email' required>

    <label for='psw'><b>Password</b></label>
    <input type='password' placeholder='Enter Password' name='psw' required>

    <label for='psw-repeat'><b>Repeat Password</b></label>
    <input type='password' placeholder='Repeat Password' name='psw-repeat' required>

    <p>By creating an account you agree to our <a href='".get_site_url()."/privacy-policy' >Terms & Privacy</a>.</p>
    <select name='role' required>
        <option value='editor'>Editor</option>
        <option value='subscriber'>Subscriber</option>
        <option value='contributor'>Contributor</option>
        <option value='author'>Author</option>
        <option value='content-editor'>Content Editor</option>
    </select>
    <div class='clearfix'>
      <button type='reset' class='cancelbtn'>Cancel</button>
      <button type='submit' class='signupbtn' name='signing_up'>Sign Up</button>
    </div>
  </div>
</form>
<?php
}
//Checks if Sign Up button is clicked
if(isset($_POST["signing_up"])){
    $mpass=md5($_POST["psw"]);
    $muser=$_POST["username"];
		$memail=$_POST["email"];
    $date=date("Y-m-d h:i:s");
     $role=$_POST["role"];
     //{global $wpdb} wordpress command for databases 
	global $wpdb;
$table = $wpdb->prefix.'users';
$data = array('user_login' => $muser, 'user_pass' => $mpass, 'user_registered'=>$date, 'user_email'=>$memail, 'display_name'=>$muser);
$format = array('%s','%s','%s','%s','%s');
$custom_query=$wpdb->insert($table,$data,$format);
$rluser=new WP_User($muser);
$rluser->set_role($role);
if(! $custom_query && ! $rluser){return 'Hmm!! Something went wrong !!';}else{	return 'Bravo !! You have been successfully registered. Click <a href='.get_site_url().'/wp-admin>here</a> to Login'; 

}
}
//If user already signed in cannot use signup function.
//Logout
function logout(){
    return 'Already signed in!! Click here to <a href='.get_site_url().'/wp-login.php?action=logout&redirect_to='.get_site_url().'/wp-admin>Logout</a>';}
if(is_user_logged_in() != TRUE){add_shortcode('signup', 'signup');}
else{ add_shortcode('signup','logout'); }
?>
