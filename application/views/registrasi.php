<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg col-lg-6 my-5 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Daftar Akun!</h1>
                            </div>
                            <form method="post" action="<?php echo base_url('registrasi/index') ?>" class="user" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>Daftar Sebagai</label>
                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="" disabled selected>Pilih Role</option>
                                        <option value="2">Member</option>
                                        <option value="3">Vendor</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Nama Lengkap" name="nama">

                                        <?php echo form_error('nama', '<div class="text-danger small ml-2">', '</div>') ?>
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Username" name="username">

                                        <?php echo form_error('username', '<div class="text-danger small ml-2">', '</div>') ?>
                                </div>

                                <!-- <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Nim" name="nim">

                                        <?php echo form_error('nim', '<div class="text-danger small ml-2">', '</div>') ?>
                                </div> -->

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Alamat" name="alamat">
                                        <?php echo form_error('alamat', '<div class="text-danger small ml-2">', '</div>') ?>
                                </div>
                                <div id="ctn">
                                    
                                </div>

                                <!-- <div class="form-group">
                                    <label>Upload KTM/ KTP</label><br>
                                    <input type="file" name="gambar" clas="form-control ml-2">
                                </div> -->

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password_1">

                                            <?php echo form_error('password_1', '<div class="text-danger small ml-2">', '</div>') ?>
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Ulangi Password" name="password_2">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?php echo base_url('auth/login') ?>">Sudah Punya Akun? Silahkan Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        // ambil elements yg di buutuhkan
        var keyword = document.getElementById('role_id');

        var container = document.getElementById('ctn');
        // var btn = document.getElementById('button-addon2');

        // tambahkan event ketika keyword ditulis

        keyword.addEventListener('change', function () {


            //buat objek ajax
            var xhr = new XMLHttpRequest();

            // cek kesiapan ajax
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    container.innerHTML = xhr.responseText;
                }
            }
            
            xhr.open('GET', '<?= base_url('auth/upload/') ?>' + keyword.value, true);
            xhr.send();

        })
    </script>