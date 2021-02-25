<?php

function CA_exists($SUBMITTED_CONTACT,$SUBMITTED_EMAIL, $con)
{
$result = mysqli_query($con,"SELECT * FROM ca2021 WHERE binary CONTACT='$SUBMITTED_CONTACT' OR binary EMAIL = '$SUBMITTED_EMAIL'");
	if(!$result || mysqli_num_rows($result) == 0)
	{
		return false;	
	}
	else
	{
		return true;
	}

}
function generate_ALMA_ID($con)
{
	
	$result = mysqli_query($con,"SELECT * FROM ca2021");

	$id = mysqli_num_rows($result) + 1500;
	$ALMA_ID = "ALMA20OP".$id;
	return $ALMA_ID;	
}



function send_email($EMAIL, $NAME, $CONTACT, $COLLEGE, $STATE, $CITY, $ALMA_ID)
{
	$replyto = $EMAIL;
    $replysubject = "ALMA FIESTA 2021: ONLINE DIWALI ETHNIC WEAR COMPETITION";

	// Set content-type header for sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: Alma Fiesta <donotreply@almafiesta.com>'."\r\n";
	
	 
	 $replymessage .= '
    <html>
    <head>
        <title>Welcome!</title>
	    <link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet">

    </head>
    <body style="font-family:"Raleway"">
        <!--<h1>Thanks you for joining with us!</h1>-->';
		$replymessage .= 'Hello there ';
		$replymessage .= $NAME;
		$replymessage .= ',<br><br>';
   $replymessage .= 'You have successfully registered for Alma Fiesta ONLINE DIWALI ETHNIC WEAR COMPETITION.<br><br>';
  	$replymessage .= 'We are glad to know that you are interested to participate in "SURAMYA", a online ethnic wear competition. Since its 1st edition, Alma Fiesta has followed a long way journey to reach here. Heralded as the "Biggest Debutant Fest of India" by The Telegraph in its maiden year 2010. Alma Fiesta has since grown to become a beacon of culture and social change. With 150+ colleges, 20,000+ footfall, shimmering stars of  "ARON CHUPA", "INDIAN OCEAN", "AGNEE", "GAJENDRA VERMA" and "NIKHIL DSOUZA", Alma Fiesta has made a mark unprecedented and unachievable by its contemporaries. An epitome of celebration, Alma Fiesta organises events of dance, music, dramatics and fine arts, workshops like Salsa and many more.<br><br>';
	$replymessage .=  '<br><br>Socio-Cultural Council of IIT Bhubaneswar and Alma Fiesta essences down to the indispensable lineage and the evergreen traditions or rituals that primarily define our nation. We live up to our mantra of keeping this vibrant cultural heritage breathing and flourishing within the mass.
But during the recent duration of time, the world-wide disaster somewhat coerced and deprived us, because the uncertainty, unusual tension, and fear replaced the enthusiasm and passion among us which has always overwhelmed our carnival of the heritage.
However, the human spirit of compassion can never be demeaned for long and is very crucial at times like this to wipe out the cloud of gloom and induce the maverick spirit in us back again. And what other than dressing and masquerading for a picture during the festive season can light up a mood the best?
So, here we come with “Suramya”, an ethnic wear competition to further brighten up this year home-made, cracker-free Diwali!<br><br>The results of the event will be out soon. <br>You will be contacted via the registered Email Id if you get selected. Please take note of your PARTICIPATION ID that will be used later.<br> Wishing you and your family a Happy and Safe Diwali.<br>';
	 $replymessage .= 'Your PARTICIPATION ID is <b>';
	 $replymessage .= $ALMA_ID;
	 $replymessage .= '</b><br><br>';
	 $replymessage .=  '<center><table style="border: 2px dashed #FB4314; width: 100%; height: 200px; margin:20px;" cellspacing="10px">
			<tr align="center">
				<th colspan="2">SURAMYA</th>
			</tr>
			<tr align="center">
                <th>PARTICIPATION ID:</th><td><i>';
		$replymessage .= $ALMA_ID;
		$replymessage .= '</i></td>
            </tr>
            <tr align="center">
                <th>Name:</th><td>';
		$replymessage .=  $NAME;
		$replymessage .='</td>
            </tr>
            <tr align="center" >
                <th>Email:</th><td>';
		$replymessage .= $EMAIL;
		$replymessage .= '</td>
            </tr>
			<tr align="center">
                <th>CONTACT:</th><td>';
		$replymessage .= $CONTACT;
		$replymessage .= '</td>
            </tr>
			
            <tr align="center">
                <th>Facebook Page:</th><td><a href="https://www.facebook.com/almafiesta/">ALMA FIESTA, IIT Bhubaneswar</a></td>
            </tr>
			<tr align="center">
				<th colspan="2">All the Best !</th>
			</tr>
        </table></center>';
	$replymessage .= 'This e-mail is automated, so please DO NOT reply';
	$replymessage .= '
    </body>
    </html>';
   
   
 mail($replyto, $replysubject, $replymessage, $headers);
}
?>