<?php

require 'vendor/autoload.php';
use Mailgun\Mailgun;


class Utils{
    function getToken($length=32){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[$this->crypto_rand_secure(0,strlen($codeAlphabet))];
        }
        return $token;
    }
     
    function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }
    // send email using built in php mail function
// send email using built in php mail function
public function sendEmailViaPhpMail($send_to_email, $subject, $message){
    # First, instantiate the SDK with your API credentials
    $mg = Mailgun::create('key-example');

    # Now, compose and send your message.
    # $mg->messages()->send($domain, $params);
    $mg->messages()->send('example.com', [
        'from'    => 'info@example.com',
        'to'      => 	$send_to_email,
        'subject' => 	$subject,
        'text'    => $message
    ]);

    if($mg){
        return true;
    }else{
        return false;
    }
    }
}
