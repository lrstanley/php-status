<?php
// This PHP file has the functions built in, so you can more dynamically create statuses,
// in different sections of the page
// Remember, you can have it store to flat file, which is easier to load.

    // Function that actually pings the port, to see if it's up.
    function check($ip,$port,$name) {
        $is_a_url = is_url($ip);
        if ($is_a_url == True) {
            $output = url($ip);
        } else {
            $output = sock($ip,$port);
        }
        if ($output == True) {
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

    function sock($ip,$port) {
        $checkSock = @fsockopen($ip, $port, $errno, $errstr, 3);
        if ($checkSock !== FALSE) return True;
        return False;
    }

    function url($site) {
        $headers = @get_headers($site);
        if(strpos($headers[0],'200')===false) return False;
        return True;
        
    }

    function is_url($item) {
        if (strpos($item,'/') !== false) return True;
        return False;
    }

    // Let's call it. :)
    function yolo($myarray) {
        foreach ($myarray as $value) {
            check($value[0],$value[1],$value[2]);
        }
    }
?>
<html>
  <head>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:300,400">
    <title>Status &middot; Services</title>
    <meta name="viewport" content="width=device-width">
    <link href="theme.min.css" rel="stylesheet">
    </head>
    <body>
        <h1 class="text-center">Service Status</h1>
        <center>
            <div class="text-center content">
                <?php
                yolo(
                    array(
                        array('liamstanley.io', 80, 'Liams Site'),
                        array('google.com', 80, 'Google'),
                        array('livestrap.tk', 80, 'Livestrap'),
                        array('example.down.site.com', 8080, 'Example'),
                        array('http://cajs.co.uk/', '', 'URL')
                    )
                ); ?>
            </div>
        </center>
    </body>
</html>
