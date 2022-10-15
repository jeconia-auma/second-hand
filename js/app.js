const order_date = new Date();
const html_order_date = document.getElementById('order_date');

html_order_date.value = order_date.toDateString();

//alert(order_date);