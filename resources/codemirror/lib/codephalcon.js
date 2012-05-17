
var editor;

window.onload = function(){
	try {
		editor = CodeMirror.fromTextArea(document.getElementById("code"), {
			lineNumbers: true,
			lineNumbers: true,
       		matchBrackets: true,
       		mode: "application/x-httpd-php",
       		indentUnit: 4,
       		indentWithTabs: true,
       		enterMode: "keep",
       		tabMode: "shift",
			onCursorActivity: function() {
				editor.setLineClass(hlLine, null, null);
				hlLine = editor.setLineClass(editor.getCursor().line, null, "activeline");
			}
		});
	}
	catch(e){
		alert(e.stack)
	}
}