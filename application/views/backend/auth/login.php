<div class="container-login">
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
      <div class="card shadow-sm my-5">
        <div class="card-body p-0">

          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center mb-4">
                  <h1 class="h3 text-gray-900">Login  
                  <br> <strong class="text-primary">Stok Management</strong></h1>
                </div>

                <?=$this->session->flashdata('message') ?>

                <form class="user" method="POST" action="<?=site_url('administrador') ?>">
                  <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?=set_value('username') ?>">
                    <?=form_error('username', '<span class="text-danger">', '</span>') ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <?=form_error('password', '<span class="text-danger">', '</span>') ?>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox" style="line-height: 1.5rem;">
                      <input type="checkbox" name="remember_me" class="custom-control-input" id="remember_me">
                      <label class="custom-control-label" for="remember_me">Remember
                        Me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


