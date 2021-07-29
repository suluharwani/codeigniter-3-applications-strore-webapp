<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register</title>
    <link href="<?=base_url('assets/startbootstrap/')?>css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="<?=base_url('assets/jquery.js')?>"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Register</h3></div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="username" type="text" placeholder="Username" name="username" />
                                            <label for="username">Username</label>
                                            <span id="username_result" ></span>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Password min 8 character" />
                                            <label for="inputPassword">Password</label>
                                            <span id="password_result" ></span>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputRepeatPassword" type="password" placeholder="Password" />
                                            <label for="inputRepeatPassword">Repeat Password</label>
                                            <span id="password_confirm" ></span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a id="register" class="btn btn-primary" >Register</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <!-- <div class="small"><a href="register.html">Need an account? Sign up!</a></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?=base_url('assets/startbootstrap/')?>js/scripts.js"></script>
    <script src="<?=base_url('assets/')?>swall.js"></script>
    <!-- check -->
    <script type="text/javascript">
     $(document).ready(function(){
        $('#username').change(function(){
           var username = $('#username').val();
           if(username != ''){
              $.ajax({
                url: "<?php echo base_url(); ?>login/check_username",
                method: "POST",
                data: {username:username},
                success: function(data){
                  $('#username_result').html(data);
              }
          });
          }
      });
        $('#inputPassword').keyup(function(){
           var password = $('#inputPassword').val();
           if(password != ''){
              $.ajax({
                url: "<?php echo base_url(); ?>login/check_password",
                method: "POST",
                data: {password:password},
                success: function(data){
                  $('#password_result').html(data);
              }
          });
          }
      });
        $('#inputRepeatPassword').keyup(function(){
           var password = $('#inputPassword').val();
           var repeatpassword = $('#inputRepeatPassword').val();
           if(repeatpassword != ''){
              $.ajax({
                url: "<?php echo base_url(); ?>login/check_confirm_password",
                method: "POST",
                data: {password:password,repeatpassword:repeatpassword},
                success: function(data){
                  $('#password_confirm').html(data);
              }
          });
          }
      });
        //register
        $('#register').on('click',function(){
          var username = $('#username').val();
          var password1 =$('#inputPassword').val();
          var password2 = $('#inputRepeatPassword').val();
          $.ajax({
            type : "POST",
            url  : "<?php echo site_url('login/daftar_admin')?>",
            dataType : "JSON",
            data : {username:username, password1:password1, password2:password2},
            success: function(response){
             Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: response.message,
                showConfirmButton: false,
                timer: 4500,
                footer: '<a href="<?=base_url('login')?>">Login Sekarang?</a>'
            })
             setTimeout(function () { 
                location.reload(1); 
            }, 
            5000
            );
         },
         error: (function(data) {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Gagal melakukan registrasi!',
              showConfirmButton: false,
              timer: 1500
          })
      })
     });
          return false;
      });
        //end
    });

</script>
</body>
</html>
