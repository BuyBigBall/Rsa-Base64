<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once("./crypt/RSA.php");

$decrypted = 'ssqdqsmkjazklsdjkmlazjmkejkmazjmejma';
if(!empty($_REQUEST['test']))	$decrypted = $_REQUEST['test'];
else							$decrypted = 'Are you OK? this is a example text.';

$privatekey = "-----BEGIN RSA PRIVATE KEY-----MIICdQIBADANBgkqhkiG9w0BAQEFAASCAl8wggJbAgEAAoGBAIwBQdylrAGcThmCjG0JB+JpVGnW+t+ywYk1Vdf/l/KEQWIgPFXvKnTVOxtjCdztg7d3IhO2OwIKV7rCWCiSbMr5pHB+76u/CLsHSQmBF3H7NhqbxUyUXaAXFsdLC7bcdB8vwzhRR+XVPuXcsQfkn2/uDsjmCLim7Jl7jS1msnrFAgMBAAECgYBWyTy7exM52FttYsiLmmqBxgsmpLXUzyk7VY2GHJFjKuqg2hyspFnsHHXMT0NA6RaaNsYv8+l2JVUmluwxEjtPVaIW7wm/1UbIGXvsp1s21F0BadGsLUZGe8h1E1I9W6urcPkyFWcQoh2bv3lN47Xs0RDRv+Af5COBjPsudNfarQJBANyoyoddWhBNq2mVK/M6WoSrGkXCKLVFGLuQkIfBkkpWAKh0rDeghaLpk9tqNrRf5mrHq6C8EbudcsxYEbzWxecCQQCibZH77YwY/vhmRI99KldOfc6rGfVAxerGyhhQsbRQ08XjFbAo/0NadCK+MKvW0wCf4f0IsSgfz6Q1PixX8UxzAkBnsDlbWpaTyqudtactaGJYrT5vQUl3xLxWhxwjbuabX8Z3Yjv698dUQoZkOIj0QYw46RLROQ7sJpRnSYssPZBJAkBfkp1NYU8H/i7m7fyIJ3vLwZbzcoiunkYwxgVcpdN1o8ZSghZvaROWi7NNuZHDC9DYQr8CeEslvKXgdj7dWCwlAkBl3GCUhv7Ql7+HwIowgxd73q2PtWcjvQen01s5D+HEoa4vY3cc3EPl/4ku+ckvHs4AD2QGV4vbd7PEsahNH6Id-----END RSA PRIVATE KEY-----";

$publickey = "-----BEGIN PUBLIC KEY-----MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCMAUHcpawBnE4ZgoxtCQfiaVRp1vrfssGJNVXX/5fyhEFiIDxV7yp01TsbYwnc7YO3dyITtjsCCle6wlgokmzK+aRwfu+rvwi7B0kJgRdx+zYam8VMlF2gFxbHSwu23HQfL8M4UUfl1T7l3LEH5J9v7g7I5gi4puyZe40tZrJ6xQIDAQAB-----END PUBLIC KEY-----";


$rsa = new Crypt_RSA();

// if you will create new keys,
// {
//     $keys = $rsa->createKey();
//     $privatekey = $keys['privatekey'];
//     $publickey = $keys['publickey'];
// }

print("<br>privatekey<br>");print($privatekey);
print("<br><br>publickey<br>");print($publickey);
print("<br><br>plaintext<br>"); print($decrypted);


$rsa->loadKey($privatekey);
$cryptedrsa = $rsa->encrypt($decrypted);
//$cryptedrsa = $rsa->sign($decrypted);
$FairPlaySignature = substr(chunk_split(base64_encode($cryptedrsa), 68, "\n\t"), 0, -2);

print("<br><br>encrypttext<br>"); 
echo $FairPlaySignature;
echo "<br>";

print("<br>decrypttext<br>"); 
$rsa->loadKey($publickey);
echo $rsa->decrypt($cryptedrsa);
exit;



