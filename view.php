<?php
require 'includes/config.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST"){

//   updateProject (e($_POST['id']), $dbh, e($_POST['title']), e($_POST['url']), e($_POST['content']), e($_POST['link']));
//   redirect('index.php');

// }

$viewProject = viewProject($_GET['id'], $dbh);

$page['title'] = 'View';

require 'partials/header.php';
require 'partials/navigation.php';
?>


<div class="container">
  <div class="row">
    <div class="col-md-12">
          </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <img src="<?= $viewProject['img_url'] ?>" class="img-responsive" alt="">
        </div>
        <div class="panel-body">
          <h4><?= $viewProject['title'] ?></h4>
          <p><?= $viewProject['content'] ?></p>

          <div class="pull-right">
            <a href="<?= $viewProject['link']?>" target="_blank"><?= $viewProject['link']?> </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Start of Card -->
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5>More projects</h5>
        </div>
        <div class="panel-body">

        </div>
      </div>
    </div>
    <!-- End of Card -->

  </div>
  <div class="row">
    <div class="col-md-8">
      <!-- Fluid width widget -->
      <div id="comments" class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">
            Recent Comments
          </h3>
        </div>
        <div class="panel-body">
                      <ul class="media-list">
              <li class="media">
                <div class="media-left">
                  <img class="comments-profile-photo" src="https://www.gravatar.com/avatar/1584a3d0ee10e385e6474ceb5d2a8623?s=80&d=mm&r=g">
                </div>
                <div class="media-body">
                  <div class="form-group" style="padding:12px;">
                    <form method="POST" action="view.php?id=6">

                      <input name="_method" type="hidden" value="ADD">

                      <textarea name="content" class="form-control animated" placeholder="Leave a comment"></textarea>

                      <button class="btn btn-info pull-right" style="margin-top:10px" type="submit">
                        Post
                      </button>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
            <hr>
          
                                    <ul class="media-list">
                <li class="media">
                  <div class="media-left">
                    <img src="https://www.gravatar.com/avatar/1e0fd3e785708a7ae747de2972159ce1?s=80&d=mm&r=g" class="comments-profile-photo">
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">
                      ashleybakernz                      <br>
                      <div class="pull-right">
                        <small>
                          21 hours ago                        </small>
                        &nbsp;
                        
                      </div>
                    </h4>
                    <p>
                      This is laaammeee.                    </p>
                  </div>
                </li>
              </ul>
                          <ul class="media-list">
                <li class="media">
                  <div class="media-left">
                    <img src="https://www.gravatar.com/avatar/a817d8d52e5dc2cb5305c198e3a9de7d?s=80&d=mm&r=g" class="comments-profile-photo">
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">
                      Danny                      <br>
                      <div class="pull-right">
                        <small>
                          21 hours ago                        </small>
                        &nbsp;
                        
                      </div>
                    </h4>
                    <p>
                      This is a comment.                    </p>
                  </div>
                </li>
              </ul>
            
                  </div>
      </div>
    </div>
  </div>
</div>
<?php
require 'partials/footer.php';
?>