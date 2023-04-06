<?php
$ocdetails = '';
$total = 0;
$productId = array();
foreach($orderdetails as $key=>$value):
    if($web!="Manualorder"){
    $productId = array();
	$pid = $value->pid;
	array_push($productId,$pid);}
	if($web=="Manualorder") {
		$ocdetails .='<tr>
					<td>'.$value->pname.'</td>
					<td>'.$value->qty.'</td>
					<td>$'.$value->price.'</td>
					<td>$'.$value->price.'</td>
				</tr>';
		$total = $value->price;
		
		$dis = 0;
        if($total>250) {
		    $priceInfo = '<p style="margin:0 !improtant">$'.$total.'</p>
                          <p style="margin:0 !improtant">FREE</p>
                          <p style="margin:0 !improtant">$'.($total+0).'</p>';
                $finaltot = $total+0;                    
		}
		elseif($total>250) {
			$priceInfo = '<p style="margin:0 !improtant">$'.$total.'</p>
                          <p style="margin:0 !improtant">FREE</p>
                          <p style="margin:0 !improtant">$'.($total-$dis).'</p>';
                $finaltot = $total-$dis;
		}
		else {
			$priceInfo = '<p style="margin:0 !improtant">$'.$total.'</p>
                          <p style="margin:0 !improtant">FREE</p>
                          <p style="margin:0 !improtant">$'.($total+0).'</p>';
                $finaltot = $total+0;}
                    
	} else {
		$tot = $value->qty*$value->price;
		$parr = explode("+",$value->pname);
		
		$ocdetails .='<tr>
						<td>'.$parr[0].'</td>
						<td>'.$value->qty.'</td>
						<td>$'.$value->price.'</td>
						<td>$'.$tot.'</td>
					</tr>';
		$total = $total + $tot;
		$dis = 0;
		
        if($total>250 && in_array(1288, $productId)) {
		    $priceInfo = '<p style="margin:0 !improtant">$'.$total.'</p>
                          <p style="margin:0 !improtant">$50.00</p>
                          <p style="margin:0 !improtant">$'.($total+50).'</p>';
                $finaltot = $total+50;                    
		}
		elseif($total>250) {
			$priceInfo = '<p style="margin:0 !improtant">$'.$total.'</p>
                          <p style="margin:0 !improtant">FREE</p>
                          <p style="margin:0 !improtant">$'.($total-$dis).'</p>';
                $finaltot = $total-$dis;
		}
		else {
			$priceInfo = '<p style="margin:0 !improtant">$'.$total.'</p>
                          <p style="margin:0 !improtant">$25</p>
                          <p style="margin:0 !improtant">$'.($total+25).'</p>';
                $finaltot = $total+25;}
	}
endforeach;



date_default_timezone_set("Asia/Kolkata");



