document.addEventListener('DOMContentLoaded', () => {
  const increaseBtn = document.querySelector('.increase');
  const decreaseBtn = document.querySelector('.decrease');
  const quantityEl = document.querySelector('.quantity');
  const totalPriceEl = document.querySelector('.total-price');
  const cartTotalEl = document.getElementById('cart-total');
  const removeBtn = document.querySelector('.remove');
  const cartItem = document.querySelector('.cart-item');

  const unitPrice = parseInt(document.querySelector('.price').textContent);

  const updateTotal = (qty) => {
    const total = unitPrice * qty;
    totalPriceEl.textContent = total.toLocaleString('id-ID');
    cartTotalEl.textContent = total.toLocaleString('id-ID');
  };

  increaseBtn.addEventListener('click', () => {
    let qty = parseInt(quantityEl.textContent);
    qty++;
    quantityEl.textContent = qty;
    updateTotal(qty);
  });

  decreaseBtn.addEventListener('click', () => {
    let qty = parseInt(quantityEl.textContent);
    if (qty > 1) qty--;
    quantityEl.textContent = qty;
    updateTotal(qty);
  });

  removeBtn.addEventListener('click', (e) => {
    e.preventDefault();
    cartItem.remove();
    cartTotalEl.textContent = '0';
  });
});
