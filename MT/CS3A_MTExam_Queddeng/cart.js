// Initialize an empty cart array
const cart = [];

// Function to add a product to the cart
function addToCart(button) {
    
    // Get product details from the button's parent element
    const product = button.parentElement;
    const name = product.dataset.name;
    const price = parseFloat(product.dataset.price);

    // Check if the product already exists in the cart
    const item = cart.find(item => item.name === name);
    item ? item.quantity++ : cart.push({ name, price, quantity: 1 });

    // Update the cart display
    renderCart();
}

// Function to remove a product from the cart
function removeFromCart(productName) {
    const itemIndex = cart.findIndex(item => item.name === productName);

    if (itemIndex !== -1) { // Check if item exists
        if (cart[itemIndex].quantity > 1) {
            cart[itemIndex].quantity -= 1; // Decrease quantity
        } else {
            cart.splice(itemIndex, 1); // Remove item from cart
        }
        renderCart(); // Update the UI
    }
}

// Function to display the cart content
function renderCart() {
    const cartContainer = document.getElementById('cart');

    // Map each cart item to HTML and display it
    cartContainer.innerHTML = cart.map(item =>
        `<div id="${item.name.replace(/\s+/g, '-')}">
            <button class="removebtn" onclick="removeFromCart('${item.name}')">-</button>
            ${item.name} x ${item.quantity} - ₱${item.price * item.quantity}
        </div>`
    ).join('');

    console.log(cartContainer.innerHTML); // Log the cart content to the console
}
