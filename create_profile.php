<?php

  require_once 'include/user.php';
  require_once 'include/functions.php';
  
  //Github registered application client id and client secret
  $client_id = 'daeb516e46690f8013f0';
  $client_secret = '4c463b6d0ea65382ea6eb91d5ba86906788e6311';
  
  /**
   * After user grants access to the application append the client id, client secret and temporary code received from oAuth
   */
  $data_post = 'client_id='.$client_id.'&'.'client_secret='.$client_secret.'&'.
		'code='.urlencode($_GET['code']);
  
  /**
   * Get the access_token to access user information 
   */
  $access_token = get_github_access_token($data_post);
  
  /*
   * method retuens the GitHub user information as an array
   */  
 $user = get_user_info($access_token);
  
  
  /**
   * sets the user information in to User class 
   * */
  $object = User::instantiate($user);
?>
<html>
	<head>
		<link href="stylesheets/main.css" rel="stylesheet" type="text/css" />
		<title>
			<?php global $object; echo $object->__get("name")." Profile"; ?>
		</title>
	</head>
	<body>
		<div>
			<img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($user['email'])))?>?s=100"/>
		</div>
		<div>
			<table class="center">
				<tr>
					 <td>Your Name </td>
					 <td>: <?php echo $object->__get("name"); ?></td>
				</tr>
				<tr>
					 <td>Company Name </td>
					 <td>: <?php echo $object->__get("company"); ?></td>
				</tr>
				<tr>
					 <td>Location </td>
					 <td>: <?php echo $object->__get("location"); ?></td>
				</tr>
				<tr>
					 <td>URL </td>
					 <td>: <a href="<?php echo $object->__get("blog")?>"><?php echo $object->__get("blog")?></a></td>
				</tr>
				<tr>
					 <td>Email address </td>
					 <td>: <a href="mailto:<?php echo $object->__get("email"); ?>"><?php echo $object->__get("email"); ?></a></td>
				</tr>
				<tr>
					 <td>Github Username </td>
					 <td>: <a href="https://github.com/<?php echo $object->__get("login"); ?>"><?php echo $object->__get("login"); ?></a></td>
				</tr>
				<tr>
					 <td><?php echo $object->__get("login"); ?> Public Repos </td>
					 <td>: <a href="https://github.com/<?php echo $object->__get("login") ?>/repositories"><?php echo $object->__get("public_repo_count"); ?></a></td>
				</tr>
				<tr>
					 <td><?php echo $object->__get("login"); ?> followers </td>
					 <td>: <a href="https://github.com/<?php echo $object->__get("login") ?>/followers"><?php echo $object->__get("followers_count"); ?></a></td>
				</tr>
				<tr>
					 <td><?php echo $object->__get("login"); ?> is following </td>
					 <td>: <a href="https://github.com/<?php echo $object->__get("login") ?>/following"><?php echo $object->__get("following_count"); ?></a></td>
				</tr>
			</table>
		</div>
	</body>
</html>



