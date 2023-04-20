<!DOCTYPE html>
<html>
<head>
    <title>ICP API Execution Test</title>
    <style>
        /* Set body background image */
        body {
            background-image: url('https://www.icash.com.tw/images/bg-content.gif');
        }

        /* Set logo image */
        #logo {
            display: block;
            width: 200px;
            height: 100px;
            background: url('https://www.icash.com.tw/images/logo.png') no-repeat left top;
        }
    </style>
</head>
<body>
    <div id="logo"></div>
    <h1>ICP API Execution Test</h1>
    <form method="post">
        <input type="submit" name="run_testcases" value="All Test Case">
    </form>

    <?php
    if (isset($_POST['run_testcases'])) {
        echo "Executing test cases...\n";
        flush();
        ob_flush();
        $output = shell_exec('cd C:\testicashapi && python run_testcase.py');
        echo "<pre>$output</pre>";
    }
    ?>
</body>
<?php
unset($output);
?>
</html>
