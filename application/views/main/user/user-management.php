<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data User</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar User Yang Terdaftar</h6>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <button type="button" data-toggle="modal" data-target="#addUserModal" class="btn btn-sm btn-success shadow-sm mb-3"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah User</button>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="listPengutang">
                <thead style="background-color: #4e73df;color:white">
                    <tr>
                        <th scope="col">Nama User</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Level</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($user as $u) {
                    ?>
                        <tr>
                            <td><?= $u['nama_user'] ?></td>
                            <td><?= $u['username'] ?></td>
                            <td><?= $u['email'] ?></td>
                            <td><?= $u['level'] ?></td>
                            <td>
                                <button onclick="modalPassword('<?= $u['id_user'] ?>','<?= $u['nama_user'] ?>')" class="btn btn-secondary">Edit Password</button>
                                <button onclick="modalLevel('<?= $u['id_user'] ?>','<?= $u['nama_user'] ?>')" class="btn btn-warning">Edit Level</button>
                                <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus User <?= $u['nama_user'] ?>?');" class="btn btn-danger">Hapus</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add User -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>user/addUser" method="POST">
                    <label>Nama User</label>
                    <input type="text" id="nama_user" name="nama_user" class="form-control mb-2" required>
                    <label>Username</label>
                    <input type="text" id="username" name="username" class="form-control mb-2" required>
                    <label>Email</label>
                    <input type="email" id="email" name="email" class="form-control mb-2" required>
                    <label>Password</label>
                    <input type="password" id="password" name="password" class="form-control mb-2" required>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Tambah User</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ganti Password User -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul-ganti-password"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <label>Password Baru</label>
                <input type="hidden" class="form-control mb-2" name="id_user_ganti_password">
                <input type="text" class="form-control mb-2" name="password-baru">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" onclick="saveNewPassword()">Edit Password</button></div>

        </div>
    </div>
</div>

<!-- Modal Ganti Level User -->
<div class="modal fade" id="changeLevelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul-ganti-level"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <label>Masukan Level Baru<br> <br><b>1 : ADMIN<br>2 : USER BIASA</b></br></label>
                <input type="hidden" class="form-control mb-2" name="id_user_ganti_level">
                <input type="text" class="form-control mb-2" name="level-baru">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" onclick="saveNewLevel()">Edit Password</button></div>

        </div>
    </div>
</div>

<script>
    function modalPassword(id, nama_user) {
        $('#changePasswordModal').modal('show');
        document.getElementById('judul-ganti-password').textContent = `Edit Password ${nama_user}`;
        $(`[name="id_user_ganti_password"]`).val(id);
    }

    function saveNewPassword() {
        let id_user = $(`[name="id_user_ganti_password"]`).val();
        let password = $(`[name="password-baru"]`).val();
        if (password != "") {
            $.ajax({
                type: 'POST',
                data: `id_user=${id_user}&password=${password}`,
                url: '<?= base_url() . "user/editPassUser" ?>',
                dataType: 'json'
            });
            location.reload();
            alert("Password Sukses Diganti");
        } else {
            alert("Isi password baru terlebih dahulu!");
        }
    }

    function modalLevel(id, nama_user) {
        $('#changeLevelModal').modal('show');
        document.getElementById('judul-ganti-level').textContent = `Edit Level ${nama_user}`;
        $(`[name="id_user_ganti_level"]`).val(id);
    }

    function saveNewLevel() {
        let id_user = $(`[name="id_user_ganti_level"]`).val();
        let level = $(`[name="level-baru"]`).val();
        console.log(level);
        if (level == "") {
            alert("Masukan Level");
        } else if (level == "1" || level == "2") {
            $.ajax({
                type: 'POST',
                data: `id_user=${id_user}&level=${level}`,
                url: '<?= base_url() . "user/editLevelUser" ?>',
                dataType: 'json'
            });

            location.reload();
            alert("Level Sukses Diganti");
        } else {
            alert("Level hanya 1 dan 2.\nLevel 1 : ADMIN\nLevel 2 : USER BIASA");
        }
    }
</script>