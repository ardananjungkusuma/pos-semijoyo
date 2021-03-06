<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Semi Joyo Login</h1>
                            </div>
                            <img src="<?= base_url() ?>assets/img/gambar_pos/default.png" width="30%" style="display: block;margin: 0 auto;">
                            <?= $this->session->flashdata('message'); ?><br>
                            <form class="user" action="<?= base_url() ?>auth/prosesLogin" method="POST">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Email or Username" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password" />
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" onclick="passwordShowUnshow()" class="custom-control-input" id="customCheck" />
                                        <label class="custom-control-label" for="customCheck">Show/Unshow Passowrd</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>