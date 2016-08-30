<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
require($_SERVER['DOCUMENT_ROOT'] . "/work/omdyac/files/mysql.php");

$curl = curl_init("https://".$_POST['form-selector']);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_USERPWD, '3645-ZYR2-B20H-OOHA:footastic');
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'OMDYAC Site');

$response = curl_exec($curl);
$resultStatus = curl_getinfo($curl);

//CHANGE THESE IF FORM CHANGES
//
$fieldNumbers = array("firstName" => 1, "lastName" => 2, "congregation" => 28, "birthdate" => 26);
//
//
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>OMD YAC • Touch Group Sort-o-matic</title>

	<link rel="stylesheet" href="/work/omdyac/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/work/omdyac/css/theme.css" type="text/css" media="all" />

    <link rel="icon" type="image/png" href="/work/omdyac/images/favicon.png" />

	<link rel="stylesheet" href="/work/omdyac/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="all" charset="utf-8" />

	<script type='text/javascript' src='/work/omdyac/js/jquery.js'></script>
	<script src="/work/omdyac/js/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

	<!--[if IE 6]>
	<script type='text/javascript' src='js/dd_belated_png.js'></script>
	<script>DD_belatedPNG.fix('.ie6fix');</script>
	<style>#footer .box ul li a, #sidebar .box ul a {zoom:1;}</style>
	<![endif]-->

    <style>
	#entriesTable {
		color: #222;
		border: 1px black solid;
		text-align:left;
		vertical-align:middle;
		width: 100%;
	}
	#entriesTable th, #entriesTable td {
		padding: 3px 10px 3px 10px;
	}
	#entriesTable th {
		background: #555;
		color: #FFF;
		text-align:center;
	}
	#entriesTable td {
		background: #AAA;
	}
	#entriesTable td.odd {
		background: #888;
	}
	</style>

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
                <h1 class="logo ie6fix"><a href="/work/omdyac/" title="">OMD YAC</a></h1>
                <ul id="nav">
            <li><a href="/"><strong>Home</strong><span>YAC Homepage</span></a></li>
            <li><a href="/work/omdyac/events/"><strong>Events</strong><span>Events and Info</span></a>
                <ul>
                    <?php
                        $mysql = new MySQL_Utilities;
                        $mysql->connect("omdyac");
                        $mysql->select("Events",'*','1=1',"StartDate");
                        $conList = $mysql->getResult();

                                foreach($conList as $con) {
                                    echo "<li><a href='/events/?e=".$con['id']."'>".$con['Title']." &raquo;</a>\n";

                                        echo "\t<ul>\n";

                                            //START REGISTRATION
                                            if(strlen($con['YouthLink']) != 0 || strlen($con['AdultLink']) != 0) {
                                                echo "\t\t<li><a href='/events/?e=".$con['id']."#reg'>Registration &raquo;</a>\n";
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
                                            echo "\t\t<li><a href='/events/?e=".$con['id']."#loc'>Location &raquo;</a>\n";
                                                echo "\t\t\t<ul>\n";

                                                    echo "\t\t\t\t<li><a href='".$con['MapLink']."'>Google Maps</a></li>\n";

                                                echo "\t\t\t</ul>\n";
                                            echo "\t\t</li>\n";
                                            //END LOCATION

                                            //START YOUTH FORMS
                                            echo "\t\t<li><a href='/events/?e=".$con['id']."#forms'>Youth Forms &raquo;</a>\n";
                                                echo "\t\t\t<ul>\n";

                                                    foreach(explode("|",$con['YouthForms']) as $formID) {
                                                        $mysql = new MySQL_Utilities;
                                                        $mysql->connect("omdyac");
                                                        $mysql->select("documents",'*',"id = ".$formID);
                                                        $form = $mysql->getResult();
                                                        $form = $form['1'];
                                                        echo "\t\t\t\t<li><a href='/documents/".$form['Link']."'>".$form['Name']."</a></li>\n";
                                                    }

                                                echo "\t\t\t</ul>\n";
                                            echo "\t\t</li>\n";
                                            //END YOUTH FORMS

                                            //START ADULT FORMS
                                            echo "\t\t<li><a href='/events/?e=".$con['id']."#forms'>Adult Forms &raquo;</a>\n";
                                                echo "\t\t\t<ul>\n";

                                                    foreach(explode("|",$con['AdultForms']) as $formID) {
                                                        $mysql = new MySQL_Utilities;
                                                        $mysql->connect("omdyac");
                                                        $mysql->select("documents",'*',"id = ".$formID);
                                                        $form = $mysql->getResult();
                                                        $form = $form['1'];
                                                        echo "\t\t\t\t<li><a href='/documents/".$form['Link']."'>".$form['Name']."</a></li>\n";
                                                    }

                                                echo "\t\t\t</ul>\n";
                                            echo "\t\t</li>\n";
                                            //END ADULT FORMS

                                            //START CON INFO
                                            if(!$con['YacMeeting']) {
                                                echo "\t\t<li><a href='/events/?e=".$con['id']."#coninfo'>Con Info &raquo;</a>\n";
                                                    echo "\t\t\t<ul>\n";

                                                        echo "\t\t\t\t<li><a href='/events/?e=".$con['id']."#touchgroups'>Touchgroups</a></li>\n";
                                                        echo "\t\t\t\t<li><a href='/events/?e=".$con['id']."#workshops'>Workshops</a></li>\n";
                                                        echo "\t\t\t\t<li><a href='/events/?e=".$con['id']."#chaplains'>Chaplains</a></li>\n";
                                                        echo "\t\t\t\t<li><a href='/events/?e=".$con['id']."#nightangels'>Nightangels</a></li>\n";

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
                    <li class="current"><a href="/work/omdyac/documents/"><strong>Documents</strong><span>Docs and Minutes</span></a>
                        <ul>
                            <li><a href="/work/omdyac/documents/#conForms">Con Forms</a></li>
                    <li><a href="/work/omdyac/documents/#docs">Documents</a></li>
                    <li><a href="/work/omdyac/documents/#mins">Minutes</a></li>
                        </ul>
                    </li>
                    <li><a href="/socialaction/"><strong>Social Action</strong><span>YAC's Social Action</span></a>
                        <ul>
                            <?php
                                $mysql = new MySQL_Utilities;
                                                        $mysql->connect("omdyac");
                                $mysql->select("socialaction",'*','1=1','id');
                                $socialActionList = $mysql->getResult();

                                foreach($socialActionList as $socialAction) {
                                    echo "<li><a href='/socialaction/?e=".$socialAction['id']."'>".$socialAction['Title']."</a>\n";
                                }
                            ?>
                        </ul>
                    </li>
                    <li><a href="/about/"><strong>About</strong><span>About the OMD YAC</span></a>
                        <ul>
                            <li><a href="/about/#mission">Mission Statement</a></li>
                            <?php
                                $mysql = new MySQL_Utilities;
                                                        $mysql->connect("omdyac");
                                $mysql->select("jobs",'*','1=1',"id");
                                $jobsList = $mysql->getResult();

                                foreach($jobsList as $job) {
                                    echo "<li><a href='/about/#".$job['id']."'>".$job['Name']."</a>\n";
                                }
                            ?>
                        </ul>
                    </li>
                    <li><a href="/contact/"><strong>Contact</strong><span>Contact the YAC</span></a>
                        <ul>
                            <li><a href="/contact/#contact">Contact Members</a></li>
                            <li><a href="/contact/#email">Email the Webmaster</a></li>
                        </ul>
                    </li>
                </ul>
            </div>	<!-- end #head -->


		<div id="main">
			<div id='sidebar'>
            <div class="box box_small">
				<div id='sitesearch_sidebar'>
				<h4>Search Site</h4>
				<form action="/work/omdyac/search/" id="searchform" method="get">
						<div><input type="text" class='rounded' id="s" name="search" value=""/>
						<input type="submit" value="." id="searchsubmit" class="button ie6fix"/>
						</div>
				</form>
				</div>
			</div>
			<div class="box box_small">

					<h3>Pages</h3>
					<ul>
						<li><a href="/">Home</a></li>
						<li><a href="/work/omdyac/events/">Events</a>
                        	<ul>
                            	<?php
								foreach($conList as $con):
								echo "<li><a href='/events/?e=".$con['id']."'>".$con['Title']." (".$con['Type'].")</a></li>";
								endforeach;
								?>
                            </ul>
                        </li>
                        <li><a href="/work/omdyac/documents/">Documents</a>
                        	<ul>
                            	<li><a href="/work/omdyac/documents/#conForms">Con Forms</a></li>
                                <li><a href="/work/omdyac/documents/#docs">Documents</a></li>
                                <li><a href="/work/omdyac/documents/#mins">Minutes</a></li>
                            </ul>
                        </li>
						<li><a href="/socialaction/">Social Action</a></li>
						<li><a href="/about/">About</a>
                        	<ul>
                            	<li><a href="/about/#mission">Mission Statement</a></li>
                                <li><a href="/about/#jobs">Jobs</a></li>
                            </ul>
                        </li>
						<li><a href="/contact/">Contact</a>
							<ul>
								<li><a href="/contact/#contact">Members' Emails</a></li>
								<li><a href="/contact/#email">Email the webmaster</a></li>
							</ul>
						</li>
                        <li><a href="/socialaction/">Social Action</a></li>
						<li><a href="/search/">Search</a></li>
                   </ul>


				</div><!--end box-->

			</div><!-- end #sidebar -->

			<div id="content">

				<div class='entry'>
					<h2><u>Touch Group Sort-o-matic</u></h2><br />
                    <h3>Showing entries for <?php echo $_POST['hiddenName']; ?></h3>
					<?php
					if($resultStatus['http_code'] == 200) {
						$htmlresponse = htmlentities($response);
						$entriesList = simplexml_load_string($response);
						echo $entriesList->count();
						echo "
						<p>Please check \"Exclude\" for any entries that will <u>not</u> be in touch groups, i.e. co-chairs and chaplains.</p>\n
						<table id='entriesTable' name='entries-table' rules='all'>
						\n\t<tr>
						\n\t\t<th width='20%'>First Name</th>
						\n\t\t<th width='20%'>Last Name</th>
						\n\t\t<th width='40%'>Congregation</th>
						\n\t\t<th width='10%'>Age</th>
						\n\t\t<th width='10%'>Exclude</th>
						\n\t</tr>
						";

						for($x = 0; $x < count($entriesList); $x++) {
							$bdate = $entriesList->Entry[$x]->{'Field'.$fieldNumbers['birthdate']};
							$age = floor((time($bdate) - strtotime($bdate))/31556926);
							echo "\n\t<tr>";
							echo "\n\t\t<td>".$entriesList->Entry[$x]->{'Field'.$fieldNumbers['firstName']}."</td>";
							echo "\n\t\t<td>".$entriesList->Entry[$x]->{'Field'.$fieldNumbers['lastName']}."</td>";
							echo "\n\t\t<td>".$entriesList->Entry[$x]->{'Field'.$fieldNumbers['congregation']}."</td>";
							echo "\n\t\t<td>$age</td>";
							echo "\n\t\t<td><input type='checkbox' name='$x'/></td";
							echo "\n\t</tr>";
						}

						echo "\n</table>";
					} else {
						echo '<p style="color:red;">There was an error connecting to '.$_POST['form-selector'].'</p>';
					}

					?>
				</div><!--end entry-->

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
							echo "<li><a href='/socialaction/?e=".$sac['id']."'>".$sac['Title']."</a></li>";
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
						echo "<li><a href='/events/?e=".$con['id']."'>".$con['Title']."</a></li>";
					endforeach;
				?>
			</ul>
		</div>
		<div class="box box_mini">
			<h4>Pages</h4>
			<ul>
  				<li><a href="/">Home</a></li>
				<li><a href="/work/omdyac/events/">Events</a></li>
				<li><a href="/work/omdyac/documents/">Documents</a></li>
				<li><a href="/socialaction/">Social Action</a></li>
			  	<li><a href="/about/">About</a></li>
				<li><a href="/contact/">Contact</a></li>
                <li><a href="/search/">Search</a></li>
			</ul>
		</div>
		<div class="box box_mini">
			<h4>Miscellaneous</h4>
			<ul>
				<li><a href="/contact/#contact">Members' Emails</a></li>
				<li><a href="/contact/#email">Email the webmaster</a></li>
				<li><a href="http://www.facebook.com/omdyac/">OMD YAC Facebook</a></li>
			</ul>
		</div>

		<div class="box box_custom_footer">
			<a href='/contact/#email' class='custom_button ie6fix rounded'><strong>Contact Form</strong><span>get in touch with us</span></a>


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

</body>
</html>
