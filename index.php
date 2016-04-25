<? include $_SERVER['DOCUMENT_ROOT']."/sys_inc/init.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/doc.php"; ?>
<script>
function get_rate(){
 	//통신
	var from = $("#from_currency").val();	
	var to = $("#to_currency").val();	
	var request = $.ajax({
	type : 'POST',
	url : '/processor/transfer.php',
	data : {mode : 'get_rate', from : from, to : to},
	beforeSend: function(e)
	{
			//전처리
			$("#rate").text('Loading...');
	}
	});						
	request.done(function(data)
	{		
		$("#rate").text(data);
		console.log(data);
		//
		var send = $("#send_amount").val();
		var rate = $("#rate").text();
		var final = (send*1) * (rate*1);
		$("#receive_amount").val(final);
	});
	request.fail(function(data)
	{
		alert('Ajax Fail');
	});	
}
function cal_receive()
{
	var send = $("#send_amount").val();
	var rate = $("#rate").text();
	var final = (send*1) * (rate*1);
	$("#receive_amount").val(final.toFixed(2));
}

function cal_send()
{
	var receive = $("#receive_amount").val();
	var rate = $("#rate").text();
	var final = (receive*1) / (rate*1);
	$("#send_amount").val(final.toFixed(2));
}

$(document).ready(function(e) {
	//init
	get_rate();
    $("#from_currency, #to_currency").change(function(e) {
        get_rate();
    });
	$("#send_amount").on('keyup',function(){
		cal_receive();
	});
	$("#receive_amount").on('keyup',function(){
		cal_send();
	});
	
});
</script>

<? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"; ?>

<!-- Carousel
    ================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel"> 
  <!-- Indicators -->
  
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <!--  <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>-->
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="item active"><img src="/img/common/wealth-69524_1280.jpg" style="opacity:0.5" alt="First slide">
      <div class="container">
        <div class="carousel-caption">
          <h1 style="text-align:left;">Transferwise</h1>
          <div style="min-height:280px;" class="col-sm-offset-7 col-sm-5"> 
            <!--form-->
            <form class="form-horizontal" action="/user/index.php" method="get">
              <div class="form-group">
                <label for="send_amount" class="col-sm-3 control-label">보낼금액</label>
                <div class="col-sm-5" style="padding-right:0;">
                  <input type="text" id="send_amount" name="send_amount" class="form-control input-lg"  placeholder="Amount" value="1000">
                </div>
                <div class="col-sm-4" style="padding-left:0;">
                  <select id="from_currency" name="from_currency" class="form-control input-lg">
                    <option value="KRW">KRW</option>
                    <option value="CNY">CNY</option>
                    <option value="USD">USD</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="receive_amount" class="col-sm-3 control-label">받을금액</label>
                <div class="col-sm-5" style="padding-right:0;">
                  <input type="text" class="form-control input-lg" id="receive_amount" name="receive_amount" placeholder="Amount">
                </div>
                <div class="col-sm-4" style="padding-left:0;">
                  <select id="to_currency" name="to_currency" class="form-control input-lg">
                    <option value="CNY">CNY</option>
                    <option value="KRW">KRW</option>
                    <option value="USD">USD</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="receive_amount" class="col-sm-3 control-label">환율</label>
                <div id="rate" style="font-weight:bold;">
                <!--rate-->Loading...                  
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-default col-sm-12">이체하기</button>
                </div>
              </div>
            </form>
            <!--form end--> 
          </div>
          <!--
          <div class="col-sm-12" style="border:solid 1px blue;">
            <p><a class="btn btn-lg btn-primary" href="#" role="button">회원가입</a></p>
          </div>-->
        </div>
      </div>
    </div>
    <!--
    <div class="item"> <img src="data:image/gif;base64,R0lGODlhAQABAIAAAGZmZgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
      <div class="container">
        <div class="carousel-caption">
          <h1>Another example headline.</h1>
          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
        </div>
      </div>
    </div>
    <div class="item"> <img src="data:image/gif;base64,R0lGODlhAQABAIAAAFVVVQAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
      <div class="container">
        <div class="carousel-caption">
          <h1>One more for good measure.</h1>
          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
        </div>
      </div>
    </div>
    --> 
  </div>
  <!--
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>--></div>
<!-- /.carousel --> 

<!-- Marketing messaging and featurettes
    ================================================== --> 
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing"> 
  
  <!-- Three columns of text below the carousel -->
  <div class="row">
    <div class="col-lg-4"> <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 140px; height: 140px;">
      <h2>Heading</h2>
      <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
      <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
    </div>
    <!-- /.col-lg-4 -->
    <div class="col-lg-4"> <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 140px; height: 140px;">
      <h2>Heading</h2>
      <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
      <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
    </div>
    <!-- /.col-lg-4 -->
    <div class="col-lg-4"> <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 140px; height: 140px;">
      <h2>Heading</h2>
      <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
      <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
    </div>
    <!-- /.col-lg-4 --> 
  </div>
  <!-- /.row --> 
  
  <!-- FOOTER -->
  <footer>
    <p class="pull-right"><a href="#">Back to top</a></p>
    <p>&copy; 2015 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer>
</div>
<!-- /.container -->
<? include $_SERVER['DOCUMENT_ROOT']."/include/footer.php"; ?>
