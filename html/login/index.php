<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    <a class="hiddenanchor" id="forget"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <?=form_open('login_controller/login', array('id' => 'login_form'));?>
          <h1>後臺系統</h1>
          <div class="control-label col-md-12 col-sm-12 col-xs-12">
            <input name='user_account' type="text" class="form-control" placeholder="帳戶"  required="required" />
          </div>
          <div class="control-label col-md-12 col-sm-12 col-xs-12">
            <input name='user_password' type="password" class="form-control" placeholder="密碼"  required="required" />
          </div>
          <div class="control-label col-md-6 col-sm-6 col-xs-6">
            <input type="text" name="login_captcha" placeholder="請輸入驗證碼" class="form-control"  />
          </div>
          <div class="control-label col-md-6 col-sm-6 col-xs-6">
            <?=$login_captcha_img?>
          </div>
          <div class="control-label col-md-12 col-sm-12 col-xs-12">
            <a class="btn btn-default submit" href="#" onclick="$(this).closest('form').submit()">登入</a>
            <a class="reset_pass" href="#forget">忘記密碼</a>
          </div>

          <div class="clearfix"></div>

          <div class="separator">
           <div class="control-label col-md-6 col-sm-6 col-xs-6">
            <p class="change_link">
              <a href="#signup" class="to_register">建立帳戶</a>
            </p>
          </div>
          <div class="control-label col-md-6 col-sm-6 col-xs-6">
            <p class="change_link">
            <a href="<?=site_url('login_controller/sample')?>" style='color:red' class="to_register">登入使用範例帳號</a>
            </p>
          </div>
          <div class="clearfix"></div>
        </div>
      </form>
    </section>
  </div>

  <div id="register" class="animate form registration_form">
    <section class="login_content">
      <?=form_open('login_controller/add', array('id' => 'add_form'));?>
      <h1>建立帳戶</h1>
      <div class="control-label col-md-12 col-sm-12 col-xs-12">
        <input type="text" name='user_account' class="form-control" placeholder="帳戶"  required="required" />
      </div>
      <div class="control-label col-md-12 col-sm-12 col-xs-12">
        <input type="email" name='user_email' id='user_email' class="form-control" placeholder="E-mail"  required="required" autocomplete='off'/>
      </div>
      <div class="control-label col-md-12 col-sm-12 col-xs-12">
        <input type="password" name='user_password' class="form-control" placeholder="密碼"  required="required" />
      </div>
      <div class="col-md-6 col-sm-6 col-xs-6">
        <input type="text" name="add_captcha" placeholder="請輸入驗證碼" class="form-control" />
      </div>
      <div class="col-md-6 col-sm-6 col-xs-6">
        <?=$add_captcha_img?>
      </div>
      <div class='col-md-12 col-sm-12 col-xs-12'>
        <div class='col-md-7 col-sm-7 col-xs-7'>
          <a class="btn btn-default submit pull-right" href="#" onclick="$(this).closest('form').submit()">確定</a>
        </div>
        <div id='message_box' class='message_box col-md-5 col-sm-5 col-xs-5'></div>
      </div>
      <div class="clearfix"></div>

      <div class="separator">
        <p class="change_link">已經有帳戶了 ?
          <a href="#signin" class="to_register">登入</a>
          <a href="#forget"　class="to_register">忘記密碼</a>
        </p>
        <div class="clearfix"></div>
        <br />
      </div>
    </form>
  </section>
</div>


<div id="forget" class="animate form forget_form">
  <section class="login_content">
    <?=form_open('login_controller/forget', array('id' => 'forget_form'));?>
    <h1>忘記密碼</h1>
    <div class="control-label col-md-12 col-sm-12 col-xs-12">
      <input type="email" name='user_email' id='forget_email' class="form-control" placeholder="email"  required="required" autocomplete='off'/>
    </div>
    <div class="control-label col-md-6 col-sm-6 col-xs-6">
      <input type="text" name="forget_captcha" placeholder="請輸入驗證碼" class="form-control"/>
    </div>
    <div class="control-label col-md-6 col-sm-6 col-xs-6">
      <?=$forget_captcha_img?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12'>
      <div class='col-md-7 col-sm-7 col-xs-7'>
        <a class="btn btn-default submit pull-right" href="#" onclick="$(this).closest('form').submit()">確定</a>
      </div>
      <div id='message_box2' class='message_box col-md-5 col-sm-5 col-xs-5'></div>
    </div>
    <div class="clearfix"></div>

    <div class="separator">
      <p class="change_link">已經有帳戶了 ?
        <a href="#signin" class="to_register">登入</a>
      </p>

      <p class="change_link">
        <a href="#signup" class="to_register">建立帳戶</a>
      </p>

      <div class="clearfix"></div>
      <br />
    </div>
  </form>
</section>
</div>

</div>
</div>
<script>
  $(function(){
    check_email('user_email', 'message_box');
    check_email('forget_email', 'message_box2');
  });
</script>