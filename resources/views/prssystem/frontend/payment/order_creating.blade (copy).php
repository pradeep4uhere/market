@extends('prssystem/layouts/blank')
@section('title')
    Please Wait...
@stop
@section('content')
<?php 
function getCallbackUrl()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'response';
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
<center>
    <div style="margin-top: 10%">
    <p><img style="width:200px;height: 100px; " src="{{config('global.THEME_URL_IMAGE')}}/loading.gif" class="img-fluid" alt=""></p>
    <h4>Please Wait...</h4>
    <p>Do not refresh this page, your order is creating, you will auto redirect.<br/><small>Your Ip Address: <?php echo $_SERVER['REMOTE_ADDR']?></small></p>

    <div>
</center>
	<form action="#" id="payment_form">
    <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
    <input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />
    <input type="text" id="key" name="key"  value="{{$merchentKey}}" />
    <input type="text" id="salt" name="salt"  value="{{$merchentSalt}}" />
    <input type="text" id="txnid" name="txnid"  value="{{$transxId}}" />
    <input type="text" id="amount" name="amount"  value="{{$total}}" />
    <input type="text" id="pinfo" name="pinfo"  value="{{$productInfo}}" />
    <input type="text" id="fname" name="fname"  value="{{$customerName}}" />
    <input type="text" id="email" name="email"  value="{{$customerEmail}}" />
    <input type="text" id="mobile" name="mobile"  value="{{$mobile}}" />
    <input type="text" id="hash" name="hash"  value="{{$hash}}" />
	</form>
<script type="text/javascript">
launchBOLT();
function launchBOLT()
{
	bolt.launch({
		key: $('#key').val(),
		txnid: $('#txnid').val(), 
		hash: $('#hash').val(),
		amount: $('#amount').val(),
		firstname: $('#fname').val(),
		email: $('#email').val(),
		phone: $('#mobile').val(),
		productinfo: $('#pinfo').val(),
		udf5: $('#udf5').val(),
		surl : $('#surl').val(),
		furl: $('#surl').val(),
		mode: 'dropout'	
	},{ 
		responseHandler: function(BOLT){
		console.log( BOLT.response.txnStatus );		
		if(BOLT.response.txnStatus != 'CANCEL')
		{
			//Salt is passd here for demo purpose only. For practical use keep salt at server side only.
			var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
			'<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
			'<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
			'<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
			'<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
			'<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
			'<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
			'<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
			'<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
			'<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
			'<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
			'<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
			'</form>';
			var form = jQuery(fr);
			jQuery('body').append(form);								
			form.submit();
		}
	},
		catchException: function(BOLT){
 			alert( BOLT.message );
	}
});
}
</script>	
@stop
