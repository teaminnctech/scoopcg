
    
    <div class="container">


		
				<div class="row">
					<div class="span12">
       <style>
       #drop_zone {
border: 2px dashed #bbb;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
padding: 25px;
text-align: center;
font: 20pt bold 'Vollkorn';
color: #bbb;

       /* Internet Explorer 10 */
display:-ms-flexbox;
-ms-flex-pack:center;
-ms-flex-align:center;

/* Firefox */
display:-moz-box;
-moz-box-pack:center;
-moz-box-align:center;

/* Safari, Opera, and Chrome */
display:-webkit-box;
-webkit-box-pack:center;
-webkit-box-align:center;

/* W3C */
display:box;
box-pack:center;
box-align:center;


height:400px;
line-height:35px;
vertical-align:middle;
margin-bottom:20px;

margin-top:80px;
}

  #drop_zone_text {
   vertical-align:middle;
  }
  
  
     #drop_zone_results {
border: 2px dashed #bbb;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
padding: 25px;
text-align: center;
font: 20pt bold 'Vollkorn';
color: #bbb;
height:100px;
padding-top:30px;
padding-bottom:30px;
margin-top:20px;
margin-bottom:25px;
display:none;


}

#gallerydescription {
 display:none;                                                                
}

   #progress_bar {
    margin: 10px 0;
    padding: 3px;
    border: 1px solid #000;
    font-size: 14px;
    clear: both;
    opacity: 0;
    -moz-transition: opacity 1s linear;
    -o-transition: opacity 1s linear;
    -webkit-transition: opacity 1s linear;
  }
  #progress_bar.loading {
    opacity: 1.0;
  }
  #progress_bar .percent {
    background-color: #99ccff;
    height: auto;
    width: 0;
  }
</style>   
        <div id="drop_zone">   
        <div id="drop_zone_text" onclick="jQuery('#file').click()">  
        Share an Image create a Gallery <br>Drag & drop files or Click and select images now!
                                                                   </div>
        </div>  <input type="file" id="files" name="file">
         <div id="progress_bar"><div class="percent">0%</div></div>
<output id="list"></output>

 <script>
  

 var reader;
  var progress = document.querySelector('.percent');
