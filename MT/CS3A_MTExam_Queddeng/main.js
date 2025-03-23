let cart = [];

function addToCart(button) {
    const product = button.parentElement;
    const name = product.dataset.name;
    const price = parseFloat(product.dataset.price);

    const item = cart.find(item => item.name === name);
    item ? item.quantity++ : cart.push({ name, price, quantity: 1 });

    renderCart();
}

function renderCart() {
    const cartContainer = document.getElementById('cart');
    cartContainer.innerHTML = cart.map(item => 
        `<div>${item.name} x ${item.quantity} - ₱${item.price * item.quantity}</div>`
    ).join('');
}
