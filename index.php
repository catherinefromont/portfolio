<?php
require 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if ($_POST["_method"] == "delete") {
        $id=$_POST['id'];
        deleteProject($id, $dbh);
        redirect('index.php');
    }

    if ($_POST["_method"] == "edit") {
        $id=$_POST['id'];
                // editProject($id, $dbh);
        redirect('edit.php?id=' . $id);
    }

    if ($_POST["_method"] == "view") {
        $id=$_POST['viewid'];
                // editProject($id, $dbh);
        redirect('view.php?id=' . $id);
    }
}


$projects = getProjects($dbh);



require 'partials/header.php';
require 'partials/navigation.php';

?>



<!-- Start of Content -->
<div class="container">
    <div class="row">
        <div class="col-md-12"><?= showMessages() ?>
        </div>
    </div>

    <div class="row">

        <?php foreach ($projects as $project):?>

           <!-- Start of Card -->
           <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading card-header">
                    <img class="img-responsive" src="<?= $project['img_url'] ?>">
                </div>

                <div class="panel-body">
                    <h4><?= $project['title'] ?></h4>
                    <p>
                        <?= $project['content'] ?>
                    </p>
                    <form method="POST" action="index.php" style="display: inline-block;">

                       <input name="_method" type="hidden" value="view">

                       <input name="viewid" type="hidden" value="<?= $project['id'] ?>">

                       <button type="submit" class="btn btn-default btn-xs">
                         <i class="icon ion-eye"></i> View
                     </button>
                 </form>

                 <div class="pull-right"><?php if(loggedIn()): ?>
                   <!-- Edit Button and Form -->
                   <form method="POST" action="index.php" style="display: inline-block;">
                     <input name="_method" type="hidden" value="edit">
                     <input name="id" type="hidden" value="<?= $project['id'] ?>">
                     <button type="submit" class="btn btn-default btn-xs">
                       <i class="icon ion-edit"></i> Edit
                   </button>
               </form>
               <!-- Delete Button and Form -->
               <form method="POST" action="index.php" style="display: inline-block;">
                 <input name="_method" type="hidden" value="delete">
                 <input name="id" type="hidden" value="<?= $project['id'] ?>">
                 <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-default btn-xs btn-danger">
                   <i class="icon ion-ios-close-outline"></i> Delete
               </button>
           </form>
       <?php endif; ?>
   </div>

</div>

</div>
</div>
<?php endforeach; ?>

</div>
</div>


<!-- End of Card -->

<!-- End of single result -->

<!-- Scripts -->
<!-- Bootstrap JavaScript -->

<?php
require 'partials/footer.php';
?>