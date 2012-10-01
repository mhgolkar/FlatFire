<?php
namespace FFDB;
/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|  */
//::: purify! inputs and outputs for :::
// replace preserved characters
//	functions:
//				pure_encode(string) returns srting
//				pure_decode(string) returns string
// ____________________________________________
//

// PURE_ENCODE
function pure_encode($pec){
$priser = array(
				"[=]",
				"[+]",
				"[|]",
				"[id]",
				"[+id]",
				"[Api]",
				"[parkey]",
				"[DB]",
				"[BRIDGE]",
				"row_",
				"[tbl]",
				"[+tbl]",
				"[loc]",
				"[+loc]",
				"[Elements index]",
				"[Security list]",
				"[Table]",
				"[STRUCTURE]",
				"[user]",
				"[hash]",
				"[DBA]",
				"[pass]",
				"[DATABASE LIST]"
			);
$poiser = array(
				"_FFDB_brac[t=qua]_",
				"_FFDB_brac[t+las]_",
				"_FFDB_brac[t|ris]_",
				"_FFDB_brac[aaydi]_",
				"_FFDB_brac[+idii]_",
				"_FFDB_brac[teypi]a_",
				"_FFDB_brac[tprki]_",
				"_FFDB_brac[tDiBi]_",
				"_FFDB_brac[tBRIj]_",
				"_FFDB_Rr_Oo_wW_",
				"_FFDB_brac[tTeybl]_",
				"_FFDB_brac[t+tiBl]_",
				"_FFDB_brac[tloca]_",
				"_FFDB_brac[t+loca]_",
				"_FFDB_brac[tElidx]_",
				"_FFDB_brac[tSecli]_",
				"_FFDB_brac[tTaBel]_",
				"_FFDB_brac[tSTRUCheR]_",
				"_FFDB_brac[tuZer]_",
				"_FFDB_brac[tHashih]_",
				"_FFDB_brac[tDnBA]_",
				"_FFDB_brac[tpazzz]_",
				"_FFDB_brac[tDtABELiI]_"
			);
	return str_replace($priser,$poiser,$pec);
}
// PURE_DECODE
function pure_decode($pec){
$priser = array(
				"[=]",
				"[+]",
				"[|]",
				"[id]",
				"[+id]",
				"[Api]",
				"[parkey]",
				"[DB]",
				"[BRIDGE]",
				"row_",
				"[tbl]",
				"[+tbl]",
				"[loc]",
				"[+loc]",
				"[Elements index]",
				"[Security list]",
				"[Table]",
				"[STRUCTURE]",
				"[user]",
				"[hash]",
				"[DBA]",
				"[pass]",
				"[DATABASE LIST]"
			);
$poiser = array(
				"_FFDB_brac[t=qua]_",
				"_FFDB_brac[t+las]_",
				"_FFDB_brac[t|ris]_",
				"_FFDB_brac[aaydi]_",
				"_FFDB_brac[+idii]_",
				"_FFDB_brac[teypi]a_",
				"_FFDB_brac[tprki]_",
				"_FFDB_brac[tDiBi]_",
				"_FFDB_brac[tBRIj]_",
				"_FFDB_Rr_Oo_wW_",
				"_FFDB_brac[tTeybl]_",
				"_FFDB_brac[t+tiBl]_",
				"_FFDB_brac[tloca]_",
				"_FFDB_brac[t+loca]_",
				"_FFDB_brac[tElidx]_",
				"_FFDB_brac[tSecli]_",
				"_FFDB_brac[tTaBel]_",
				"_FFDB_brac[tSTRUCheR]_",
				"_FFDB_brac[tuZer]_",
				"_FFDB_brac[tHashih]_",
				"_FFDB_brac[tDnBA]_",
				"_FFDB_brac[tpazzz]_",
				"_FFDB_brac[tDtABELiI]_"
			);
	return str_replace($poiser,$priser,$pec);
}


// PURE_ENCODE_INI
function pure_encode_ini($pec){
$ini_priser = array(
				"null",
				"yes",
				"no",
				"true",
				"false",
				"{",
				"}",
				"|",
				"&",
				"~",
				"!",
				"[",
				"]",
				"(",
				")",
				"\""
				);
$ini_poiser = array(
				"_n-u-l-u-l-u_",
				"_y-e-s-su-s_",
				"_nagme_ono_",
				"_t-e-r-r_teu_e_",
				"_f-a-l-sa-fe_",
				"_p-e-g-a-s-u-s_",
				"_pig-p-i-g-us_",
				"_p-i-per-o-lo-gy_",
				"_a-me-pe-s-a-ra-nd_",
				"_Ho-d-ud-ay-e_",
				"_Kha-fa-n-mota-jeb_",
				"_da_-da-l-u-s_",
				"_i-ee-Ka_ru_u-s_",
				"_p-a-ra-na-t-ez_",
				"_p-a-ra-be-t-ez_",
				"_mon-chest-er-qu_"
				);
	return str_replace($ini_priser,$ini_poiser,$pec);
}
// PURE_DECODE_INI
function pure_decode_ini($pec){
$ini_priser = array(
				"null",
				"yes",
				"no",
				"true",
				"false",
				"{",
				"}",
				"|",
				"&",
				"~",
				"!",
				"[",
				"]",
				"(",
				")",
				"\""
				);
$ini_poiser = array(
				"_n-u-l-u-l-u_",
				"_y-e-s-su-s_",
				"_nagme_ono_",
				"_t-e-r-r_teu_e_",
				"_f-a-l-sa-fe_",
				"_p-e-g-a-s-u-s_",
				"_pig-p-i-g-us_",
				"_p-i-per-o-lo-gy_",
				"_a-me-pe-s-a-ra-nd_",
				"_Ho-d-ud-ay-e_",
				"_Kha-fa-n-mota-jeb_",
				"_da_-da-l-u-s_",
				"_i-ee-Ka_ru_u-s_",
				"_p-a-ra-na-t-ez_",
				"_p-a-ra-be-t-ez_",
				"_mon-chest-er-qu_"
				);
	return str_replace($ini_poiser,$ini_priser,$pec);
}
?>