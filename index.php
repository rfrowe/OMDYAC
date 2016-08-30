<!-- Designed by Ryan Rowe -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
date_default_timezone_set("America/New_York");
require($_SERVER['DOCUMENT_ROOT'] . "/work/omdyac/files/facebook.php");
require($_SERVER['DOCUMENT_ROOT'] . "/work/omdyac/files/mysql.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>OMD YAC</title>

	<link rel="stylesheet" href="/work/omdyac/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/work/omdyac/css/theme.css" type="text/css" media="all" />

    <link rel="icon" type="image/png" href="/work/omdyac/images/favicon.png" />

	<link rel="stylesheet" href="/work/omdyac/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="all" charset="utf-8" />

	<script type='text/javascript' src='/work/omdyac/js/jquery.js'></script>
	<script src="/work/omdyac/js/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

	<script type="text/javascript" src="/work/omdyac/slideshow/js/swfobject/swfobject.js"></script>

	<script type="text/javascript">
		var flashvars = {};
		flashvars.xml = "/work/omdyac/slideshow/config.xml";
		flashvars.font = "font.swf";
		var attributes = {};
		attributes.wmode = "transparent";
		attributes.id = "slider";
		swfobject.embedSWF("/work/omdyac/slideshow/cu3er.swf", "featured_image", "940", "420", "9", "expressInstall.swf", flashvars, attributes);
</script>


	<script type='text/javascript' src='/work/omdyac/js/custom.js'></script>

	<!--[if IE 6]>
	<script type='text/javascript' src='js/dd_belated_png.js'></script>
	<script>DD_belatedPNG.fix('.ie6fix');</script>
	<style>#footer .box ul li a, #sidebar .box ul a {zoom:1;}</style>
	<![endif]-->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34126044-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body id='frontpage'>

<div class='wrapper'>

	<div id="top">
    <div id="head">
                <h1 class="logo ie6fix"><a href="/work/omdyac/" title="">OMD YAC</a></h1>
                <ul id="nav">
            <li class="current"><a href="/work/omdyac/"><strong>Home</strong><span>YAC Homepage</span></a></li>
            <li><a href="/work/omdyac/events/"><strong>Events</strong><span>Events and Info</span></a>
                <ul>
                    <?php
                        $mysql = new MySQL_Utilities;
                        $mysql->connect("omdyac");
                        $mysql->select("Events",'*','1=1',"StartDate");
                        $conList = $mysql->getResult();

                                foreach($conList as $con) {
                                    echo "<li><a href='/work/omdyac/events/?e=".$con['id']."'>".$con['Title']." &raquo;</a>\n";

                                        echo "\t<ul>\n";

                                            //START REGISTRATION
                                            if(strlen($con['YouthLink']) != 0 || strlen($con['AdultLink']) != 0) {
                                                echo "\t\t<li><a href='/work/omdyac/events/?e=".$con['id']."#reg'>Registration &raquo;</a>\n";
                                                    echo "\t\t\t<ul>\n";

                                                    if(strlen($con['YouthLink']) != 0) {
                                                        echo "\t\t\t\t<li><a href='".$con['YouthLink']."'>Youth Registration</a></li>\n";
                                                    }
                                                    if(strlen($con['AdultLink']) != 0) {
                                                        echo "\t\t\t\t<li><a href='".$con['AdultLink']."'>Adult Registration</a></li>\n";
                                                    }

                                                    echo "\t\t\t</ul>\n";
                                                echo "\t\t</li>\n";
                                            }
                                            //END REGISTRATION

                                            //START LOCATION
                                            echo "\t\t<li><a href='/work/omdyac/events/?e=".$con['id']."#loc'>Location &raquo;</a>\n";
                                                echo "\t\t\t<ul>\n";

                                                    echo "\t\t\t\t<li><a href='".$con['MapLink']."'>Google Maps</a></li>\n";

                                                echo "\t\t\t</ul>\n";
                                            echo "\t\t</li>\n";
                                            //END LOCATION

                                            //START YOUTH FORMS
                                            echo "\t\t<li><a href='/work/omdyac/events/?e=".$con['id']."#forms'>Youth Forms &raquo;</a>\n";
                                                echo "\t\t\t<ul>\n";

                                                    foreach(explode("|",$con['YouthForms']) as $formID) {
                                                        $mysql = new MySQL_Utilities;
                                                        $mysql->connect("omdyac");
                                                        $mysql->select("documents",'*',"id = ".$formID);
                                                        $form = $mysql->getResult();
                                                        $form = $form['1'];
                                                        echo "\t\t\t\t<li><a href='/work/omdyac/documents/".$form['Link']."'>".$form['Name']."</a></li>\n";
                                                    }

                                                echo "\t\t\t</ul>\n";
                                            echo "\t\t</li>\n";
                                            //END YOUTH FORMS

                                            //START ADULT FORMS
                                            echo "\t\t<li><a href='/work/omdyac/events/?e=".$con['id']."#forms'>Adult Forms &raquo;</a>\n";
                                                echo "\t\t\t<ul>\n";

                                                    foreach(explode("|",$con['AdultForms']) as $formID) {
                                                        $mysql = new MySQL_Utilities;
                                                        $mysql->connect("omdyac");
                                                        $mysql->select("documents",'*',"id = ".$formID);
                                                        $form = $mysql->getResult();
                                                        $form = $form['1'];
                                                        echo "\t\t\t\t<li><a href='/work/omdyac/documents/".$form['Link']."'>".$form['Name']."</a></li>\n";
                                                    }

                                                echo "\t\t\t</ul>\n";
                                            echo "\t\t</li>\n";
                                            //END ADULT FORMS

                                            //START CON INFO
                                            if(!$con['YacMeeting']) {
                                                echo "\t\t<li><a href='/work/omdyac/events/?e=".$con['id']."#coninfo'>Con Info &raquo;</a>\n";
                                                    echo "\t\t\t<ul>\n";

                                                        echo "\t\t\t\t<li><a href='/work/omdyac/events/?e=".$con['id']."#touchgroups'>Touchgroups</a></li>\n";
                                                        echo "\t\t\t\t<li><a href='/work/omdyac/events/?e=".$con['id']."#workshops'>Workshops</a></li>\n";
                                                        echo "\t\t\t\t<li><a href='/work/omdyac/events/?e=".$con['id']."#chaplains'>Chaplains</a></li>\n";
                                                        echo "\t\t\t\t<li><a href='/work/omdyac/events/?e=".$con['id']."#nightangels'>Nightangels</a></li>\n";

                                                    echo "\t\t\t</ul>\n";
                                                echo "\t\t</li>\n";
                                            }
                                            //END CON INFO

                                        echo "\t</ul>\n";

                                    echo "</li>\n";
                                }
                            ?>
                        </ul>
                    </li>
                    <li><a href="/work/omdyac/documents/"><strong>Documents</strong><span>Docs and Minutes</span></a>
                        <ul>
                            <li><a href="/work/omdyac/documents/#conForms">Con Forms</a></li>
                    		<li><a href="/work/omdyac/documents/#docs">Documents</a></li>
                    		<li><a href="/work/omdyac/documents/#mins">Minutes</a></li>
                        </ul>
                    </li>
                    <li><a href="/work/omdyac/socialaction/"><strong>Social Action</strong><span>YAC's Social Action</span></a>
                        <ul>
                            <?php
                                $mysql = new MySQL_Utilities;
                                $mysql->connect("omdyac");
                                $mysql->select("socialaction",'*','1=1','id');
                                $socialActionList = $mysql->getResult();

                                foreach($socialActionList as $socialAction) {
                                    echo "<li><a href='/work/omdyac/socialaction/?e=".$socialAction['id']."'>".$socialAction['Title']."</a>\n";
                                }
                            ?>
                        </ul>
                    </li>
                    <li><a href="/work/omdyac/about/"><strong>About</strong><span>About the OMD YAC</span></a>
                        <ul>
                            <li><a href="/work/omdyac/about/#mission">Mission Statement</a></li>
                            <?php
                                $mysql = new MySQL_Utilities;
                                $mysql->connect("omdyac");
                                $mysql->select("jobs",'*','1=1',"id");
                                $jobsList = $mysql->getResult();

                                foreach($jobsList as $job) {
                                    echo "<li><a href='/work/omdyac/about/#".$job['id']."'>".$job['Name']."</a>\n";
                                }
                            ?>
                        </ul>
                    </li>
                    <li><a href="/work/omdyac/contact/"><strong>Contact</strong><span>Contact the YAC</span></a>
                        <ul>
                            <li><a href="/work/omdyac/contact/#contact">Contact Members</a></li>
                            <li><a href="/work/omdyac/contact/#email">Email the Webmaster</a></li>
                        </ul>
                    </li>
                </ul>
            </div>	<!-- end #head -->

		<div id="featured">

			<div id="featured_image">
            	<img src="/work/omdyac/images/cover/cover.jpg" alt="" class='current_img' />
                <img src="/work/omdyac/images/cover/4.jpg" alt="" />
                <img src="/work/omdyac/images/cover/7.jpg" alt="" />
				<!--
                <img src="images/cover/1.jpg" alt="" />
				<img src="images/cover/2.jpg" alt="" />
                <img src="images/cover/3.jpg" alt="" />
                <img src="images/cover/4.jpg" alt="" />
                <img src="images/cover/5.jpg" alt="" />
                <img src="images/cover/6.jpg" alt="" />
                <img src="images/cover/7.jpg" alt="" />
                <img src="images/cover/8.jpg" alt="" />
                <img src="images/cover/9.jpg" alt="" />
                <img src="images/cover/10.jpg" alt="" />
                <img src="images/cover/11.jpg" alt="" />
                <img src="images/cover/12.jpg" alt="" />
                <img src="images/cover/13.jpg" alt="" /> -->
			</div><!--end featured_image-->

		</div><!--end featured-->

	  <div id="infotext">
      	<?php
			$mysql = new MySQL_Utilities;
			$mysql->connect("omdyac");
			$mysql->select("Events",'*','1=1',"StartDate ASC");
			$conInfo = $mysql->getResult();
			$currentEvent;
			foreach($conInfo as $info):
				if($info['StartDate'] > time()) {
					$currentEvent = $info;
					$done=false;
					break;
				} elseif ($info['StartDate'] < time() && $info['EndDate'] > time()) {
				$title = $info['Title'];
				$location = $info['Location'];
				$link = $info['MapLink'];
				$type = $info['Type'];

				$eventLink = "<a href='/work/omdyac/events?e=".$info['id']."' class='conLink'>".$title."</a>";
				$locationLink = "<a href='".$link."' class='conLink'>".$location."</a>";

				$startDay = date("F jS",$info['StartDate']);
				$endDay = date("jS", $info['EndDate']);

				echo '<h2 align="center">'. $eventLink .' (<span style="color: #36F;">'. $type .'</span>) is happening right now at '. $locationLink .'!<br />It started <span style="color: #36F">'. $startDay .'</span> and it will end the <span style="color: #36F">'. $endDay .'</span>.<br /><br />';
				$done=true;
				break;
				} else {
					$done = false;
				}
			endforeach;
			if(isset($currentEvent) && !$done) {
				$title = $currentEvent['Title'];
				$location = $currentEvent['Location'];
				$link = $currentEvent['MapLink'];
				$type = $currentEvent['Type'];

				$eventLink = "<a href='/work/omdyac/events?e=".$currentEvent['id']."' class='conLink'>".$title."</a>";
				$locationLink = "<a href='".$link."' class='conLink'>".$location."</a>";

				$startDay = date("F jS",$currentEvent['StartDate']);
				$endDay = date("jS", $currentEvent['EndDate']);

				if(strlen($currentEvent['YouthLink']) == 0) {
					$youthLink = '<a class="closed">Not Open</a>';
				} else {
					$youthLink = '<a class="open" href="'.$currentEvent["YouthLink"].'" target="_blank">Open</a>';
				}

				if(strlen($currentEvent['AdultLink']) == 0) {
					$adultLink = '<a class="closed">Not Open</a>';
				} else {
					$adultLink = '<a class="open" href="'.$currentEvent["AdultLink"].'" target="_blank">Open</a>'	;
				}

			echo '<h2 align="center">The next event is '. $eventLink .' (<span style="color: #36F;">'. $type .'</span>) taking place at '. $locationLink .'<br />from <span style="color: #36F">'. $startDay .'</span> to <span style="color: #36F">'. $endDay .'</span>.<br /><br />';

			echo '<div id="adultLink">Adult Registration: '. $adultLink .'</div><div id="youthLink">Youth Registration: '. $youthLink .'</div><br /><br />

			<div id="countbox1"></div>

			</h2>';
        } elseif (!$done){
        	echo '<h2 align="center">There are no more events planned</h2>';
        } ?>
		</div><!--end infotext-->

		<div id="main">
			<div class="box box_small box1"><a href="http://www.facebook.com/omdyac/"><img src="/work/omdyac/images/facebook.png" alt="OMD YAC Facebook" /></a><div class="underLine" style="clear: both;"></div>
                <?php

				$facebook = new facebook;
				$facebook->init();

				for($x = 0; $x < 2; $x++) {
					echo "<div class='underLine'>\n";
					echo "<br /><span class='date'>Posted on <em>";
					echo date("D, F jS",$facebook->getDate($x))."</em> at <em>".date("g:i a",$facebook->getDate($x));
					echo "</em></span><br />\n<p>";
					echo $facebook->getDesc($x,200);
					//echo "</p>\n<a class='more-link' href='".$facebook->getLink($x)."'>Read More</a><br />\n</div>\n\n";
					echo "</p>\n<a class='more-link' href='https://facebook.com/omdyac'>Read More</a><br />\n</div>\n\n";
				}

				?>

                <div class="underLine"><div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like-box href="http://www.facebook.com/pages/OMD-YAC/185507731518038" width="280" show_faces="false" border_color="" stream="false" header="true"></fb:like-box></div>
		  </div><!-- end .box -->


			<div class="box box_small box2">
				<a href="/work/omdyac/documents/#docs" ><img src="/work/omdyac/images/documents.png" alt="Important con forms and minutes" /></a>
                <div class="underLine" style="clear: both;"></div><br />
				<table width="100%" border="1" rules="rows">
                <tr><th style="background: #CCC;"><a href="/work/omdyac/documents/#docs">Documents</a></th></tr>
                <?php

					$mysql = new MySQL_Utilities;
                                                        $mysql->connect("omdyac");
					$mysql->select("documents",'*','1=1',"con DESC");
					$docs = $mysql->getResult();

					foreach($docs as $document):
							echo "<tr><td><a href='/work/omdyac/documents/".$document['Link']."'>".$document['Name']."</a></td></tr>\n";
					endforeach;

				?>
                </table>
			</div><!-- end .box -->

            <div class="box box_small box3">
				<a href="/work/omdyac/documents/#mins" ><img src="/work/omdyac/images/minutes.png" alt="Important con forms and minutes" /></a>
                <div class="underLine" style="clear: both;"></div><br />
				<table width="100%" border="1" rules="all">
                <tr><th style="background: #CCC;" colspan="2"><a href="/work/omdyac/documents/#mins">Minutes</a></th></tr>
                <?php

					$mysql = new MySQL_Utilities;
                                                        $mysql->connect("omdyac");
					$mysql->select("minutes",'*','1=1',"Year DESC");
					$docs = $mysql->getResult();
					foreach($docs as $document):
							echo "<tr><td><a href='/work/omdyac/documents/minutes/".$document['Link']."'>".$document['Name']."</a></td><td width='30px'>".$document['Year']."</td></tr>\n";
					endforeach;

				?>
                </table>
			</div><!-- end .box -->
		</div><!--end main-->

	</div><!-- end #top -->



</div><!-- end #wrapper -->

<div class='wrapper' id='footerwrap'>

	<div id='footer'>

		<div class="box box_mini">
			<h4>Social Action</h4>
			<ul>
				<?php
					$mysql = new MySQL_Utilities;
                    $mysql->connect("omdyac");
					$mysql->select("socialaction","*","1=1","id");
					$sacList = $mysql->getResult();

					$x = 0;
					foreach($sacList as $sac):
						if($x < 4) {
							echo "<li><a href='/work/omdyac/socialaction/?e=".$sac['id']."'>".$sac['Title']."</a></li>";
							$x++;
						}
					endforeach;
				?>
			</ul>
		</div>
		<div class="box box_mini">
			<h4>Events</h4>
			<ul>
			  	<?php
					$mysql = new MySQL_Utilities;
					$mysql->connect("omdyac");
					$mysql->select("Events","*","1=1","StartDate DESC");
					$conList = $mysql->getResult();

					foreach($conList as $con):
						echo "<li><a href='/work/omdyac/events/?e=".$con['id']."'>".$con['Title']."</a></li>";
					endforeach;
				?>
			</ul>
		</div>
		<div class="box box_mini">
			<h4>Pages</h4>
			<ul>
  				<li><a href="/work/omdyac/">Home</a></li>
				<li><a href="/work/omdyac/events/">Events</a></li>
				<li><a href="/work/omdyac/documents/">Documents</a></li>
				<li><a href="/work/omdyac/socialaction/">Social Action</a></li>
			  	<li><a href="/work/omdyac/about/">About</a></li>
				<li><a href="/work/omdyac/contact/">Contact</a></li>
                <li><a href="/work/omdyac/search/">Search</a></li>
			</ul>
		</div>
		<div class="box box_mini">
			<h4>Miscellaneous</h4>
			<ul>
				<li><a href="/work/omdyac/contact/#contact">Members' Emails</a></li>
				<li><a href="/work/omdyac/contact/#email">Email the webmaster</a></li>
				<li><a href="http://www.facebook.com/omdyac/">OMD YAC Facebook</a></li>
			</ul>
		</div>

		<div class="box box_custom_footer">
			<a href='/work/omdyac/contact/#email' class='custom_button ie6fix rounded'><strong>Contact Form</strong><span>get in touch with us</span></a>


			<div id='sitesearch_footer'>
			<h4>Search Site</h4>
				<form action="/work/omdyac/search/" id="searchform" method="get">
						<div><input type="text" class='rounded' id="s" name="search" value=""/>
						<input type="submit" value="." id="searchsubmit" class="button ie6fix"/>
						</div>
				</form>
			</div>


			<p>All content Copyright OMD YAC &copy; <?php echo date("Y"); ?></p>

			<ul class="social_bookmarks">
				<li class='rss'><a class='ie6fix' href="https://www.facebook.com/feeds/page.php?id=185507731518038&format=rss20">RSS</a></li>
				<li class='facebook'><a class='ie6fix' href="http://www.facebook.com/omdyac/">Facebook</a></li>
				<li class='twitter'><a class='ie6fix' href="#">Twitter</a></li>
				<li class='flickr'><a class='ie6fix' href="#">flickr</a></li>
			</ul>
		</div>


	</div><!--end footer-->

</div>
<script type="text/javascript">
				//######################################################################################
				// Author: ricocheting.com
				// Version: v2.0
				// Date: 2011-03-31
				// Description: displays the amount of time until the "dateFuture" entered below.

				// NOTE: the month entered must be one less than current month. ie; 0=January, 11=December
				// NOTE: the hour is in 24 hour format. 0=12am, 15=3pm etc
				// format: dateFuture1 = new Date(year,month-1,day,hour,min,sec)
				// example: dateFuture1 = new Date(2003,03,26,14,15,00) = April 26, 2003 - 2:15:00 pm

				dateFuture1 = new Date(<?php $int = (int)date("m", $currentEvent['StartDate'])-1;
				echo (int)date("Y", $currentEvent['StartDate']).",".$int.",".(int)date("j", $currentEvent['StartDate']).",".(int)date("G", $currentEvent['StartDate']).",".(int)date("i", $currentEvent['StartDate']).",".(int)date("s", $currentEvent['StartDate']); ?>);

				// TESTING: comment out the line below to print out the "dateFuture" for testing purposes
				//document.write(dateFuture +"<br />");


				//###################################
				//nothing beyond this point
				function GetCount(ddate,iid){

					dateNow = new Date();	//grab current date
					amount = ddate.getTime() - dateNow.getTime();	//calc milliseconds between dates
					delete dateNow;

					// if time is already past
					if(amount < 0){
						document.getElementById(iid).innerHTML= "<span style='color: #36F;'>" + <?php echo '"'.$currentEvent['Name'].'"'; ?> + "</span> is happening now!!!";
					}
					// else date is still good
					else{
						days=0;hours=0;mins=0;secs=0;out="";

						amount = Math.floor(amount/1000);//kill the "milliseconds" so just secs

						days=Math.floor(amount/86400);//days
						amount=amount%86400;

						hours=Math.floor(amount/3600);//hours
						amount=amount%3600;

						mins=Math.floor(amount/60);//minutes
						amount=amount%60;

						secs=Math.floor(amount);//seconds

						if(days != 0){out += "<span style='color: #36F;'>"+ days +"</span> "+((days==1)?"day":"days")+", ";}
						if(hours != 0){out += "<span style='color: #36F;'>"+ hours +"</span> "+((hours==1)?"hour":"hours")+", ";}
						out += "<span style='color: #36F;'>"+ mins +"</span> "+((mins==1)?"min":"mins")+", ";
						out += "<span style='color: #36F;'>"+ secs +"</span> "+((secs==1)?"sec":"secs")+", ";
						out += "until "+ "<span style='color: #36F'>" + <?php echo '"'.$currentEvent['Title'].'"'; ?> + '</span>!!!';
						//out = out.substr(0,out.length-2);    Idk what this was supposed to do...
						document.getElementById(iid).innerHTML=out;

						setTimeout(function(){GetCount(ddate,iid)}, 1000);
					}
				}

				window.onload=function(){
					GetCount(dateFuture1, 'countbox1');
					//you can add additional countdowns here (just make sure you create dateFuture2 and countbox2 etc for each)
				};
				</script>
</body>
</html>
