<?php
/**
 * @package   Hitsteps
 */
 

 
 
namespace Plugin\Hitsteps;

 if(ipIsManagementState()){
 if (isset($_GET['_hst_proxy_heatmap'])&&$_GET['_hst_proxy_heatmap']!=''){


$manual_apicode = Helper::apicode();
			
if ($manual_apicode!=''){


if ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "on") &&( isset($_SERVER['HTTP_X_FORWARDED_PROTO'])&& $_SERVER['HTTP_X_FORWARDED_PROTO'] == "http")){$prot="http://";}else{$prot="https://";}

$curlurl=$_GET['_hst_proxy_heatmap'];
//init curl
$ch = curl_init();
 
 
curl_setopt($ch, CURLOPT_REFERER, '');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);     
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//Set the URL to work with
curl_setopt($ch, CURLOPT_URL, $curlurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//execute the request (the login)
$store = curl_exec($ch);
$finalURL = curl_getinfo($ch,CURLINFO_EFFECTIVE_URL );

$heatmap_script="
<img width=1 height=1 src=\"//hitsteps.com/login-code.php?code=".$manual_apicode."&page=heatmap\" />

<script>
HSTracked=1;

function hst_ready(fn){var d=document;(d.readyState=='loading')?d.addEventListener('DOMContentLoaded',fn):fn();}

if (typeof jQuery == 'undefined') {
	if (typeof $ == 'function'){thisPageUsingOtherJSLibrary = true;}else{thisPageUsingOtherJSLibrary = false;}
	function getScript(url, success) {
		var script     = document.createElement('script'); script.src = url; var head = document.getElementsByTagName('head')[0], done = false;
		script.onload = script.onreadystatechange = function() {if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { done = true; success(); script.onload = script.onreadystatechange = null; head.removeChild(script);};}; head.appendChild(script); };
	

	
	getScript('//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js', function() {
	if (typeof jQuery=='undefined') {} else {jQuery.noConflict();_HS_jquery_injected=1;if (thisPageUsingOtherJSLibrary) {_HS_jquery_injected=1;} else {jQuery.noConflict();_HS_jquery_injected=1;}}});} else {_HS_jquery_injected=1;};

var hstc=document.createElement('script');var hstcs='www.';if (document.location.protocol=='https:') hstcs='';hstc.src='//hitsteps.com/js/heatmap.js';hstc.async=true;var htssc = document.getElementsByTagName('script')[0];htssc.parentNode.insertBefore(hstc, htssc);


hst_ready( function ( $ ) {

window.setTimeout(function(){

var _HS_body = document.body,_HS_html = document.documentElement;
var _HS_dhh = Math.max( _HS_body.scrollHeight, _HS_body.offsetHeight,_HS_html.clientHeight, _HS_html.scrollHeight, _HS_html.offsetHeight );


var hstc=document.createElement('script');var hstcs='www.';if (document.location.protocol=='https:') hstcs='';hstc.src='//hitsteps.com/stats/heatmap.php?format=js&cw='+window.innerWidth+'&dh='+_HS_dhh+'&sid='+sid+'&url='+escape('".$finalURL."');hstc.async=true;var htssc = document.getElementsByTagName('script')[0];htssc.parentNode.insertBefore(hstc, htssc.nextSibling);

},1000);

});

</script>
";

if (stripos($store,"<head>")){
$store = preg_replace("/<head>/i", "<head><base href='$finalURL' /><script src=\"//hitsteps.com/track.php?code=".substr($manual_apicode,0,32)."\"></script>", $store, 1);
}else{
$store = "<base href='".$finalURL."' />" . "<script src=\"//hitsteps.com/track.php?code=".substr($manual_apicode,0,32)."\"></script>" . $store;
}
$store =  $store . $heatmap_script;

echo $store;

 die();
 }
 }
 }
 
