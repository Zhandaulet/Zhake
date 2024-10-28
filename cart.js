document.addEventListener('DOMContentLoaded', function() {
    // Найти все кнопки "Добавить в корзину"
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    // Функция для добавления товара в корзину
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productName = this.getAttribute('data-product');
            const productPrice = this.getAttribute('data-price');
            addToCart(productName, productPrice);
        });
    });

    // Функция для добавления товара в localStorage
    function addToCart(productName, productPrice) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const existingProduct = cart.find(item => item.name === productName);

        if (existingProduct) {
            existingProduct.quantity += 1;
        } else {
            cart.push({ name: productName, price: productPrice, quantity: 1 });
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        alert(`${productName} добавлен в корзину!`);
    }
});
