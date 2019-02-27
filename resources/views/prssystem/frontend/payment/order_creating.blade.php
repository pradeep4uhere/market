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
<center>
    <div style="margin-top: 10%">
    <p><img style="width:200px;height: 100px; " src="{{config('global.THEME_URL_IMAGE')}}/loading.gif" class="img-fluid" alt=""></p>
    <h4>Please Wait...</h4>
    <p>Do not refresh this page, your order is creating, you will auto redirect.<br/><small>Your Ip Address: <?php echo $_SERVER['REMOTE_ADDR']?></small></p>

    <div>
</center>

<form action="<?php echo $PAYU_BASE_URL; ?>" method="post" name="payuForm">
	  {{ csrf_field() }}
      <input type="hidden" name="key" value="<?php echo $merchentKey ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $transxId ?>" />
      <input type="hidden" name="amount" value="<?php echo $total; ?>" />
      <input type="hidden" name="firstname" id="firstname" value="<?php echo $customerName; ?>" />
      <input type="hidden" name="email" id="email" value="<?php echo $customerEmail; ?>" />
      <input type="hidden" name="phone" value="<?php echo $mobile; ?>" />
      <input type="hidden" name="productinfo" value="<?php echo $productInfo; ?>"/>
      <input type="hidden" name="surl" value="<?php echo $successUrl ?>"/>
      <input type="hidden" name="furl" value="<?php echo $failedUrl ?>" />
      <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
      <input type="hidden" name="lastname" id="lastname" value="" />
      <input type="hidden" name="curl" value="" />
      <input type="hidden" name="address1" value="" />
      <input type="hidden" name="address2" value="" />
      <input type="hidden" name="city" value="" />
      <input type="hidden" name="state" value="" />
      <input type="hidden" name="country" value="" />
      <input type="hidden" name="zipcode" value="" />
      <input type="hidden" name="udf1" value="" />
      <input type="hidden" name="udf2" value="" />
      <input type="hidden" name="udf3" value="" />
      <input type="hidden" name="udf4" value="" />
      <input type="hidden" name="udf5" value="" />
      <input type="hidden" name="pg" value="" />
    </form>
<script type="text/javascript">
submitPayuForm();
var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
var payuForm = document.forms.payuForm;
payuForm.submit();
}
</script>	
@stop
