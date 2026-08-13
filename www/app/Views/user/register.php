<div class="container">
    <h1><?= $title ?></h1>

    <div class="row">
        <div class="col-md-6 offset-md-3">

            <form action="<?=base_url('/register')?>" method="post">
                <?=get_csrf_field()?>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control <?= get_validation_class('name') ?>" id="name" placeholder="name" value="<?=old('name')?>">
                    <?=get_errors('name')?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name='email' class="form-control <?= get_validation_class('email') ?>" id="email" placeholder="name@example.com" value="<?=old('email')?>">
                    <?=get_errors('email')?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control <?= get_validation_class('password') ?>" id="password" placeholder="password">
                    <?=get_errors('password')?>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control <?= get_validation_class('confirmPassword') ?>" id="confirmPassword" placeholder="Confirm Password">
                    <?=get_errors('confirmPassword')?>
                </div>

                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>

            <?php session()->remove('form_data'); ?>
            <?php session()->remove('form_errors'); ?>

        </div>
    </div>

</div>