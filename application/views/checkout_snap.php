<html>
<title>Checkout</title>

<head>
  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-HCprc-t2i590xFMn"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>


  <form id="payment-form" method="post" action="<?= site_url() ?>/snap/finish">
    <input type="number" min="10000" name="result_type" id="result-type" value=""></div>
    <!-- <input type="text" name="result_data" id="result-data" value=""></div> -->
  </form>

  <button id="pay-button">Pay!</button>
  <script type="text/javascript">
    $('#pay-button').click(function(event) {
      event.preventDefault();
      let nominal = Number($('#result-type').val());
      if (nominal >= 10000) {
        $(this).attr("disabled", "disabled");

        $.ajax({
          url: '<?= site_url() ?>/snap/token/' + nominal,
          cache: false,

          success: function(data) {
            //location = data;

            console.log('token = ' + data);

            var resultType = document.getElementById('result-type');
            var resultData = document.getElementById('result-data');

            function changeResult(type, data) {
              $("#result-type").val(type);
              $("#result-data").val(JSON.stringify(data));
              //resultType.innerHTML = type;
              //resultData.innerHTML = JSON.stringify(data);
            }

            snap.pay(data, {

              onSuccess: function(result) {
                changeResult('success', result);
                console.log(result.status_message);
                console.log(result);
                $("#payment-form").submit();
              },
              onPending: function(result) {
                changeResult('pending', result);
                console.log(result.status_message);
                $("#payment-form").submit();
              },
              onError: function(result) {
                changeResult('error', result);
                console.log(result.status_message);
                $("#payment-form").submit();
              }
            });
          }
        });
      } else {
        alert('Nominal minimal Rp. 10.000');
      }

    });
  </script>


</body>

</html>