<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Redirecting...</title>
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,300'>
    <link rel="stylesheet" type='text/css' href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type='text/css' href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            padding: 0;
            background-color: #fffffe;
            color: #1a1a1a;
            text-align: center;
        }

        .header {
            margin-top: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .sk-folding-cube {
            margin: 20px auto;
            width: 40px;
            height: 40px;
            position: relative;
            -webkit-transform: rotateZ(45deg);
            transform: rotateZ(45deg);
        }

        .sk-folding-cube .sk-cube {
            float: left;
            width: 50%;
            height: 50%;
            position: relative;
            -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
        }

        .sk-folding-cube .sk-cube:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #1abc9c;
            -webkit-animation: sk-foldCubeAngle 2.4s infinite linear both;
            animation: sk-foldCubeAngle 2.4s infinite linear both;
            -webkit-transform-origin: 100% 100%;
            -ms-transform-origin: 100% 100%;
            transform-origin: 100% 100%;
        }

        .sk-folding-cube .sk-cube2 {
            -webkit-transform: scale(1.1) rotateZ(90deg);
            transform: scale(1.1) rotateZ(90deg);
        }

        .sk-folding-cube .sk-cube3 {
            -webkit-transform: scale(1.1) rotateZ(180deg);
            transform: scale(1.1) rotateZ(180deg);
        }

        .sk-folding-cube .sk-cube4 {
            -webkit-transform: scale(1.1) rotateZ(270deg);
            transform: scale(1.1) rotateZ(270deg);
        }

        .sk-folding-cube .sk-cube2:before {
            -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
        }

        .sk-folding-cube .sk-cube3:before {
            -webkit-animation-delay: 0.6s;
            animation-delay: 0.6s;
        }

        .sk-folding-cube .sk-cube4:before {
            -webkit-animation-delay: 0.9s;
            animation-delay: 0.9s;
        }

        @-webkit-keyframes sk-foldCubeAngle {
            0%, 10% {
                -webkit-transform: perspective(140px) rotateX(-180deg);
                transform: perspective(140px) rotateX(-180deg);
                opacity: 0;
            }
            25%, 75% {
                -webkit-transform: perspective(140px) rotateX(0deg);
                transform: perspective(140px) rotateX(0deg);
                opacity: 1;
            }
            90%, 100% {
                -webkit-transform: perspective(140px) rotateY(180deg);
                transform: perspective(140px) rotateY(180deg);
                opacity: 0;
            }
        }

        @keyframes sk-foldCubeAngle {
            0%, 10% {
                -webkit-transform: perspective(140px) rotateX(-180deg);
                transform: perspective(140px) rotateX(-180deg);
                opacity: 0;
            }
            25%, 75% {
                -webkit-transform: perspective(140px) rotateX(0deg);
                transform: perspective(140px) rotateX(0deg);
                opacity: 1;
            }
            90%, 100% {
                -webkit-transform: perspective(140px) rotateY(180deg);
                transform: perspective(140px) rotateY(180deg);
                opacity: 0;
            }
        }
    </style>
    <script src="https://sdk.paylike.io/3.js"></script>
    <script type="text/javascript">
        var PAYLIKE_PUBLIC_KEY = "<?php echo $this->get('publicKey'); ?>";
        var paylike = Paylike(PAYLIKE_PUBLIC_KEY);

        function pay() {
            paylike.popup(
                {
                    title: "<?php echo $this->get('title'); ?>",
                    description: "<?php echo $this->get('description'); ?>",
                    currency: "<?php echo $this->get('currency'); ?>",
                    amount: "<?php echo $this->get('amount') * 100; ?>",
                    //locale 			: "<?php //echo $this->get('amount');?>//",
                    custom: {
                        orderId: "<?php echo $this->get('orderId'); ?>",
                        customer: {
                            name: '<?php echo $this->get('firstName') . ' ' . $this->get('lastName'); ?>',
                            email: '<?php echo $this->get('email'); ?>',
                            telephone: '<?php echo $this->get('phone'); ?>',
                            address: '<?php echo $this->get('address'); ?>',
                            customerIp: '<?php echo $this->get('clientIp'); ?>'
                        },
                        platform: {
                            name: 'bytic-omnipay',
                            version: '<?php echo \Paytic\Omnipay\Paylike\Gateway::VERSION; ?>',
                        },
                    },
                },
                function (err, res) {
                    console.log('+++++++++++ RETURN API +++++++++++++++++');
                    if (err) {
                        return console.warn(err);
                    }

                    if (typeof res === 'undefined') {
                        console.log('RESULT undefined');
                        return;
                    }

                    console.log(res);
                    console.log('++++++++++++++++++++++++++++');

                    var return_url = '<?php echo $this->get('returnUrl'); ?>'
                        + '&pOrderId=' + '<?php echo $this->get('orderId'); ?>'
                        + '&pTransactionId=' + res.transaction.id;
                    console.log(return_url);

                    location.href = return_url;
                }
            );
        }
    </script>
</head>
<body onload="pay()">
<div class="header">
    <h1>
        Redirecting to Payment Platform
    </h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h4>
                SUB
            </h4>
            <hr/>

            <div class="sk-folding-cube">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
            </div>

            <p>
                If you are not redirected in 5 seconds click the button below.
            </p>
            <button type="button" value="Go now" class="btn btn-success btn-lg" onclick="pay()"/>
        </div>
    </div>
</div>
</body>
</html>