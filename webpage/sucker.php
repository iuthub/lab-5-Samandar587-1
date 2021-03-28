<!DOCTYPE html>
<html>
<head>
    <title>Buy Your Way to a Better Education!</title>
    <link href="buyagrade.html" type="text/css" rel="stylesheet" />
</head>
<body>


<?php

//IF the form is submitted, process the data
if(isset($_POST['name']) && isset($_POST['section']) && isset($_POST['credit_card']) && isset($_POST['card'])) {
    if(preg_match('/^[A-Z][a-zA-Z]+/', $_POST['name'])
        && preg_match('/[A-Z]{2}/', $_POST['section'])
        && preg_match('/[0-9]{16}/', $_POST['credit_card'])
        && preg_match('/[a-zA-Z]+/', $_POST['card'])) {
        $name = $_POST['name'];
        $section = $_POST['section'];
        $credit_card = $_POST['credit_card'];
        $card = $_POST['card'];

        //Save to a text file
        $file = fopen('suckers.txt', 'a');
        $text = $name.';'.$section.';'.$credit_card.';'.$card."\n";
        fwrite($file, $text);
        fclose($file);

        $filecontents = file_get_contents('suckers.txt');

        if((preg_match('/^5[0-9]{15}$/', $credit_card) && preg_match('/Mastercard/', $card))
            || (preg_match('/^4[0-9]{15}$/', $credit_card) && preg_match('/Visa/', $card)) ) {

            ?>
            <h1>Thanks, sucker!</h1>
            <p>Your information has been recorded</p>
            <dl>
                <dt>Name</dt>
                <dd><?=$name?></dd>

                <dt>Section</dt>
                <dd><?=$section?></dd>

                <dt>Credit Card</dt>
                <dd><?=$credit_card?> (<?=$card?>)</dd>
            </dl>
            <p>Here are all the suckers who have submitted here:</p>
            <pre><?=$filecontents?></pre>

            <?php
        }

        else {
            print "<h1>Sorry</h1>";
            print "You didn't provide a valid credit card number. Click <a href='buyagrade.html'>here</a> to go back.";
        }
    }
    else {
        print "<h1>Sorry</h1>";
        print "You must fill out all the fields. Click <a href='buyagrade.html'>here</a> to go back.";
    }
}

?>
</body>
</html>
