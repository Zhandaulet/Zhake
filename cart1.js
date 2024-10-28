document.addEventListener('DOMContentLoaded', function() {
    // Отображение товаров в корзине
    const cartItemsContainer = document.getElementById('cart-items');
    const totalPriceElement = document.getElementById('total-price');
    const clearCartButton = document.getElementById('clear-cart'); // Кнопка для очистки корзины

    function displayCart() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let totalPrice = 0;

        cartItemsContainer.innerHTML = ''; // Очищаем контейнер перед добавлением товаров

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p>Ваша корзина пуста</p>';
        }

        cart.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.classList.add('cart-item');
            itemElement.innerHTML = `
                <h3>${item.name}</h3>
                <p>Цена: ${item.price} ₸</p>
                <p>Количество: ${item.quantity}</p>
            `;
            cartItemsContainer.appendChild(itemElement);

            // Рассчитываем общую сумму
            totalPrice += item.price * item.quantity;
        });

        totalPriceElement.textContent = totalPrice;
    }

    // Функция для очистки корзины
    clearCartButton.addEventListener('click', function() {
        localStorage.removeItem('cart'); // Удаляем корзину из localStorage
        displayCart(); // Обновляем отображение корзины
        totalPriceElement.textContent = '0'; // Обнуляем общую сумму
    });

    // Вызываем функцию отображения товаров при загрузке страницы
    displayCart();
});
