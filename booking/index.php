<?php session_start() ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Success</title>

    <link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
    <script src="semantic/jquery.min.js"> </script>
    <script src="semantic/semantic.min.js"></script>
    <link href="semantic/datepicker.css" rel="stylesheet" type="text/css">
    <script src="semantic/datepicker.js"></script>
    <script>
        var ORDERREF = '<?php echo $_SESSION['ORDERREF'] ?>';
    </script>
    <script src="nav.js"></script>

    <style>
        body {
            background-color: f1f1f1;
        }

        a {
            cursor: pointer;
        }

        .success-message {
            font-size: 16px !important;
            padding: 0 20px;
        }
    </style>

</head>

<body>
    <div class="ui inverted huge borderless fixed fluid menu">
        <a class="header item">TICKET RESERVATION SYSTEM</a>
    </div><br>


    <div class="ui fluid container center aligned" style="cursor:pointer;margin-top:40px">
        <div class="ui unstackable tiny steps">

            <div class="step" onclick="booking()">
                <i class="thumbs up icon"></i>
                <div class="content">
                    <div class="title">Booking Success</div>
                </div>
            </div>

        </div>
    </div>
    <br>
    <div id="dynamic">

        <div class="ui container text" id="booking-page">
            <div class="ui attached message">

                <div class="header">Order Ref: <span style="color:red;font-size:15px">
                        <?php echo $_SESSION['ORDERREF'] ?>
                    </span> </div>
                <br>
                <p>Thank for booking with us &#128512;</p>
            </div>

            <form class="ui form attached fluid loading segment" id="submitForm">
                <div class="field">
                    <br>
                    <label class="success-message">
                        Your tickets are ready!
                    </label>

                </div>
                <div class="field">
                    <label class="success-message">
                        An email has been sent with a link to download your ticket. Please check your <a
                            href="https://mail.google.com/">email</a> within 10
                        minutes.
                    </label>
                </div>

                <div style="text-align:center">
                    <br>
                    <button class="ui green submit button">Done!</button>
                </div>
            </form>
        </div>

    </div>
    <script>
        $(document).ready(function () {
            $('#submitForm').on('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission.
                window.location.href = 'index_main.php'; // Redirect to index_main.php
            });
        });
    </script>
</body>

</html>