$str ='
<head>
    <style>
        #outlook a {
            padding: 0;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        [data-ogsb] .es-button {
            border-width: 0 !important;
            padding: 10px 20px 10px 20px !important;
        }

        [data-ogsb] .es-button.es-button-1635314822655 {
            padding: 10px 20px !important;
        }

        [data-ogsb] .es-button.es-button-1635331926528 {
            padding: 10px 20px !important;
        }

        /*
END OF IMPORTANT
*/
        s {
            text-decoration: line-through;
        }

        html,
        body {
            width: 100%;
            font-family: Arial, sans-serif;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            border-collapse: collapse;
            border-spacing: 0px;
        }

        table td,
        html,
        body,
        .es-wrapper {
            padding: 0;
            Margin: 0;
        }

        .es-content,
        .es-header,
        .es-footer {
            table-layout: fixed !important;
            width: 100%;
        }

        img {
            display: block;
            border: 0;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        table tr {
            border-collapse: collapse;
        }

        p,
        hr {
            Margin: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            Margin: 0;
            line-height: 120%;
            mso-line-height-rule: exactly;
            font-family: Arial, sans-serif;
        }

        p,
        ul li,
        ol li,
        a {
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
            mso-line-height-rule: exactly;
        }

        .es-left {
            float: left;
        }

        .es-right {
            float: right;
        }

        .es-p5 {
            padding: 5px;
        }

        .es-p5t {
            padding-top: 5px;
        }

        .es-p5b {
            padding-bottom: 5px;
        }

        .es-p5l {
            padding-left: 5px;
        }

        .es-p5r {
            padding-right: 5px;
        }

        .es-p10 {
            padding: 10px;
        }

        .es-p10t {
            padding-top: 10px;
        }

        .es-p10b {
            padding-bottom: 10px;
        }

        .es-p10l {
            padding-left: 10px;
        }

        .es-p10r {
            padding-right: 10px;
        }

        .es-p15 {
            padding: 15px;
        }

        .es-p15t {
            padding-top: 15px;
        }

        .es-p15b {
            padding-bottom: 15px;
        }

        .es-p15l {
            padding-left: 15px;
        }

        .es-p15r {
            padding-right: 15px;
        }

        .es-p20 {
            padding: 20px;
        }

        .es-p20t {
            padding-top: 20px;
        }

        .es-p20b {
            padding-bottom: 20px;
        }

        .es-p20l {
            padding-left: 20px;
        }

        .es-p20r {
            padding-right: 20px;
        }

        .es-p25 {
            padding: 25px;
        }

        .es-p25t {
            padding-top: 25px;
        }

        .es-p25b {
            padding-bottom: 25px;
        }

        .es-p25l {
            padding-left: 25px;
        }

        .es-p25r {
            padding-right: 25px;
        }

        .es-p30 {
            padding: 30px;
        }

        .es-p30t {
            padding-top: 30px;
        }

        .es-p30b {
            padding-bottom: 30px;
        }

        .es-p30l {
            padding-left: 30px;
        }

        .es-p30r {
            padding-right: 30px;
        }

        .es-p35 {
            padding: 35px;
        }

        .es-p35t {
            padding-top: 35px;
        }

        .es-p35b {
            padding-bottom: 35px;
        }

        .es-p35l {
            padding-left: 35px;
        }

        .es-p35r {
            padding-right: 35px;
        }

        .es-p40 {
            padding: 40px;
        }

        .es-p40t {
            padding-top: 40px;
        }

        .es-p40b {
            padding-bottom: 40px;
        }

        .es-p40l {
            padding-left: 40px;
        }

        .es-p40r {
            padding-right: 40px;
        }

        .es-menu td {
            border: 0;
        }

        .es-menu td a img {
            display: inline-block !important;
        }

        a {
            text-decoration: none;
        }

        p,
        ul li,
        ol li {
            font-family: Arial, sans-serif;
            line-height: 150%;
        }

        ul li,
        ol li {
            Margin-bottom: 15px;
        }

        .es-menu td a {
            text-decoration: none;
            display: block;
            font-family: Arial, sans-serif;
        }

        .es-wrapper {
            width: 100%;
            height: 100%;
            background-image: ;
            background-repeat: repeat;
            background-position: center top;
        }

        .es-wrapper-color {
            background-color: #555555;
        }

        .es-header {
            background-color: transparent;
            background-image: ;
            background-repeat: repeat;
            background-position: center top;
        }

        .es-header-body {
            background-color: transparent;
        }

        .es-header-body p,
        .es-header-body ul li,
        .es-header-body ol li {
            color: #a0a7ac;
            font-size: 14px;
        }

        .es-header-body a {
            color: #a0a7ac;
            font-size: 14px;
        }

        .es-content-body {
            background-color: #f8f8f8;
        }

        .es-content-body p,
        .es-content-body ul li,
        .es-content-body ol li {
            color: #333333;
            font-size: 14px;
        }

        .es-content-body a {
            color: #3ca7f1;
            font-size: 14px;
        }

        .es-footer {
            background-color: transparent;
            background-image: ;
            background-repeat: repeat;
            background-position: center top;
        }

        .es-footer-body {
            background-color: #242424;
        }

        .es-footer-body p,
        .es-footer-body ul li,
        .es-footer-body ol li {
            color: #888888;
            font-size: 13px;
        }

        .es-footer-body a {
            color: #aaaaaa;
            font-size: 13px;
        }

        .es-infoblock,
        .es-infoblock p,
        .es-infoblock ul li,
        .es-infoblock ol li {
            line-height: 120%;
            font-size: 12px;
            color: #a0a7ac;
        }

        .es-infoblock a {
            font-size: 12px;
            color: #a0a7ac;
        }

        h1 {
            font-size: 30px;
            font-style: normal;
            font-weight: normal;
            color: #333333;
        }

        h2 {
            font-size: 24px;
            font-style: normal;
            font-weight: normal;
            color: #333333;
        }

        h3 {
            font-size: 20px;
            font-style: normal;
            font-weight: bold;
            color: #333333;
        }

        .es-header-body h1 a,
        .es-content-body h1 a,
        .es-footer-body h1 a {
            font-size: 30px;
        }

        .es-header-body h2 a,
        .es-content-body h2 a,
        .es-footer-body h2 a {
            font-size: 24px;
        }

        .es-header-body h3 a,
        .es-content-body h3 a,
        .es-footer-body h3 a {
            font-size: 20px;
        }

        a.es-button,
        button.es-button {
            border-style: solid;
            border-color: #242424;
            border-width: 10px 20px 10px 20px;
            display: inline-block;
            background: #242424;
            border-radius: 20px;
            font-size: 18px;
            font-family: \'lucida sans unicode\', \'lucida grande\', sans-serif;
            font-weight: normal;
            font-style: normal;
            line-height: 120%;
            color: #ffffff;
            text-decoration: none;
            width: auto;
            text-align: center;
        }

        .es-button-border {
            border-style: solid solid solid solid;
            border-color: #242424 #242424 #242424 #242424;
            background: #2cb543;
            border-width: 0px 0px 0px 0px;
            display: inline-block;
            border-radius: 20px;
            width: auto;
        }

        @media only screen and (max-width: 600px) {

            p,
            ul li,
            ol li,
            a {
                line-height: 150% !important;
            }

            h1,
            h2,
            h3,
            h1 a,
            h2 a,
            h3 a {
                line-height: 120% !important;
            }

            h1 {
                font-size: 30px !important;
                text-align: center;
            }

            h2 {
                font-size: 26px !important;
                text-align: center;
            }

            h3 {
                font-size: 20px !important;
                text-align: center;
            }

            .es-header-body h1 a,
            .es-content-body h1 a,
            .es-footer-body h1 a {
                font-size: 30px !important;
            }

            .es-header-body h2 a,
            .es-content-body h2 a,
            .es-footer-body h2 a {
                font-size: 26px !important;
            }

            .es-header-body h3 a,
            .es-content-body h3 a,
            .es-footer-body h3 a {
                font-size: 20px !important;
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li,
            .es-header-body a {
                font-size: 16px !important;
            }

            .es-content-body p,
            .es-content-body ul li,
            .es-content-body ol li,
            .es-content-body a {
                font-size: 16px !important;
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li,
            .es-footer-body a {
                font-size: 16px !important;
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li,
            .es-infoblock a {
                font-size: 12px !important;
            }

            *[class="gmail-fix"] {
                display: none !important;
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important;
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important;
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important;
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important;
            }

            .es-button-border {
                display: block !important;
            }

            a.es-button,
            button.es-button {
                font-size: 20px !important;
                display: block !important;
                border-width: 10px 20px 10px 20px !important;
            }

            .es-btn-fw {
                border-width: 10px 0px !important;
                text-align: center !important;
            }

            .es-adaptive table,
            .es-btn-fw,
            .es-btn-fw-brdr,
            .es-left,
            .es-right {
                width: 100% !important;
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important;
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important;
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important;
            }

            .es-m-p0 {
                padding: 0px !important;
            }

            .es-m-p0r {
                padding-right: 0px !important;
            }

            .es-m-p0l {
                padding-left: 0px !important;
            }

            .es-m-p0t {
                padding-top: 0px !important;
            }

            .es-m-p0b {
                padding-bottom: 0 !important;
            }

            .es-m-p20b {
                padding-bottom: 20px !important;
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important;
            }

            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important;
            }

            tr.es-desk-hidden {
                display: table-row !important;
            }

            table.es-desk-hidden {
                display: table !important;
            }

            td.es-desk-menu-hidden {
                display: table-cell !important;
            }

            .es-menu td {
                width: 1% !important;
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important;
            }

            table.es-social {
                display: inline-block !important;
            }

            table.es-social td {
                display: inline-block !important;
            }
        }

    </style>
</head>
<table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center" width="600">
	<tbody>
	    <tr>
           <td class="esd-structure es-p5" style="background-color: #fefbfa;"
              esd-general-paddings-checked="false" bgcolor="#fefbfa" align="left">
              <table width="100%" cellspacing="0" cellpadding="0" style="padding: 3px;border: 1px solid #0a9d7b;">
                 <tbody>
                    <tr>
                        <td style="display:flex;width: 80%;">
                            <img class="adapt-img" src="https://oneglobalpharma.com/assets/img/global-pharma-logo.png" alt width="130" style="display: block;">
                        </td>
                        <td style="text-align: center;width: 20%;background: #0a9d7b;color: #fff;">
                            <p style="font-weight: 600;font-size: 14px;">'.$data->invid.'</p>
                        </td>
                    </tr>
                 </tbody>
              </table>
           </td>
        </tr>
        <br style="margin-bottom: -4px !important;">
        <tr>
           <td class="esd-structure es-p20" align="left" bgcolor="#87c6ec" style="background-color: #87c6ec;">
              <table cellpadding="0" cellspacing="0" width="100%">
                 <tbody>
                    <tr>
                       <td width="560" class="esd-container-frame" align="center" valign="top">
                          <table cellpadding="0" cellspacing="0" width="100%">
                             <tbody>
                                <tr>
                                   <td align="center" style="background-color:#ffffff;border:1px solid #0a9d7b;margin-top:52px;padding: 0 19px;" class="esd-block-text">
                                      <p style="text-align: left;font-weight: 600;">Hello '.$data->name.'</p>
                                      <p style="text-align: left;">Thanks for shopping with One Newlands Pharmacy. We have received your order on '.$data->date.'
                                      and a detail invoice copy is attached herewith. Kindly click on the “Pay now” button 
                                      bellow and complete the payment process.</p>
                                      
                                      <p style="text-decoration:underline;text-align: center;font-weight: 600;">Note: Name on bank statement for your order of $'.$finaltot.' will be Newlands Pharmacy. 
                                      This name will also appear on your  credit or debit card statement</p>
                                      
                                      <p style="text-align: center;"><b>Click on the button below to view detailed invoice & make payment.</b></p>
                                      
                                      <span class="es-button-border" style="border-radius: 5px; background: #010101;"> 
                                        <a href="'.$data->pay_link.'" style="border-radius:5px!important;font-weight:bold!important;padding:12px 36px!important;text-decoration:none!important;border-width:10px 20px!important;color:#ffffff!important;background:#0e810e!important;border-color:#001100!important;display:block!important;width:fit-content!important;margin: 11px auto!important;">
                                            PAY NOW
                                        </a></span>
                                      
                                      
                                   </td>
                                </tr>
                             </tbody>
                          </table>
                       </td>
                    </tr>
                 </tbody>
              </table>
           </td>
        </tr>
        <br>
        <tr>
                    <td class="esd-structure es-p20" esd-general-paddings-checked="false"
                        style="background-color:#f8f8f8;padding:20px!important;border: 1px solid #0e810e;" bgcolor="#f8f8f8" align="left" esd-custom-block-id="482536">
                        <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                        <span class="es-button-border" style="border-radius: 5px; background: #010101;"> 
                                        <a href="https://oneglobalpharma.com/confirm/receive_order/'.str_replace("#","",$data->invid).'" style="border-radius:5px!important;font-weight:bold!important;padding: 4px 8px!important;text-decoration:none!important;border-width:10px 20px!important;color:#ffffff!important;background: #b1b1b1!important;border-color: #008b00!important;display:block!important;width:fit-content!important;margin:11px auto!important">
                                            Terms & Condition
                                        </a>
                                      </span>
                        <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                            <tbody>
                                <tr>
                                    <td class="es-m-p20b esd-container-frame" width="270" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-block-text es-p10b" align="center">
                                                        <h3 style="color:#2b3445;margin: 0;">24/7 assistance</h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-block-text" align="center" esd-links-color="#335e90">
                                                        <p style="line-height:150%;color:#242424;margin: 0;">Call <a
                                                                target="_blank"
                                                                style="line-height: 150%; color: #335e90;"
                                                                href="tel:13155154364">+1 315 515
                                                                4364<br></a>Email&nbsp;<a target="_blank"
                                                                style="color: #335e90;"
                                                                href="mailto:admin@oneglobalpharma.com">admin@oneglobalpharma.com</a>
                                                            or<br><a target="_blank" href=""
                                                                style="color: #335e90;">Visit Newlands Pharmacy</a> for
                                                            expert assistance.</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
                        <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                            <tbody>
                                <tr>
                                    <td class="esd-container-frame" width="270" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-block-text es-p10b" align="center">
                                                        <h3 style="color: #2b3445; margin: 0;">Our guarantee</h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-block-text" align="center" esd-links-color="#335e90">
                                                        <p style="line-height:150%;color:#242424;margin: 0;">Your satisfaction
                                                            is 100% guaranteed.</p>
                                                        <p style="line-height:150%;color:#242424;margin: 0;">See our <a
                                                                target="_blank"
                                                                href="https://oneglobalpharma.com/order_return"
                                                                style="color: #335e90;">Returns and Exchanges
                                                                policy.</a></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--[if mso]></td></tr></table><![endif]-->
                    </td>
        </tr>
        
        <br>
        
                <tr>
                    <td class="esd-structure es-p20t es-p20r es-p20l" align="left" bgcolor="#010101"
                        style="background-color: #ffffff;border: 1px solid #0e810e;" esd-custom-block-id="481465">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                        <table cellpadding="0" cellspacing="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-block-text" align="center">
                                                        <p><strong><a target="_blank" style="line-height: 150%;"
                                                                    href="https://oneglobalpharma.com/allmeds">Browse
                                                                    all medicines</a></strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" class="esd-block-text es-p20t es-p20b"
                                                        esd-links-underline="none">
                                                        <p style="line-height: 1;color: #000; margin: 0;">Global
                                                            Pharma,<br>Ohio, USA<br><br></p>
                                                        <p style="line-height: 1;color: #000; margin: 0;"><a target="_blank"
                                                                href="tel:13155154364" style="text-decoration: none;">+1
                                                                315 515 4364</a></p>
                                                        <p style="line-height: 1;color: #000; margin: 0;"><a target="_blank"
                                                                href="mailto:admin@oneglobalpharma.com"
                                                                style="line-height: 120%; text-decoration: none;">admin@oneglobalpharma.com</a>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-block-text es-p10t es-p10b" align="center">
                                                        <p style="color: #000;"><em><span
                                                                    style="font-size: 11px; line-height: 150%;">You are
                                                                    receiving this email because you have visited our
                                                                    site or ordered product from our site</span></em>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
	</tbody>
</table>';
$subject = "Here is your invoice to pay for $".$total;

// if($web=="Manualorder" || $web=="globalpharmamedicines.com") {
// 	sendmail("orderonline@oneglobalpharma.com", "Newlands Pharmacy", $email, $subject, $str);
// } else if($web=="thtramadol-howto.com"){
//     sendmail("admin@tramadol-howto.com", "tramadol-howto.com", $email, $subject, $str);
// } else if($web=="sedegital.com") {
// 	sendmail("orderonline@oneglobalpharma.com", "Selco Digital", $email, $subject, $str);
// } else {
//     sendmail("admin@".$web, $web, $email, $subject, $str);
// }

sendmail("orderonline@oneglobalpharma.com", "Newlands Pharmacy", $data->email, $subject, $str);
// include('/home/oneglobalpharma/public_html/securecrm/0webapi/api/classes/sendMail.php');
// sendGridMailSender($subject, $data->email, 'Newlands Pharmacy', $str);


// if($email=='sandeep.webenetic@gmail.com'){
//     include('/home/oneglobalpharma/public_html/securecrm/0webapi/api/classes/sendMail.php');
//     sendGridMailSender($subject, $email, 'Newlands Pharmacy', $str);
// }

// include('/home/oneglobalpharma/public_html/securecrm/0webapi/api/classes/sendMail.php');
// sendGridMailSender('Test MSG', 'sandeepparekh10@gmail.com', 'sandeep', 'Hello Msg');

$curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://hideuri.com/api/v1/shorten",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "url=https://oneglobalpharma.com/confirm/receive_order/".str_replace("#","",$data->invid)."",
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded"
    ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
    $payLinkShort = json_decode($response, true)['result_url'];
}


$curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://hideuri.com/api/v1/shorten",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "url=".$data->pay_link,
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded"
    ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
    $paypalLink = json_decode($response, true)['result_url'];
}


$post_data = [
        'username'=>'Newlands Pharmacy', 
        'key'=>'Newlands Pharmacy@2022', 
        'method'=>'http', 
        'to'=>$data->phone, 
        'message'=>'Dear '.$data->name.', payment link of $'.$total.' for your invoice number '.str_replace("#","",$data->invid).' have generated. View Here: '.$payLinkShort.' and Pay here: '.$paypalLink.' - GlobalPharma', 
        'senderid'=>'mycompany'];
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "https://api-mapper.clicksend.com/http/v2/send.php" );
    curl_setopt($ch, CURLOPT_POST, 1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $postResult = curl_exec($ch);
    if (curl_errno($ch)) {
        // print curl_error($ch);
    }
    curl_close($ch);
    // var_dump($postResult);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.ultramsg.com/instance5491/messages/chat",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$data->phone."&body=Dear ".$data->name.", payment link of $".$total." for your invoice number ".str_replace('#','',$data->invid)." have generated. View Here: ".$payLinkShort." and Pay Here ".$paypalLink." - GlobalPharma&priority=0&referenceId=",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
//   echo "cURL Error #:" . $err;
} else {
//   echo $response;
}



?>