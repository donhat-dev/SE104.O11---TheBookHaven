<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="public/js/main.js">
    <style>
        #myBtn {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Fixed/sticky position */
            bottom: 20px;
            /* Place the button at the bottom of the page */
            right: 30px;
            /* Place the button 30px from the right */
            z-index: 99;
            /* Make sure it does not overlap */
            border: none;
            /* Remove borders */
            outline: none;
            /* Remove outline */
            background-color: #f21852;
            /* Set a background color */
            color: white;
            /* Text color */
            cursor: pointer;
            /* Add a mouse pointer on hover */
            padding: 15px;
            /* Some padding */
            border-radius: 10px;
            /* Rounded corners */
            font-size: 18px;
            /* Increase font size */
            height: 60px;
            width: 60px;
        }

        #myBtn:hover {
            background-color: #fff;
            color: #f21852;
            /* Add a dark-grey background on hover */
        }
    </style>
</head>

<body>
    <button type='button' id="myBtn" title="Go to top"><i style="font-size:25px" class="fa fa-shopping-bag"></i></button>

</body>
<script>
    mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop >= 0 || document.documentElement.scrollTop >= 0) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
</script>

</html>