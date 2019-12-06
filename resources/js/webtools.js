$(document).ready(function(){
    const currentUri = "/" + location.pathname.substr(1);
    const currentAnchor = $("a[href='" + currentUri + "']");

    currentAnchor.addClass("active");
    currentAnchor.parents(".has-treeview").addClass("menu-open");
});
