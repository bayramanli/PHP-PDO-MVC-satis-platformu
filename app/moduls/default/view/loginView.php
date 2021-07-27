<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giriş Yap</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/css/custom.css">

    <!-- AlertifyJs  start-->
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <!-- AlertifyJs end -->

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Giriş Yap</h5>
                    <form class="form-signin" action="/login" method="post">
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" name="users_email" class="form-control" placeholder="Email address"
                                   required autofocus>
                            <label for="inputEmail">Email adresi</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="users_password" class="form-control" placeholder="Password"
                                   required>
                            <label for="inputPassword">Şifre</label>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Şifremi Unuttum</label>
                        </div>
                        <button class="btn btn-lg btn-success btn-block text-uppercase" name="users_login" type="submit">Giriş Yap</button>
                        <hr class="my-4">
                        <a class="d-block text-center mt-2 small" href="/register">Kayıt Ol</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_SESSION['messageManagement'])) {
    if ($_SESSION['messageManagement']['status']) { ?>
        <script>
            if (!alertify.errorAlert) {
                //define a new errorAlert base on alert
                alertify.dialog('errorAlert', function factory() {
                    return {
                        build: function () {
                            var errorHeader = '<span class="ti-check" '
                                + 'style="vertical-align:middle;color:#4dff34;">'
                                + '</span> Kayıt Başarılı';
                            this.setHeader(errorHeader);
                        }
                    };
                }, true, 'alert');
            }
            alertify
                .errorAlert("<?php echo $_SESSION['messageManagement']['message']; ?>");
        </script>
    <?php } else { ?>
        <script>
            if (!alertify.errorAlert) {
                //define a new errorAlert base on alert
                alertify.dialog('errorAlert', function factory() {
                    return {
                        build: function () {
                            var errorHeader = '<span class="ti-close" '
                                + 'style="vertical-align:middle;color:#ff3645;">'
                                + '</span> Bilgilendirme Mesajı';
                            this.setHeader(errorHeader);
                        }
                    };
                }, true, 'alert');
            }
            <?php if ($_SESSION['messageManagement']['captcha']) { ?>
            alertify
                .errorAlert("<?php echo $_SESSION['messageManagement']['message']; ?>");
            <?php } else { ?>
            alertify
                .errorAlert("Girdiğiniz bilgiler hatalıdır. Lütfen doğru bilgileri girerek tekrar deneyiniz.");
            <?php } ?>
        </script>
    <?php } ?>
    <?php unset($_SESSION['messageManagement']); ?>

<?php } ?>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/custom.js"></script>
</body>
</html>