document.getElementById("genera-url").addEventListener("click", function(event){ 
    const originalValue = document.getElementById("title").value;
    event.preventDefault();
    console.log(originalValue);

    if(/[^A-Za-z0-9_ ]+/g.test(originalValue)){
        alert('Non sono ammessi caratteri speciali. Per favore, riprova');
    } else {
        const newValue = originalValue.trim().toLowerCase();
        const slugText = document.getElementById("slug");
        slugText.value = newValue.replace(/\s+/g, '-');
    }
});  
