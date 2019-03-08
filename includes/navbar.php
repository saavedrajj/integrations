<?php $baseUrl =  "https://" .$_SERVER['SERVER_NAME'] . "/integrations/"; ?>
<?php /*include "<?php echo $baseUrl;?>includes/common.php";*/ ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Integrations</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $baseUrl;?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Paypal</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo $baseUrl;?>paypal/express-checkout/">Express Checkout</a>
          <a class="dropdown-item" href="#">Links</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Braintree</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo $baseUrl;?>braintree/drop-in/">Drop-In UI</a>
          <a class="dropdown-item" href="<?php echo $baseUrl;?>braintree/hosted-fields/">Hosted Fields</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Stripe</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo $baseUrl;?>stripe/checkout/">Checkout</a>
          <a class="dropdown-item" href="<?php echo $baseUrl;?>stripe/card-payments/">Card Payments</a>
        </div>
      </li>      
    </ul>
  </div>
</nav>