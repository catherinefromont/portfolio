<?php
require 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$title = $img_url = $content = $link = '';
// Add data from form
$title = $_POST['title'];
$img_url = $_POST['img_url'];
$content = $_POST['content'];
$link = $_POST['link'];
addMessage('success', 'New Project successfully added!');
    redirect('index.php');

            
// Next, we must do some validation to see if we got valid data
$errors = [];



addProject($dbh, $title, $img_url, $content, $link);
}


require 'partials/header.php';
require 'partials/navigation.php';


?>

<body>
    <div id="app">

        <!-- Start of Navigation -->
       
        <!-- End of Navigation -->

        <!-- Start of Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Dashboard
                        </div>
                        <div class="panel-body">

                            <form class="form-horizontal" role="form" method="POST" action="dashboard.php">
                                <!-- Form Title -->
                                <div class="form-group">
                                    <label class="col-md-4">
                                        Add new project
                                    </label>
                                </div>

                                <!-- Title Input -->
                                <div class="form-group">
                                    <label for="title" class="col-md-4 control-label">Title</label>

                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control" name="title" value="" autofocus="">
                                    </div>
                                </div>

                                <!-- Image Url Input -->
                                <div class="form-group">
                                    <label for="img_url" class="col-md-4 control-label">Image Url</label>

                                    <div class="col-md-6">
                                        <input id="img_url" type="text" class="form-control" name="img_url" value="" autofocus=""  onchange="readURL(this)">
                                    </div>
                                </div>

                                <!-- Content Input -->
                                <div class="form-group">
                                    <label for="content" class="col-md-4 control-label">Content</label>

                                    <div class="col-md-6">
                                        <input id="content" type="text" class="form-control" name="content" value="" autofocus="">
                                    </div>
                                </div>

                                <!-- Link Input -->
                                <div class="form-group">
                                    <label for="link" class="col-md-4 control-label">Link</label>

                                    <div class="col-md-6">
                                        <input id="link" type="text" class="form-control" name="link" value="" autofocus="">
                                    </div>
                                </div>

                                 <!-- Submit Button -->
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary" onsubmit="addProject">
                                            Add
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
                        <img style="display: block;" width="300px" height="200px" id="projectThumbnail" src="img/place-holder.png" class="img-responsive">
                    </div>
                </div>

            </div>
        </div>
        <!-- End of Content -->
    </div>
    <!-- Scripts -->
    <!-- <script src="js/app.js"></script>
    <script type="text/javascript">

     //  function readURL(input) {
     //    var url = input.value;
     //    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
     //    if (url && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {

     //      $('#projectThumbnail').attr('src', url);

     //    }else{
     //     $('#projectThumbnail').attr('src', 'img/place-holder.png');
     //   }
     // }

    </script> -->
</body>
</html>

<?php
require 'partials/footer.php';
?>