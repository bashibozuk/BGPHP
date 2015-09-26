<!DOCTYPE html>
<html>
<head>
    <title>BGPHP Container</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/bootstrap.css"/>
    <link rel="stylesheet" href="/assets/css/bootstrap-theme.css"/>
    <script type="text/javascript" src="/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/form/Form.js"></script>
    <script type="text/javascript" src="/assets/js/form/AjaxForm.js"></script>
    <script type="text/javascript" src="/assets/js/RegisterForm.js"></script>
    <script type="text/javascript" src="/assets/js/app.js"></script>
    <style>

        .site-panel {
            padding: 1.5em;
        }

        form .error {
            color: red;
        }
    </style>

</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">BGPHP</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="#register"> Register Container</a></li>
                        <li><a href="#track"> Track Container</a></li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="row site-panel" id="index">

            <div class="jumbotron">
                <div class="container">
                    <h1>Click 'Register container' to registrer new container or 'Track container to track your
                        container'</h1>

                </div>

            </div>

        </div>

        <div class="row site-panel" id="register">
            <form id="register-form" action="server/contact.php" method="post" role="form">

                <div class="form-group">
                    <label for="contact-form-container_code">Name:</label>
                    <input name="container_code" id="contact-form-container_code" class="form-control" type="text"/>
                    <p class="error"></p>
                </div>

                <div class="form-group">

                    <button class="btn btn-primary">Register</button>
                </div>
            </form>

        </div>
    </div>
</body>
</html>