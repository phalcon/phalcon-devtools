var editor, currentHandle = null, currentLine;

window.onload = function () {
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
            onCursorActivity: function () {
                var line = editor.getCursor().line, handle = editor.getLineHandle(line);
                if (handle == currentHandle && line == currentLine) return;
                if (currentHandle) {
                    editor.setLineClass(currentHandle, null, null);
                    editor.clearMarker(currentHandle);
                }
                currentHandle = handle;
                currentLine = line;
                editor.setLineClass(currentHandle, null, "activeline");
                editor.setMarker(currentHandle, String(line + 1));
            }
        });
    }
    catch (e) {
        alert(e.stack)
    }
}
