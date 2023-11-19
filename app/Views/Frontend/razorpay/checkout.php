<div class="content-wrapper remove-background">


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-light"> Welcome, <small><?= session()->get('name'); ?></small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('subscription') ?>">Subscription</a></li>
                        <li class="breadcrumb-item active">Purchase</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-md-12">

                <?= $razorPay['id'] ?>


<button id="rzp-button1">Pay Now</button>


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "<?= getenv('RAZORPAY_KEY_ID'); ?>", // Enter the Key ID generated from the Dashboard
    "amount": "<?= $razorPay['amount'] ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "PRIVATECH", //your business name
    "description": "Test Transaction",
    "image": "<?= base_url('public/assets/frontend/images/web-logo.png') ?>",
    "order_id": "<?= $razorPay['id'] ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "callback_url": "<?= base_url('subscription/paymentStatus') ?>",
    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
        "name": "Amlan Bhuyan", //your customer's name
        "email": "amlan17bhuyan@gmail.com",
        "contact": "9127022438" //Provide the customer's phone number for better conversion rates 
    },
    "notes": {
        "address": "Privatech Garden LLP"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>



                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->





        </div>
    </div>



</div>