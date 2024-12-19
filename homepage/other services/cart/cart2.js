let cart = [];

function toggleCart() {
    document.getElementById('cartContainer').classList.toggle('active');
}

function addToCart(name, price, image) {
    const existingProductIndex = cart.findIndex(item => item.name === name);
    if (existingProductIndex !== -1) {
        cart[existingProductIndex].quantity += 1;
    } else {
        cart.push({ name, price, image, quantity: 1 });
    }
    updateCart();
}

function updateCart() {
    const cartContainer = document.getElementById('cart');
    cartContainer.innerHTML = '';

    let total = 0;

    cart.forEach(item => {
        total += item.price * item.quantity;
        cartContainer.innerHTML += `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}">
                <div class="cart-item-info">
                    <div class="cart-item-title">${item.name}</div>
                    <div class="cart-item-quantity">
                        <button onclick="updateQuantity('${item.name}', -1)">-</button>
                        <span>${item.quantity}</span>
                        <button onclick="updateQuantity('${item.name}', 1)">+</button>
                    </div>
                </div>
                <div class="cart-item-price">Rp.${item.price * item.quantity}</div>
                <div class="cart-item-remove" onclick="removeFromCart('${item.name}')">&times;</div>
            </div>
        `;
    });
    // document.getElementById('totalPrice').innerText = `Rp.${total}`;
    document.getElementById('totalPrice').setAttribute('value', `Rp.${total}`);
}

function updateQuantity(name, change) {
    const productIndex = cart.findIndex(item => item.name === name);
    if (productIndex !== -1) {
        cart[productIndex].quantity += change;
        if (cart[productIndex].quantity <= 0) {
            cart.splice(productIndex, 1);
        }
        updateCart();
    }
}

function removeFromCart(name) {
    cart = cart.filter(item => item.name !== name);
    updateCart();
}


