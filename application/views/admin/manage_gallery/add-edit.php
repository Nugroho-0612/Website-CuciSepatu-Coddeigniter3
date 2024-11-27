<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('assets/img/profile/') . $user['image']; ?>"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?=base_url('Admin/edit')?>"
                    class="d-block"><?=$user['first_name'];?><?=$user['last_name'];?></a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class=" mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?php echo base_url('Admin') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                <li class="nav-header">EXAMPLES</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Mailbox
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compose</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/read-mail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Read</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Pages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>


                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('Admin/gallery') ?>" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Services
                                </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('Admin/shop') ?>" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Shop
                                </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('Admin/gallery') ?>" class="nav-link active">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Gallery
                                </p>
                            </a>
                        </li>
                    </ul>

                <li class="nav-item">
                    <a href="<?=base_url('Auth/logout')?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gallery</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <div class="container">
        <h1><?php echo $title; ?></h1>
        <hr>

        <!-- Display status message -->
        <?php if (!empty($error_msg)) {?>
        <div class="col-xs-12">
            <div class="alert alert-danger"><?php echo $error_msg; ?></div>
        </div>
        <?php }?>

        <div class="row">
            <div class="col-md-6">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter title"
                            value="<?php echo !empty($image['title']) ? $image['title'] : ''; ?>">
                        <?php echo form_error('title', '<p class="help-block text-danger">', '</p>'); ?>
                    </div>
                    <div class="form-group">
                        <label>Images:</label>
                        <input type="file" name="image" class="form-control" multiple>
                        <?php echo form_error('image', '<p class="help-block text-danger">', '</p>'); ?>
                        <?php if (!empty($image['file_name'])) {?>
                        <div class="img-box">
                            <img src="<?php echo base_url('assets/img/portfolio/' . $image['file_name']); ?>">
                        </div>
                        <?php }?>
                    </div>

                    <a href="<?php echo base_url('manage_gallery'); ?>" class="btn btn-secondary">Back</a>
                    <input type="hidden" name="id" value="<?php echo !empty($image['id']) ? $image['id'] : ''; ?>">
                    <input type="submit" name="imgSubmit" class="btn btn-success" value="SUBMIT">
                </form>
            </div>
        </div>
    </div>


    <!-- /.content -->
</div>



<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<!-- jQuery -->
<script src="<?php echo base_url() ?>
assets/vendor/AdminLTE-3.2.0/
plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>
assets/vendor/AdminLTE-3.2.0/
plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ekko Lightbox -->
<script src="<?php echo base_url() ?>
assets/vendor/AdminLTE-3.2.0/
plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>
assets/vendor/AdminLTE-3.2.0/
dist/js/adminlte.min.js"></script>
<!-- Filterizr-->
<script src="<?php echo base_url() ?>
assets/vendor/AdminLTE-3.2.0/
plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>
assets/vendor/AdminLTE-3.2.0/
dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function() {
    $(document).on("click", '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true,
        });
    });

    $(".filter-container").filterizr({
        gutterPixels: 3
    });
    $(".btn[data-filter]").on("click", function() {
        $(".btn[data-filter]").removeClass("active");
        $(this).addClass("active");
    });
});
</script>
</body>

</html>