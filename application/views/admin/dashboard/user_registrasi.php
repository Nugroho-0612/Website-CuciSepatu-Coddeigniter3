<!-- Content Wrapper. Contains page content -->
<div class=" content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Registrations</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=base_url('Admin')?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?=base_url('Admin/user_registrasi')?>">User
                                Registrations</a></li>
                    </ol>

                    <div class="input-group rounded">
                        <br>
                    </div>
                    <form action="" method="POST">
                        <div class="input-group rounded">
                            <input type="search" class="form-control rounded" name="keyword" placeholder="Search"
                                aria-label="Search" aria-describedby="search-addon" />
                            <span class="input-group-text border-0" id="search-addon" type="submit">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </form>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?=$this->session->flashdata('message');?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role Id</th>
                <th scope="col">Date create</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($userall)): ?>
            <div class="alert alert-danger" role="alert">
                data not found
            </div>
            <?php endif;?>

            <?php if (!empty($userall)) {$i = 0;
    foreach ($userall as $u) {$i++;
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $u['first_name']; ?>&nbsp<?=$u['last_name'];?></td>
                <td><?php echo $u['email']; ?></td>
                <td><?php echo $u['role_id']; ?></td>
                <td><?php echo $u['date_create']; ?></td>

                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="badge text-bg-primary" data-bs-toggle="modal"
                        data-bs-target="#view<?php echo $u['id']; ?>">
                        View
                    </button>

                    <!-- Modal -->

                    <div class="modal fade" id="view<?php echo $u['id']; ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <section>
                                        <div class="container py-5">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="card mb-4">
                                                        <div class="card-body text-center">
                                                            <img src="<?php echo base_url('assets/img/profile/') . $u['image']; ?>"
                                                                alt="avatar" class="rounded-circle img-fluid"
                                                                style="width: 150px;">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="card mb-4">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="mb-0">First Name</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">
                                                                        <?=$u['first_name'];?></p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="mb-0">Last Name</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">
                                                                        <?=$u['last_name'];?></p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="mb-0">Email</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">
                                                                        <?=$u['email'];?></p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="mb-0">Role Id</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">
                                                                        <?=$u['role_id'];?></p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="mb-0">Date Create</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">
                                                                        <?=$u['date_create'];?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
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
                        data-bs-target="#edit<?php echo $u['id']; ?>">
                        Edit
                    </button>

                    <!-- Modal -->
                    <form action="<?=base_url('Admin/edit_user');?>" method="POST">
                        <div class="modal fade" id="edit<?php echo $u['id']; ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">First Name :</label>
                                            <input type="text" class="form-control" name="firstname" id="recipient-name"
                                                value="<?php echo $u['first_name']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Last Name :</label>
                                            <input type="text" class="form-control" name="lastname" id="recipient-name"
                                                value="<?php echo $u['last_name']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">email :</label>
                                            <input type="text" class="form-control" name="email" id="recipient-name"
                                                value="<?php echo $u['email']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Role ID :</label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="role_id">
                                                <option selected value="<?php echo $u['role_id']; ?>">
                                                    <?php echo $u['role_id']; ?></option>
                                                <option>Pilih Role ID</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
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

                    <a href="<?php echo base_url('Admin/delete_user/' . $u['id']); ?>" class="badge text-bg-danger"
                        onclick="return confirm('Are you sure to delete data?')?true:false;">
                        Delete</a>
                </td>
            </tr>
            <?php }}?>

            <?php ?>

        </tbody>


    </table>

    <p><?=$this->pagination->create_links();
?></p>
    <!-- /.content -->
</div>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js">
</script>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"
    integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous">
</script>
<!-- ChartJS -->
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script
    src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
</script>
<!-- Summernote -->
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script
    src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
</script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url() ?>assets/vendor/AdminLTE-3.2.0/dist/js/pages/dashboard.js"></script>
</body>

</html>