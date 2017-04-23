<?php
require 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        updateProject($_POST['id'], $dbh, $_POST['title'],$_POST['img_url'],$_POST['content'],$_POST['link']);
        redirect("index.php");
    }
$editProject = editProject($_GET['id'], $dbh);


require 'partials/header.php';
require 'partials/navigation.php';

?>

<!-- Start of Content -->
<div class="container">

  <div class="row">
    <div class="col-md-12">
          </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          Edit
        </div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="edit.php">
            <input id="id" type="text" name="id" value="<?= $editProject['id'] ?>" hidden>



            <!-- Form Title -->
            <div class="form-group">
              <label class="col-md-4">
                Edit project
              </label>
            </div>

            <!-- Title Input -->
            <div class="form-group">
              <label for="projectName" class="col-md-4 control-label">Title</label>

              <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" value="<?= $editProject['title'] ?>"  autofocus="">
              </div>
            </div>

            <!-- Image Url Input -->
            <div class="form-group">
              <label for="projectImgUrl" class="col-md-4 control-label">Image Url</label>

              <div class="col-md-6">
                <input id="image_url" type="text" class="form-control" name="img_url" value="<?= $editProject['img_url'] ?>"  autofocus="" onchange="readURL(this)">
              </div>
            </div>

            <!-- Content Input -->
            <div class="form-group">
              <label for="projectContent" class="col-md-4 control-label">Content</label>

              <div class="col-md-6">
                <input id="content" type="text" class="form-control" name="content" value="<?= $editProject['content'] ?>"  autofocus="">
              </div>
            </div>

            <!-- Link Input -->
            <div class="form-group">
              <label for="projectLink" class="col-md-4 control-label">Link</label>

              <div class="col-md-6">
                <input id="link" type="text" class="form-control" name="link" value="<?= $editProject['link'] ?>"  autofocus="">
              </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Update
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <!-- Image Display Thumbnail -->
      <div class="form-group">
        <img style="display: block;" width="100%" height="100%" id="projectThumbnail" src="<?= $editProject['img_url'] ?>" class="img-responsive">
      </div>
    </div>
  </div>
</div>


<?php
require 'partials/footer.php';
 ?>
<!-- End of Content -->