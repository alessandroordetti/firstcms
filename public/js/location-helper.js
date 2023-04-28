// regioni le stampi via laravel 

const regione = document.getElementById('regione')
const provincia = document.getElementById('provincia')
const comune = document.getElementById('comune')

regione.addEventListener('change', function (el) {
    console.log(el);
    const valueRegione = el.target.value
    provincia.removeAttribute('disabled');
    provincia.innerHTML = '';
    axios.post('/api/province', {
        regione: valueRegione
    }).then(function(response) {
        let data = response.data
        let opt = document.createElement('option');
        opt.value = ''
        opt.innerHTML = 'Seleziona la provincia'
        provincia.appendChild(opt);

        for (let i=0; i < data.length; i++) {
            let e = data[i];
            opt = document.createElement('option');
            opt.value = e.nome;
            opt.innerHTML = e.nome;
            provincia.appendChild(opt);
        }
        
    })
})



provincia.addEventListener('change', function(el){
    const valueProvincia = el.target.value;
    comune.removeAttribute('disabled');

    axios.post('/api/comuni', {
        provincia: valueProvincia,
        comune: comune.value // include the comune value in the POST request
    }).then(function(response){
        let data = response.data;
        let opt = document.createElement('option');
        opt.value = '';
        opt.innerHTML = 'Seleziona il comune';
        comune.appendChild(opt);
        
        for (let i = 0; i < data.length; i++) {
            let e = data[i];
            let opt = document.createElement('option');
            opt.value = e.nome;
            opt.innerHTML = e.nome;

            console.log(e)
            console.log(opt)

            comune.appendChild(opt);
        }
    })
})

/*let regionsNames = [];


let regioni = document.getElementById('regione');
let province = document.getElementById('provincia');
let comune = document.getElementById('comune');

regioni.addEventListener('change', function () {
    if(regioni.selectedIndex >= 0){
        axios.get('http://cmsmultiversity/api/location')
            .then(response => {
                console.log(response.data);
                results = response.data;

                for (let index = 0; index < results.length; index++) {
                    regionsNames.push(results[index].nome);
                }

                console.log(regionsNames);
            })
            .catch(error => {
                console.log(error);
            });


        province.removeAttribute('disabled');

        province.addEventListener('change', function (){
            comune.removeAttribute('disabled');
        })
    }
})*/