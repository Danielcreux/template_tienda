// Datos de productos (simulados)
const products = [
    {
        id: 1,
        name: "Zapatos Deportivos",
        price: 59.99,
        image: "https://via.placeholder.com/300"
    },
    {
        id: 2,
        name: "Camiseta Casual",
        price: 19.99,
        image: "https://via.placeholder.com/300"
    },
    {
        id: 3,
        name: "Reloj Inteligente",
        price: 99.99,
        image: "https://via.placeholder.com/300"
    },
    {
        id: 4,
        name: "Audífonos Inalámbricos",
        price: 49.99,
        image: "https://via.placeholder.com/300"
    }
];

let cart = [];

// Cargar productos en el grid
function loadProducts() {
    const productGrid = document.getElementById("product-grid");
    productGrid.innerHTML = "";

    products.forEach(product => {
        const productCard = document.createElement("div");
        productCard.className = "product-card";
        productCard.innerHTML = `
            <img src="${product.image}" alt="${product.name}" class="product-img">
            <div class="product-info">
                <h3>${product.name}</h3>
                <p>$${product.price.toFixed(2)}</p>
                <button class="add-to-cart" data-id="${product.id}">Añadir al carrito</button>
            </div>
        `;
        productGrid.appendChild(productCard);
    });

    // Eventos para botones "Añadir al carrito"
    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.addEventListener("click", addToCart);
    });
}

// Añadir producto al carrito
function addToCart(event) {
    const productId = parseInt(event.target.getAttribute("data-id"));
    const product = products.find(p => p.id === productId);
    cart.push(product);
    updateCartCount();
}

// Actualizar contador del carrito
function updateCartCount() {
    const cartCount = document.querySelector(".cart-count");
    cartCount.textContent = cart.length;
}

// Inicializar
document.addEventListener("DOMContentLoaded", () => {
    loadProducts();
});