<?php
$apicode = ipGetOption('Hitsteps.apicode');
			if ($apicode==""){
				$apicode=ipConfig()->get('hitsteps_apicode');
			}
?>
<h1><a class="btn btn-default" style="float: right;" onclick="jQuery('#hst_conf').toggle(200);">Configure</a>Hitsteps Realtime Analytics</h1><br />

<div id="hst_conf" style="border: 1px solid #eaeaea; border-radius: 3px; bacgkround: #fdfdfd; padding: 10px; <?php if ($apicode!=''){ ?>display: none;<?php } ?>">

<?php

//check if api code is set by default config.php file, or entered here manually
if (ipConfig()->get('hitsteps_apicode')!=''&&ipGetOption('Hitsteps.apicode')=='') {$default_is_set=1;}else{if (ipGetOption('Hitsteps.apicode')==ipConfig()->get('hitsteps_apicode')&&ipConfig()->get('hitsteps_apicode')!='')  {$default_is_set=1;}else{$default_is_set=0; }}


?>

<?php if ($default_is_set==1){ ?>
<a class="btn btn-default" style="margin-bottom:10px;" onclick="jQuery('.name-apicode').find('.form-control').val('<?php echo ipConfig()->get('hitsteps_apicode'); ?>'); jQuery(this).hide(); jQuery('.name-apicode').show();">Manually set an API code</a>
<?php } ?>

<?php

echo $form->render();
?>

<?php if ($default_is_set==1){ ?>
<script>
//simulate document ready without jquery
function r(f){/in/.test(document.readyState)?setTimeout(r,9,f):f()}
r(function(){
jQuery(".name-apicode").hide();
});</script>
<?php } ?>

</div>


<?php

if ($apicode!=''){

?>
<div class="row">
<div class="col-md-12" style="margin-bottom: 30px;">


<iframe style="width: 100%; height: 420px; border:1px solid #ccc;" scrollable="no" scrolling="no"  name="hitsteps-stat" frameborder="0" style="background-color: #fff; border: 1px solid #A4A2A3;" margin="0" padding="0" marginheight="0" marginwidth="0" width="100%" height="420" src="//hitsteps.com/stats/wp3.2.php?code=<?php echo $apicode;  ?>">	


		<p align="center">
		<a href="//hitsteps.com/login-code.php?code=<?php echo $option['code']; ?>">
		<span>
		<font face="Verdana" style="font-size: 12pt"><?php echo __("Your Browser don't show our widget's iframe. Please Open Hitsteps Dashboard manually.",'hitsteps');?></font></span></a></iframe>
		
		
		
</div>
<div class="col-md-6">
<iframe style="width: 100%; height: 420px;border:1px solid #ccc;" name="hitsteps-stat-mini" frameborder="0" style="background-color: #fff; border: 1px solid #A4A2A3;" margin="0" padding="0" marginheight="0" marginwidth="0" width="100%" height="420" src="//hitsteps.com/stats/wp-dashboard.php?code=<?php echo $apicode;  ?>">

		<p align="center">
		<a href="//hitsteps.com/login-code.php?code=<?php echo $option['code']; ?>">
		<span>
		<font face="Verdana" style="font-size: 12pt"><?php echo __("Your Browser don't show our widget's iframe. Please Open Hitsteps Dashboard manually by clicking here.",'hitsteps');?></font></span></a></iframe>

</div>
<div class="col-md-6">

<iframe style="width: 100%; height: 420px;border:1px solid #ccc;" scrollable='no' scrolling="no"  name="hitsteps-stat-map" frameborder="0" style="background-color: #fff; border: 1px solid #A4A2A3;" margin="0" padding="0" marginheight="0" marginwidth="0" width="100%" height="420" src="//hitsteps.com/stats/wp-map.php?impresspage=1&code=<?php echo $apicode;  ?>">	

		<p align="center">
		<a href="//hitsteps.com/login-code.php?code=<?php echo $apicode;  ?>">
		<span><font face="Verdana" style="font-size: 12pt"><?php echo __("Your Browser don't show our widget's iframe. Please Open Hitsteps Dashboard manually.",'hitsteps');?></font></span></a></iframe>


</div>
</div>

<?php

}








?>
