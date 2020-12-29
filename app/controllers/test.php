<?php

class test extends Controller
{

    public function index()
    {

        echo  date("h:i:sa");
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
            echo 'donation_msg' . 'تم الارسال بنجاح   ';
        } else {
            echo 'donation_msg' . 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger';
        }
    }

    public function imgWrite()
    {
        if (isset($_POST['submit'])) {
            $text1 = $_POST['text1'];
            $text2 = $_POST['text2'];
            $text3 = $_POST['text3'];
            // $text1Size = strlen($_POST['text1']) * 4;
            // $text2Size = strlen($_POST['text2']) * 6;
            // $text3Size = strlen($_POST['text3']) * 4;
            // var_dump($text1Size);
            // var_dump(imagefontwidth(40) * strlen($text3));
            // var_dump($text3Size);
            
            $lines = [
                ['x' => 690, 'y' => 130, 'text' => $text1, 'font' => true],
                ['x' => 690, 'y' => 310, 'text' => $text2, 'size' => 40],
                ['x' => 690, 'y' => 530, 'text' => $text3, 'font' => true],
            ];
            echo  '<img src ="' . str_replace(APPROOT, URLROOT, imgWrite(APPROOT . MEDIAFOLDER . '/test.jpg', $lines, APPROOT . MEDIAFOLDER . '/default2.jpg', 20, 'white')) . '" />';
        } else {
            echo '<!doctype html>
            <html lang="en">
              <head>
                <title>Title</title>
                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            
                <!-- Bootstrap CSS -->
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
              </head>
              <body>
              <div class="row">
                  <div class="col-6 offset-3">
                  <p>Image write</p>
                  <form method="post" class="card p-3">
                  <div class="form-group ">
                    <label for="">text to image</label>
                    <input type="text" name="text1" class="form-control">
                    <input type="text" name="text2" class="form-control">
                    <input type="text" name="text3" class="form-control">
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </form> 
                  </div>
              </div>
              
                <!-- Optional JavaScript -->
                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
              </body>
            </html>';
        }
    }
}
