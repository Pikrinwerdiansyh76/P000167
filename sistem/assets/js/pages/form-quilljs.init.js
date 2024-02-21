"use strict";
var quill = new Quill('#editor-container', {
  	modules: {
        toolbar: [
            [{ font: [] }, { size: [] }],
            ["bold", "italic", "underline", "strike"],
            [{ color: [] }, { background: [] }],
            [{ script: "super" }, { script: "sub" }],
            [{ header: [!1, 1, 2, 3, 4, 5, 6] }, "blockquote", "code-block"],
            [{ list: "ordered" }, { list: "bullet" }, { indent: "-1" }, { indent: "+1" }],
            ["direction", { align: [] }],
            ["link", "image", "video"],
            ["clean"],
        ],
    },
  	placeholder: 'Compose an epic...',
  	theme: 'snow'
});

var form = document.querySelector('form');
form.onsubmit = function() {
  	// Populate hidden form on submit
  	var about = document.querySelector('input[name=about]');
  	about.value = JSON.stringify(quill.getContents());
  
  	console.log("Submitted", $(form).serialize(), $(form).serializeArray());
  
  	// No back end to actually submit to!
};
