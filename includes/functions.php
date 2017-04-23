<?php

function loggedIn() {
    return !empty($_SESSION['username']);
}

function redirect($url){
	header('Location: ' . $url);
    die();
}


// -----------------------------------------------------------------------------
//Connect to the database function.
// -----------------------------------------------------------------------------


function connectDatabase($host,$database,$user,$pass){
	try{
		$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		return  $dbh;

	} catch (PDOException $e){
		print('Error! ' . $e->getMessage() . '<br>');
		die();
	}
}

// -----------------------------------------------------------------------------
// Insert into "users" table
// -----------------------------------------------------------------------------


function addUser($dbh, $username, $email, $password) {

//Prepare the statement that will be executed
	$sth = $dbh->prepare("INSERT INTO users VALUES (NULL, :username, :email, :password)");



//Bind the "$searchQuery" the SQL statement
	$sth->bindValue(':username', $username, PDO::PARAM_STR);
	$sth->bindValue(':email', $email , PDO::PARAM_STR);
	$sth->bindValue(':password', $password , PDO::PARAM_STR);
	

//Execute the statement
	$success = $sth->execute();    
	return true;
}

// -----------------------------------------------------------------------------
// Insert into "projects" table
// -----------------------------------------------------------------------------

/* 
 To add a new message you will use this syntax addMessage [success|error] [message]

 To display errors on the page place following code in a div on what ever page.

 <= showMessages() ?>
*/



/**
 * A helpful message function to return all massages saved in the session
 * @param string|null $type
 * @return string
 */
function showMessages($type = null)
{
  $messages = '';
  if(!empty($_SESSION['flash'])) {
    foreach ($_SESSION['flash'] as $key => $message) {
      if(($type && $type === $key) || !$type) {
        foreach ($message as $k => $value) {
          unset($_SESSION['flash'][$key][$k]);
          $key = ($key == 'error') ? 'danger': $key;
          $messages .= '<div class="alert alert-' . $key . '">' . $value . '</div>' . "\n";
        }
      }
    }
  }
  return $messages;
}


/**
 * Add a message to the session
 * @param string $type
 * @param string $message
 * @return void
 */
function addMessage($type, $message) {

  $_SESSION['flash'][$type][] = $message;
}

function addProject($dbh, $title, $img_url, $content, $link) {

//Prepare the statement that will be executed
	$sth = $dbh->prepare("INSERT INTO projects VALUES (NULL, :title, :img_url, :content, :link)");



//Bind the "$searchQuery" the SQL statement
	$sth->bindValue(':title', $title, PDO::PARAM_STR);
	$sth->bindValue(':img_url', $img_url , PDO::PARAM_STR);
	$sth->bindValue(':content', $content , PDO::PARAM_STR);
	$sth->bindValue(':link', $link , PDO::PARAM_STR);

//Execute the statement
	$success = $sth->execute();    
	return success;
}

// function getUser($dbh) {

// 	$sth = $dbh->prepare("SELECT * FROM portfolio");
// 	$sth->execute();
// 	$result = $sth->fetchAll();
//     // die(var_dump($result));
// 	return $result;


// } 

function getUser($dbh, $username) {
    $sth = $dbh->prepare('SELECT * FROM `users` WHERE username = :username OR email = :email');

    $sth->bindValue(':username', $username, PDO::PARAM_STR);
    $sth->bindValue(':email', $username, PDO::PARAM_STR);

    // Execute the statement.
    $sth->execute();

    $row = $sth->fetch();

    if (!empty($row)) {
      return $row;
    }
    return false;
}
function getProjects($dbh) {
    $sth = $dbh->prepare('SELECT * FROM `projects` ');



    // Execute the statement.
    $sth->execute();

    $row = $sth->fetchAll();

    if (!empty($row)) {
      return $row;
    }
    return false;
}

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

function deleteProject($id, $dbh) {
	$result = $dbh->prepare("DELETE FROM projects WHERE id = :id");
	$result->bindParam(':id', $id);
	$result->execute();
}


function editProject($id, $dbh) {
	$sth = $dbh->prepare("SELECT * FROM projects WHERE id = :id");
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->execute();
	$result = $sth->fetch();
	return $result;
}

function updateProject($id, $dbh, $title, $img_url, $content, $link) {
	$sth = $dbh->prepare("UPDATE projects SET title = :title, img_url = :img_url, content = :content, link = :link WHERE id = :id");
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->bindParam(':title', $title, PDO::PARAM_STR);
	$sth->bindParam(':img_url', $img_url, PDO::PARAM_STR);
	$sth->bindParam(':content', $content, PDO::PARAM_STR);
	$sth->bindParam(':link', $link, PDO::PARAM_STR);
	$result = $sth->execute();
	return $result;
}

// -----------------------------------------------------------------------------
// View projects functions
// -----------------------------------------------------------------------------

function viewProject($id, $dbh) {
	// prepare statement that will be executed
	$sth = $dbh->prepare("SELECT * FROM projects WHERE id = :id");
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->execute();

	$result = $sth->fetch();
	return $result;
}