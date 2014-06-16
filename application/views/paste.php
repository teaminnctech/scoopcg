
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
  	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <title>localhost</title>
      
    <!-- bjqs.css contains the *essential* css needed for the slider to work -->
    <link rel="stylesheet" href="<?=base_url();?>css/bjqs.css">

    <!-- some pretty fonts for this demo page - not required for the slider -->
    <link href='http://fonts.googleapis.com/css?family=Source+Code+Pro|Open+Sans:300' rel='stylesheet' type='text/css'> 

    <!-- demo.css contains additional styles used to set up this demo page - not required for the slider --> 
    <link rel="stylesheet" href="<?=base_url();?>css/demo.css">

    <!-- load jQuery and the plugin -->
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="<?=base_url();?>js/bjqs-1.3.min.js"></script>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-19067049-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
      
  </head>
  
  <body>
  
    <div id="container">
  
      <h2>Copy and Paste Gallery on localhost</h2>

      <!--  Outer wrapper for presentation only, this can be anything you like -->
      <div id="banner-fade">

        <!-- start Basic Jquery Slider -->
        <ul class="bjqs">
        </ul>
        <!-- end Basic jQuery Slider -->

      </div>
      <!-- End outer wrapper -->


        <p class="description">This page shows an example of how you can use the
            W3C Clipboard API to copy and paste data directly from your own applications
            and other internet sites, to this web page. Slider code van <a href="http://basic-slider.com/">http://basic-slider.com/</a></p>

      <script class="secret-source">
        jQuery(document).ready(function($) {

          $('#banner-fade').bjqs({
            height      : 320,
            width       : 620,
            responsive  : true
          });

        });
      </script>

        <script type="text/javascript">

            $(document).ready(function() {
                window.addEventListener("paste",processEvent);

                function processEvent(e) {
                    for (var i = 0 ; i < e.clipboardData.items.length ; i++) {

                        // get the clipboard item
                        var clipboardItem = e.clipboardData.items[i];
                        var type = clipboardItem.type;

                        // if it's an image add it to the image field
                        if (type.indexOf("image") != -1) {

                            // get the image content and create an img dom element
                            var blob = clipboardItem.getAsFile();
                            var blobUrl = window.webkitURL.createObjectURL(blob);
                            							
							var img = $("<img/>");
                            img.attr("src",blobUrl);
							$("#path").val(blobUrl);
                            
							// our slider requires an li item.
                            var li = $("<li></li>");

                            // add the correct class and add the image
                            li.addClass("bjqs-slide");
                            li.append(img);

                            // add this image to the list of images
                            $(".bjqs").append(li);

                            // reset the basic-slider added elements
                            $(".bjqs-controls").remove();
                            $(".bjqs-markers").remove();

                            // reset the image slider
                            $('#banner-fade').bjqs({
                                height      : 320,
                                width       : 620,
                                responsive  : true
                            });
                        
						
						//URL=$("#path").val();
						getBase64FromImageUrl(blobUrl);
						   function getBase64FromImageUrl(URL) {
							var img = new Image();
							img.src = URL;
							img.onload = function () {
						
						
							var canvas = document.createElement("canvas");
							canvas.width =this.width;
							canvas.height =this.height;
						
							var ctx = canvas.getContext("2d");
							ctx.drawImage(this, 0, 0);
						
						
							var dataURL = canvas.toDataURL("image/png");
						//alert(  dataURL.replace(/^data:image\/(png|jpg);base64,/, ""));
					
					$.ajax({
							type: "POST",
							url: "<?=base_url('welcome/upload');?>",
							data: {html: dataURL},
							success: function(msg) {
								alert(msg)
								//alert("Image Successfully Uploaded,Now Go Back And Click Submit"								  											);
								$("#reps").text(msg);
								 window.close();
								 window.close();
							},
							error: function() {
								alert("Error Occurred  While Uploading Image");
							}
						});
			
			
					}
				}
		
						} else {
                            console.log("Not supported: " + type);
                        }

                    }
                }
            });
        </script>
<span id="reps"></span>
<?php //echo $this->session->userdata('session_id'); ?>
<form action="<?=base_url('welcome/create_gallery');?>" method="post">
<input type="text" class="form-control" name="title" placeholder="Title" /><br>
<textarea name="des" class="form-control"  rows="5" cols="25" placeholder="Description"></textarea><br>
<input type="submit" class="btn btn-default" name="submit" />

<!--<div class="form-group"> <label class="sr-only" for="exampleInputEmail2">Email address</label> <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email"> </div>-->
</form>
  </body>
</html>
