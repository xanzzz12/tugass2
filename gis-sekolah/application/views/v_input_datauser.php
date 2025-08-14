<div class="col-sm-7">
    <div class="panel panel-primary">
        <div class="panel-heading">
        Input Data User
        </div>
        <div class="panel-body">                   

         <?php

        echo validation_errors('<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>','</div>');
        //notifikasi pesan data berhasil di simpan
        
        if ($this->session->flashdata('pesan')){
            echo '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
            echo $this->session->flashdata('pesan');
            echo '</div>';    
        }
        echo form_open('user/input'); 
        ?>

        <div class="form-group">
                <label>Nama User</label>
                <input name="nama_user" placeholder="Nama User" value="<?= set_value('nama_user') ?>" class="form-control" />
             </div>

        <div class="form-group">
                <label>Username</label>
                <input name="username" placeholder="Username" value="<?= set_value('username') ?>" class="form-control" />
             </div>

        <div class="form-group">
                <label>Password</label>
                <input name="password" placeholder="Password" value="<?= set_value('password') ?>" class="form-control" />
             </div>

        <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="admin" <?= set_select('role', 'admin') ?>>Admin</option>
                    <option value="operator" <?= set_select('role', 'operator') ?>>Operator</option>
                    <option value="user" <?= set_select('role', 'user') ?>>User</option>
                </select>
             </div>

        <div class="form-group">
                <label></label>
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                <button type="reset" class="btn btn-sm btn-success">Reset</button>
             </div>


        <?php echo form_close() ?>

        </div>
        </div>
</div>
