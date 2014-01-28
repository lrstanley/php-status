<?php
    // Define the services you want to check for here.
    $services = array(
                      array('liamstanley.net', 80, 'Liams Site'),
                      array('google.com', 80, 'Google'),
                      array('livestrap.tk', 80, 'Livestrap'),
                      array('example.down.site.com', 8080, 'Example')
                      );


    // Function that actually pings the port, to see if it's up.
    function check($ip,$port,$name) {
        $checkSock = @fsockopen($ip, $port, $errno, $errstr, 3);
        if ($checkSock !== FALSE)
        {
            // online!
            $status = "up";
            $nice = "Online";
        } else {
            // offline!
            $status = "down";
            $nice = "Offline";
        }
        echo '<div id="'.$ip.'" class="span2 '.$status.' top">
                <div class="service">
                    <div class="name">'.$name.'</div>
                    <h2 class="status">'.$nice.'</h2>
                </div>
            </div>';
    }

    // Let's call it. :)
    foreach ($services as $value) {
        check($value[0],$value[1],$value[2]);
    }
?>