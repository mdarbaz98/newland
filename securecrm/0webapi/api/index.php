<?php
header("Content-Type: application/json");
require 'Slim/Slim.php';
include('classes/Mail/mail.php');
include('classes/painkill/PaikKiller.inc.php');
include('classes/gpharma/GloPharma.inc.php');
include('classes/gphmed/GloPharmamedz.inc.php');
include('classes/drugplan/DrugPlan.inc.php');
include('classes/ordercp/OrderCy.inc.php');
include('classes/tramaex/TramaEx.inc.php');
include('classes/tramasale/TramaSale.inc.php');
include('classes/buyanxi/BuyAnxi.inc.php');
include('classes/traonlinecod/TraOnlineCod.inc.php');
include('classes/tramhowto/TramHowto.inc.php');
include('classes/stripepay/StripePay.inc.php');



$painkill = new PaikKiller();
$gpharma = new GloPharma();
$gphmed = new GloPharmamedz();
$drugplan = new DrugPlan();
$ordercy = new OrderCy();
$tramaex = new TramaEx();
$tramasale = new TramaSale();
$buyanxi = new BuyAnxi();
$traolcod = new TraOnlineCod();
$tramhowto = new TramHowto();
$strpy = new StripePay();
 

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->post('/login','login'); /* User login */
$app->get('/mod','mod'); /* Mark Order Deliver Click From Email */
$app->post('/getbadgetnumbers','getbadgetnumbers'); /* Mark Order Deliver Click From Email */
$app->post('/givegrantpermission','givegrantpermission'); /* Mark Order Deliver Click From Email */
$app->post('/deletegrantrequest','deletegrantrequest'); /* Mark Order Deliver Click From Email */
$app->post('/addnewgrantpermission','addnewgrantpermission'); /* Mark Order Deliver Click From Email */
$app->post('/rtrakingmail','rtrakingmail'); /* Resend Traking Email From Modal */
$app->post('/rstrckingmailmanualoc','rstrckingmailmanualoc'); /* Resend Traking Email From Modal In Manual Order */

$app->post('/todayorder','todayorder'); /* Get all Todays Order */
$app->post('/allorders','allorders'); /* Get all Todays Order */
$app->post('/orderdelay','orderdelay'); /* Get all Todays Order */
$app->post('/trackdelay','trackdelay'); /* Get all Todays Order */
$app->post('/cusdata','cusdata'); /* Get all Todays Order */
$app->post('/allinv','allinv'); /* Get all Todays Order */
$app->post('/allmanualorder','allmanualorder'); /* Get all Manual Orders */
$app->post('/allocsendcomposemail','allocsendcomposemail'); /* Send Newly Composed Mail */

$app->post('/getrecordspain','getrecordspain'); /* Get All Website Orders Painkiller */
$app->post('/getrecordsglobalpharma','getrecordsglobalpharma'); /* Get All Website Orders Newlands Pharmacy*/
$app->post('/getrecordsdrugstore','getrecordsdrugstore'); /* Get All Website Orders Drugstore*/
$app->post('/getrecordsordercp','getrecordsordercp'); /* Get All Website Orders Order Cypionate*/
$app->post('/getrecordstramaex','getrecordstramaex'); /* Get All Website Orders Tramadol Export*/
$app->post('/getrecordstramasale','getrecordstramasale'); /* Get All Website Orders Tramadol Sale*/
$app->post('/getrecordsbuyanxi','getrecordsbuyanxi'); /* Get All Website Orders Tramadol Sale*/
$app->post('/getrecordstripepay','getrecordstripepay'); /* Get All Website Orders Tramadol Sale*/
$app->post('/getrecordstronlinecod','getrecordstronlinecod'); /* Get All Website Orders Tramadol Sale*/
$app->post('/getrecordstramhowto','getrecordstramhowto'); /* Get All Website Orders Tramadol Sale*/

$app->post('/dltTodayOrder','dltTodayOrder'); /* Delete Todays Order */
$app->post('/dltAllOrders','dltAllOrders'); /* Delete Todays Order */
$app->post('/dltManualOrder','dltManualOrder'); /* Delete Todays Order */
$app->post('/dltPainkillOrder','dltPainkillOrder'); /* Delete Pain KIller Order */
$app->post('/dltGlobalPharmaOrder','dltGlobalPharmaOrder'); /* Delete Newlands Pharmacy Order */
$app->post('/dltDrugstoreOrder','dltDrugstoreOrder'); /* Delete Drugstore Order */
$app->post('/dltOrderCp','dltOrderCp'); /* Delete Order Cypionate Order */
$app->post('/dltTramaEx','dltTramaEx'); /* Delete Tramadol Export Order */
$app->post('/dltTramaSale','dltTramaSale'); /* Delete Tramadol Sale Order */
$app->post('/dltBuyAnxity','dltBuyAnxity'); /* Delete Buy Anxity Order */
$app->post('/dltStripepay','dltStripepay'); /* Delete Buy Anxity Order */
$app->post('/dlttramaolcod','dlttramaolcod'); /* Delete Buy Anxity Order */
$app->post('/dlttramaolhowto','dlttramaolhowto'); /* Delete Buy Anxity Order */
$app->post('/deltrackingids','deltrackingids');

$app->post('/updatestatusor','updatestatusor'); /* Update Status of Payment oredr Todays */
$app->post('/updatestatusalloc','updatestatusalloc'); /* Update Status of Payment All Order */
$app->post('/updatestatusmanualoc','updatestatusmanualoc'); /* Update Status of Payment Manual Order */
$app->post('/updatestatusorpain','updatestatusorpain'); /* Update Status of Payment oredr Painkiller*/
$app->post('/updatestatusorglobal','updatestatusorglobal'); /* Update Status of Payment oredr Gobal Pharma */
$app->post('/updatestatusordrugstore','updatestatusordrugstore'); /* Update Status of Payment oredr Gobal Pharma */
$app->post('/updatestatusorordercp','updatestatusorordercp'); /* Update Status of Payment oredr Order Cypionate */
$app->post('/updatestatusortramaex','updatestatusortramaex'); /* Update Status of Payment oredr Tramadol Export */
$app->post('/updatestatusortramasale','updatestatusortramasale'); /* Update Status of Payment oredr Tramadol Sale */
$app->post('/updatestatusbuyanxi','updatestatusbuyanxi'); /* Update Status of Payment oredr Tramadol Sale */
$app->post('/updatestatusstripepay','updatestatusstripepay'); /* Update Status of Payment oredr Tramadol Sale */
$app->post('/updatestatustraonlinecod','updatestatustraonlinecod'); /* Update Status of Payment oredr Tramadol Sale */
$app->post('/updatestatustramhowto','updatestatustramhowto'); /* Update Status of Payment oredr Tramadol Sale */

$app->post('/addtrakingidtoc','addtrakingidtoc'); /* Add Traking IDS */
$app->post('/addtrakingidtalloc','addtrakingidtalloc'); /* Add Traking IDS All Order Panel */
$app->post('/addtrakingidmanualoc','addtrakingidmanualoc'); /* Add Traking IDS All Order Panel */
$app->post('/addtrakingidpain','addtrakingidpain'); /* Add Traking IDS */
$app->post('/addtrakingidglobal','addtrakingidglobal'); /* Add Traking IDS */

$app->post('/addadmin','addadmin'); /* Add Traking IDS */

$app->post('/addtrakingiddrugstore','addtrakingiddrugstore'); /* Add Traking IDS */
$app->post('/addtrakingidordercp','addtrakingidordercp'); /* Add Traking IDS */
$app->post('/addtrakingidtramaex','addtrakingidtramaex'); /* Add Traking IDS */
$app->post('/addtrakingidtramasale','addtrakingidtramasale'); /* Add Traking IDS */
$app->post('/addtrakingidbuyanxi','addtrakingidbuyanxi'); /* Add Traking IDS */
$app->post('/addtrakingidstripepay','addtrakingidstripepay'); /* Add Traking IDS */
$app->post('/addtrakingidtraolcod','addtrakingidtraolcod'); /* Add Traking IDS */
$app->post('/addtrakingidtramhowto','addtrakingidtramhowto'); /* Add Traking IDS */

$app->post('/addshippingtoc','addshippingtoc'); /* Add Shipping Company Names */
$app->post('/addshippingtalloc','addshippingtalloc'); /* Add Shipping Company Names All Order*/
$app->post('/addshippingpain','addshippingpain'); /* Add Shipping Company Names */
$app->post('/addshippingglobal','addshippingglobal'); /* Add Shipping Company Names */
$app->post('/addshippingdrugstore','addshippingdrugstore'); /* Add Shipping Company Names */
$app->post('/addshippingordercp','addshippingordercp'); /* Add Shipping Company Names */
$app->post('/addshippingtramaex','addshippingtramaex'); /* Add Shipping Company Names */
$app->post('/addshippingtramasale','addshippingtramasale'); /* Add Shipping Company Names */
$app->post('/addshippingbuyanxi','addshippingbuyanxi'); /* Add Shipping Company Names */
$app->post('/addshippingstripepay','addshippingstripepay'); /* Add Shipping Company Names */
$app->post('/addshippingtraolcod','addshippingtraolcod'); /* Add Shipping Company Names */
$app->post('/addshippingtramhowto','addshippingtramhowto'); /* Add Shipping Company Names */

