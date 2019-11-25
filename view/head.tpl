<html>
<head>
    <meta http-equiv="content-language" content="ru">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $this->title?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/jquery.form-validator.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.7/bootstrap-notify.min.js" integrity="sha256-LlN0a0J3hMkDLO1mhcMwy+GIMbIRV7kvKHx4oCxNoxI=" crossorigin="anonymous"></script>
    <script src="/src/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/src/css/bootstrap.min.css" />
    <script src="/src/js/jquery.redirect.js"></script>
    <script src="/src/js/form-validator-ru.js"></script>
    <script>
        var confirmActText = "<?php echo $this->phrase[34]?>";
        var NotifyHeadSuccess = "<?php echo $this->phrase[26]?>";
        var NotifyHeadWarning = "<?php echo $this->phrase[27]?>";
    </script>
    <script src="/src/js/common.js"></script>

</head>
</html>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Test - <?php echo $this->title?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <div class="form-group">
                    <select class="form-control" id="changeLanguage">
                        <option><?php echo $this->phrase[2]?></a></option>
                        <option value="ru"><?php echo $this->phrase[3]?></a></option>
                        <option value="en"><?php echo $this->phrase[4]?></a></option>
                    </select>
                </div>
            </form>
        </div>
    </nav>
