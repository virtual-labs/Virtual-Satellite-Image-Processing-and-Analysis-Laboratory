<?php
session_start();
$Image = $_POST['Image']; //All the required inputs
//echo $Image;
$r=$_POST['Rband'];
//echo "<br>".$r;
$g=$_POST['Gband'];
//echo "<br>".$g;
$b=$_POST['Bband'];
//echo "<br>".$b;


$fname=$_SESSION['fname'];
//echo "<br>".$fname;
$_SESSION['fname']=$fname;
$lname=$_SESSION['lname'];
//echo "<br>".$lname;
$_SESSION['lname']=$lname;
$email=$_SESSION['email'];
//echo "<br>".$email;
$_SESSION['email']=$email;
$folder=$_SESSION['folder'];
//echo "<br>".$folder;
$_SESSION['folder']=$folder;
$_path='../user_data/'.$folder.'/';
//echo "<br>".$_path."<br>";

//echo $fname;
//echo "<br>".$lname;
//echo "<br>".$email;
//echo "<br>user_data/".$folder;

$format=$_POST['format'];
//echo "<br>".$format;
$pass=$_POST['pass'];
//echo "<br>".$pass;
$cutoff=$_POST['cutoff'];
//echo "<br>".$cutoff."<br>";
$order=$_POST['order'];
//echo "<br>".$order."<br>";



//check filename
if ($Image == "inputimage" || $Image == "quickbird.jpg") {

    putenv("SCIHOME=/home/Ubuntu/.Scilab/scilab-5.5.0"); //the code from master.sce is written here for the 1st experiment
      $code = "stacksize('max');mode(-1);exec('/usr/share/scilab/contrib/sivp/loader.sce');
getd;
pic='$Image';
RGB=[$r $g $b];
path='$_path';
tline1='$pass';
tline3=$cutoff;
tline4=$order;
typef='$format';
fftfilter(pic,RGB,tline1,tline3,tline4,typef,path);";
$code = str_replace('\"', '"', $code);
        $code = preg_replace("/[\n\r]/","", $code);
 exec('scilab -nw -nb -e "' . $code . ';exit;"', $output); //send code to scilab for execution
      
   if ($Image == "quickbird.jpg") {

//display the outputs
echo "<img src='".$_path."/out_original_img.jpg'> ";
echo "<img margin-left='20px;' src='".$_path."/out_magnitude_spectrum_$r.jpg'> ";
echo "<img margin-left='20px;' src='".$_path."/out_magnitude_spectrum_$g.jpg'> <br><br> ";
echo "<img margin-left='20px;' src='".$_path."/out_magnitude_spectrum_$b.jpg'> ";
echo "<img margin-left='20px;' src='".$_path."/out_mag_spectrum_All.jpg'> ";
echo "<img margin-left='20px;' src='".$_path."/".$format."".$pass." filteredimg $r.jpg'> <br><br>";
echo "<img margin-left='20px;' src='".$_path."/".$format."".$pass." filteredimg $g.jpg'> ";
echo "<img margin-left='20px;' src='".$_path."/".$format."".$pass." filteredimg $b.jpg'> ";
echo "<img margin-left='20px;' src='".$_path."/".$format."".$pass." filteredimg.jpg'>";
}
else
{
echo "<img src='".$_path."/out_original_img.jpg'> <br><br>";
echo "<img src='".$_path."/out_magnitude_spectrum_$r.jpg'><br><br> ";
echo "<img src='".$_path."/out_magnitude_spectrum_$g.jpg'> <br><br> ";
echo "<img src='".$_path."/out_magnitude_spectrum_$b.jpg'> <br><br>";
echo "<img src='".$_path."/out_mag_spectrum_All.jpg'><br><br> ";
echo "<img src='".$_path."/".$format."".$pass." filteredimg $r.jpg'> <br><br>";
echo "<img src='".$_path."/".$format."".$pass." filteredimg $g.jpg'> <br><br>";
echo "<img src='".$_path."/".$format."".$pass." filteredimg $b.jpg'> <br><br>";
echo "<img src='".$_path."/".$format."".$pass." filteredimg.jpg'>";

}
 } 
    
else{

print ("Wrong input");

}
 
?> 
    

