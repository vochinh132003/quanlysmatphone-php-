<?php
include "navbarr.php";
?>
<div id="cart" style="padding: 20px 100px;">
    <h2>Giỏ hàng</h2>
    <div class="row">
        <div class="col-md-9">
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Setting</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="cart">
                        <h5 class="card-title">Tổng cộng</h5>
                        <p class="card-text" id="cart-total"></p>
                    </div>
                    <a class="btn btn-success" href="http://localhost/DOANPHPMYSQL_2023/admin/category/order.php">
                        <span>Đặt hàng</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>
<style>
    th {
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }

    th:last-child {
        border-right: none;
    }

    td {
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }

    td:last-child {
        border-right: none;
    }

    .cart {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .cart .card-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .cart .card-text {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .cart-btn {
        display: flex;
        justify-content: center;
    }

    .btn-success {
        width: 100%;
    }

    .quantity-container {
        display: flex;
        align-items: center;
    }

    .quantity-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 25px;
        height: 25px;
        border: none;
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
    }

    .quantity-value {
        margin: 0 10px;
        font-weight: bold;
    }
</style>

<script src="http://localhost/DOANPHPMYSQL_2023/admin/assets/js/cart.js"></script>
<script>
    function showCartItems() {
        // Lấy giỏ hàng từ Cookie
        var cart = getCartFromCookie();

        // Lấy thẻ tbody để chèn các sản phẩm vào
        var cartItems = document.getElementById("cart-items");

        // Tính tổng tiền
        var cartTotal = 0;

        // Xóa các sản phẩm trong giỏ hàng trước đó (nếu có)
        while (cartItems.firstChild) {
            cartItems.removeChild(cartItems.firstChild);
        }
        var j = 0;
        // Thêm các sản phẩm vào giỏ hàng
        for (var i = 0; i < cart.length; i++) {
            var productId = cart[i].id;
            var productName = cart[i].name;
            var productPrice = cart[i].price;
            var productQuantity = cart[i].quantity;
            var productImage = cart[i].image; // Thêm dòng này

            var productTotal = productPrice * productQuantity;
            cartTotal += productTotal;

            var tr = document.createElement("tr");
            // Tạo phần tử <td> cho số thứ tự
            var stt = document.createElement("td");
            stt.textContent = ++j; // Tăng giá trị của biến đếm và gán nó vào phần tử <td>
            tr.appendChild(stt);
            var tdImage = document.createElement("td");
            var img = document.createElement("img");
            // img.src = URL.createObjectURL(productImage); 
            img.src = productImage;
            img.style.width = "50px";
            img.style.height = "50px";
            tdImage.appendChild(img);
            tr.appendChild(tdImage);

            var tdName = document.createElement("td");
            tdName.textContent = productName;
            tr.appendChild(tdName);

            var tdPrice = document.createElement("td");
            tdPrice.textContent = productPrice + "VNĐ";
            tr.appendChild(tdPrice);

            var tdQuantity = document.createElement("td");
            tdQuantity.innerHTML = `
                    <button type="button" class="btn btn-primary btn-sm" onclick="decreaseQuantity(${productId})">-</button>
                    <span id="quantity-${productId}">${productQuantity}</span>
                    <button type="button" class="btn btn-primary btn-sm" onclick="increaseQuantity(${productId})">+</button>
                `;
            tr.appendChild(tdQuantity);

            var tdTotal = document.createElement("td");
            tdTotal.textContent = productTotal + "VNĐ";
            tr.appendChild(tdTotal);

            var tdRemove = document.createElement("td");
            var button = document.createElement("button");
            button.type = "button";
            button.className = "btn btn-danger btn-sm";
            button.textContent = "Xóa";
            button.onclick = (function (productId) {
                return function () {
                    removeProductFromCart(productId);
                }
            })(productId);
            tdRemove.appendChild(button);
            tr.appendChild(tdRemove);

            cartItems.appendChild(tr);
        }

         // Hiển thị tổng tiền
        var cartTotalElement = document.getElementById("cart-total");
        cartTotalElement.textContent = cartTotal.toLocaleString("vi-VN") + " VNĐ";
    }

    var cartTotal = 0;
    function changeQuantity(productId, quantity) {
        // Get the cart from the cookie
        var cart = getCartFromCookie();

        // Find the product in the cart
        var index = findProductInCart(productId, cart);
        if (index !== -1) {
            // Update the product quantity
            cart[index].quantity = parseInt(quantity);

            // If the quantity becomes 0, remove the product from the cart
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }

            // Save the updated cart to the cookie
            setCartToCookie(cart);

            // Update the cart display
            showCartItems();
        }
    }
    function increaseQuantity(productId) {
        // Lấy giỏ hàng từ cookie
        var cart = getCartFromCookie();

        // Tìm sản phẩm trong giỏ hàng
        var index = findProductInCart(productId, cart);
        if (index !== -1) {
            // Increase the product quantity by 1
            cart[index].quantity++;

            // Save the updated cart to the cookie
            setCartToCookie(cart);

            // Update the cart display
            showCartItems();
        }
    }
    function decreaseQuantity(productId) {
        // Lấy giỏ hàng từ cookie
        var cart = getCartFromCookie();

        // Tìm sản phẩm trong giỏ hàng
        var index = findProductInCart(productId, cart);
        if (index !== -1) {
            // Giảm số lượng sản phẩm đi 1
            cart[index].quantity--;

            // Nếu số lượng sản phẩm bằng 0, xóa sản phẩm khỏi giỏ hàng
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }

            // Lưu giỏ hàng đã cập nhật vào cookie
            setCartToCookie(cart);

            // Cập nhật hiển thị giỏ hàng
            showCartItems();
        }
    }


    function removeProductFromCart(productId) {
        // Lấy giỏ hàng từ Cookie
        var cart = getCartFromCookie();

        // Tìm sản phẩm trong giỏ hàng
        var productIndex = findProductInCart(productId, cart);

        if (productIndex !== -1) {
            // Nếu sản phẩm có trong giỏ hàng, xóa sản phẩm đó khỏi giỏ hàng
            cart.splice(productIndex, 1);

            // Lưu giỏ hàng mới vào Cookie
            setCartToCookie(cart);

            // Hiển thị lại các sản phẩm trong giỏ hàng
            showCartItems();
        }
    }

    // Hiển thị các sản phẩm trong giỏ hàng khi trang web được tải lên
    showCartItems();

</script>