class Event
{
    public static function ipBeforeController()
    {
        if(!ipIsManagementState())
        {
            $manual_apicode = Helper::apicode();
			
			if ($manual_apicode!=''){
			
			$langstr='';
			if (ipGetOption('Hitsteps.chatlang')==''&&ipGetOption('Hitsteps.chatlang')!='auto') $langstr="&lang=".ipGetOption('Hitsteps.chatlang');
			
			
			ipAddJsContent('Hitsteps',"
			(function(){
var hstc=document.createElement('script');
var hstcs='www.';
hstc.src='//hitsteps.com/track.php?code=".substr($manual_apicode,0,32).$langstr."';
hstc.async=true;
var htssc = document.getElementsByTagName('script')[0];
htssc.parentNode.insertBefore(hstc, htssc);
})();
			
			");
			
		
			
			}

			//ipAddJs('//hitsteps.com/track.php?code='.substr($manual_apicode,0,32), array('async'=>'true'), 12);

        }else{
        
            $manual_apicode = Helper::apicode();
			
			if ($manual_apicode!=''){
			
			$langstr='';

			
			
$pageURL="";	
 $thispage = ipContent()->getCurrentPage();

 if ($thispage){
 $pageURL=str_replace(ipConfig()->baseUrl()."home/",ipConfig()->baseUrl(),ipConfig()->baseUrl().$thispage->getUrlPath());
 }
 
	
			
			
			

if ($pageURL!=''){







ipAddJsContent('Hitsteps_AdminPanel',"
			
			hs_apicode='".substr($manual_apicode,0,32).$langstr."';

			hs_current_pageURL=\"".$pageURL."\";
			hs_current_pageURL_stats=\"".urlencode(str_replace("https://","http://",$pageURL))."\";





			(function(){

$( document ).ready(function() {

jQuery(\"body\").append(\"<style>.hs-heatmap-button-holder-container{ pointer-events: none; opacity: 1;transition: opacity 100ms linear; } .wrapper:hover .hs-heatmap-button-holder-container {opacity: 0.1;} #page-wr:hover .hs-heatmap-button-holder-container {opacity: 0.1;} </style>\");


if ($(\"#page-wr\").length){
jQuery('<div class=\'hs-heatmap-button-holder-container\' style=\'position: relative; \'><div onclick=\'window.location.href=\"?aa=Hitsteps\";\' class=\'hs-heatmap-button-holder\' style=\'bottom:0px; right: 10px; position: fixed; text-align: center; \'><div style=\'cursor: pointer; margin-right: 10px; background:rgba(255,255,255,0.6); border:1px solid #bbb; border-bottom:0px; padding:4px 8px; border-radius:5px 5px 0px 0px; display: inline-block; font-size: 9pt; color: #444;\'><img style=\'margin-top: 5px;margin-bottom: 0px;\' height=\'100%\' src=\'https://hitsteps.com/api/wp-graph.php?bg=white&code=".$manual_apicode."\' /><br><small style=\'font-size:7pt;\' id=\'hs_stats_button_label\'>Hitsteps hourly stats</small></div><div style=\'cursor: pointer;  background:rgba(255,255,255,0.6); border:1px solid #bbb; border-bottom:0px;  padding:4px 8px; border-radius:5px 5px 0px 0px; display: inline-block; font-size: 9pt; color: #444;\'><img style=\'margin-top: 5px;margin-bottom: 0px;\' height=\'100%\' src=\'https://hitsteps.com/api/wp-graph.php?bg=white&code=".$manual_apicode."&purl='+hs_current_pageURL_stats+'\' /><br><small style=\'font-size:7pt;\' id=\'hs_stats_button_label\'>This page hourly stats</small></div></div></div>').appendTo('#page-wr');
}else{
jQuery('<div class=\'hs-heatmap-button-holder-container\' style=\'position: relative; \'><div onclick=\'window.location.href=\"?aa=Hitsteps\";\' class=\'hs-heatmap-button-holder\' style=\'bottom:0px; right: 10px; position: fixed; text-align: center; \'><div style=\'cursor: pointer; margin-right: 10px; background:rgba(255,255,255,0.6); border:1px solid #bbb; border-bottom:0px; padding:4px 8px; border-radius:5px 5px 0px 0px; display: inline-block; font-size: 9pt; color: #444;\'><img style=\'margin-top: 5px;margin-bottom: 0px;\' height=\'100%\' src=\'https://hitsteps.com/api/wp-graph.php?bg=white&code=".$manual_apicode."\' /><br><small style=\'font-size:7pt;\' id=\'hs_stats_button_label\'>Hitsteps hourly stats</small></div><div style=\'cursor: pointer;  background:rgba(255,255,255,0.6); border:1px solid #bbb; border-bottom:0px;  padding:4px 8px; border-radius:5px 5px 0px 0px; display: inline-block; font-size: 9pt; color: #444;\'><img style=\'margin-top: 5px;margin-bottom: 0px;\' height=\'100%\' src=\'https://hitsteps.com/api/wp-graph.php?bg=white&code=".$manual_apicode."&purl='+hs_current_pageURL_stats+'\' /><br><small style=\'font-size:7pt;\' id=\'hs_stats_button_label\'>This page hourly stats</small></div></div></div>').appendTo('.wrapper');
}

});



})();
			
			");




ipAddJsContent('Hitsteps_AdminPanel_Heatmapbtn',"
jQuery( document ).ready( function ( $ ) {




	$( \"body\" ).on( 'click' , '.plugin_hitsteps' , function ( ev ) {

		ev.preventDefault();
		
		if ($(\"#page-wr\").length){
		if ( !$( '#hsheatmapframe' ).length ) {
		$(\"#page-wr\").css('overflow','hidden');
		$(\".ipsAdminPanelContainer\").animate({'opacity':'0.3'},300);
		$(\".ipsAdminPanelContainer\").css('pointer-events','none');
		$(\".plugin_hitsteps\").css('background','rgba(0,0,0,0.3)');
		$(\"#page-wr\").prepend(\"<iframe frameborder='0' style='overflow:hidden;' scrolling='no' frameborder='0' id='hsheatmapframe' src='?_hst_proxy_heatmap=".urlencode($pageURL)."' width=100% height='\"+$(\"#page-wr\").height()+\"'></iframe>\");
		

		
		}else{
		$(\"#page-wr\").css('overflow','auto');
		$(\".ipsAdminPanelContainer\").animate({'opacity':'1'},300);
		$(\".ipsAdminPanelContainer\").css('pointer-events','default');
		$(\".plugin_hitsteps\").css('background','rgba(0,0,0,0)');
		$( '#hsheatmapframe' ).remove();
		}
		}else{
		if ( !$( '#hsheatmapframe' ).length ) {
		$(\".wrapper\").css('overflow','hidden');
		$(\".ipsAdminPanelContainer\").animate({'opacity':'0.3'},300);
		$(\".ipsAdminPanelContainer\").css('pointer-events','none');
		$(\".plugin_hitsteps\").css('background','rgba(0,0,0,0.3)');
		_hs_wh=$(\".wrapper\").height();
		$(\".wrapper\").prepend(\"<iframe frameborder='0' style='overflow:hidden;' scrolling='no' frameborder='0' id='hsheatmapframe' src='?_hst_proxy_heatmap=".urlencode($pageURL)."' width=100% height='\"+_hs_wh+\"'></iframe>\");
		$(\".wrapper\").height(_hs_wh);
		

		
		}else{
		$(\".wrapper\").css('overflow','auto');
		$(\".ipsAdminPanelContainer\").animate({'opacity':'1'},300);
		$(\".ipsAdminPanelContainer\").css('pointer-events','default');
		$(\".plugin_hitsteps\").css('background','rgba(0,0,0,0)');
		$( '#hsheatmapframe' ).remove();
		$(\".wrapper\").height('auto');
		}	
		}
		

});
});


");
}



			
			}
        
        
        
        }
    }
}