/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */


var dropdown2 = document.getElementsByClassName("dropdown-btn2");
var i;

for (i = 0; i < dropdown2.length; i++) {
    dropdown2[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent2 = this.nextElementSibling;
        if (dropdownContent2.style.display === "block") {
            dropdownContent2.style.display = "none";
        } else {
            dropdownContent2.style.display = "block";
        }
    });
}



var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}