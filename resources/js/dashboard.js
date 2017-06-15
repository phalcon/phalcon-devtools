//migration export data checkbox
var object = document.getElementById("force");
object.addEventListener("change", function(event) {
    var block = document.getElementById("choose_type_data");
    if (object.checked) {
        block.style.display = "block";
    } else {
        block.style.display = "none";
    }
});
