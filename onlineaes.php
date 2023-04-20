<?php
if (array_key_exists('encode', $_POST)) {
    encode();
}

if (array_key_exists('decode', $_POST)) {
    decode();
}

function encode()
{
    echo '送出資料<br>';
    $key = $_POST["key"];
    $iv = $_POST["iv"];
    $data = $_POST["data"];
    echo "Key: " . $key . '<br>';
    echo "IV: " . $iv . '<br>';
    echo "Data: " . $data . '<br>';
    $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    echo '<br>';
    echo "加密結果:<br>";
    echo(base64_encode($encrypted));
    echo '<br>';
}

function decode()
{
    echo '送出資料<br>';
    $key = $_POST["key"];
    $iv = $_POST["iv"];
    $data = $_POST["data"];
    echo "Key: " . $key . '<br>';
    echo "IV: " . $iv . '<br>';
    echo "Data: " . $data . '<br>';
    $encryptedData = base64_decode($data);
    $decrypted = openssl_decrypt($encryptedData, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    $decrypted1 = urldecode($decrypted);
    echo ('<br>');
    echo "解密結果:<br>";
    echo ($decrypted1);
}
?>
<title>加解密範例AA</title>
<form method="post">
    KEY:<br>
    <input type="text" name="key"><br>
    IV:<br>
    <input type="text" name="iv"><br>
    Data:<br>
    <input type="text" name="data"><br>
    <input type="submit" name="decode" id="decode" value="	解密		"/>
    <input type="submit" name="encode" id="encode" value="	加密		"/><br/>
</form>
