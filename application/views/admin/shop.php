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
                            <a href="<?php echo base_url('Admin/services') ?>   " class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Services
                                </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('Admin/shop') ?>" class="nav-link active">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Shop
                                </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('Admin/gallery') ?>" class="nav-link">
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
                    <h1>Shop</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=base_url('Admin')?>">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Created</th>
                <th scope="col">Modified</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <div class=" d-flex flex-row-reverse mb-2 me-5">
                <!-- Button trigger modal -->
                <button type=" button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add">
                    Tambah <i class="fa-regular fa-plus"></i>
                </button>

                <!-- Modal -->
                <form method="post" action="<?=base_url('Admin/addItem');?>" enctype="multipart/form-data">
                    <div class=" modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class=" modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form tambah data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Name</label>
                                        <small class="text-danger"><?=form_error('name');?></small>
                                        <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Jumlah</label>
                                        <small class="text-danger"><?=form_error('jumlah');?></small>
                                        <input type="number" class="form-control" name="jumlah"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Harga</label>
                                        <small class="text-danger"><?=form_error('harga');?></small>
                                        <input type="number" class="form-control" name="harga"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Title</label>
                                        <small class="text-danger"><?=form_error('title');?></small>
                                        <input type="text" class="form-control" name="title" id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image" id="exampleInputPassword1">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <?=$this->session->flashdata('message');?>
            <?php if (empty($shop)): ?>
            <!-- <div class="alert alert-danger" role="alert">
                data not found
            </div> -->
            <?php endif;?>

            <?php if (!empty($shop)) {$i = 0;
    foreach ($shop as $s) {$i++;
        ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$s['name'];?></td>
                <td><?=$s['jumlah'];?></td>
                <td><?=$s['harga'];?></td>
                <td><?=$s['title'];?></td>
                <td><img src="<?=base_url('assets/img/shop/') . $s['image'];?>" class="img-thumbnail" style="width:80px"
                        alt="..."></td>
                <td><?=$s['created'];?></td>
                <td><?=$s['modified'];?></td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="badge text-bg-primary" data-bs-toggle="modal"
                        data-bs-target="#view<?php echo $s['id']; ?>">
                        View
                    </button>

                    <!-- Modal -->

                    <div class="modal fade" id="view<?php echo $s['id']; ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">View</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-lg-8">
                                        <div class=" card">
                                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                                <img src="<?=base_url('assets/img/shop/') . $s['image'];?>"
                                                    class="img-fluid" />
                                                <a href="<?=base_url('assets/img/shop/') . $s['image'];?>">
                                                    <div class="mask"
                                                        style="background-color: rgba(251, 251, 251, 0.15);">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title"><?=$s['name'];?></h5>
                                                <p class="card-text"><?=$s['title'];?></p>
                                                <p class="card-text">Rp. <?=$s['harga'];?></p>
                                                <a href="<?=base_url('User/checkout');?>"
                                                    class="btn btn-primary">Buy</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                    <!-- Button trigger modal -->
                    <button type="button" class="badge text-bg-warning" data-bs-toggle="modal"
                        data-bs-target="#edit<?php echo $s['id']; ?>">
                        Edit
                    </button>

                    <!-- Modal -->
                    <form enctype="multipart/form-data" action="<?=base_url('Admin/editItem');?>" method="POST">
                        <div class="modal fade" id="edit<?php echo $s['id']; ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?php echo $s['id']; ?>">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Name</label>
                                            <small class="text-danger"><?=form_error('name');?></small>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" value="<?php echo $s['name']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Jumlah</label>
                                            <small class="text-danger"><?=form_error('jumlah');?></small>
                                            <input type="number" class="form-control" name="jumlah"
                                                id="exampleInputPassword1" value="<?php echo $s['jumlah']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Harga</label>
                                            <small class="text-danger"><?=form_error('harga');?></small>
                                            <input type="number" class="form-control" name="harga"
                                                id="exampleInputPassword1" value="<?php echo $s['harga']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Title</label>
                                            <small class="text-danger"><?=form_error('title');?></small>
                                            <input type="text" class="form-control" name="title"
                                                id="exampleInputPassword1" value="<?php echo $s['title']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Image</label>
                                            <input type="file" class="form-control" name="image"
                                                id="exampleInputPassword2">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- End Modal -->

                    <a href="<?php echo base_url('Admin/deleteItem/' . $s['id']); ?>" class="badge text-bg-danger"
                        onclick="return confirm('Are you sure to delete data?')?true:false;">
                        Delete</a>
                </td>
            </tr>
            <?php }}?>

            <?php ?>
        </tbody>
    </table>
    <!-- /.content -->
</div>



<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
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

<!-- Home CDN -->
<!-- Vendor JS Files -->
<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/aos/aos.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?php echo base_url() ?>assets/js/main.js"></script>
<!-- End home CDN -->

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