var filearray = new Array();
var b;
var filetype;
  function abortRead() {
    reader.abort();
  }

  function errorHandler(evt) {
    switch(evt.target.error.code) {
      case evt.target.error.NOT_FOUND_ERR:
        alert('File Not Found!');
        break;
      case evt.target.error.NOT_READABLE_ERR:
        alert('File is not readable');
        break;
      case evt.target.error.ABORT_ERR:
        break; // noop
      default:
        alert('An error occurred reading this file.');
    };
  }

  function updateProgress(evt) {
    // evt is an ProgressEvent.
    if (evt.lengthComputable) {
      var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
      // Increase the progress bar length.
      if (percentLoaded < 100) {
        progress.style.width = percentLoaded + '%';
        progress.textContent = percentLoaded + '%';
      }
    }
  }
  
  function sendForm() {

  var
     oData = new FormData(document.forms.namedItem("selldown"));

  oData.append("CustomField", "This is some extra data");

  var oReq = new XMLHttpRequest();
  oReq.open("POST", "stash.php", true);
  oReq.onload = function(oEvent) {
    if (oReq.status == 200) {
      oOutput.innerHTML = "Uploaded!";
    } else {
      oOutput.innerHTML = "Error " + oReq.status + " occurred uploading your file.<br \/>";
    }
  };

  oReq.send(oData);

}
  
  
    
  function handleFileSelect1(evt) {
    // Reset progress indicator on new file selection.
    progress.style.width = '0%';
    progress.textContent = '0%';
         $('.instrotext').hide();
              $('#drop_zone_results').show();
                  $('#gallerydescription').show();
                    



    reader1 = new FileReader();
    reader1.onerror = errorHandler;
    reader1.onprogress = updateProgress;
    reader1.onabort = function(e) {
      alert('File read cancelled');
    };
    reader1.onloadstart = function(e) {
      document.getElementById('progress_bar').className = 'loading';
    };
    reader1.onload = function(e) {
      // Ensure that the progress bar displays 100% at the end.
      progress.style.width = '100%';
	    var data = e.target.result;
		
		 b = data;
                ///document.getElementById("addproduct").disabled=false;     	
				
				 $("#producttitle").show();	//console.log(data);
	 console.log(data);
      progress.textContent = '100%';
      setTimeout("document.getElementById('progress_bar').className='';", 2000);
      
      
        $('#drop_zone_results').append('<div id="inputthumb"><span class="close-btn"><a href="#">X</a></span><img width="100" src="'+ data +'"></div>');
    }

    // Read in the image file as a binary string.
     reader1.readAsDataURL(evt.target.files[0]);
	
	     filearray.push(evt.target.files[0]);
	   var files = evt.target.files[0]; // FileList object.
	
	filetype = evt.target.files[0].type;
	//	console.log(evt.target.files[0].name);
			//console.log();
				//console.log(evt.target.files[0].size);
				
				
				 
	//console.log(reader.readAsBinaryString(evt.target.files[0]));
	//
	
	  var files = evt.target.files; // FileList object

/// var fil = files[0];
/// window.b = files[0];
    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                  f.size, ' bytes, last modified: ',
                  f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
                  '</li>');
    }
    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
    
    
    	   
     console.log(filearray);   
  }

  document.getElementById('files').addEventListener('change', handleFileSelect1, false);
    

  
    function handleFileSelect(evt) {
    evt.stopPropagation();
    evt.preventDefault();
	
	   progress.style.width = '0%';
    progress.textContent = '0%';
    
    

          $('.instrotext').hide();
              $('#drop_zone_results').show();
                  $('#gallerydescription').show();
                  
                  
console.log(evt.dataTransfer.files.length);

for (var i = 0; i< evt.dataTransfer.files.length; i++) {

    reader = new FileReader();
    reader.onerror = errorHandler;
    reader.onprogress = updateProgress;
	
	  reader.onabort = function(e) {
      alert('File read cancelled');
    };
    reader.onloadstart = function(e) {
      document.getElementById('progress_bar').className = 'loading';
    };
    reader.onload = function(e) {
      // Ensure that the progress bar displays 100% at the end.
      progress.style.width = '100%';
      progress.textContent = '100%';
	     var data = e.target.result;
                    		//console.log(data);
							//console.log(e.target.result);
					    //alert("-- Data Length --" + data.length);
						//	 console.log(data);
						 //console.log(data);
				 window.b = data;
				
       // 	 console.log(data);
      progress.textContent = '100%';
      setTimeout("document.getElementById('progress_bar').className='';", 2000);
      
        $('#drop_zone_results').append('<div id="inputthumb"><span class="close-btn"><a href="#">X</a></span><img width="100" src="'+ data +'"></div>');
				 ///document.getElementById("addproduct").disabled=false;
				 
			///	 $("#producttitle").show();
				 
				 ///$("input[type=file]").val("");		
      setTimeout("document.getElementById('progress_bar').className='';", 2000);
    }

   reader.readAsDataURL(evt.dataTransfer.files[i]);  
    filearray.push(evt.dataTransfer.files[i]);
}
	   
     console.log(filearray);      
	    ///reader.readAsBinaryString(evt.dataTransfer.files[0]); 
	console.log(evt.dataTransfer.files[0]);
	  ///	console.log(reader.readAsDataURL(evt.dataTransfer.files[0]));
		//	console.log(reader.readAsText(evt.dataTransfer.files[0]));
			//console.log(reader.readAsArrayBuffer(evt.dataTransfer.files[0]));
			
				filetype = evt.dataTransfer.files[0].type;
			var files = evt.dataTransfer.files; // FileList object.

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      //console.log('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                //  f.size, ' bytes, last modified: ',
               //   f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
               //   '</li>');
			//console.log(f.name);	
			//console.log(reader.readAsDataURL(f));
			// var reader1 = new FileReader();
			 ///console.log(reader1.readAsDataURL(f));	
			   
				  
    }    
		   var xhr  = new XMLHttpRequest(),
    data = new FormData();

