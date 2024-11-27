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


        <!-- Display status message -->
        <?php if (!empty($success_msg)) {?>
        <div class="col-xs-12">
            <div class="alert alert-success"><?php echo $success_msg; ?></div>
        </div>
        <?php } elseif (!empty($error_msg)) {?>
        <div class="col-xs-12">
            <div class="alert alert-danger"><?php echo $error_msg; ?></div>
        </div>
        <?php }?>

        <div class="row">
            <div class="col-md-12 head">
                <p class="fs-2"><?php echo $title; ?> </p>
                <a href="<?=base_url('Admin/gallery')?>" class="btn btn-outline-primary btn-sm" tabindex="-1"
                    role="button" aria-disabled="true">Back</a>
                <!-- Add link -->
                <div class="float-right">
                    <a href="<?php echo base_url('manage_gallery/add'); ?>" class="btn btn-success"><i class="plus"></i>
                        Upload Image</a>
                </div>
            </div>
            &nbsp
            <!-- Data list table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="10%">Image</th>
                        <th width="40%">Title</th>
                        <th width="19%">Created</th>
                        <th width="8%">Status</th>
                        <th width="18%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($gallery)) {$i = 0;
    foreach ($gallery as $row) {$i++;
        $image = !empty($row['file_name']) ? '<img src="' . base_url() . 'assets/img/portfolio/' . $row['file_name'] . '" class="img-thumbnail" alt="" />' : '';
        $statusLink = ($row['status'] == 1) ? site_url('Manage_gallery/block/' . $row['id']) : site_url('Manage_gallery/unblock/' . $row['id']);
        $statusTooltip = ($row['status'] == 1) ? 'Click to Inactive' : 'Click to Active';
        ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $image; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['created']; ?></td>
                        <td><a href="<?php echo $statusLink; ?>" title="<?php echo $statusTooltip; ?>"><span
                                    class="badge <?php echo ($row['status'] == 1) ? 'badge-success' : 'badge-danger'; ?>"><?php echo ($row['status'] == 1) ? 'Active' : 'Inactive'; ?></span></a>
                        </td>
                        <td>
                            <a href="<?php echo base_url('Manage_gallery/view/' . $row['id']); ?>"
                                class="badge text-bg-primary">view</a>
                            <a href="<?php echo base_url('Manage_gallery/edit/' . $row['id']); ?>"
                                class="btn badge text-bg-warning">edit</a>
                            <a href="<?php echo base_url('Manage_gallery/delete/' . $row['id']); ?>"
                                class="badge text-bg-danger"
                                onclick="return confirm('Are you sure to delete data?')?true:false;">delete</a>
                        </td>
                    </tr>
                    <?php }} else {?>
                    <tr>
                        <td colspan="6">No image(s) found...</td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
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