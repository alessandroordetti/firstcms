
document.getElementById("genera-url").addEventListener("click", function(event){ 
    const newValue = document.getElementById("title").value;
    event.preventDefault();
    console.log(newValue);

    const slugText = document.getElementById("slug");
    slugText.value = newValue.trim().toLowerCase().replace(/\s+/g, '-');
});
