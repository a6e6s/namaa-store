<?php

class test extends Controller
{

    public function index()
    {

        echo  date("h:i:sa") ;



    }
    public function respond()
    {
        var_dump($_GET);
        var_dump($_POST);
    }

    public function redirect()
    {
        $requestParams = array(
            'command' => 'AUTHORIZATION',
            'access_code' => 'zx0IPmPy5jp1vAz8Kpg7',
            'merchant_identifier' => 'CycHZxVj',
            'merchant_reference' => 'XYZ9239-yu898',
            'amount' => '10000',
            'currency' => 'AED',
            'language' => 'en',
            'customer_email' => 'test@payfort.com',
            'signature' => '7cad05f0212ed933c9a5d5dffa31661acf2c827a',
            'order_description' => 'iPhone 6-S',
            'return_url' => 'http://localhost/Blank-MVC/test/respond',
        );
        $request = array_merge($_POST, $requestParams);

        $redirectUrl = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';
        echo "<html xmlns='http://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
        echo "<form action='$redirectUrl' method='post' name='frm'>\n";
        foreach ($request as $a => $b) {
            echo "\t<input type='hidden' name='" . htmlentities($a) . "' value='" . htmlentities($b) . "'>\n";
        }
        echo "\t<script type='text/javascript'>\n";
        echo "\t\tdocument.frm.submit();\n";
        echo "\t</script>\n";
        echo "</form>\n</body>\n</html>";
    }
    public function test2()
    {
        echo '<form name=‘fr’ action=‘redirect(.)php’ method=‘POST’>
        <include type=‘hidden’ name=‘var1’ value=‘val1’>
        <include type=‘hidden’ name=‘var2’ value=‘val2’>
        </form>
        <script type=‘text/javascript’>
        document.fr.submit();
        </script>';
    }

    public function sendEmail()
    {
        die('ssssss');
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: namaa <ololsms@s192-169-243-241.secureserver.net>' . "\r\n";
        $headers .= 'Cc: ololsms@s192-169-243-241.secureserver.net' . "\r\n";
        $message = 'this is test sending message'; // replace name string with user name
        $result = mail('a6e6s1@gmail.com', 'check if server sending mail', $message, $headers); // sending Email
        if ($result) {
            echo 'donation_msg'. 'تم الارسال بنجاح   ';
        } else {
            echo 'donation_msg'. 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger';
        }
    }
}
