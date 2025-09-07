<?= $this->extend("layouts/app.php") ?>

<?= $this->section('content') ?>
    <div class="container pt-5" >
        <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert alert-success">
                <p><?= session()->getFlashdata('msg') ?></p>
            </div>
        <?php endif; ?>
        <h3 class="mb-2" style="color:#EAEAEA;">Create a New User</h3>
        <div class="card col-12 col-md-5 register-card w-75 mx-auto">
            <div class="card-body">

                <?php if (session('error') !== null) : ?>
                    <div class="alert alert-danger" role="alert"><?= esc(session('error')) ?></div>
                <?php elseif (session('errors') !== null) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php if (is_array(session('errors'))) : ?>
                            <?php foreach (session('errors') as $error) : ?>
                                <?= esc($error) ?>
                                <br>
                            <?php endforeach ?>
                        <?php else : ?>
                            <?= esc(session('errors')) ?>
                        <?php endif ?>
                    </div>
                <?php endif ?>

                <form action="<?= base_url("user/create") ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- Email -->
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                        <label for="floatingEmailInput"><?= lang('Auth.email') ?></label>
                    </div>

                    <!-- Username -->
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="floatingUsernameInput" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                        <label for="floatingUsernameInput"><?= lang('Auth.username') ?></label>
                    </div>

                    <div class="form-floating mb-2">
                        
                        <select name="role_id" class="form-select" aria-label="Default select example" id="role_id">
                            <!-- <option selected>Categories</option> -->
                            <?php foreach($roles as $role):?>
                                <option value="<?= $role->id ?>"><?= $role->name?></option>
                            <?php endforeach ?>    

                        </select>
                        <label for="role_id" >Role</label>
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>
                        <label for="floatingPasswordInput"><?= lang('Auth.password') ?></label>
                    </div>

                    <!-- Password (Again) -->
                    <div class="form-floating mb-5">
                        <input type="password" class="form-control" id="floatingPasswordConfirmInput" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required>
                        <label for="floatingPasswordConfirmInput"><?= lang('Auth.passwordConfirm') ?></label>
                    </div>

                    <div class="d-grid col-12 col-md-8 mx-auto m-3">
                        <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.register') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
