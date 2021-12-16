let accountButton = document.getElementById('open_account');
let closeAccount = document.getElementById('close_account');

accountButton.addEventListener('click', function(ev){
    ev.preventDefault();

    document.querySelector('.account-container').classList.add('active-account')

})

closeAccount.addEventListener('click', function(ev){
    ev.preventDefault();
    document.querySelector('.account-container').classList.remove('active-account')

})