<?php
require 'includes/config.php';

// $hash = password_hash('changeme', PASSWORD_BCRYPT);
// $matches = password_verify('changeme', $hash);
// dd($matches);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // die(var_dump($_POST));
  if (!empty($_POST['username']) && !empty($_POST['password'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    // Add data to the session
    $success = addUser($dbh, $username, $email, $password);

    if ($success) {
      addMessage('success','You have been registered');

      // Redirect to the index
      redirect('index.php');
    }
    else {
      addMessage('error','Could not register your account!');

      // Refresh the page
      redirect('register.php');
    }

  }
  else {
    addMessage('error','Please enter all fields');
  }
}

$page['title'] = 'Register';
require 'partials/header.php';
require 'partials/navigation.php';
?>

<div class="container">

  <div class="row">
    <div class="col-md-12">
          </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Register</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="register.php">

            <div class="form-group">
              <label for="username" class="col-md-4 control-label">Username</label>

              <div class="col-md-6">
                <input id="username" type="text" class="form-control" name="username" value=""  autofocus="">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-md-4 control-label">E-Mail Address</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="" >
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="col-md-4 control-label">Password</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" >
              </div>
            </div>

            <div class="form-group">
              <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Register
                </button>
              </div>
            </div>
            <div><?= showMessages() ?></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require 'partials/footer.php';
?>