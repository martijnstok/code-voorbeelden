<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //Check recaptia
    $captcha = $_POST['g-recaptcha-response'];
    if (!$captcha) {
        http_response_code(1);
        echo "Fout bij het aanmaken van een racaptia code. Probeer dit later opnieuw";
        exit;
    }
    
    $secretKey = "SECTERKEYVANGOOGLEAPI";
    $ip        = $_SERVER['REMOTE_ADDR'];
    
    // post request to server
    $url  = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $secretKey,
        'response' => $captcha
    );
    
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    
    $context      = stream_context_create($options);
    $response     = file_get_contents($url, false, $context);
    $responseKeys = json_decode($response, true);
    
    header('Content-type: application/json');
    if ($responseKeys["success"]) {
        //Geen robot
        $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $name    = $_POST['name'];
        $page    = $_POST['page'];
        $bericht = $_POST['bericht'];
        // Check that data was sent to the mailer.
        if (empty($email)) {
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again. Error code: 400";
            exit;
        }
        
        $recipient = "ontavnger@test.nl";
        
        $subject  = 'Bericht van website';
        $subject2 = "Uw bericht is ontvangen";
        
        $content = 'Er is een contactverzoek verstuurd vanuit de website. <br><br>';
        $content .= 'Contactgegevens: <br>';
        $content .= '<b>Naam:</b> ' . $name . ' <br>';
        $content .= '<b>Email:</b> <a href="mailto:' . $email . '">' . $email . ' </a><br>';
        $content .= '<b>Pagina:</b> ' . $page . ' <br><br>';
        $content .= '<b>Bericht:</b><br> ' . $bericht;
        $content2 = 'HTML bericht naar klant';
        
        
        
        $headers = "From: afzender <afzender@test.nl>\n";
        $headers .= "X-Sender: afzender <afzender@test.nl>\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();
        $headers .= "X-Priority: 1\n"; // Urgent message!
        $headers .= "Return-Path: return@test.nl\n"; // Return path for errors
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
        
        
        // Send the email.
        if (mail($recipient, $subject, $content, $headers)) {
            
            //Send mail to costumer
            if (mail($email, $subject2, $content2, $headers)) {
                echo json_encode(array(
                    'success' => 'true'
                ));
            } else {
                http_response_code(500);
                echo "Oops! Something went wrong and we couldn't send your message. Errorcode: 500";
            }
        } else {
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message. Errorcode: 500";
        }
    } else {
        //Robot
        echo json_encode(array(
            'success' => 'false'
        ));
    }
}


?>