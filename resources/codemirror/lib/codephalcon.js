var editor, currentHandle = null, currentLine;

window.onload = function () {
    try {
        editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            matchBrackets: true,
            mode: "application/x-httpd-php",
            indentUnit: 4,
            indentWithTabs: true,
            enterMode: "keep",
            tabMode: "shift",
            theme: 'ambiance',
            styleActiveLine: true,
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
