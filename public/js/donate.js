const amount = document.getElementById('amount');
const donateBtn = document.getElementById('donateBtn');
const donationAmount = localStorage.getItem('donationAmount') || 0;
const inputAmount = document.getElementById('inputAmount');
const paymentMethod = JSON.parse(localStorage.getItem('paymentMethod')) || {};
const methodSelected = document.getElementById('methodSelected');
const paymentMethodId = document.getElementById('paymentMethodId');

if (amount) {
    amount.addEventListener('keyup', () => {

        if (amount.value && amount.value > 100000) {
            const donationAmount = localStorage.setItem("donationAmount", Number(amount.value));;
            donateBtn.disabled = false;
        } else {
            donateBtn.disabled = true;
        }
    });

    if (donateBtn) {
        donateBtn.addEventListener('click', (e) => {
            if (isEmpty(paymentMethod)) {
                gotoPayment();
            } else {
                return window.location.assign(contributeUrl);
            }
        });
    }
}

function selectAmount(e) {
    e.preventDefault();

    const donationAmount = Number(e.currentTarget.dataset.amount);
    localStorage.setItem("donationAmount", donationAmount);

    if (isEmpty(paymentMethod)) {
        gotoPayment();
    } else {
        return window.location.assign(contributeUrl);
    }
}

function gotoPayment(e) {
    // go to the detail payment
    return window.location.assign(paymentUrl);
}

function selectMethod(e) {
    e.preventDefault();

    const paymentMethod = {
        "id": e.currentTarget.dataset.id,
        "name": e.currentTarget.dataset.name,
        "short_name": e.currentTarget.dataset.shortname,
        "image_url": e.currentTarget.dataset.imageurl
    };
    localStorage.setItem("paymentMethod", JSON.stringify(paymentMethod));
    // go to the contribute
    return window.location.assign(contributeUrl);
}

if (inputAmount) {
    inputAmount.value = donationAmount;
}

if (paymentMethodId) {
    if (isEmpty(paymentMethod)) {
        paymentMethodId.value = null;
    } else {
        paymentMethodId.value = paymentMethod.id;
    }
}

if (methodSelected) {
    if (isEmpty(paymentMethod)) {
        methodSelected.innerHTML = `<div class="payment-option"><div class="flex items-center"><p>Metode pembayaran</p></div><a href="#" class="btn-sm btn-success" onclick="gotoPayment(event)">Pilih</a></div>`;
    } else {
        methodSelected.innerHTML = `<div class="payment-option"><div class="flex items-center"><div class="rounded overflow-hidden w-20 shadow"><img src="${paymentMethod.image_url}" alt="payment_method"></div><p class="ml-3">${paymentMethod.short_name}</p></div><a href="#" class="btn-sm btn-success" onclick="gotoPayment(event)">Ganti</a></div>`;
    }
}

function isEmpty(obj) {
    for (var key in obj) {
        if (obj.hasOwnProperty(key))
            return false;
    }
    return true;
}