$app->post('/addpaymentlink','addpaymentlink'); /* Save Manual Order Data */
$app->post('/resendpaymentmail','resendpaymentmail'); /* Save Manual Order Data */
$app->post('/reorderemailsend','reorderemailsend'); /* Save Manual Order Data */
$app->post('/savemanualoc','savemanualoc'); /* Save Manual Order Data */
$app->post('/updatemanualoc','updatemanualoc'); /* Save Manual Order Data */
$app->post('/updateorderuserdata','updateorderuserdata'); /* Update User Data for order */
$app->post('/updateproduct','updateproduct'); /* Update User Data for order */

/*Enquiry Section*/
$app->post('/getallenquiries','getallenquiries'); /* get all Enquiry Data */
$app->post('/dltenquiries','dltenquiries'); /* Delete Enquiry */
$app->post('/changestsenquiry','changestsenquiry'); /* Change Status of Enquiry */
$app->post('/replyenquiry','replyenquiry'); /* Change Status of Enquiry */
$app->post('/replyenquiry_custo','replyenquiry_custo'); /* Change Status of Enquiry */


/*Cases Component API Calls*/
$app->post('/fetchsingleorderdetails','fetchsingleorderdetails'); 
$app->post('/createannewcase','createannewcase'); 
$app->post('/getallopencases','getallopencases'); 
$app->post('/getallclosedcases','getallclosedcases'); 
$app->post('/deletecases','deletecases'); 
$app->post('/changestatuscase','changestatuscase'); 
$app->post('/reopencasestatus','reopencasestatus');
$app->post('/fetchcustreports','fetchcustreports');
$app->post('/dltcustreport','dltcustreport');
$app->post('/replycustreport','replycustreport');
$app->post('/replycustreport_custo','replycustreport_custo');
$app->post('/changecustreportsts','changecustreportsts');
$app->post('/addreshiptrakingscase','addreshiptrakingscase');
$app->post('/rtrakingmailcases','rtrakingmailcases');
$app->post('/addcasenote','addcasenote');
$app->post('/delcasenote','delcasenote');

/* Admin and Second Admin Conversatoin Report Api */
$app->post('/adminreportadd','adminreportadd');
$app->post('/getalladmincomments','getalladmincomments');
$app->post('/replyeadmincomments','replyeadmincomments');
$app->post('/deleteadmincomments','deleteadmincomments');
$app->post('/replyeadmincommentsadmin','replyeadmincommentsadmin');


/* Api for the EMail Intermediate Opration*/
$app->post('/reportanissue','reportanissue');
$app->post('/aftersalesfollowup','aftersalesfollowup');
$app->post('/getallwebsingleocdata', 'getallwebsingleocdata');

$app->post('/getallundelivredoc', 'getallundelivredoc');
$app->post('/deleteundelivredoc', 'deleteundelivredoc');
$app->post('/changestsundelivredoc', 'changestsundelivredoc');

$app->post('/getaftersalesfollowuprec', 'getaftersalesfollowuprec');
$app->post('/changestsfollowupoc', 'changestsfollowupoc');
$app->post('/deletefollowupoc', 'deletefollowupoc');
$app->post('/followupnumberofcallset', 'followupnumberofcallset');
 

    

$app->run();

/************************* USER LOGIN *************************************/
/* ### User login ### */

function login() {
	global $painkill;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $painkill->login($data);
	echo $res;
}

function getbadgetnumbers() {
	global $tramaex;
	global $drugplan;
	$nor = $tramaex->get_allwebsite_contact_form_details_oneday();
	$norissues = $drugplan->get_all_customer_reports_oneday();
	$grantdata = $drugplan->get_all_phone_grant_data();
	echo '{"tissues": "'.$norissues.'","tenquiry":"'.$nor.'", "grantdata": '.json_encode($grantdata).'}';
}

function givegrantpermission() {
	global $drugplan;
	$request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->give_grant_permission_phoneno($data->id);
	$grantdata = $drugplan->get_all_phone_grant_data();
	echo '{"grantdata": '.json_encode($grantdata).'}';
}

function deletegrantrequest() {
	global $drugplan;
	$request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->delete_permission_phoneno($data->id);
	$grantdata = $drugplan->get_all_phone_grant_data();
	echo '{"grantdata": '.json_encode($grantdata).'}';
}

function addnewgrantpermission() {
	global $drugplan;
	$request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->addnew_permission_request($data);
	$grantdata = $drugplan->get_all_phone_grant_data();
	echo '{"grantdata": '.json_encode($grantdata).'}';
}

function todayorder() {
	
    global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
    global $tramasale;
    global $buyanxi;
    global $traolcod;
    global $tramhowto;
    global $strpy;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	
	$array =array();
	$userData = '';
	$inc = 0;
		$respa = $painkill->get_allorders_today($array, $inc);
		$restrpy = $strpy->get_allorders_today($respa[0], $respa[1]);
		$resgb = $gpharma->get_allorders_today($restrpy[0], $restrpy[1]);
		$resgbmz = $gphmed->get_allorders_today($resgb[0], $resgb[1]);
		$resdp = $drugplan->get_allorders_today($resgbmz[0], $resgbmz[1]);
		$resoc = $ordercy->get_allorders_today($resdp[0], $resdp[1]);
		$restex = $tramaex->get_allorders_today($resoc[0], $resoc[1]);
		$restsale = $tramasale->get_allorders_today($restex[0], $restex[1]);
		$resanxi = $buyanxi->get_allorders_today($restsale[0], $restsale[1]);
		$restrolcod = $traolcod->get_allorders_today($resanxi[0], $resanxi[1]);
		$restrhowto = $tramhowto->get_allorders_today($restrolcod[0], $restrolcod[1]);
		$array = $painkill->get_manual_all_orders($restrhowto[0], $restrhowto[1],"d1");
	if($array[0]){
	   $userData = json_encode($array[0]);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	   echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}  
}

