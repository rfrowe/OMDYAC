<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
date_default_timezone_set("America/New_York");
require($_SERVER['DOCUMENT_ROOT'] . "/work/omdyac/public_html/files/mysql.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>OMD YAC &bull; Events</title>

    <link rel="stylesheet" href="/work/omdyac/public_html/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/work/omdyac/public_html/css/theme.css" type="text/css" media="all" />

    <link rel="icon" type="image/png" href="/work/omdyac/public_html/images/favicon.png" />

	<link rel="stylesheet" href="/work/omdyac/public_html/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="all" charset="utf-8" />

	<script type='text/javascript' src='/work/omdyac/public_html/js/jquery.js'></script>
	<script src="/work/omdyac/public_html/js/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

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

<body id='subpage'>

<div class='wrapper'>

	<div id="top">

		<div id="head">
                <h1 class="logo ie6fix"><a href="/work/omdyac/public_html/" title="">OMD YAC</a></h1>
                <ul id="nav">
            <li><a href="/work/omdyac/public_html/"><strong>Home</strong><span>YAC Homepage</span></a></li>
            <li class="current"><a href="/work/omdyac/public_html/events/"><strong>Events</strong><span>Events and Info</span></a>
                <ul>
                    <?php
                        $mysql = new MySQL_Utilities;
                        $mysql->connect("omdyac");
                        $mysql->select("Events",'*','1=1',"StartDate");
                        $conList = $mysql->getResult();

                                foreach($conList as $con) {
                                    echo "<li><a href='/work/omdyac/public_html/events/?e=".$con['id']."'>".$con['Title']." &raquo;</a>\n";

                                        echo "\t<ul>\n";

                                            //START REGISTRATION
                                            if(strlen($con['YouthLink']) != 0 || strlen($con['AdultLink']) != 0) {
                                                echo "\t\t<li><a href='/work/omdyac/public_html/events/?e=".$con['id']."#reg'>Registration &raquo;</a>\n";
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
                                            echo "\t\t<li><a href='/work/omdyac/public_html/events/?e=".$con['id']."#loc'>Location &raquo;</a>\n";
                                                echo "\t\t\t<ul>\n";

                                                    echo "\t\t\t\t<li><a href='".$con['MapLink']."'>Google Maps</a></li>\n";

                                                echo "\t\t\t</ul>\n";
                                            echo "\t\t</li>\n";
                                            //END LOCATION

                                            //START YOUTH FORMS
                                            echo "\t\t<li><a href='/work/omdyac/public_html/events/?e=".$con['id']."#forms'>Youth Forms &raquo;</a>\n";
                                                echo "\t\t\t<ul>\n";

                                                    foreach(explode("|",$con['YouthForms']) as $formID) {
                                                        $mysql = new MySQL_Utilities;
                                                        $mysql->connect("omdyac");
                                                        $mysql->select("documents",'*',"id = ".$formID);
                                                        $form = $mysql->getResult();
                                                        $form = $form['1'];
                                                        echo "\t\t\t\t<li><a href='/work/omdyac/public_html/documents/".$form['Link']."'>".$form['Name']."</a></li>\n";
                                                    }

                                                echo "\t\t\t</ul>\n";
                                            echo "\t\t</li>\n";
                                            //END YOUTH FORMS

                                            //START ADULT FORMS
                                            echo "\t\t<li><a href='/work/omdyac/public_html/events/?e=".$con['id']."#forms'>Adult Forms &raquo;</a>\n";
                                                echo "\t\t\t<ul>\n";

                                                    foreach(explode("|",$con['AdultForms']) as $formID) {
                                                        $mysql = new MySQL_Utilities;
                                                        $mysql->connect("omdyac");
                                                        $mysql->select("documents",'*',"id = ".$formID);
                                                        $form = $mysql->getResult();
                                                        $form = $form['1'];
                                                        echo "\t\t\t\t<li><a href='/work/omdyac/public_html/documents/".$form['Link']."'>".$form['Name']."</a></li>\n";
                                                    }

                                                echo "\t\t\t</ul>\n";
                                            echo "\t\t</li>\n";
                                            //END ADULT FORMS

                                            //START CON INFO
                                            if(!$con['YacMeeting']) {
                                                echo "\t\t<li><a href='/work/omdyac/public_html/events/?e=".$con['id']."#coninfo'>Con Info &raquo;</a>\n";
                                                    echo "\t\t\t<ul>\n";

                                                        echo "\t\t\t\t<li><a href='/work/omdyac/public_html/events/?e=".$con['id']."#touchgroups'>Touchgroups</a></li>\n";
                                                        echo "\t\t\t\t<li><a href='/work/omdyac/public_html/events/?e=".$con['id']."#workshops'>Workshops</a></li>\n";
                                                        echo "\t\t\t\t<li><a href='/work/omdyac/public_html/events/?e=".$con['id']."#chaplains'>Chaplains</a></li>\n";
                                                        echo "\t\t\t\t<li><a href='/work/omdyac/public_html/events/?e=".$con['id']."#nightangels'>Nightangels</a></li>\n";

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
                    <li><a href="/work/omdyac/public_html/documents/"><strong>Documents</strong><span>Docs and Minutes</span></a>
                        <ul>
                            <li><a href="/work/omdyac/public_html/documents/#conForms">Con Forms</a></li>
                    		<li><a href="/work/omdyac/public_html/documents/#docs">Documents</a></li>
                    		<li><a href="/work/omdyac/public_html/documents/#mins">Minutes</a></li>
                        </ul>
                    </li>
                    <li><a href="/work/omdyac/public_html/socialaction/"><strong>Social Action</strong><span>YAC's Social Action</span></a>
                        <ul>
                            <?php
                                $mysql = new MySQL_Utilities;
                                $mysql->connect("omdyac");
                                $mysql->select("socialaction",'*','1=1','id');
                                $socialActionList = $mysql->getResult();

                                foreach($socialActionList as $socialAction) {
                                    echo "<li><a href='/work/omdyac/public_html/socialaction/?e=".$socialAction['id']."'>".$socialAction['Title']."</a>\n";
                                }
                            ?>
                        </ul>
                    </li>
                    <li><a href="/work/omdyac/public_html/about/"><strong>About</strong><span>About the OMD YAC</span></a>
                        <ul>
                            <li><a href="/work/omdyac/public_html/about/#mission">Mission Statement</a></li>
                            <?php
                                $mysql = new MySQL_Utilities;
                                $mysql->connect("omdyac");
                                $mysql->select("jobs",'*','1=1',"id");
                                $jobsList = $mysql->getResult();

                                foreach($jobsList as $job) {
                                    echo "<li><a href='/work/omdyac/public_html/about/#".$job['id']."'>".$job['Name']."</a>\n";
                                }
                            ?>
                        </ul>
                    </li>
                    <li><a href="/work/omdyac/public_html/contact/"><strong>Contact</strong><span>Contact the YAC</span></a>
                        <ul>
                            <li><a href="/work/omdyac/public_html/contact/#contact">Contact Members</a></li>
                            <li><a href="/work/omdyac/public_html/contact/#email">Email the Webmaster</a></li>
                        </ul>
                    </li>
                </ul>
            </div>	<!-- end #head -->

		<div id="main">
			<div id='sidebar'>
            <div class="box box_small">
				<div id='sitesearch_sidebar'>
				<h4>Search Site</h4>
				<form action="/work/omdyac/public_html/search/" id="searchform" method="get">
						<div><input type="text" class='rounded' id="s" name="search" value=""/>
						<input type="submit" value="." id="searchsubmit" class="button ie6fix"/>
						</div>
				</form>
				</div>
			</div>
			<div class="box box_small">

					<h3>Pages</h3>
					<ul>
						<li><a href="/work/omdyac/public_html/">Home</a></li>
						<li><a href="/work/omdyac/public_html/events/">Events</a>
                        	<ul>
                            	<?php
								foreach($conList as $con):
								echo "<li><a href='/work/omdyac/public_html/events/?e=".$con['id']."'>".$con['Title']." (".$con['Type'].")</a></li>";
								endforeach;
								?>
                            </ul>
                        </li>
                        <li><a href="/work/omdyac/public_html/documents/">Documents</a>
                        	<ul>
                            	<li><a href="/work/omdyac/public_html/documents/#conForms">Con Forms</a></li>
                                <li><a href="/work/omdyac/public_html/documents/#docs">Documents</a></li>
                                <li><a href="/work/omdyac/public_html/documents/#mins">Minutes</a></li>
                            </ul>
                        </li>
						<li><a href="/work/omdyac/public_html/socialaction/">Social Action</a></li>
						<li><a href="/work/omdyac/public_html/about/">About</a>
                        	<ul>
                            	<li><a href="/work/omdyac/public_html/about/#mission">Mission Statement</a></li>
                                <li><a href="/work/omdyac/public_html/about/#jobs">Jobs</a></li>
                            </ul>
                        </li>
						<li><a href="/work/omdyac/public_html/contact/">Contact</a>
							<ul>
								<li><a href="/work/omdyac/public_html/contact/#contact">Members' Emails</a></li>
								<li><a href="/work/omdyac/public_html/contact/#email">Email the webmaster</a></li>
							</ul>
						</li>
                        <li><a href="/work/omdyac/public_html/socialaction/">Social Action</a></li>
						<li><a href="/work/omdyac/public_html/search/">Search</a></li>
                   </ul>


				</div>

			</div><!-- end #sidebar -->

			<div id="content">

            	<?php

				$mysql = new MySQL_Utilities;
				$mysql->connect("omdyac");
				$mysql->select("Events","*","id = ".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], stripslashes($_GET['e'])) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")));
				$eventInfo = $mysql->getResult();
				if(count($eventInfo) == 0) {
					echo "<script language='javascript'>alert('There was an error retrieving the event information. Please contact the webmaster at redacted@address.com'); window.location = './'</script>";
				}

				$eventInfo = $eventInfo['1'];

				$startDay = date("d",$eventInfo['StartDate']);
				$endDay = date("d",$eventInfo['EndDate']);
				$year = date("Y",$eventInfo['StartDate']);
				$month = date("M",$eventInfo['StartDate']);

				if($eventInfo['YacMeeting'] == false) {
				$sql2 = new MySQL_Utilities;
				$sql2->connect("omdyac");
				$sql2->select("ConStuff","*","conid = ".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], stripslashes($_GET['e'])) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")));
				$conInfo = $sql2->getResult();
				$conInfo = $conInfo['1'];
				$nightAngels = explode("|",$conInfo['NightAngels']);
				$workshopArray = explode("|",$conInfo['Workshops']);
				$tgLeaderArray = explode("|",$conInfo['TouchGroups']);
				$chaplainArray = explode("|",$conInfo['Chaplains']);

				}
				if(strlen($eventInfo['YouthLink']) == 0) {
						$youth = '<a class="closed">Not Open</a>';
					} else {
						$youth = '<a class="open" href="'.$eventInfo["YouthLink"].'" target="_blank">Open</a>';
					}

					if(strlen($eventInfo['AdultLink']) == 0) {
						$adult = '<a class="closed">Not Open</a>';
					} else {
						$adult = '<a class="open" href="'.$eventInfo["AdultLink"].'" target="_blank">Open</a>'	;
					}

				?>

				<div class='entry blogentry'>
				<div class="condate">
	       				<span class='conday'><?php echo $startDay."-".$endDay; ?></span>
	       				<span class='conmonth'><?php echo $month; ?></span>
	       				<span class='conyear'><?php echo $year; ?></span>
	       			</div><!-- end date -->
				  <h2><?php echo $eventInfo['Title']; ?></h2>

				  <div class='post_data'>
						<span class='categories'>&nbsp;</span>
						<span class='author'>posted by <a href='#'>OMD YAC</a></span>
						</div><!--end post data-->
						<p>
                        	<table class='con-table' border='1' width='100%' rules='groups'>
                            <colgroup span="2"></colgroup> <colgroup></colgroup>
                            <tbody>
                                <tr>
                                    <th colspan="3">Con Information</th>
                                </tr>
                            </tbody>
                            <tbody id="reg">
                                <tr>
                                    <th width="15%">Registration</th>
                                    <td width="60%">Adult Link: <?php echo $adult; ?></td>
                                    <td width="25%">Youth Link: <?php echo $youth; ?></td>
                                </tr>
                            </tbody>
                            <?php if($eventInfo['YacMeeting'] == false) {
                            echo '<tbody>
                            	<tr>
                                	<th rowspan="2">Touchgroups and Chaplains</th>
                                    <td id="touchgroups">Touchgroup Leaders:</td><td id="chaplains">Chaplains:</td>
                                </tr>
                                <tr>
                                	<td>
										<table border="1" frame="box" width="100%" rules="rows" class="mini-con">';
											foreach($tgLeaderArray as $tgLeader) {
												echo "<tr><td>".$tgLeader."</td></tr>";
											}
                                    	echo '</table>
                                    </td>
                                    <td>
										<table border="1" frame="box" width="100%" rules="rows" class="mini-con">';
											foreach($chaplainArray as $chaplain) {
												echo "<tr><td>".$chaplain."</td></tr>";
											}
                                    	echo '</table>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <th rowspan="2">Workshops and Night Angels</th>
                                    <td id="workshops">Workshops:</td><td id="nightangels">Night Angels:</td>
                                </tr>
                                <tr>
                                    <td>
										<table border="1" frame="box" width="100%" rules="rows" class="mini-con" height="100%">';
										foreach($workshopArray as $workshop) {
											echo "<tr><td>".$workshop."</td></tr>";
										}
                                     	echo '</table>
                                    </td>
                                    <td>
                                        <table border="1" frame="box" width="100%" rules="all">
                                            <tr>
                                                <th colspan="2">Friday</th>
                                            </tr>
                                            <tr>
                                                <th width="30px">1-3</th>
                                                <td>'; echo $nightAngels[0]."<br />".$nightAngels[1]; echo '</td>
                                            </tr>
                                            <tr>
                                                <th width="30px">3-5</th>
                                                <td>'; echo $nightAngels[2]."<br />".$nightAngels[3]; echo '</td>
                                            </tr>
                                            <tr>
                                                <th width="30px">5-7</th>
                                                <td>'; echo $nightAngels[4]."<br />".$nightAngels[5]; echo '</td>
                                            </tr>
                                         </table><br />
                                         <table border="1" frame="box" width="100%" rules="all">
                                            <tr>
                                                <th colspan="2">Saturday</th>
                                            </tr>
                                            <tr>
                                                <th width="30px">1-3</th>
                                                <td>'; echo $nightAngels[6]."<br />".$nightAngels[7]; echo '</td>
                                            </tr>
                                            <tr>
                                                <th width="30px">3-5</th>
                                                <td>'; echo $nightAngels[8]."<br />".$nightAngels[9]; echo '</td>
                                            </tr>
                                            <tr>
                                                <th width="30px">5-7</th>
                                                <td>'; echo $nightAngels[10]."<br />".$nightAngels[11]; echo '</td>
                                            </tr>
                                        </table>
                                     </td>
                                 </tr>
                             </tbody>';
							} ?>
                             <tbody id="loc">
                            	<tr>
                                	<th>Location</th>
                                    <td colspan="2"><?php echo "<a href='".$eventInfo['MapLink']."'>".$eventInfo['Location']."</a>" ?></td>
                                </tr>
                            </tbody>
                            </table><br />
						  <h3><u>Additional Information</u></h3><br />
                          <span class="desc">
                          <p><?php
						  	echo $eventInfo['Description'];
						  ?></p>
                          <p>
                          <ul class="forms" id="forms">
                          <li>Youth Forms:
                          <ul>
                          <?php
						  		foreach(explode("|",$eventInfo['YouthForms']) as $form):
									$mysql = new MySQL_Utilities;
									$mysql->connect("omdyac");
									$mysql->select("documents",'*','id = '.$form);
									$doc = $mysql->getResult();
									$doc = $doc['1'];
									echo "<li><a href='/work/omdyac/public_html/documents/".$doc['Link']."'>".$doc['Name']."</a></li>\n";
								endforeach;
						  ?>
                          </ul></li>
                          <li>Adult Forms:
                          <ul style="list-style-type: square;">
							  <?php
                                    foreach(explode("|",$eventInfo['AdultForms']) as $form):
                                        $mysql = new MySQL_Utilities;
                                        $mysql->connect("omdyac");
                                        $mysql->select("documents",'*','id = '.$form);
                                        $doc = $mysql->getResult();
										$doc = $doc['1'];
                                        echo "<li><a href='/work/omdyac/public_html/documents/".$doc['Link']."'>".$doc['Name']."</a></li>\n";
                                    endforeach;
                              ?>
                          </ul></li></ul>
                          </p>
                          </span>

				<!--end entry-->
			  </div>

			</div><!-- end content -->

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
							echo "<li><a href='/work/omdyac/public_html/socialaction/?e=".$sac['id']."'>".$sac['Title']."</a></li>";
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
						echo "<li><a href='/work/omdyac/public_html/events/?e=".$con['id']."'>".$con['Title']."</a></li>";
					endforeach;
				?>
			</ul>
		</div>
		<div class="box box_mini">
			<h4>Pages</h4>
			<ul>
  				<li><a href="/work/omdyac/public_html/">Home</a></li>
				<li><a href="/work/omdyac/public_html/events/">Events</a></li>
				<li><a href="/work/omdyac/public_html/documents/">Documents</a></li>
				<li><a href="/work/omdyac/public_html/socialaction/">Social Action</a></li>
			  	<li><a href="/work/omdyac/public_html/about/">About</a></li>
				<li><a href="/work/omdyac/public_html/contact/">Contact</a></li>
                <li><a href="/work/omdyac/public_html/search/">Search</a></li>
			</ul>
		</div>
		<div class="box box_mini">
			<h4>Miscellaneous</h4>
			<ul>
				<li><a href="/work/omdyac/public_html/contact/#contact">Members' Emails</a></li>
				<li><a href="/work/omdyac/public_html/contact/#email">Email the webmaster</a></li>
				<li><a href="http://www.facebook.com/omdyac/">OMD YAC Facebook</a></li>
			</ul>
		</div>

		<div class="box box_custom_footer">
			<a href='/work/omdyac/public_html/contact/#email' class='custom_button ie6fix rounded'><strong>Contact Form</strong><span>get in touch with us</span></a>


			<div id='sitesearch_footer'>
			<h4>Search Site</h4>
				<form action="/work/omdyac/public_html/search/" id="searchform" method="get">
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

</body>
</html>
