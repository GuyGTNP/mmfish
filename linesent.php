<?php
include('config.php');  
$rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz23456789'),0,5);
$mc1=date("Ymdhis");
$mc= substr($mc1,12);
$mcode =$rand."-".$mc;

	 
	 
$date = date("Y-m-d");
$sa = $_GET['id']; 
$mt = date("Y-m-d");

  
$sql = "UPDATE salefish SET Pending = '1',Date_re = '$mt' ,memo='$mcode' where Id = '$sa' ";
$objQuery = mysqli_query($conn,$sql) or die (mysqli_error());



	 
$sql = "SELECT * FROM salefish where id = '$sa' ";   
 $query = mysqli_query($conn,$sql) or die(mysqli_error());
$Num_Rows = mysqli_num_rows($query);
$Result=mysqli_fetch_array($query);	 
$bill = $Result["Bill_no"];
$name = $Result["Name_car"];	 
$Acc = $Result["Acc"];	 
$Price= $Result["Total_p"];
$dateo=$Result["Date_o"];
$namef =$Result["Name_fish"];
    ?>
<input type = "hidden" name = "id" value ="<? echo $name ?> ">

<?php
$sql = "SELECT * FROM detail where name = '$name' ";   
 $query = mysqli_query($conn,$sql) or die(mysqli_error());
$Num_Rows = mysqli_num_rows($query);
$Result=mysqli_fetch_array($query);	 
$lid = $Result["lineid"];

//echo $lid;

if ($lid== ""){
 //header( "location: lineapi.php?id=$sa" );
echo "<script type='text/javascript'>";
echo "window.location = 'กรับเงิน.Mitr?id=$sa'; ";
echo "</script>";

 exit(0);
}

else{

   


$strAccessToken = "EaU5NbZzQ1ukQVxZzCpovFjfExuJ2wAYFlJwIuGWu2k3h+NT8Vfk7PqeL5yghE4szf/oP1SZUaRTGfV9oydpnPM910Iua0EgEkfJW9ZCZ0+lF3FewLFyqCBARUMFsmG7wwTiHt09pFjKv5kFH1M70wdB04t89/1O/w1cDnyilFU=";
 
 
$strUrl = "https://api.line.me/v2/bot/message/push";

$image_thumbnail_url = 'localhost/salefith/mmxx/123.png';  // ขนาดสูงสุด 240×240px JPEG กรณีที่มีรูปภาพ(ขนาดเล็ก)
$image_fullsize_url = '';  // ขนาดสูงสุด 1024×1024px JPEG กรณีที่มีรูปภาพ(ขนาดใหญ่)


$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 

$arrPostData = array();
$arrPostData['to'] = $lid;
$arrPostData['messages'][0]['type'] = "text";
 
 $arrPostData['messages'][0]['text'] ="Bill no ".$bill. "  บ่อ "  . $namef .   "      วันที่  ".$dateo .   "  ของ  ". $name ." จำนวน " . $Acc . "  ก.ก     ยอดเงิน   " . number_format($Price) ." บาท  ได้ชำระเงินผ่านระบบเรียบร้อยแล้ว   Ref  :" .$mcode . "" ; 
 




$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
 if(curl_error($ch))
 {
   $return_array = array( 'status' => '000: send fail', 'message' => curl_error($ch) );//คืนค่าตัวแปร และแสดงค่า Error 
  //echo "ส่งไม่ได้";
 }
 else
 {
  //$return_array = json_decode($result, true);
    // echo "<script type='text/javascript'>";
    // echo "window.location ='anumut.php?id='$sa; ";
      
    //  echo "</script>";
	//echo"<script type='text/javascript'>alert('อนุมัติ ไม่สำเร็จ' );window.history.go(-1);</script>";
 //header("location: http://61.7.230.235:8080/vi/vichakarn.php");
 ?>
 <meta http-equiv="refresh" content="0;url=กรับเงิน.Mitr">
 <?php
 exit(0);
}

curl_close ($ch);
}
 ?>
