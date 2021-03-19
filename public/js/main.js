const body = document.getElementsByTagName("BODY")[0];
const navigation = document.getElementById('navigation');
const drawer = document.getElementById('drawer');
let navShow = false;

function mobileMenu(e) {
    e.preventDefault();

    if (!navShow) {
        navShow = true;
        navigation.classList.add('active');
        if (drawer) {
            drawer.classList.remove('hidden');
        }
        body.classList.add('overflow-hidden');
    } else {
        navShow = false;
        navigation.classList.remove('active');
        if (drawer) {
            drawer.classList.add('hidden');
        }
        body.classList.remove('overflow-hidden');
    }

    console.log(navShow);
}