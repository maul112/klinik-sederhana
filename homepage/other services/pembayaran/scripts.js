document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    const cardForm = document.getElementById('cardForm');
    
    cards.forEach(card => {
        card.addEventListener('click', function() {
            cards.forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
        });
    });
    
    cardForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const newCard = document.createElement('div');
        newCard.classList.add('card');
        newCard.innerHTML = `
            <div class="card-details">
                <div class="bank">${cardForm.bank.value}</div>
                <div class="card-type">${cardForm['card-type'].value}</div>
                <div class="card-number">${cardForm['card-number'].value}</div>
                <div class="expiry">${cardForm.expiry.value}</div>
                <div class="cvv">${cardForm.cvv.value}</div>
                <div class="cardholder">${cardForm.cardholder.value}</div>
            </div>
        `;
        newCard.addEventListener('click', function() {
            cards.forEach(c => c.classList.remove('selected'));
            newCard.classList.add('selected');
        });
        document.querySelector('.cards').insertBefore(newCard, document.querySelector('.add-card-button'));
        closeModal();
    });
});

// Set your publishable key: remember to change this to your live publishable key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
var stripe = Stripe('your-publishable-key-here');
var elements = stripe.elements();

// Set up Stripe.js and Elements to use in checkout form
var style = {
    base: {
        color: "#32325d",
        fontFamily: 'Arial, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
            color: "#aab7c4"
        }
    },
    invalid: {
        color: "#fa755a",
        iconColor: "#fa755a"
    }
};

var card = elements.create("card", { style: style });
card.mount("#card-element");

card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}


function openModal() {
    document.getElementById('cardModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('cardModal').style.display = 'none';
}
