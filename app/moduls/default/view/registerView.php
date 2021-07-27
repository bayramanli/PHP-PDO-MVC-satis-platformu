<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kayıt Ol</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css">
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
                    <h5 class="card-title text-center">Kayıt Ol</h5>
                    <form class="form-signin" action="/registerOp" method="post">
                        <div class="form-label-group">
                            <input type="text" id="inputName" name="users_name" class="form-control"
                                   placeholder="Adınız"
                                   required autofocus>
                            <label for="inputName">Adınız</label>
                        </div>
                        <div class="form-label-group">
                            <input type="text" id="inputSurname" name="users_surname" class="form-control"
                                   placeholder="Soyadınız"
                                   required autofocus>
                            <label for="inputSurname">Soyadınız</label>
                        </div>
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" name="users_email" class="form-control"
                                   placeholder="Email adresi"
                                   required autofocus>
                            <label for="inputEmail">Email adresi</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="users_password" class="form-control"
                                   placeholder="Password"
                                   required>
                            <label for="inputPassword">Şifre</label>
                        </div>

                        <button class="btn btn-lg btn-success btn-block text-uppercase" name="users_insert"
                                type="submit">Kayıt Ol
                        </button>
                        <hr class="my-4">
                        <a class="d-block text-center mt-2 small" href="/login">Giriş Yap</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_SESSION['messageManagement'])) { ?>
    <script>
        if (!alertify.errorAlert) {
            //define a new errorAlert base on alert
            alertify.dialog('errorAlert', function factory() {
                return {
                    build: function () {
                        var errorHeader = '<span class="ti-close" '
                            + 'style="vertical-align:middle;color:#e10000;">'
                            + '</span> Kayıt Başarısız';
                        this.setHeader(errorHeader);
                    }
                };
            }, true, 'alert');
        }
        alertify
            .errorAlert("<?php echo $_SESSION['messageManagement']['message']; ?>");
    </script>
    <?php unset($_SESSION['messageManagement']); ?>

<?php } ?>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/custom.js"></script>
</body>
</html>