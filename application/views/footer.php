                      <footer class="footer">
        <div class="container">
          
        </div>
    </footer>
    	<div id="debug"><!-- Stores the Profiler Results --></div>
    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  
    <script type="text/javascript" src="<?php echo base_url("js/bootstrap.min.js");  ?>"></script>
<script type='text/javascript'>
$(document).ready(function(){

///$(".dropdown-toggle").dropdown();$(".tooltips").tooltip();

});

</script>

    <script type="text/javascript">
	$( document ).ready(function() {
		console.log("GGG");
		
		
    $('#myModallogin').on('show', function (e) {
		console.log("SHOW");
  $('#myModal').modal('hide')
})
	
	  $('#myModal').on('show', function (e) {
		console.log("SHOW");
  $('#myModallogin').modal('hide')
})
	
//	$('.tooltip-test').tooltip();
///	$(".popover-test").popover(); 
	
	console.log("GGG");
	
});


$(document).ready(function() {   
            var sideslider = $('[data-toggle=collapse-side]');
            var sel = sideslider.attr('data-target');
            var sel2 = sideslider.attr('data-target-2');
            sideslider.click(function(event){
                $(sel).toggleClass('in');
                $(sel2).toggleClass('out');
            });
        });

		</script>
</body>
</html>