data.append("files", f); // You don't need to use a FileReader
// append your post fields

// attach your events
xhr.addEventListener('load', function(e) {});
xhr.upload.addEventListener('progress', function(e) {});

//xhr.open('POST', '/process/upload.php', true);
//xhr.send(data);
	
	
    ////var files = evt.dataTransfer.files; // FileList object.
	
	/////console.log(evt.dataTransfer.files[0]);
		//console.log(files[0].name);
		//	console.log(  files[0].type);
				//console.log( files[0].size);
				
			
				 

 //window.b = files[0];
    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
    
  
    
      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                  f.size, ' bytes, last modified: ',
                  f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
                  '</li>');
    }
    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
  }
  
  
  function handleDragOver(evt) {
    evt.stopPropagation();
    evt.preventDefault();
    evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
  }
  
   var dropZone = document.getElementById('drop_zone');
  dropZone.addEventListener('dragover', handleDragOver, false);
  dropZone.addEventListener('drop', handleFileSelect, false);
  
  
   

$(document).ready(function() {

          

   $(document).on( "click",'.close-btn a', function() {
   event.preventDefault();
   
    var $li = $(this).closest("#inputthumb");
  var myIndex = $li.parent().children().index( $li );
  //alert( myIndex );
        $(this).closest("#inputthumb").hide();
        
         filearray.splice(myIndex,1);
              console.log(filearray);
 //alert('AAA');
});  
        
  
});


      




</script>

			</div><!--/span4-->
				</div><!--/row-->
        
        		<div class="row">
					<div class="span12">
              <div id="drop_zone_results">  
              
              </div>
          
          </div>
          </div>
          
           	<div class="row clearfix instrotext">
		<div class="col-md-12 column">
			<div class="jumbotron">
				<h1>
			Create your Gallery Now!
It's Free!
				</h1>
				<p>
				Start a public or private gallery and share with your friends. Drag and drop and fill out details below
				</p>
				<p>
					<a class="btn btn-primary btn-large" href="#">Load Details</a>
          
              		<a href="<?php ///echo site_url(SITE_AREA) ?>" class="btn btn-large btn-success">Go to the Admin area</a>
     		<a href="<?php /////echo site_url(REGISTER_URL); ?>" class="btn btn-large btn-primary">Regiter free account</a>
				</p>
			</div>
			<div class="row clearfix">
				<div class="col-md-12 column">
				</div>
			</div>
		</div>
	</div>
          
          
          <div class="container" id="gallerydescription">
	<div class="row clearfix">
		<div class="metadasection column">
			<div class="page-header">
				<h1>
					Add Gallery Details <small>Title, description, privacy settings and custom url eding</small>
				</h1>
			</div>
	
		<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Form Name</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="gallerytitle">Title </label>  
  <div class="col-md-6">
  <input id="gallerytitle" name="gallerytitle" type="text" placeholder="add a title" class="form-control input-md">
  <span class="help-block">title missing</span>  
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="gallerydescription">Details</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="gallerydescription" name="gallerydescription">add some details to your gallery</textarea>
  </div>
</div>

