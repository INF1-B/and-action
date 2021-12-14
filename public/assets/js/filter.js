let filterButton = document.getElementById('filter');
let closeButton = document.getElementById('close');

filterButton.addEventListener('click', function(ev){
    ev.preventDefault();

    document.querySelector('.filter').classList.add('active-filter')

})

closeButton.addEventListener('click', function(ev){
    ev.preventDefault();
    document.querySelector('.filter').classList.remove('active-filter')

})