<?php
$str = "
Numeric num1 = 15;
String str1 = 'hello';
Print 'hello';
Something 'Hi';
String str2 = 'Unterminated line'
Numeric num2 = #notanumericvalue;
String str3 'No equal operator';
Numeric num3 3333;
";
$code = htmlspecialchars($str);
?>

<form method="POST" action="process.php">
    <table>
        <tbody>
        <tr>
            <td>Your Code</td>
        </tr>
        <tr>
            <td>
                <textarea name="code" style="width: 500px; height: 300px;"><?php echo $code; ?></textarea></td>
        </tr>
        </tbody>
    </table>
    <input type="submit">
</form>
<h3>Rules</h3>
<table border="1" width="100%">
    <tr>
        <td>
            <strong>Reserved Word(s)</strong>
        </td>
        <td>
            <strong>Description</strong>
        </td>
    </tr>
    <tr>
        <td>Terminating lines with semi-colon</td>
        <td>Always end a line of code with <strong>;</strong></td>
    </tr>
    <tr>
        <td>Declaring an Integer</td>
        <td>To declare an Integer value, write code
            <i>Numeric num1 = 3.14;</i>,
            declares a variable num1 with a value of 3.14.
            Numeric handles integers, floats and doubles.</td>
    </tr>
    <tr>
        <td>Declaring a String</td>
        <td>To declare a String
            <i>String str1 = 'Hello';</i>,
            declares a variable str1 with a value of 'Hello'. String should be under single quote.</td>
    </tr>
    <tr>
        <td>Print a line</td>
        <td>To print output, follow the syntax <i>Print 'Hello';</i>,<i>Print num1;</i>, or <i>Print str1;</i>,</td>
    </tr>

</table>