function allorders() {
	global $painkill;
	global $drugplan;
	global $gpharma;
	global $gphmed;
	global $ordercy;
	global $tramaex;
	global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $tramhowto;
	global $strpy;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	
	$array =array();
	$userData = '';
	$inc = 0;
		$respa = $painkill->get_all_orders($array, $inc, $data);
		$restrpy = $strpy->get_all_orders($respa[0], $respa[1], $data);
		$resgb = $gpharma->get_all_orders($restrpy[0], $restrpy[1], $data);
		$resdpmz = $gphmed->get_all_orders($resgb[0], $resgb[1], $data);
		$resdp = $drugplan->get_all_orders($resdpmz[0], $resdpmz[1], $data);
		$resoc = $ordercy->get_all_orders($resdp[0], $resdp[1],$data);
		$restrx = $tramaex->get_all_orders($resoc[0], $resoc[1],$data);
		$restrsale = $tramasale->get_all_orders($restrx[0], $restrx[1],$data);
		$resanxi = $buyanxi->get_all_orders($restrsale[0], $restrsale[1],$data);
		$restrolcod = $traolcod->get_all_orders($resanxi[0], $resanxi[1],$data);
		$restrhowto = $tramhowto->get_all_orders($restrolcod[0], $restrolcod[1],$data);
		$array = $painkill->get_manual_all_orders($restrhowto[0], $restrhowto[1],$data->method);
		
	 if($array[0]){
	   $userData = json_encode($array[0]);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	   echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
	
}
   

function getrecordspain() {
    global $painkill;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$userData = '';
	$array = $painkill->get_allorders_array($array);
	
	 if($array){
	     $userData = json_encode($array);
	   echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	   echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
	exit;
}

function getrecordsglobalpharma() {
    global $gpharma;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$userData = '';
	$array = $gpharma->get_allorders_array($array);
	
	 if($array){
	     $userData = json_encode($array);
	   echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	   echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
	exit;
}

function getrecordsdrugstore() {
    global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$userData = '';
	$array = $drugplan->get_allorders_array($array);
	
	 if($array){
	     $userData = json_encode($array);
	   echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	   echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
	exit;
}

function getrecordsordercp() {
    global $ordercy;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$userData = '';
	$array = $ordercy->get_allorders_array($array);
	
	 if($array){
	     $userData = json_encode($array);
	   echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	   echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
	exit;
}

function getrecordstramaex() {
    global $tramaex;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$userData = '';
	$array = $tramaex->get_allorders_array($array);
	
	 if($array){
	     $userData = json_encode($array);
	   echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	   echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
	exit;
}

function getrecordstramasale() {
    global $tramasale;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$userData = '';
	$array = $tramasale->get_allorders_array($array);
	
	 if($array){
	     $userData = json_encode($array);
	   echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	   echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
	exit;
}

function getrecordsbuyanxi() {
	global $buyanxi;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$userData = '';
	$array = $buyanxi->get_allorders_array($array);
	
	 if($array){
	     $userData = json_encode($array);
	   echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	   echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
	exit;
}

function getrecordstripepay() {
	global $strpy;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$userData = '';
	$array = $strpy->get_allorders_array($array);
	
	 if($array){
	     $userData = json_encode($array);
	   echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	   echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
	exit;
}
function getrecordstronlinecod() {
	global $traolcod;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$userData = '';
	$array = $traolcod->get_allorders_array($array);
	
	 if($array){
	     $userData = json_encode($array);
	   echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	   echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
	exit;
}

function getrecordstramhowto() {
	global $tramhowto;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$userData = '';
	$array = $tramhowto->get_allorders_array($array);
	
	 if($array){
	     $userData = json_encode($array);
	   echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	   echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
	exit;
}







/*Delete All Order Functions here*/
function dltTodayOrder() {
	global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
	global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $tramhowto;
	global $strpy;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$inc = 0;
	switch($data->web) {
		case  "painkillermedicines.com":
			$res = $painkill->delete_order_today($data, $array);
			break;
		case  "globalpharmamedicines.com":
			$res = $gpharma->delete_order_today($data, $array);
			break;
		case  "oneglobalpharma.com":
			$res = $gphmed->delete_order_today($data, $array);
			break;
		case  "drugstoreplanet.com":
			$res = $drugplan->delete_order_today($data, $array);
			break;
		case  "ordercypionate.com":
			$res = $ordercy->delete_order_today($data, $array);
			break;
		case  "tramadolexport.com":
			$res = $tramaex->delete_order_today($data, $array);
			break;
		case  "tramadolsale.com":
			$res = $tramasale->delete_order_today($data, $array);
			break;
		case  "buyanxietymedicines.com":
			$res = $buyanxi->delete_order_today($data, $array);
			break;
		case  "sedegital.com":
			$res = $strpy->delete_order_today($data, $array);
			break;
		case  "bytramadolonlinecod.com":
			$res = $traolcod->delete_order_today($data, $array);
			break;
		case  "thtramadol-howto.com":
			$res = $tramhowto->delete_order_today($data, $array);
			break;
		case  "Manualorder":
			$res = $painkill->delete_order_manual_oc($data);
			break;
	}
	
		$respa = $painkill->get_allorders_today($array, $inc);
		$restrpy = $strpy->get_allorders_today($respa[0], $respa[1]);
		$resgb = $gpharma->get_allorders_today($restrpy[0], $restrpy[1]);
		$resgbmz = $gphmed->get_allorders_today($resgb[0], $resgb[1]);
		$resdp = $drugplan->get_allorders_today($resgbmz[0], $resgbmz[1]);
		$resoc = $ordercy->get_allorders_today($resdp[0], $resdp[1]);
		$restex = $tramaex->get_allorders_today($resoc[0], $resoc[1]);
		$restsale = $tramasale->get_allorders_today($restex[0], $restex[1]);
		$resanxi = $buyanxi->get_allorders_today($restsale[0], $restsale[1]);
		$restrolcod = $traolcod->get_allorders_today($resanxi[0], $resanxi[1]);
		$restrhowto = $tramhowto->get_allorders_today($restrolcod[0], $restrolcod[1]);
		$array = $painkill->get_manual_all_orders($restrhowto[0], $restrhowto[1],"d1");
		
	 if(!empty($array[0])){
		 $userData = json_encode($array[0]);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/*Delete All Order Functions here*/
function dltAllOrders() {
	global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
	global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $tramhowto;
	global $strpy;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$inc = 0;
	switch($data->web) {
		case  "painkillermedicines.com":
			$res = $painkill->delete_order_today($data, $array);
			break;
		case  "globalpharmamedicines.com":
			$res = $gpharma->delete_order_today($data, $array);
			break;
		case  "oneglobalpharma.com":
			$res = $gphmed->delete_order_today($data, $array);
			break;
		case  "drugstoreplanet.com":
			$res = $drugplan->delete_order_today($data, $array);
			break;
		case  "ordercypionate.com":
			$res = $ordercy->delete_order_today($data, $array);
			break;
		case  "tramadolexport.com":
			$res = $tramaex->delete_order_today($data, $array);
			break;
		case  "tramadolsale.com":
			$res = $tramasale->delete_order_today($data, $array);
			break;
		case  "buyanxietymedicines.com":
			$res = $buyanxi->delete_order_today($data, $array);
			break;
		case  "sedegital.com":
			$res = $strpy->delete_order_today($data, $array);
			break;
		case  "bytramadolonlinecod.com":
			$res = $traolcod->delete_order_today($data, $array);
			break;
		case  "thtramadol-howto.com":
			$res = $tramhowto->delete_order_today($data, $array);
			break;
		case  "Manualorder":
			        $painkill->delete_order_manual_oc($data);
			break;
	}
		$res = $drugplan->delete_followup_oc_when_original_delete($data->id);
	
		$respa = $painkill->get_all_orders($array, $inc, $data);
		$restrpy = $strpy->get_all_orders($respa[0], $respa[1], $data);
		$resgb = $gpharma->get_all_orders($restrpy[0], $restrpy[1], $data);
		$resdpmz = $gphmed->get_all_orders($resgb[0], $resgb[1], $data);
		$resdp = $drugplan->get_all_orders($resdpmz[0], $resdpmz[1], $data);
		$resoc = $ordercy->get_all_orders($resdp[0], $resdp[1],$data);
		$restrx = $tramaex->get_all_orders($resoc[0], $resoc[1],$data);
		$restrsale = $tramasale->get_all_orders($restrx[0], $restrx[1],$data);
		$resanxi = $buyanxi->get_all_orders($restrsale[0], $restrsale[1],$data);
		$restrolcod = $traolcod->get_all_orders($resanxi[0], $resanxi[1],$data);
		$restrhowto = $tramhowto->get_all_orders($restrolcod[0], $restrolcod[1],$data);
		$array = $painkill->get_manual_all_orders($restrhowto[0], $restrhowto[1],$data->method);
		
	
	 if(!empty($array[0])){
		 $userData = json_encode($array[0]);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function deltrackingids() {
	global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
	global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $tramhowto;
	global $strpy;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$inc = 0;
	switch($data->web) {
		case  "painkillermedicines.com":
			$res = $painkill->delete_trackingids($data, $array);
			break;
		case  "globalpharmamedicines.com":
			$res = $gpharma->delete_trackingids($data, $array);
			break;
		case  "drugstoreplanet.com":
			$res = $drugplan->delete_order_today($data, $array);
			break;
		case  "ordercypionate.com":
			$res = $ordercy->delete_order_today($data, $array);
			break;
		case  "tramadolexport.com":
			$res = $tramaex->delete_order_today($data, $array);
			break;
		case  "tramadolsale.com":
			$res = $tramasale->delete_order_today($data, $array);
			break;
		case  "buyanxietymedicines.com":
			$res = $buyanxi->delete_order_today($data, $array);
			break;
		case  "sedegital.com":
			$res = $strpy->delete_trackingids($data, $array);
			break;
		case  "bytramadolonlinecod.com":
			$res = $traolcod->delete_trackingids($data, $array);
			break;
		case  "thtramadol-howto.com":
			$res = $tramhowto->delete_order_today($data, $array);
			break;
		case  "Manualorder":
			        $painkill->delete_trackingids_moc($data);
			break;
		case  "oneglobalpharma.com":
			        $gphmed->delete_trackingids($data, $array);
			break;
	}
	
	echo '{"userData": "yes","status":"1","msg":"Successfully Delete Order"}';
}

/* Delete Order functions Block Pain*/
function dltPainkillOrder() {
    global $painkill;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $painkill->delete_order($data, $array);
	 if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function updateorderuserdata() {
    global $gphmed;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $gphmed->update_customer($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Customer Details"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found okay"}';
	}
}

function updateproduct() {
    global $gphmed;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $gphmed->update_product($data, $array);
	if($array){
// 		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Customer Details"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found okay"}';
	}
}

/* Delete Order functions Block Newlands Pharmacy*/
function dltGlobalPharmaOrder() {
    global $gpharma;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $gpharma->delete_order($data, $array);
	 if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Delete Order functions Block Drugstore*/
function dltDrugstoreOrder() {
    global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $drugplan->delete_order($data, $array);
	 if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Delete Order functions Block Order Cypionate*/
function dltOrderCp() {
    global $ordercy;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $ordercy->delete_order($data, $array);
	 if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Delete Order functions Block Tramadol Export*/
function dltTramaEx() {
    global $tramaex;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $tramaex->delete_order($data, $array);
	 if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Delete Order functions Block Tramadol Sale*/
function dltTramaSale() {
    global $tramasale;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $tramasale->delete_order($data, $array);
	 if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Delete Order functions Block Order Cypionate*/
function dltBuyAnxity() {
    global $buyanxi;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $buyanxi->delete_order($data, $array);
	 if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function dltStripepay() {
    global $strpy;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $strpy->delete_order($data, $array);
	 if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}


/* Delete Order functions Block Order Cypionate*/
function dlttramaolcod() {
    global $traolcod;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $traolcod->delete_order($data, $array);
	 if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Delete Order functions Block Order Cypionate*/
function dlttramaolhowto() {
    global $tramhowto;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $tramhowto->delete_order($data, $array);
	 if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}





/*Update Status Session function here*/
function updatestatusor() {
    global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
	global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $tramhowto;
	global $strpy;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$inc = 0;
	$userData = '';
	/*Check Value of Status is set*/
	if(isset($data->statusval)) {
		switch($data->web) {
			case  "painkillermedicines.com":
				$res = $painkill->update_order_status_todayoc($data, $array);
				break;
			case  "globalpharmamedicines.com":
				$res = $gpharma->update_order_status_todayoc($data, $array);
				break;
			case  "oneglobalpharma.com":
				$res = $gphmed->update_order_status_todayoc($data, $array);
				break;
			case  "drugstoreplanet.com":
				$res = $drugplan->update_order_status_todayoc($data, $array);
				break;
			case  "ordercypionate.com":
				$res = $ordercy->update_order_status_todayoc($data, $array);
				break;
			case  "tramadolexport.com":
				$res = $tramaex->update_order_status_todayoc($data, $array);
				break;
			case  "tramadolsale.com":
				$res = $tramasale->update_order_status_todayoc($data, $array);
				break;
			case  "buyanxietymedicines.com":
				$res = $buyanxi->update_order_status_todayoc($data, $array);
				break;
			case  "sedegital.com":
				$res = $strpy->update_order_status_todayoc($data, $array);
				break;
			case  "bytramadolonlinecod.com":
				$res = $traolcod->update_order_status_todayoc($data, $array);
				break;
			case  "thtramadol-howto.com":
				$res = $tramhowto->update_order_status_todayoc($data, $array);
				break;
			case  "Manualorder":
				$res = $painkill->update_order_status_manual_oc($data);
				break;
		}
	}
	
		$respa = $painkill->get_allorders_today($array, $inc);
		$restrpy = $strpy->get_allorders_today($respa[0], $respa[1]);
		$resgb = $gpharma->get_allorders_today($restrpy[0], $restrpy[1]);
		$resgbmz = $gphmed->get_allorders_today($resgb[0], $resgb[1]);
		$resdp = $drugplan->get_allorders_today($resgbmz[0], $resgbmz[1]);
		$resoc = $ordercy->get_allorders_today($resdp[0], $resdp[1]);
		$restex = $tramaex->get_allorders_today($resoc[0], $resoc[1]);
		$restsale = $tramasale->get_allorders_today($restex[0], $restex[1]);
		$resanxi = $buyanxi->get_allorders_today($restsale[0], $restsale[1]);
		$restrolcod = $traolcod->get_allorders_today($resanxi[0], $resanxi[1]);
		$restrhowto = $tramhowto->get_allorders_today($restrolcod[0], $restrolcod[1]);
		$array = $painkill->get_manual_all_orders($restrhowto[0], $restrhowto[1],"d1");

	 if(!empty($array[0])){
		 $userData = json_encode($array[0]);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
		echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/*Update Status All Order Pages function here*/
function updatestatusalloc() {
    global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
	global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $tramhowto;
	global $strpy;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$inc = 0;
	$userData = '';
	/*Check Value of Status is set*/
	if(isset($data->statusval)) {
		switch($data->web) {
			case  "painkillermedicines.com":
				$res = $painkill->update_order_status_todayoc($data, $array);
				$web = "painkill";
				break;
			case  "globalpharmamedicines.com":
				$res = $gpharma->update_order_status_todayoc($data, $array);
				$web = "globpharm";
				break;
			case  "oneglobalpharma.com":
				$res = $gphmed->update_order_status_todayoc($data, $array);
				$web = "globpharmedz";
				break;
			case  "drugstoreplanet.com":
				$res = $drugplan->update_order_status_todayoc($data, $array);
				$web = "drugstore";
				break;
			case  "ordercypionate.com":
				$res = $ordercy->update_order_status_todayoc($data, $array);
				$web = "ordercp";
				break;
			case  "tramadolexport.com":
				$res = $tramaex->update_order_status_todayoc($data, $array);
				$web = "tramex";
				break;
			case  "tramadolsale.com":
				$res = $tramasale->update_order_status_todayoc($data, $array);
				$web = "tramsale";
				break;
			case  "buyanxietymedicines.com":
				$res = $buyanxi->update_order_status_todayoc($data, $array);
				$web = "buyanxi";
				break;
			case  "sedegital.com":
				$res = $strpy->update_order_status_todayoc($data, $array);
				$web = "stripepay";
				break;
			case  "bytramadolonlinecod.com":
				$res = $traolcod->update_order_status_todayoc($data, $array);
				$web = "trolcd";
				break;
			case  "thtramadol-howto.com":
				$res = $tramhowto->update_order_status_todayoc($data, $array);
				$web = "tramhto";
				break;
			case  "Manualorder":
				$painkill->update_order_status_manual_oc($data);
				$web = "manualoc";
				break;
		}
		
		if($data->statusval=="Processed" || $data->statusval=="Shipped" || $data->statusval=="Tracking" || $data->statusval=="Delivered") {
			$res = $drugplan->auto_save_in_followup($data->oid, $web);
		}
	}
		
		$respa = $painkill->get_all_orders($array, $inc, $data);
		$restrpy = $strpy->get_all_orders($respa[0], $respa[1], $data);
		$resgb = $gpharma->get_all_orders($restrpy[0], $restrpy[1], $data);
		$resdpmz = $gphmed->get_all_orders($resgb[0], $resgb[1], $data);
		$resdp = $drugplan->get_all_orders($resdpmz[0], $resdpmz[1], $data);
		$resoc = $ordercy->get_all_orders($resdp[0], $resdp[1],$data);
		$restrx = $tramaex->get_all_orders($resoc[0], $resoc[1],$data);
		$restrsale = $tramasale->get_all_orders($restrx[0], $restrx[1],$data);
		$resanxi = $buyanxi->get_all_orders($restrsale[0], $restrsale[1],$data);
		$restrolcod = $traolcod->get_all_orders($resanxi[0], $resanxi[1],$data);
		$restrhowto = $tramhowto->get_all_orders($restrolcod[0], $restrolcod[1],$data);
		$array = $painkill->get_manual_all_orders($restrhowto[0], $restrhowto[1],$data->method);

	 if(!empty($array[0])){
		 $userData = json_encode($array[0]);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
		echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}



/* Update Status of Order pain killer*/
function updatestatusorpain() {
    global $painkill;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $painkill->update_order_status($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Update Status of Order Gobal Pharma */
function updatestatusorglobal() {
    global $gpharma;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $gpharma->update_order_status($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Update Status of Order Drugstore */
function updatestatusordrugstore() {
    global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $drugplan->update_order_status($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Update Status of Order Order Cypionate */
function updatestatusorordercp() {
    global $ordercy;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $ordercy->update_order_status($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Update Status of Order Tramadol Export */
function updatestatusortramaex() {
    global $tramaex;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $tramaex->update_order_status($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Update Status of Order Tramadol Export */
function updatestatusortramasale() {
    global $tramasale;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $tramasale->update_order_status($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Update Status of Order Order Cypionate */
function updatestatusbuyanxi() {
    global $buyanxi;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $buyanxi->update_order_status($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function updatestatusstripepay() {
	 global $strpy;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $strpy->update_order_status($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}
/* Update Status of Order Order Cypionate */
function updatestatustraonlinecod() {
    global $traolcod;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $traolcod->update_order_status($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Update Status of Order Order Cypionate */
function updatestatustramhowto() {
    global $tramhowto;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $tramhowto->update_order_status($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}





/* Add Traking IDS Function Here*/
function addtrakingidtoc() {
    global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
	global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $tramhowto;
	global $strpy;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$inc = 0;
	switch($data->web) {
		case  "painkillermedicines.com":
			$res = $painkill->addtrakingidtoday_oc($data, $array);
			break;
		case  "globalpharmamedicines.com":
			$res = $gpharma->addtrakingidtoday_oc($data, $array);
			break;
		case  "oneglobalpharma.com":
			$res = $gphmed->addtrakingidtoday_oc($data, $array);
			break;
		case  "drugstoreplanet.com":
			$res = $drugplan->addtrakingidtoday_oc($data, $array);
			break;
		case  "ordercypionate.com":
			$res = $ordercy->addtrakingidtoday_oc($data, $array);
			break;
		case  "tramadolexport.com":
			$res = $tramaex->addtrakingidtoday_oc($data, $array);
			break;
		case  "tramadolsale.com":
			$res = $tramasale->addtrakingidtoday_oc($data, $array);
			break;
		case  "buyanxietymedicines.com":
			$res = $buyanxi->addtrakingidtoday_oc($data, $array);
			break;
		case  "sedegital.com":
			$res = $strpy->addtrakingidtoday_oc($data, $array);
			break;
		case  "bytramadolonlinecod.com":
			$res = $traolcod->addtrakingidtoday_oc($data, $array);
			break;
		case  "thtramadol-howto.com":
			$res = $tramhowto->addtrakingidtoday_oc($data, $array);
			break;
		case  "Manualorder":
			$res = $painkill->addtrakingid_manual_oc($data);
			break;
	}
	
		$respa = $painkill->get_allorders_today($array, $inc);
		$restrpy = $strpy->get_allorders_today($respa[0], $respa[1]);
		$resgb = $gpharma->get_allorders_today($restrpy[0], $restrpy[1]);
		$resgbmz = $gphmed->get_allorders_today($resgb[0], $resgb[1]);
		$resdp = $drugplan->get_allorders_today($resgbmz[0], $resgbmz[1]);
		$resoc = $ordercy->get_allorders_today($resdp[0], $resdp[1]);
		$restex = $tramaex->get_allorders_today($resoc[0], $resoc[1]);
		$restsale = $tramasale->get_allorders_today($restex[0], $restex[1]);
		$resanxi = $buyanxi->get_allorders_today($restsale[0], $restsale[1]);
		$restrolcod = $traolcod->get_allorders_today($resanxi[0], $resanxi[1]);
		$restrhowto = $tramhowto->get_allorders_today($restrolcod[0], $restrolcod[1]);
		$array = $painkill->get_manual_all_orders($restrhowto[0], $restrhowto[1],"d1");
	
	if(!empty($array[0])){
		 $userData = json_encode($array[0]);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Traking IDS Function Here For All Orders*/
function addtrakingidtalloc() {
    global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
	global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $tramhowto;
	global $strpy;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$inc = 0;
	switch($data->web) {
		case  "painkillermedicines.com":
			$res = $painkill->addtrakingidtoday_oc($data, $array);
			break;
		case  "globalpharmamedicines.com":
			$res = $gpharma->addtrakingidtoday_oc($data, $array);
			break;
		case  "oneglobalpharma.com":
			$res = $gphmed->addtrakingidtoday_oc($data, $array);
			break;
		case  "drugstoreplanet.com":
			$res = $drugplan->addtrakingidtoday_oc($data, $array);
			break;
		case  "ordercypionate.com":
			$res = $ordercy->addtrakingidtoday_oc($data, $array);
			break;
		case  "tramadolexport.com":
			$res = $tramaex->addtrakingidtoday_oc($data, $array);
			break;
		case  "tramadolsale.com":
			$res = $tramasale->addtrakingidtoday_oc($data, $array);
			break;
		case  "buyanxietymedicines.com":
			$res = $buyanxi->addtrakingidtoday_oc($data, $array);
			break;
		case  "sedegital.com":
			$res = $strpy->addtrakingidtoday_oc($data, $array);
			break;
		case  "bytramadolonlinecod.com":
			$res = $traolcod->addtrakingidtoday_oc($data, $array);
			break;
		case  "thtramadol-howto.com":
			$res = $tramhowto->addtrakingidtoday_oc($data, $array);
			break;
		case  "Manualorder":
					$painkill->addtrakingid_manual_oc($data);
			break;
	}
	
		$respa = $painkill->get_all_orders($array, $inc, $data);
		$restrpy = $strpy->get_all_orders($respa[0], $respa[1], $data);
		$resgb = $gpharma->get_all_orders($restrpy[0], $restrpy[1], $data);
		$resdpmz = $gphmed->get_all_orders($resgb[0], $resgb[1], $data);
		$resdp = $drugplan->get_all_orders($resdpmz[0], $resdpmz[1], $data);
		$resoc = $ordercy->get_all_orders($resdp[0], $resdp[1],$data);
		$restrx = $tramaex->get_all_orders($resoc[0], $resoc[1],$data);
		$restrsale = $tramasale->get_all_orders($restrx[0], $restrx[1],$data);
		$resanxi = $buyanxi->get_all_orders($restrsale[0], $restrsale[1],$data);
		$restrolcod = $traolcod->get_all_orders($resanxi[0], $resanxi[1],$data);
		$restrhowto = $tramhowto->get_all_orders($restrolcod[0], $restrolcod[1],$data);
		$array = $painkill->get_manual_all_orders($restrhowto[0], $restrhowto[1],$data->method);
	
	if(!empty($array[0])){
		 $userData = json_encode($array[0]);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Traking IDS Pain Killer*/
function addtrakingidpain() {
    global $painkill;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $painkill->addtrakingid($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Traking IDS Newlands Pharmacy*/
function addtrakingidglobal() {
    global $gpharma;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $gpharma->addtrakingid($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function addadmin() {
    global $painkill;;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $painkill->addadmins($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Traking IDS Drugstore */
function addtrakingiddrugstore() {
    global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $drugplan->addtrakingid($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Traking IDS Order Cypionate */
function addtrakingidordercp() {
    global $ordercy;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $ordercy->addtrakingid($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Traking IDS Tramadol Export */
function addtrakingidtramaex() {
    global $tramaex;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $tramaex->addtrakingid($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Traking IDS Tramadol Sale */
function addtrakingidtramasale() {
    global $tramasale;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $tramasale->addtrakingid($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Traking IDS Order Cypionate */
function addtrakingidbuyanxi() {
    global $buyanxi;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $buyanxi->addtrakingid($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function addtrakingidstripepay() {
    global $strpy;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $strpy->addtrakingid($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}



/* Add Traking IDS Order Cypionate */
function addtrakingidtraolcod() {
    global $traolcod;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $traolcod->addtrakingid($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Traking IDS Order Cypionate */
function addtrakingidtramhowto() {
    global $tramhowto;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $tramhowto->addtrakingid($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}



/* Add Shipping Company Names function HERE */
function addshippingtoc() {
    global $painkill;
    global $gpharma;
    global $gphmed;
    global $tramhowto;
    global $drugplan;
    global $ordercy;
    global $tramaex;
	global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $strpy;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$inc = 0;
	switch($data->web) {
		case  "painkillermedicines.com":
			$res = $painkill->addshipping_toc($data, $array);
			break;
		case  "globalpharmamedicines.com":
			$res = $gpharma->addshipping_toc($data, $array);
			break;
		case  "oneglobalpharma.com":
			$res = $gphmed->addshipping_toc($data, $array);
			break;
		case  "drugstoreplanet.com":
			$res = $drugplan->addshipping_toc($data, $array);
			break;
		case  "ordercypionate.com":
			$res = $ordercy->addshipping_toc($data, $array);
			break;
		case  "tramadolexport.com":
			$res = $tramaex->addshipping_toc($data, $array);
			break;
		case  "tramadolsale.com":
			$res = $tramasale->addshipping_toc($data, $array);
			break;
		case  "buyanxietymedicines.com":
			$res = $buyanxi->addshipping_toc($data, $array);
			break;
		case  "sedegital.com":
			$res = $strpy->addshipping_toc($data, $array);
			break;
		case  "bytramadolonlinecod.com":
			$res = $traolcod->addshipping_toc($data, $array);
			break;
		case "Manualorder":
			$res = $painkill->addshipping_maualoc($data, $array);
			break;
	}
	
	$respa = $painkill->get_allorders_today($array, $inc);
		$restrpy = $strpy->get_allorders_today($respa[0], $respa[1]);
		$resgb = $gpharma->get_allorders_today($restrpy[0], $restrpy[1]);
		$resgbmz = $gphmed->get_allorders_today($resgb[0], $resgb[1]);
		$resdp = $drugplan->get_allorders_today($resgbmz[0], $resgbmz[1]);
		$resoc = $ordercy->get_allorders_today($resdp[0], $resdp[1]);
		$restex = $tramaex->get_allorders_today($resoc[0], $resoc[1]);
		$restsale = $tramasale->get_allorders_today($restex[0], $restex[1]);
		$resanxi = $buyanxi->get_allorders_today($restsale[0], $restsale[1]);
		$restrolcod = $traolcod->get_allorders_today($resanxi[0], $resanxi[1]);
		$restrhowto = $tramhowto->get_allorders_today($restrolcod[0], $restrolcod[1]);
		$array = $painkill->get_manual_all_orders($restrhowto[0], $restrhowto[1],"d1");
	
	
	
	if(!empty($array[0])){
		 $userData = json_encode($array[0]);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Payment Link to Order function HERE */
function addpaymentlink() {
    global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
	global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $tramhowto;
	global $strpy;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$inc = 0;
	$data->data->pay_link = $data->linkurl;
	$data->oid = $data->data->oid;

	switch($data->data->web) {
		case  "painkillermedicines.com":
			$res = $painkill->addocpayment_link($data, $array);
			break;
		case  "globalpharmamedicines.com":
			$res = $gpharma->addocpayment_link($data, $array);
			break;
		case  "oneglobalpharma.com":
			$res = $gphmed->addocpayment_link($data, $array);
			break;
		case  "drugstoreplanet.com":
			$res = $drugplan->addocpayment_link($data, $array);
			break;
		case  "ordercypionate.com":
			$res = $ordercy->addocpayment_link($data, $array);
			break;
		case  "tramadolexport.com":
			$res = $tramaex->addocpayment_link($data, $array);
			break;
		case  "tramadolsale.com":
			$res = $tramasale->addocpayment_link($data, $array);
			break;
		case  "buyanxietymedicines.com":
			$res = $buyanxi->addocpayment_link($data, $array);
			break;
		case  "sedegital.com":
			$res = $strpy->addocpayment_link($data, $array);
			break;
		case  "bytramadolonlinecod.com":
			$res = $traolcod->addocpayment_link($data, $array);
			break;
		case  "thtramadol-howto.com":
			$res = $tramhowto->addocpayment_link($data, $array);
			break;
		case "Manualorder":
			$res = $painkill->addocpayment_link_maualoc($data, $array);
			break;
	}
	
	$res = $drugplan->resend_payment_reminder_mail($data->data);
	echo '{"userData": "","status":"1","msg":"Resend Mail Successfully"}';
	
}


/* Add Shipping Company Names function HERE All Order*/
function addshippingtalloc() {
    global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
	global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $tramhowto;
	global $strpy;

	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$inc = 0;
	switch($data->web) {
		case  "painkillermedicines.com":
			$res = $painkill->addshipping_toc($data, $array);
			break;
		case  "globalpharmamedicines.com":
			$res = $gpharma->addshipping_toc($data, $array);
			break;
		case  "oneglobalpharma.com":
			$res = $gphmed->addshipping_toc($data, $array);
			break;
		case  "drugstoreplanet.com":
			$res = $drugplan->addshipping_toc($data, $array);
			break;
		case  "ordercypionate.com":
			$res = $ordercy->addshipping_toc($data, $array);
			break;
		case  "tramadolexport.com":
			$res = $tramaex->addshipping_toc($data, $array);
			break;
		case  "tramadolsale.com":
			$res = $tramasale->addshipping_toc($data, $array);
			break;
		case  "buyanxietymedicines.com":
			$res = $buyanxi->addshipping_toc($data, $array);
			break;
		case  "sedegital.com":
			$res = $strpy->addshipping_toc($data, $array);
			break;
		case  "bytramadolonlinecod.com":
			$res = $traolcod->addshipping_toc($data, $array);
			break;
		case  "thtramadol-howto.com":
			$res = $tramhowto->addshipping_toc($data, $array);
			break;
		case "Manualorder":
			$res = $painkill->addshipping_maualoc($data, $array);
			break;
		
	}
	
		$respa = $painkill->get_all_orders($array, $inc, $data);
		$restrpy = $strpy->get_all_orders($respa[0], $respa[1], $data);
		$resgb = $gpharma->get_all_orders($restrpy[0], $restrpy[1], $data);
		$resdpmz = $gphmed->get_all_orders($resgb[0], $resgb[1], $data);
		$resdp = $drugplan->get_all_orders($resdpmz[0], $resdpmz[1], $data);
		$resoc = $ordercy->get_all_orders($resdp[0], $resdp[1],$data);
		$restrx = $tramaex->get_all_orders($resoc[0], $resoc[1],$data);
		$restrsale = $tramasale->get_all_orders($restrx[0], $restrx[1],$data);
		$resanxi = $buyanxi->get_all_orders($restrsale[0], $restrsale[1],$data);
		$restrolcod = $traolcod->get_all_orders($resanxi[0], $resanxi[1],$data);
		$restrhowto = $tramhowto->get_all_orders($restrolcod[0], $restrolcod[1],$data);
		$array = $painkill->get_manual_all_orders($restrhowto[0], $restrhowto[1],$data->method);
	
	if(!empty($array[0])){
		 $userData = json_encode($array[0]);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Shiping Company Name Pain Killer*/
function addshippingpain() {
    global $painkill;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $painkill->addshippingpain($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Shiping Company Name Newlands Pharmacy*/
function addshippingglobal() {
    global $gpharma;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $gpharma->addshippinglobal($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Shiping Company Name Drugstore */
function addshippingdrugstore() {
    global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $drugplan->addshippingdrugstore($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Shiping Company Name Drugstore */
function addshippingordercp() {
    global $ordercy;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $ordercy->addshippingordercp($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Shiping Company Name Tramadol Export */
function addshippingtramaex() {
    global $tramaex;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $tramaex->addshippingall_order($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Shiping Company Name Tramadol Export */
function addshippingtramasale() {
    global $tramasale;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $tramasale->addshippingall_order($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Shiping Company Name Drugstore */
function addshippingbuyanxi() {
    global $buyanxi;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $buyanxi->addshippingordercp($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function addshippingstripepay() {
    global $strpy;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $strpy->addshippingordercp($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}



/* Add Shiping Company Name Drugstore */
function addshippingtraolcod() {
    global $traolcod;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $traolcod->addshippingall_order($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Shiping Company Name Drugstore */
function addshippingtramhowto() {
    global $tramhowto;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $tramhowto->addshippingall_order($data, $array);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}




/*Mark Order Deliver function*/
function mod() {
    global $painkill;
    global $gpharma;
    global $drugplan;
    global $ordercy;
    global $tramaex;
	global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $tramhowto;
	global $strpy;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$id = $_GET['id'];
	$web = $_GET['web'];
	
	switch($web) {
		case  "pk":
			$res = $painkill->mark_oc_deliver($id);
			break;
		case  "gp":
			$res = $gpharma->mark_oc_deliver($id);
			break;
		case  "dp":
			$res = $drugplan->mark_oc_deliver($id);
			break;
		case  "oc":
			$res = $ordercy->mark_oc_deliver($id);
			break;
		case  "trx":
			$res = $tramaex->mark_oc_deliver($id);
			break;
		case  "trs":
			$res = $tramasale->mark_oc_deliver($id);
			break;
		case  "banx":
			$res = $buyanxi->mark_oc_deliver($id);
			break;
		case  "stripepay":
			$res = $strpy->mark_oc_deliver($id);
			break;
		case  "trht":
			$res = $tramhowto->mark_oc_deliver($id);
			break;
		case  "trolcod":
			$res = $traolcod->mark_oc_deliver($id);
			break;
	}
	echo "Thank you for confirmation.";
}


/* Resend Traking ID mail from Modal Function*/
function rtrakingmail() {
	global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
    global $tramasale;
    global $buyanxi;
    global $traolcod;
    global $tramhowto;
    global $strpy;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$inc = 0;
	switch($data->web) {
		case  "painkillermedicines.com":
			$res = $painkill->resend_traking_mail($data);
			break;
		case  "globalpharmamedicines.com":
			$res = $gpharma->resend_traking_mail($data);
			break;
		case  "oneglobalpharma.com":
			$res = $gphmed->resend_traking_mail($data);
			break;
		case  "drugstoreplanet.com":
			$res = $drugplan->resend_traking_mail($data);
			break;
		case  "ordercypionate.com":
			$res = $ordercy->resend_traking_mail($data);
			break;
		case  "tramadolexport.com":
			$res = $tramaex->resend_traking_mail($data);
			break;
		case  "tramadolsale.com":
			$res = $tramasale->resend_traking_mail($data);
			break;
		case  "buyanxietymedicines.com":
			$res = $buyanxi->resend_traking_mail($data);
			break;
		case  "sedegital.com":
			$res = $strpy->resend_traking_mail($data);
			break;
		case  "bytramadolonlinecod.com":
			$res = $traolcod->resend_traking_mail($data);
			break;
		case  "thtramadol-howto.com":
			$res = $tramhowto->resend_traking_mail($data);
			break;
		case  "Manualorder":
			$res = $painkill->resend_traking_mail_manual_oc($data);
			break;
	}
	echo '{"userData": "","status":"1","msg":"Resend Mail Successfully"}';
}


/* Get All Manual Order from Painkiller*/
function allmanualorder() {
	global $painkill;
	$request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	
	$array = $painkill->get_manual_all_orders(array(),0,'all');
	if(!empty($array[0])){
		 $userData = json_encode($array[0]);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Update Status of Manual Order*/
function updatestatusmanualoc() {
	global $painkill;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $painkill->update_order_status_manual_oc($data);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/*Delete Manual Order */
function dltManualOrder() {
    global $painkill;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array =array();
	$userData = '';
	$array = $painkill->delete_order_manual_oc($data);
	 if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Delete Order"}';
	} else {
	  echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Add Traking IDS Manual Order */
function addtrakingidmanualoc() {
    global $painkill;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $painkill->addtrakingid_manual_oc($data);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/* Save Manual Order Data*/ 
function savemanualoc() {
	global $painkill;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $painkill->save_manual_order($data);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
} 

/* Update Manual Order Data*/ 
function updatemanualoc() {
	global $painkill;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = array();
	$array = $painkill->update_manual_order($data);
	if(!empty($array)){
		 $userData = json_encode($array);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/*Resend Email in MOdal Manual Order*/
function rstrckingmailmanualoc() {
	global $painkill;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$array = $painkill->resend_traking_mail_manual_oc($data);
	echo '{"userData": "","status":"1","msg":"Resend Mail Successfully"}';
}

function resendpaymentmail() {
	global $drugplan;
	$request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->resend_payment_reminder_mail($data->data);
	echo '{"userData": "","status":"1","msg":"Resend Mail Successfully"}';
}

function reorderemailsend() {
	global $drugplan;
	$request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->reorder_ask_customer_email($data);
	echo '{"userData": "","status":"1","msg":"Reorder Mail Successfully  sent"}';
}
/*Resend Email in MOdal Manual Order*/
function allocsendcomposemail() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

	
	switch($data->web) {
		case  "painkillermedicines.com":
			sendmail("admin@painkillermedicines.com", "Pain Killer", $data->email, $data->subject, $data->body);
			break;
		case  "globalpharmamedicines.com":
			sendmail("admin@globalpharmameds.com", "Newlands Pharmacy", $data->email, $data->subject, $data->body);
			break;
		case  "oneglobalpharma.com":
			sendmail("admin@oneglobalpharma.com", "Newlands Pharmacy", $data->email, $data->subject, $data->body);
			break;
		case  "drugstoreplanet.com":
			sendmail("admin@selcoenterprises.com", "Drugstore Planet", $data->email, $data->subject, $data->body);
			break;
		case  "ordercypionate.com":
			sendmail("admin@ordercypionate.com", "Order Cypionate", $data->email, $data->subject, $data->body);
			break;
		case  "tramadolexport.com":
			sendmail("admin@selcoenterprises.com", "Tramadol Export", $data->email, $data->subject, $data->body);
			break;
		case  "tramadolsale.com":
			sendmail("admin@tramadolsale.com", "Tramadol Sale", $data->email, $data->subject, $data->body);
			break;
		case  "buyanxietymedicines.com":
			sendmail("admin@selcoenterprises.com", "Buy Anxiety Medicines", $data->email, $data->subject, $data->body);
			break;
		case  "sedegital.com":
			sendmail("admin@selcoenterprises.com", "Selco Degital", $data->email, $data->subject, $data->body);
			break;
		case  "bytramadolonlinecod.com":
			sendmail("admin@buytramadolonlinecod.com", "Tramadol Online Cod", $data->email, $data->subject, $data->body);
			break;
		case  "Manualorder":
			sendmail("admin@globalpharmameds.com", "Newlands Pharmacy", $data->email, $data->subject, $data->body);
			break;
	}
	echo '{"userData": "","status":"1","msg":"Resend Mail Successfully"}';
}
/*Get all Website enquiries*/
function getallenquiries() {
	global $tramaex;
	$res = $tramaex->get_allwebsite_contact_form_details();
	if(!empty($res)){
		 $userData = json_encode($res);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function cusdata() {
    global $gphmed;
    $res = $gphmed->get_cus_data();
	if(!empty($res)){
		 $userData = json_encode($res);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function allinv() {
    global $gphmed;
    $res = $gphmed->get_inv_data();
	if(!empty($res)){
		 $userData = json_encode($res);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}


function orderdelay() {
    global $gphmed;
    $res = $gphmed->orderdelay();
	if(!empty($res)){
		 $userData = json_encode($res);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function trackdelay() {
    global $gphmed;
    $res = $gphmed->trackdelay();
	if(!empty($res)){
		 $userData = json_encode($res);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}


/*Delete enquiries*/
function dltenquiries() {
	global $tramaex;
	$request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	
	$responce = $tramaex->dlt_enquiry($data->id);
	$res = $tramaex->get_allwebsite_contact_form_details();
	if(!empty($res)){
		 $userData = json_encode($res);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}
/*Change Status of enquiry*/
function changestsenquiry() {
	global $tramaex;
	$request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	
	$responce = $tramaex->update_enquiry_sts($data->id);
	$res = $tramaex->get_allwebsite_contact_form_details();
	if(!empty($res)){
		 $userData = json_encode($res);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/*Reply Enquiry Message from Admin*/
function replyenquiry() {
	global $tramaex;
	$request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$responce = $tramaex->enquiry_reply_send($data);
	$res = $tramaex->get_allwebsite_contact_form_details();
	if(!empty($res)){
		 $userData = json_encode($res);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}


/*Reply Enquiry messagefrom customer*/
function replyenquiry_custo() {
	global $tramaex;
	$res = $tramaex->enquiry_reply_send_user($_POST);
	if(!empty($res)){
		echo '{"userData": "Saved Data","status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/*Cases Component API Calls ALL functions*/
function fetchsingleorderdetails() {
    global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
    global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $strpy;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	switch($data->web) {
		case  "painkillermedicines.com":
			$res = $painkill->get_single_order_array($data->oid);
			break;
		case  "globalpharmamedicines.com":
			$res = $gpharma->get_single_order_array($data->oid);
			break;
		case  "oneglobalpharma.com":
			$res = $gphmed->get_single_order_array($data->oid);
			break;
		case  "drugstoreplanet.com":
			$res = $drugplan->get_single_order_array($data->oid);
			break;
		case  "ordercypionate.com":
			$res = $ordercy->get_single_order_array($data->oid);
			break;
		case  "tramadolexport.com":
			$res = $tramaex->get_single_order_array($data->oid);
			break;
		case  "tramadolsale.com":
			$res = $tramasale->get_single_order_array($data->oid);
			break;
		case  "buyanxietymedicines.com":
			$res = $buyanxi->get_single_order_array($data->oid);
			break;
		case  "sedegital.com":
			$res = $strpy->get_single_order_array($data->oid);
			break;
		case  "bytramadolonlinecod.com":
			$res = $traolcod->get_single_order_array($data->oid);
			break;
		case  "Manualorder":
			$res = $painkill->manualoc_get_single_order_array($data->oid);
			break;
	}
	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function createannewcase() {
    global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->create_new_case($data);
	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function getallopencases() {
	global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->get_all_open_cases($data);
	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function deletecases() {
	global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->delete_case($data->id);
	$res = $drugplan->get_all_closed_cases();
	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function changestatuscase() {
	global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->changestatuscases($data->id);
	$res = $drugplan->get_all_open_cases();
	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function getallclosedcases() {
	global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->get_all_closed_cases($data);
	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function reopencasestatus() {
	global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->changestatuscases_reopen($data->id);
	$res = $drugplan->get_all_closed_cases();
	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function fetchcustreports() {
	global $drugplan;
	$res = $drugplan->get_all_customer_reports();
	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function dltcustreport() {
	global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->delete_cust_report($data->id);
	$res = $drugplan->get_all_customer_reports();
	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function changecustreportsts() {
	global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->change_cust_report_sts($data->id);
	$res = $drugplan->get_all_customer_reports();
	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function replycustreport() {
	global $drugplan;
	$request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$responce = $drugplan->enquiry_reply_send($data);
	$res = $drugplan->get_all_customer_reports();
	if(!empty($res)){
		 $userData = json_encode($res);
		echo '{"userData": ' .$userData . ',"status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function replycustreport_custo() {
	global $drugplan;
	$res = $drugplan->enquiry_reply_send_user($_POST);
	if(!empty($res)){
		echo '{"userData": "Saved Data","status":"1","msg":"Successfully Update Status"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}


function addreshiptrakingscase() {
    global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->reshiptrakingids($data);
	echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Update Status"}';
}

function rtrakingmailcases() {
	global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->resend_reshipmail($data);
	echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Update Status"}';
}

function addcasenote() {
	global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->addcase_note($data);
	echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Update Status"}';
}

function delcasenote() {
	global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->delcase_note($data);
	echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Update Status"}';
}



/* Admin Report Conversation Functions*/
function adminreportadd() {
	global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->add_cooment($data);
	echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Add Comments"}';
}

function getalladmincomments() {
	global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->get_all_admincomments();
	echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Add Comments"}';
}

function replyeadmincomments() {
	global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->save_sec_admin_msg($data);
	echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Add Comments"}';
}

function deleteadmincomments() {
	global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->detele_admin_message($data);
	echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Add Comments"}';
}

function replyeadmincommentsadmin() {
	global $drugplan;
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	$res = $drugplan->save_master_admin_msg($data);
	echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Add Comments"}';
}


/*Cases Component API Calls ALL functions*/
function reportanissue() {
    global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
    global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $strpy;
	global $tramhowto;

	switch($_POST['web']) {
		case  "painkill":
			$res = $painkill->get_single_order_array_byid($_POST['id']);
			$web = "painkillermedicines.com";
			break;
		case  "globpharm":
			$res = $gpharma->get_single_order_array_byid($_POST['id']);
			$web = "globalpharmamedicines.com";
			break;
		case  "globpharmedz":
			$res = $gphmed->get_single_order_array_byid($_POST['id']);
			$web = "oneglobalpharma.com";
			break;
		case  "drugstore":
			$res = $drugplan->get_single_order_array_byid($_POST['id']);
			$web = "drugstoreplanet.com";
			break;
		case  "ordercp":
			$res = $ordercy->get_single_order_array_byid($_POST['id']);
			$web = "ordercypionate.com";
			break;
		case  "tramex":
			$res = $tramaex->get_single_order_array_byid($_POST['id']);
			$web = "tramadolexport.com";
			break;
		case  "tramsale":
			$res = $tramasale->get_single_order_array_byid($_POST['id']);
			$web = "tramadolsale.com";
			break;
		case  "buyanxi":
			$res = $buyanxi->get_single_order_array_byid($_POST['id']);
			$web = "buyanxietymedicines.com";
			break;
		case  "stripepay":
			$res = $strpy->get_single_order_array_byid($_POST['id']);
			$web = "sedegital.com";
			break;
		case  "trolcd":
			$res = $traolcod->get_single_order_array_byid($_POST['id']);
			$web = "bytramadolonlinecod.com";
			break;
		case  "tramhto":
			$res = $tramhowto->get_single_order_array_byid($_POST['id']);
			$web = "thtramadol-howto.com";
			break;
		case  "manualoc":
			$res = $painkill->mcget_single_order_array_byid($_POST['id']);
			$web = "Manualorder";
			break;
	}
	
	$responce = $drugplan->save_report_an_issue($res, $_POST, $web);
	
	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/*Cases Component API Calls ALL functions*/
function aftersalesfollowup() {
    global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
    global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $strpy;
	global $tramhowto;

	switch($_POST['web']) {
		case  "painkill":
			$res = $painkill->get_single_order_array_byid($_POST['id']);
			$web = "painkillermedicines.com";
			break;
		case  "globpharm":
			$res = $gpharma->get_single_order_array_byid($_POST['id']);
			$web = "globalpharmamedicines.com";
			break;
		case  "globpharmedz":
			$res = $gphmed->get_single_order_array_byid($_POST['id']);
			$web = "oneglobalpharma.com";
			break;
		case  "drugstore":
			$res = $drugplan->get_single_order_array_byid($_POST['id']);
			$web = "drugstoreplanet.com";
			break;
		case  "ordercp":
			$res = $ordercy->get_single_order_array_byid($_POST['id']);
			$web = "ordercypionate.com";
			break;
		case  "tramex":
			$res = $tramaex->get_single_order_array_byid($_POST['id']);
			$web = "tramadolexport.com";
			break;
		case  "tramsale":
			$res = $tramasale->get_single_order_array_byid($_POST['id']);
			$web = "tramadolsale.com";
			break;
		case  "buyanxi":
			$res = $buyanxi->get_single_order_array_byid($_POST['id']);
			$web = "buyanxietymedicines.com";
			break;
		case  "stripepay":
			$res = $strpy->get_single_order_array_byid($_POST['id']);
			$web = "sedegital.com";
			break;
		case  "trolcd":
			$res = $traolcod->get_single_order_array_byid($_POST['id']);
			$web = "bytramadolonlinecod.com";
			break;
		case  "tramhto":
			$res = $tramhowto->get_single_order_array_byid($_POST['id']);
			$web = "thtramadol-howto.com";
			break;
		case  "manualoc":
			$res = $painkill->mcget_single_order_array_byid($_POST['id']);
			$web = "Manualorder";
			break;
	}
	
	$responce = $drugplan->save_aftersales_followup($res, $_POST, $_POST['web']);
	
	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

/*Cases Component API Calls ALL functions*/
function getallwebsingleocdata() {
    global $painkill;
    global $gpharma;
    global $gphmed;
    global $drugplan;
    global $ordercy;
    global $tramaex;
    global $tramasale;
	global $buyanxi;
	global $traolcod;
	global $strpy;
	global $tramhowto;

	switch($_POST['web']) {
		case  "painkill":
			$res = $painkill->get_single_order_array_byid($_POST['id']);
			$web = "painkillermedicines.com";
			break;
		case  "globpharm":
			$res = $gpharma->get_single_order_array_byid($_POST['id']);
			$web = "globalpharmamedicines.com";
			break; 
		case  "globpharmedz":
			$res = $gphmed->get_single_order_array_byid($_POST['id']);
			$web = "oneglobalpharma.com";
			break; 
		case  "drugstore":
			$res = $drugplan->get_single_order_array_byid($_POST['id']);
			$web = "drugstoreplanet.com";
			break;
		case  "ordercp":
			$res = $ordercy->get_single_order_array_byid($_POST['id']);
			$web = "ordercypionate.com";
			break;
		case  "tramex":
			$res = $tramaex->get_single_order_array_byid($_POST['id']);
			$web = "tramadolexport.com";
			break;
		case  "tramsale":
			$res = $tramasale->get_single_order_array_byid($_POST['id']);
			$web = "tramadolsale.com";
			break;
		case  "buyanxi":
			$res = $buyanxi->get_single_order_array_byid($_POST['id']);
			$web = "buyanxietymedicines.com";
			break;
		case  "stripepay":
			$res = $strpy->get_single_order_array_byid($_POST['id']);
			$web = "sedegital.com";
			break;
		case  "trolcd":
			$res = $traolcod->get_single_order_array_byid($_POST['id']);
			$web = "bytramadolonlinecod.com";
			break;
		case  "tramhto":
			$res = $tramhowto->get_single_order_array_byid($_POST['id']);
			$web = "thtramadol-howto.com";
			break;
		case  "manualoc":
			$res = $painkill->mcget_single_order_array_byid($_POST['id']);
			$web = "Manualorder";
			break;
	}

	if(!empty($res)){
		echo '{"userData": '.json_encode($res).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}


/*Cases Component API Calls ALL functions*/
function getallundelivredoc() {
    global $drugplan;
	
	$arr = $drugplan->get_all_undelivred_oc();
	$array  = array();
	foreach($arr as $key=>$value):
		$value['detailsarr'] = get_single_res($value['web'], $value['secid']);
		array_push($array, $value);
	endforeach;

	if(!empty($array)){
		echo '{"userData": '.json_encode($array).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function getaftersalesfollowuprec() {
	global $drugplan;
	
	$arr = $drugplan->get_all_aftersalesfollowup_oc();
	$array  = array();
	foreach($arr as $key=>$value):
		$value['detailsarr'] = get_single_res($value['web'], $value['secid']);
		array_push($array, $value);
	endforeach;

	if(!empty($array)){
		echo '{"userData": '.json_encode($array).',"status":"1","msg":"Successfully Fetch Data"}';
	} else {
	    echo '{"userData": "","status":"0","msg":"Failed, Data Not Found"}';
	}
}

function get_single_res($web, $id) {
	    global $painkill;
		global $gpharma;
		global $gphmed;
		global $drugplan;
		global $ordercy;
		global $tramaex;
		global $tramasale;
		global $buyanxi;
		global $traolcod;
		global $strpy;
		global $tramhowto;
	switch($web) {
		case  "painkill":
			$res = $painkill->get_single_order_array_byid($id);
			$web = "painkillermedicines.com";
			return $res;
			break;
		case  "globpharm":
			$res = $gpharma->get_single_order_array_byid($id);
			$web = "globalpharmamedicines.com";
			return $res;
			break;
		case  "globpharmedz":
			$res = $gphmed->get_single_order_array_byid($id);
			$web = "oneglobalpharma.com";
			return $res; 
			break;
		case  "drugstore":
			$res = $drugplan->get_single_order_array_byid($id);
			$web = "drugstoreplanet.com";
			return $res;
			break;
		case  "ordercp":
			$res = $ordercy->get_single_order_array_byid($id);
			$web = "ordercypionate.com";
			return $res;
			break;
		case  "tramex":
			$res = $tramaex->get_single_order_array_byid($id);
			$web = "tramadolexport.com";
			return $res;
			break;
		case  "tramsale":
			$res = $tramasale->get_single_order_array_byid($id);
			$web = "tramadolsale.com";
			return $res;
			break;
		case  "buyanxi":
			$res = $buyanxi->get_single_order_array_byid($id);
			$web = "buyanxietymedicines.com";
			return $res;
			break;
		case  "stripepay":
			$res = $strpy->get_single_order_array_byid($id);
			$web = "sedegital.com";
			return $res;
			break;
		case  "trolcd":
			$res = $traolcod->get_single_order_array_byid($id);
			$web = "bytramadolonlinecod.com";
			return $res;
			break;
		case  "tramhto":
			$res = $tramhowto->get_single_order_array_byid($id);
			$web = "thtramadol-howto.com";
			return $res;
			break;
		case  "manualoc":
			$res = $painkill->mcget_single_order_array_byid($id);
			$web = "Manualorder";
			return $res;
			break;
	}
}

function deleteundelivredoc() {
	global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	
	$res = $drugplan->delete_undelivred_oc($data->id);
	
	$responce = getallundelivredoc();
}

function deletefollowupoc() {
	global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	
	$res = $drugplan->delete_followup_oc($data->id);
	
	$responce = getaftersalesfollowuprec();
}

function changestsundelivredoc() {
	global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	
	$res = $drugplan->update_undelivred_oc($data);
	
	$responce = getallundelivredoc();
}

function changestsfollowupoc() {
	global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	
	$res = $drugplan->update_followup_oc($data);
	
	$responce = getaftersalesfollowuprec();
}


function followupnumberofcallset() {
	global $drugplan;
	
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
	
	$res = $drugplan->set_followup_numberofcall($data);
	
	$responce = getaftersalesfollowuprec();
}
?>
