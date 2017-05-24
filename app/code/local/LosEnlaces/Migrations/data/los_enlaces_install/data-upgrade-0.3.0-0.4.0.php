<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$installer = $this;
$installer->startSetup();

$helloCont = <<<EOF
<style>
	.buttons {
		position: absolute;
		left: 50%;
		transform: translateX(-50%);
	}
	
	#photo,
	#video {
		position: relative;
		top: 40px;
		width: 500px;
		margin: 0 auto;
		display: block;
	}

	.content-scandi {
		display: none;
	}

	#swlogo {
		margin: 0 auto;
		display: block
	}

	button {
		width: 120px;
		background: red;
		color: white;
		text-transform: uppercase;
		padding: 5px 10px;
		border: none;
		outline: none;
		z-index: 9999;
	}

	#img {
		position: relative;
		width: 50%;
		margin: 0 auto;
		display: none;
		height: 430px;
		top: 30px;
	}

	h1 {
	    position: absolute;
	    left: 50%;
	    transform: translateX(-50%);
        font-weight: bold;
	}
	
	#wanted {
            top: 40px;
            color: red;
	}

	#title {
            bottom: 10px;
            width: 400px;
            left: 50%;
            text-align: center;
            color: white;
	}

</style>

	<img id="swlogo" src="{{skin url="images/sw.png"}}" alt="Scandiweb is cool!">
	<div class="content-scandi">
		
	<div class="buttons">
		<button id="capture">Go!!!</button>
		<button id="cancel">Once again</button>	
	</div>
	<video src="" id="video"></video>
	<canvas style="display:none" id="canvas"></canvas>
	<div id="img">
		<img src="" id="photo" alt="">
		<h1 id="wanted">Wanted</h1>
		<h1 id="title">Awesome Magento Magician</h1>	
	</div>
	
	</div>
		<script>
		var takePicture = jQuery('#take-picture');
		var video = jQuery('#video')[0];
		var capture = jQuery('#capture');
		var canvas = jQuery('#canvas')[0];
		var photo = jQuery('#photo')[0];
		var width = 500;
		var stream;
		var streaming = false;
		var cancel = jQuery('#cancel');
		var wrapper = jQuery('#img');
		var media;

		function takepicture() {
			wrapper.show();
			jQuery(video).hide();
		    var context = canvas.getContext('2d');
		    if (width && height) {
		      canvas.width = width;
		      canvas.height = height;
		      context.drawImage(video, 0, 0, width, height);
		      var data = canvas.toDataURL('image/png');
		      photo.setAttribute('src', data);
		    } else {
		      clearphoto();
		    }
			stream && stream.getTracks()[0].stop();
		}

		function clearphoto() {
			launchCapture();
			wrapper.hide();
			jQuery(video).show();
			console.log('clear');
		    var context = canvas.getContext('2d');
		    context.fillStyle = "#AAA";
		    context.fillRect(0, 0, canvas.width, canvas.height);
		    var data = canvas.toDataURL('image/png');
		    photo.setAttribute('src', data);
		}

		var launchCapture = function() {
			media = navigator.mediaDevices.getUserMedia({video: true});
			media
				.then(function(s){
					stream = s;
					video.srcObject = stream;
					video.play();
				})
				.catch(function(err){
					console.log('An error occured: ' + err);
				});
		}

		jQuery(function(){
			jQuery('#swlogo').on('click', function(){
				jQuery('.content-scandi').show();
				launchCapture();
			});

			video.oncanplay = function(){
				if (!streaming) {
			        height = video.videoHeight / (video.videoWidth/width);
			        video.setAttribute('width', width);
			        video.setAttribute('height', height);
			        canvas.setAttribute('width', width);
			        canvas.setAttribute('height', height);
			    }
			    streaming = true;
		    };

		   	cancel.on('click', function(){
		    	clearphoto();
		    })

			capture.on('click', function(){
				takepicture();
			});
		});


	</script>

EOF;

$identifier = "awesome";

Mage::getModel('cms/page')
        ->load($identifier, 'identifier')
        ->setIdentifier($identifier)
        ->setContent($helloCont)
        ->setRootTemplate('one_column')
        ->setTitle("Great job!")
        ->setStores(array(0))
        ->save();

$installer->endSetup();
