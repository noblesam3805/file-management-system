
var recognition = new webkitSpeechRecognition();

	// Are we processing a short phrase or performing continuous dictation?
	recognition.continuous = false;

	// Do we require interim results in addition to the final results?
	recognition.interimResults = true;

	// We speak The Queens English here, my good man
	recognition.lang = 'en-GB'



	// Set up
	recognition.onstart = function(event){
	 console.log("onstart", event);
	 if(document.getElementById("speech"))
	 	document.getElementById("speech").innerHTML = "<p>Start Recording</p>";
	}

	// Process parsed result
	/*recognition.onresult = function(event){
	 console.log("onresult", event);
	} */
var final_transcript = '';

	recognition.onresult = function(event) {
   	 var interim_transcript = '';
   	 var confidence = 0;

	    for (var i = event.resultIndex; i < event.results.length; ++i) {
	      if (event.results[i].isFinal) {
		final_transcript += event.results[i][0].transcript;
		confidence = event.results[i][0].confidence;
	      } else {
		interim_transcript += event.results[i][0].transcript;
	      }
	    }
	    //final_transcript = capitalize(final_transcript);
	    //final_span.innerHTML = linebreak(final_transcript);
	    //interim_span.innerHTML = linebreak(interim_transcript);
		console.log("Result",event);
		console.log("Scripted result = "+final_transcript);
		if(document.getElementById("speech")) {
			var speech = document.getElementById("speech"); speech.innerHTML = " ";
			speech.innerHTML = "<p style ='color:white'>Processing Speech...</p>";
		}
		//+"<p>confidence: "+confidence+"</p>";
		//document.getElemntById("bio_pass").value = final_transition;
		//console.log(document.getElemntById("bio_pass").value);
		//console.log("displayed = "+speech.innerHTML);
	  };


	// Handle error
	recognition.onerror = function(event){
	 console.log("onerror", event);
	}

	// Housekeeping after success or failed parsing
	recognition.onend = function(){
	 console.log("onend");
	 if(document.getElementById("speech"))
	 	document.getElementById("speech").innerHTML = "<p style ='color:white'>Done...<br/>Click on Login</p>";
	 document.getElementById("bio_data").innerHTML = "<p style ='color:white'>"+final_transcript+"</p>";
	 document.getElementById("bio_pass").value = final_transcript;
	 console.log("bio_pass value = "+document.getElementById("bio_pass").value);
	 //document.getElementById("speech").innerHTML = " ";

	}

function talk() {
	// Kick off the Speech to Text recognition process
	recognition.start();
}

function clearResult() {
 final_transcript = "";
}
