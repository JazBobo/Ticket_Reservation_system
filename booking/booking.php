<?php session_start() ?>
<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Reservation System</title>


    <link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
    <script src="semantic/jquery.min.js"> </script>
    <script src="semantic/semantic.min.js"></script>
    <link href="semantic/datepicker.css" rel="stylesheet" type="text/css">
    <script src="semantic/datepicker.js"></script>
    <script>
        var ORDERREF = '<?php echo $_SESSION['ORDERREF'] ?>';
    </script>
    <script src="nav.js"></script>

    <script>
        function showMpesaInstructions(paymentMethod) {
            var mpesaInstructions = document.getElementById('mpesaInstructions'); var transactionIdField = document.getElementById('codebox');
            if (paymentMethod === 'MPESA') {
                mpesaInstructions.style.display = 'block';
                transactionIdField.disabled = true;
            } else {
                mpesaInstructions.style.display = 'none';
                transactionIdField.disabled = false;
            }
        }

        function enableTransactionId() { var transactionIdField = document.getElementById('codebox'); transactionIdField.disabled = false; }
    </script>


    <style>
        body {
            background-color: f1f1f1;
        }


        a {
            cursor: pointer;
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
                <i class="bus icon"></i>
                <div class="content">
                    <div class="title">Booking Details</div>
                    <div class="description">Travelling and booking info</div>
                </div>
            </div>
            <div class="step disabled" onclick="contact()" id="contactbtn">
                <i class="address book icon"></i>
                <div class="content">
                    <div class="title">Details</div>
                    <div class="description">Contact information</div>
                </div>
            </div>
            <div class="disabled step" id="billingbtn" onclick="billing()">
                <i class="money icon"></i>
                <div class="content">
                    <div class="title">Billing</div>
                    <div class="description">Payment and verification</div>
                </div>
            </div>
            <div class="disabled step" onclick="confirmdetails()" id="confimationbtn">
                <i class="info icon"></i>
                <div class="content">
                    <div class="title">Confirm Details</div>
                    <div class="description">Verify order details</div>
                </div>
            </div>
            <div class="disabled step" id="finishbtn">
                <i class="check icon"></i>
                <div class="content">
                    <div class="title">Finish Booking</div>
                    <div class="description">Redirecting to Success</div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div id="dynamic">


        <div class="ui container text" id="booking-page">
            <div class="ui attached message">
                <div class="header">Booking Info</div>
                <div class="header">Order Ref: <span style="color:red;font-size:15px">
                        <?php echo $_SESSION['ORDERREF'] ?> <a href='index_main.php'>Cancel Order</a>
                    </span> </div>
                <p>Enter traveling booking info</p>
            </div>


            <form class="ui form attached fluid loading segment" onsubmit="return contact(this)">
                <div class="field">
                    <label>Destination</label>
                    <div class="field">
                        <select required id="destination">
                            <option value="" selected disabled>--Travel Destination--</option>
                            <option>MOMBASA to NAIROBI</option>
                            <option>NAIROBI to MOMBASA</option>
                            <option>NAIROBI to NAKURU</option>
                            <option>NAKURU to NAIROBI</option>
                            <option>NAIROBI to EMBU</option>
                            <option>EMBU to NAIROBI</option>
                            <option>NAIROBI to ISIOLO</option>
                            <option>ISIOLO to NAIROBI</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label>Traveling Class</label>
                    <div class="field">
                        <select name="gender" required id="travelclass">
                            <option value="" selected disabled>Select Travel Class</option>
                            <option>Nissan (Shuttle)</option>
                            <option>Bus (Blue/White)</option>
                            <option>Commuter Bus (Matatu)</option>
                            <option>Coaster Bus</option>
                        </select>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Number of Seats</label>
                        <input placeholder="Number of Seats" type="number" id="seats" min="1" max="72" value="1"
                            required>
                    </div>
                    <div class="field">
                        <label>Date of Travel</label>
                        <input type="date" required min="2024-03-25">
                    </div>
                </div>
                <div style="text-align:center">
                    <div><label>Ensure all details have been filled correctly</label></div>
                    <button class="ui green submit button">Submit Details</button>
                </div>
            </form>
        </div>




        <div class="ui container text" id="contact-page" style="display:none">
            <div class="ui attached message">
                <div class="header">Enter your Customer Details! </div>
                <div class="header">Order Ref: <span style="color:red;font-size:15px">
                        <?php echo $_SESSION['ORDERREF'] ?> <a href='index_main.php'> Cancel Order</a>
                    </span> </div>
                <p>Fill the required Fields</p>
            </div>
            <form class="ui form attached fluid loading segment" onsubmit="return billing(this)">
                <div class="field">
                    <label>Full name</label>
                    <input placeholder="Enter your Full name" type="text" id="fullname" required>
                </div>


                <div class="field">
                    <label>Email address</label>
                    <input placeholder="Enter your Email address" type="text" id="contact" required>
                </div>


                <div class="field">
                    <label>Gender</label>
                    <div class="field">
                        <select name="gender" required id="gender">
                            <option value="" selected disabled>--Choose Gender--</option>
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                        </select>
                    </div>
                </div>


                <div style="text-align:center">
                    <div><label>Ensure all details have been filled correctly</label></div>
                    <button class="ui green submit button">Submit Details</button>
                </div>


            </form>
        </div>


        <div class="ui container text" id="billing-page" style="display:none">
            <div class="ui attached message">
                <div class="header">Validate Payment Information</div>
                <div class="header">Order Ref: <span style="color:red;font-size:15px">
                        <?php echo $_SESSION['ORDERREF'] ?> <a href='index_main.php'>Cancel Order</a>
                    </span> </div>
                <p>Enter Payment Details to Proceed</p>
            </div>


            <form class="ui form attached fluid loading segment" onsubmit="return confirmdetails(this)">
                <div class="field"> <label>Payment</label> <select name="gender" required id="paymentmethod"
                        onchange="showMpesaInstructions(this.value)">
                        <option value="" selected disabled>Method of Payment</option>
                        <option value="MPESA">MPESA</option>
                        <option value="">Bank Payment - Coming Soon...</option>
                    </select> </div>
                <div id="mpesaInstructions" style="display: none;">
                    <p>Lipa Na M-Pesa, PAYBILL</p>
                    <ol>
                        <li>Go to M-Pesa on your phone Menu</li>
                        <li>Select Lipa na M-Pesa</li>
                        <li>Select Pay Bill</li>
                        <li>Go Enter the business number: 779006</li>
                        <li>Enter account number: 1296508</li>
                        <li>Enter amount to pay</li>
                        <li>Enter your M-pesa PIN</li>
                        <li>Confirm details are correct and press OK</li>
                        <li>Upon receiving M-Pesa payment confirmation message, click the DONE button below</li>
                    </ol> <button class="ui button" onclick="enableTransactionId()">DONE</button>
                </div>
                <div class="field"> <label>Transaction ID</label>
                    <div class="ui icon input"> <input placeholder="Enter the Transaction Code" type="text" required
                            id="codebox" disabled> <i class="payment icon"></i> </div>
                </div>


                <div class="field">
                    <label>Confirm Amount(Ksh)</label>


                    <div class="ui icon input">
                        <input value="52.03" type="text" id="amount" readonly>
                    </div>
                </div>
                <div style="text-align:center">
                    <button class="ui green submit button" disabled id="proceed-button">Proceed</button>
                </div>
            </form>
            <div class="ui bottom attached warning message"><i class="icon help"></i><b id="payment-info"></b></div>
        </div>




        <div class="ui text container" id="confirmdetails-page" style="display:none">
            <div class="ui positive message">
                <b>Before proceeding, re-check the following details you provied</b><br>
                <i>Ticket might not be re-printed, hence details you provided should be valid</i>
                <br>
                <div class="ui horizontal divider">The Details Provided</div>
                <div id="details"></div>

                <div class="ui horizontal divider">Confirm Details</div>
                <div class="ui fluid container center aligned">
                    <a class="ui button green" onclick="senddata()">YES|Confirm</a>
                </div>
            </div>
        </div>


    </div>

    <script>
        $("#codebox").on("input", function () {
            if ($(this).val() != "") {
                $("#proceed-button").prop("disabled", false);
            } else {
                $("#proceed-button").prop("disabled", true);
            }
        });
    </script>
    <script>
        const destinationFares = {
            "MOMBASA to NAIROBI": 2000,
            "NAIROBI to MOMBASA": 2000,
            "NAIROBI to NAKURU": 1500,
            "NAKURU to NAIROBI": 1500,
            "NAIROBI to EMBU": 1000,
            "EMBU to NAIROBI": 1000,
            "NAIROBI to ISIOLO": 2500,
            "ISIOLO to NAIROBI": 2500
        };

        function calculateTotalFare() {
            const destination = document.getElementById("destination").value;
            const travelClass = document.getElementById("travelclass").value;
            const seats = parseInt(document.getElementById("seats").value);

            let baseFare = destinationFares[destination];
            let classFare = 0;

            switch (travelClass) {
                case "Nissan (Shuttle)":
                    classFare = 500;
                    break;
                case "Bus (Blue/White)":
                    classFare = 200;
                    break;
                case "Commuter Bus (Matatu)":
                    classFare = 100;
                    break;
                case "Coaster Bus":
                    classFare = 300;
                    break;
            }

            const totalFare = (baseFare + classFare) * seats;
            document.getElementById("amount").value = totalFare.toFixed(2);
        }

        document.getElementById("destination").addEventListener("change", calculateTotalFare);
        document.getElementById("travelclass").addEventListener("change", calculateTotalFare);
        document.getElementById("seats").addEventListener("input", calculateTotalFare);

    </script>

</body>


</html>