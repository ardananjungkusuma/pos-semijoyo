<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Change Your Password</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= base_url() ?>user/postChangePassword">
            <div class="form-group">
                <label>Masukan Password Baru</label>
                <input type="text" id="password" name="password" class="form-control mb-2" placeholder="New Password" required>
            </div>
            <a href="<?= base_url() ?>main" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            <button type="submit" class="btn btn-sm btn-primary shadow-sm mb-3" onclick="return confirm('Apakah anda yakin ingin mengganti password?')"><i class="fas fa-lock fa-sm text-white-50"></i> Ganti Password</button>
        </form>
    </div>
</div>