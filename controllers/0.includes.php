<?php 
	session_start();
	date_default_timezone_set("Europe/Paris");	
	header("Content-Type: text/html; charset=utf-8");
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	
	$IADN = file_exists("../libs/infos_iadn.prs") ? parse_ini_file("../libs/infos_iadn.prs", true) : false;

	if ( $IADN ) {
		$logoname = (empty($IADN["iadnLogo"]) ? "logo_default.png" : ( file_exists("assets/img/".$IADN["iadnLogo"]) ? $IADN["iadnLogo"] : 'not_found.png'));
		$_SESSION["iadnLogo"] = "assets/img/".$logoname;

		$_SESSION["Footer_Email"] = "<div style='font-size: 10pt; border: 1px dotted grey; padding: 10px; background: #eee; max-width: 200px; text-align: center' >";
		$_SESSION["Footer_Email"] .= "<b>".$IADN["iadnLibelle"]."</b><br>";
		$_SESSION["Footer_Email"] .= $IADN["iadnAdresse"]."<br>";
		$_SESSION["Footer_Email"] .= $IADN["iadnCp"]." ".$IADN["iadnVille"]."<br>";
		$_SESSION["Footer_Email"] .= empty($IADN["iadnPhone"]) ? "" : $IADN["iadnPhone"]."<br>";
		$_SESSION["Footer_Email"] .= empty($IADN["iadnEmail"]) ? "" : $IADN["iadnEmail"]."<br>";
		$_SESSION["Footer_Email"] .= empty($IADN["iadnHttps"]) ? "" : $IADN["iadnHttps"];
		$_SESSION["Footer_Email"] .= "</div>";
	} else {
		$IADN = false;
		$_SESSION["iadnLogo"] = "assets/img/logo_default.png";
		$_SESSION["Footer_Email"] = "";
	}
?>