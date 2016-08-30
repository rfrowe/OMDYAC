<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
require($_SERVER['DOCUMENT_ROOT'] . "/work/omdyac/files/mysql.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>OMD YAC • Search</title>

	<link rel="stylesheet" href="/work/omdyac/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/work/omdyac/css/theme.css" type="text/css" media="all" />

    <link rel="icon" type="image/png" href="/work/omdyac/images/favicon.png" />

	<link rel="stylesheet" href="/work/omdyac/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="all" charset="utf-8" />

	<script type='text/javascript' src='/work/omdyac/js/jquery.js'></script>
	<script src="/work/omdyac/js/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

    <script language="javascript">
	function fixSearch() {
		document.getElementById("gsc-i-id1").value = "<?php echo $_GET['search']; ?>";
	}
	</script>

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
                <h1 class="logo ie6fix"><a href="/work/omdyac/" title="">OMD YAC</a></h1>
                <ul id="nav">
            <li><a href="/work/omdyac/"><strong>Home</strong><span>YAC Homepage</span></a></li>
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
                    <li class="current"><a href="/work/omdyac/about/"><strong>About</strong><span>About the OMD YAC</span></a>
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
						<li><a href="/work/omdyac/">Home</a></li>
						<li><a href="/work/omdyac/events/">Events</a>
                        	<ul>
                            	<?php
								foreach($conList as $con):
								echo "<li><a href='/work/omdyac/events/?e=".$con['id']."'>".$con['Title']." (".$con['Type'].")</a></li>";
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
						<li><a href="/work/omdyac/socialaction/">Social Action</a></li>
						<li><a href="/work/omdyac/about/">About</a>
                        	<ul>
                            	<li><a href="/work/omdyac/about/#mission">Mission Statement</a></li>
                                <li><a href="/work/omdyac/about/#jobs">Jobs</a></li>
                            </ul>
                        </li>
						<li><a href="/work/omdyac/contact/">Contact</a>
							<ul>
								<li><a href="/work/omdyac/contact/#contact">Members' Emails</a></li>
								<li><a href="/work/omdyac/contact/#email">Email the webmaster</a></li>
							</ul>
						</li>
                        <li><a href="/work/omdyac/socialaction/">Social Action</a></li>
						<li><a href="/work/omdyac/search/">Search</a></li>
                   </ul>


				</div>

			</div><!-- end #sidebar -->

			<div id="content">

				<div class='entry'>
					<h2>Search</h2>
					<div id="cse" style="width: 100%;">Loading</div>
					<script src="http://www.google.com/jsapi" type="text/javascript"></script>
                    <script type="text/javascript">
                      google.load('search', '1', {language : 'en', style : google.loader.themes.V2_DEFAULT});
                      google.setOnLoadCallback(function() {
                        var customSearchOptions = {};  var customSearchControl = new google.search.CustomSearchControl(
                          '003934138399150827551:gvaajlq4nt8', customSearchOptions);
                        customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
                        customSearchControl.draw('cse');
						fixSearch();
                      }, true);
                    </script>

                    <style type="text/css">
                      .gsc-control-cse {
                        font-family: Arial, sans-serif;
                        border-color: #FFFFFF;
                        background-color: #FFFFFF;
                      }
                      .gsc-control-cse .gsc-table-result {
                        font-family: Arial, sans-serif;
                      }
                      input.gsc-input, .gsc-input-box, .gsc-input-box-hover, .gsc-input-box-focus {
                        border-color: #D9D9D9;
                      }
                      input.gsc-search-button, input.gsc-search-button:hover, input.gsc-search-button:focus {
                        border-color: #2F5BB7;
                        background-color: #357AE8;
                        background-image: none;
                        filter: none;
                      }
                      .gsc-tabHeader.gsc-tabhInactive {
                        border-color: #CCCCCC;
                        background-color: #FFFFFF;
                      }
                      .gsc-tabHeader.gsc-tabhActive {
                        border-color: #CCCCCC;
                        border-bottom-color: #FFFFFF;
                        background-color: #FFFFFF;
                      }
                      .gsc-tabsArea {
                        border-color: #CCCCCC;
                      }
                      .gsc-webResult.gsc-result,
                      .gsc-results .gsc-imageResult {
                        border-color: #FFFFFF;
                        background-color: #FFFFFF;
                      }
                      .gsc-webResult.gsc-result:hover,
                      .gsc-imageResult:hover {
                        border-color: #FFFFFF;
                        background-color: #FFFFFF;
                      }
                      .gs-webResult.gs-result a.gs-title:link,
                      .gs-webResult.gs-result a.gs-title:link b,
                      .gs-imageResult a.gs-title:link,
                      .gs-imageResult a.gs-title:link b {
                        color: #1155CC;
                      }
                      .gs-webResult.gs-result a.gs-title:visited,
                      .gs-webResult.gs-result a.gs-title:visited b,
                      .gs-imageResult a.gs-title:visited,
                      .gs-imageResult a.gs-title:visited b {
                        color: #1155CC;
                      }
                      .gs-webResult.gs-result a.gs-title:hover,
                      .gs-webResult.gs-result a.gs-title:hover b,
                      .gs-imageResult a.gs-title:hover,
                      .gs-imageResult a.gs-title:hover b {
                        color: #1155CC;
                      }
                      .gs-webResult.gs-result a.gs-title:active,
                      .gs-webResult.gs-result a.gs-title:active b,
                      .gs-imageResult a.gs-title:active,
                      .gs-imageResult a.gs-title:active b {
                        color: #1155CC;
                      }
                      .gsc-cursor-page {
                        color: #1155CC;
                      }
                      a.gsc-trailing-more-results:link {
                        color: #1155CC;
                      }
                      .gs-webResult .gs-snippet,
                      .gs-imageResult .gs-snippet,
                      .gs-fileFormatType {
                        color: #333333;
                      }
                      .gs-webResult div.gs-visibleUrl,
                      .gs-imageResult div.gs-visibleUrl {
                        color: #009933;
                      }
                      .gs-webResult div.gs-visibleUrl-short {
                        color: #009933;
                      }
                      .gs-webResult div.gs-visibleUrl-short {
                        display: none;
                      }
                      .gs-webResult div.gs-visibleUrl-long {
                        display: block;
                      }
                      .gs-promotion div.gs-visibleUrl-short {
                        display: none;
                      }
                      .gs-promotion div.gs-visibleUrl-long {
                        display: block;
                      }
                      .gsc-cursor-box {
                        border-color: #FFFFFF;
                      }
                      .gsc-results .gsc-cursor-box .gsc-cursor-page {
                        border-color: #CCCCCC;
                        background-color: #FFFFFF;
                        color: #1155CC;
                      }
                      .gsc-results .gsc-cursor-box .gsc-cursor-current-page {
                        border-color: #CCCCCC;
                        background-color: #FFFFFF;
                        color: #1155CC;
                      }
                      .gsc-webResult.gsc-result.gsc-promotion {
                        border-color: #F6F6F6;
                        background-color: #F6F6F6;
                      }
                      .gsc-completion-title {
                        color: #1155CC;
                      }
                      .gsc-completion-snippet {
                        color: #333333;
                      }
                      .gs-promotion a.gs-title:link,
                      .gs-promotion a.gs-title:link *,
                      .gs-promotion .gs-snippet a:link {
                        color: #1155CC;
                      }
                      .gs-promotion a.gs-title:visited,
                      .gs-promotion a.gs-title:visited *,
                      .gs-promotion .gs-snippet a:visited {
                        color: #1155CC;
                      }
                      .gs-promotion a.gs-title:hover,
                      .gs-promotion a.gs-title:hover *,
                      .gs-promotion .gs-snippet a:hover {
                        color: #1155CC;
                      }
                      .gs-promotion a.gs-title:active,
                      .gs-promotion a.gs-title:active *,
                      .gs-promotion .gs-snippet a:active {
                        color: #1155CC;
                      }
                      .gs-promotion .gs-snippet,
                      .gs-promotion .gs-title .gs-promotion-title-right,
                      .gs-promotion .gs-title .gs-promotion-title-right *  {
                        color: #333333;
                      }
                      .gs-promotion .gs-visibleUrl,
                      .gs-promotion .gs-visibleUrl-short {
                        color: #009933;
                      }
                    </style>

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
</body>
</html>
