<?php
    include("config/constants.php");
    require_once('lib/vendor/autoload.php');
    use Dompdf\Dompdf;

    $user_id = $_GET['id'];
    $dates = $_GET['dates'];

    $html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Times New Roman", Times, serif;
        }
        
        .container {
            width: 100vw;
        }
        
        .wrapper {
            width: 90%;
            margin: auto;
        }
        
        .logo {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        
        img {
            position: relative;
            left: 50%;
            transform: translateX(-50%);
        }

        .header {
            width: 100vw;
            background-color: steelblue;
            color: white;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
            font-weight: bold;
        }
        
        .tbl-full {
            width: 100%;
        }
        
        th {
            text-align: left;
        }
        
        .tbl-full, .tbl-full th, .tbl-full td {
            border: 1px solid steelblue;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 1px;
        }
        
        .footer {
            width: 100vw;
            background-color: steelblue;
            color: white;
        }
        </style>
    </head>
    <body>
        <br><br>
        <div class="logo">
                <img src="'.SITEURL.'images/icons/logo3.png" alt="logo">
                <h3 class="text-center">Online Second Hand Books Purchase and Delivery System</h3>
        </div>';

            //Get the details of the user
            $sql = "SELECT * FROM users WHERE id=$user_id";
            $res = mysqli_query($conn, $sql);
    
            if($sql == TRUE){
                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $user_id = $row["id"];
                    $name = $row["full_name"];
                    $national_id = $row["national_id"];
                    $mobile = $row["mobile"];
                    $email = $row["email"];
                }
            }else{
                //
            }

        $html .= '<div class="header">
            <div class="wrapper">
                <table class="tbl-30">
                    <tr>
                        <td>
                            <h3>Name</h3>
                        </td>
                        <td>: '.$name.'</td>
                    </tr>
                    <tr>
                        <td>
                            <h3>National Id</h3>
                        </td>
                        <td>: '.$national_id.'</td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Mobile Number</h3>
                        </td>
                        <td>: '.$mobile.'</td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Email</h3>
                        </td>
                        <td>: '.$email.'</td>
                    </tr>
                </table>
            </div>
        </div>
    
        <div class="container">
        <h2 class="text-center">Invoice</h2>
            <div class="wrapper">
                <table class="tbl-full">
                    <tr>
                        <th>Book</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Amount (Ksh.)</th>
                    </tr>';

    //get the purchase details from database
    $sql3 = "SELECT * FROM book_order WHERE user_id=$user_id AND delivery_date='$dates'";
    $res3 = mysqli_query($conn, $sql3);
    $total = 0;

    if($res3 == TRUE){
        $count3 = mysqli_num_rows($res3);
        if($count3 > 0){
            while($row3 = mysqli_fetch_assoc($res3)){
                $total += $row3["amount"];
                $html .= '<tr>
                    <td>'.$row3["book_id"].'</td>
                    <td>'.$row3["price"].'</td>
                    <td>'.$row3["qty"].'</td>
                    <td class="text-right">'.$row3["amount"].'</td>
                </tr>';
            }
        }
    }else{
        echo mysqli_error($conn);
    }

    $html .= '<tr>
    <td colspan="4"></td>
</tr>
<tr>
    <td colspan="3" class="text-right">Total</td>
    <td class="text-right">Ksh. '.number_format($total, 2).'</td>
</tr>
</table>
</div>
<br>
</div>
<div class="footer">
<div class="wrapper">
<p>This reciept is an evidence of purchase by the above mentioned individual from Online Second Hand Books Purchase and Delivery System</p>
</div>
</div>
</body>
</html>';

$dompdf = new Dompdf();
$dompdf->set_option('isRemoteEnabled', TRUE);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('invoice.pdf', ['Attachment' => 0]);
?>            