<!-- Prepended text-->
<div class="form-group">
  <label class="col-md-4 control-label" for="customurlfield">Add a Custom URL</label>
  <div class="col-md-5">
    <div class="input-group">
      <span class="input-group-addon">thescoop.us/</span>
      <input id="customurlfield" name="customurlfield" class="form-control" placeholder="add a custom url" type="text">
    </div>
    <p class="help-block">add a custom url</p>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="privacysettings">Privacy Settings</label>
  <div class="col-md-4"> 
    <label class="radio-inline" for="privacysettings-0">
      <input type="radio" name="privacysettings" id="privacysettings-0" value="public" checked="checked">
      Public (of course sharing is good)
    </label> 
    <label class="radio-inline" for="privacysettings-1">
      <input type="radio" name="privacysettings" id="privacysettings-1" value="private">
      Private
    </label>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="thepassword">Password</label>  
  <div class="col-md-5">
  <input id="thepassword" name="thepassword" type="text" placeholder="add a password" class="form-control input-md">
  <span class="help-block">password is missing</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Text Input</label>  
  <div class="col-md-4">
  <input id="textinput" name="textinput" type="text" placeholder="placeholder" class="form-control input-md">
  <span class="help-block">help</span>  
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="publishingsettings">Ready for take off! </label>
  <div class="col-md-8">
    <button id="publishingsettings" name="publishingsettings" class="btn btn-primary">Preview</button>
    <button id="button2id" name="button2id" class="btn btn-success">Publish Gallery</button>
  </div>
</div>

</fieldset>
</form>

		</div>
	</div>
</div>
          
          
			</div><!--/container-->

			<div class="container">
			

		        
		        <div class="row">
					<div class="span12 middle-headings" id="center">

                        
                        

    
    


        


















<div id="myModallogin" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
    <h3 id="myModalLabel">Log in to your Account</h3>
  </div>
  
  <div class="modal-body">
<div id="login">
	<h2>Please sign in</h2>

	
	
	<form action="http://thescoop.us/index.php/login" method="post" accept-charset="utf-8" autocomplete="off"><div style="display:none">
<input type="hidden" name="ci_csrf_token" value="d40cf323f1dba58c14520b4011e482ca">
</div>
		<div class="control-group ">
			<div class="controls">
				<input style="width: 95%" type="text" name="login" id="login_value" value="" tabindex="1" placeholder="Email">
			</div>
		</div>

		<div class="control-group ">
			<div class="controls">
				<input style="width: 95%" type="password" name="password" id="password" value="" tabindex="2" placeholder="Password">
			</div>
		</div>

					<div class="control-group">
				<div class="controls">
					<label class="checkbox" for="remember_me">
						<input type="checkbox" name="remember_me" id="remember_me" value="1" tabindex="3">
						<span class="inline-help">Remember me</span>
					</label>
				</div>
			</div>
		
		<div class="control-group">
			<div class="controls">
				<input class="btn btn-large btn-primary" type="submit" name="log-me-in" id="submit" value="Sign In" tabindex="5">
			</div>
		</div>
	</form>
		<!-- Activation Block -->
			<p style="text-align: left" class="well">
				Need to activate your account?<br>
				<b>Have an activation code to enter to activate your membership?</b> Enter it on the <a href="http://thescoop.us/index.php/activate">Activate</a> page.<br><br>    <b>Need your code again?</b> Request it again on the <a href="http://thescoop.us/index.php/resend_activation">Resend Activation</a> page.			</p>
	
	<p style="text-align: center">
					<a href="http://thescoop.us/index.php/register">Create An Account</a>		
		<br><a href="http://thescoop.us/index.php/forgot_password">Forgot Your Password?</a>	</p>

</div>
  </div>
  
  <div class="modal-footer">
  <button  href="#myModallogin" class="btn btn-info" data-toggle="modal" aria-hidden="true">Need to Register?</button>  
  
  <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>-->
    
  </div>
  </div>

    
   
    
    
    
    
    
					</div><!--/span12-->					
				</div><!--/row-->
				
				<div class="row-fluid">
		            <ul class="thumbnails">
		         
                       
                      
                      
		            </ul>
		        </div><!--/row fluid-->




			</div><!--/container-->
		</div><!--/white--><!--/testimonials-->


