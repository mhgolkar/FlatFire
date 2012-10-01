<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 CVSXPORT	 |
//		 |_______________|  */
// ::: XML Export Plugin 4 FFDB :::
// plug-in-name::XmlXport[+]
// plug-in-des::Exports a database to xml format[+]
// plug-in-ver::01.00[+]
// plug-in-fil::XmlXport.php[+]
//export XML


define("_FF_PLUG_CORE_XMLx_",true);
// predefined chars currection function
function xmlpred($in){
	// predefined entity references
	$predefus = array("<",">","&","'","\"");
	$posdefus = array("&lt;","&gt;","&amp;","&apos;","&quot;");
	return str_replace($predefus,$posdefus,$in);
}
function xmlprth($in){
	return str_replace(" ","_",trim($in));
}
function XmlXport($it=null){
global $indb;
	//
	if ( $indb && connected($indb["db"]) && $it!==null) {
		// HEADERS
		header("Content-Type: text/xml; charset=utf-8");
		header("Content-Disposition: attachment; filename=FF_".$it."_".mt_rand(100,999).".xml");
		// XML
		$output = fopen("php://output", "w");
		$xmlperit = xmlpred($it);
		// START
		fwrite($output,"<?xml version=\"1.0\"?>\n");
		// get row headings (structure) or fields
		if(@free_existance($it)){
			$freeall = @get_free($it);
			if($freeall){
			$headins = array_keys($freeall);
			$valuesa = array_values($freeall);
			$cvaluesa = array_map("FFDB\xmlpred",$valuesa);
			$cheadins = array_map("FFDB\xmlpred",$headins);
			$theadins = array_map("FFDB\xmlprth",$cheadins);
			$ladgaga ="";
			foreach($cheadins as $hutan){
				$ladgaga .= "<!ELEMENT ".$hutan." (#PCDATA)>\n";
			}
			fwrite($output,"
<!DOCTYPE ".$xmlperit."
[
<!ELEMENT ".$xmlperit." (".implode(",",$theadins).")>
".$ladgaga."
]>\n		
			");
			}
		}
		elseif(@table_exists($it)){
			$headins = parse_src($it);
			$cheadins = array_map("FFDB\xmlpred",$headins);
			$theadins = array_map("FFDB\xmlprth",$cheadins);
			$valuero = get_row_count($it)+1;
			$ladgaga ="";
			foreach($theadins as $hutan){
				$ladgaga .= "<!ELEMENT ".$hutan." (#PCDATA)>\n";
			}
			fwrite($output,"
<!DOCTYPE ".$xmlperit." [
<!ELEMENT ".$xmlperit." (_ROW_+)>
<!ELEMENT _ROW_ (".implode(",",$theadins).")>
".$ladgaga."
]>\n
			");
		}
		// outputting XML
		if(@$cvaluesa){
			$xmltor = "
<".$xmlperit.">\n";
			for($talf=0;$talf<count($cvaluesa);$talf++){
			$xmltor .= "	<".$theadins[$talf].">".$cvaluesa[$talf]."</".$theadins[$talf].">\n";
			}
			$xmltor .= "</".$xmlperit.">";
		fwrite($output,$xmltor);
		return true;
		}
		if(@$valuero){
		$xmltor = "
<".$xmlperit.">";
			for($coj=0;$coj<=$valuero-1;$coj++){
			$xmltor .= "
	<_ROW_>\n";
				$newries = array_map("FFDB\xmlpred",get_row($it,$coj));
				for($talf=0;$talf<count($theadins);$talf++){
				$xmltor .= "\t\t<".$theadins[$talf].">".$newries[$headins[$talf]]."</".$theadins[$talf].">\n";
				}
			$xmltor .= "\t</_ROW_>\n";
			}
		$xmltor .= "</".$xmlperit.">";
		fwrite($output,$xmltor);
		return true;
		}
	return false;
	}
	else return false;
}

?>