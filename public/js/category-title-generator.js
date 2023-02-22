const categoryOption = document.getElementsByClassName("category-option");
const title = document.getElementById('title').value;

document.getElementById("genera-url").addEventListener("click", function(event){ 
    const originalValue = document.getElementById("title").value;
    const categorySlug = document.getElementById("category-id").options[document.getElementById("category-id").selectedIndex].dataset.slug;

    console.log(categorySlug);
    if (originalValue === '' && title === '') {
        alert('Inserisci un titolo ed una categoria per generare lo slug');
        return;
    }

    
    for (let index = 0; index < categoryOption.length; index++) {
        event.preventDefault();
    
        if(/[^A-Za-z0-9\u00C0-\u017F\s_ ]+/g.test(originalValue)){
            alert('Non sono ammessi caratteri speciali. Per favore, riprova');
        } else {
            const newValue = categorySlug + '/' + originalValue.toLowerCase().replace(/\s+/g, '-');
            const slugText = document.getElementById("slug");
            slugText.value = newValue;
        }
    }
});  
