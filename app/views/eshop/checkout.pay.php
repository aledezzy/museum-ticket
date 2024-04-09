<?php $this->view("header",$data); ?>
<div style="text-align: center;">
	<h1>Select a payment method below</h1>
	
<?php

  if(isset($_SESSION['POST_DATA'])){


      $total = 0;
      $description = "order 0";
      extract($_SESSION['POST_DATA']);
    
  }
?>
	<br><br>
	 	<div id="smart-button-container">
      <div style="text-align: center;">
        <div id="paypal-button-container"></div>
      </div>
    </div>
  <script src="https://www.paypal.com/sdk/js?client-id=AR43Syo2JVFyeZGMKfOgt6V0y7_d34fELYEX8GfXnn37Ws7fPp8CbQ6fSYZjM3t-14xt4xC33cupGRpO&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'gold',
          layout: 'vertical',
          label: 'paypal',
          
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"<?=$description?>","amount":{"currency_code":"USD","value":<?=$total?>,"breakdown":{"item_total":{"currency_code":"USD","value":<?=$total?>},"shipping":{"currency_code":"USD","value":0},"tax_total":{"currency_code":"USD","value":0}}}}]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            //alert('Transaction completed by ' + details.payer.name.given_name + '!');
            window.location.href = '<?=ROOT."checkout/thank_you?mode=approved"?>';
          });
        },

        onCancel: function(data) {
          window.location.href = '<?=ROOT."checkout/thank_you?mode=cancel"?>';
        },

        onError: function(err) {
          window.location.href = '<?=ROOT."checkout/thank_you?mode=error"?>';
        }
      }).render('#paypal-button-container');
    }
    initPayPalButton();
  </script>

<br><br>
</div>
<?php $this->view("footer",$data); ?>