<?php
include "navbarr.php";
?>
<form action="http://localhost/DOanphpMYSQL_2023/admin/core/xulyadd_cthd.php" method="POST">
    <div id="cart" style="padding: 20px 100px;">
        <div class="row">
            <div class="col-md-6 form">
                <?php
                if (isset($_SESSION['username'], $_SESSION['user_id'], $_SESSION['DiaChi'], $_SESSION['SoDienThoai'],$_SESSION['id'], $_SESSION['Email'])) {
                    $user_id = $_SESSION['user_id'];
                    $dia_chi = $_SESSION['DiaChi'];
                    $so_dien_thoai = $_SESSION['SoDienThoai'];
                    $id = $_SESSION['id'];
                    $email = $_SESSION['Email'];
                    ?>
                    <div class="mb-3">
                        <input type="hidden" value="<?php echo $id; ?>" class="form-control" id="ten_khachhang"
                            name="makh">
                        <label for="ten_khachhang" class="form-label">Tên khách hàng:</label>
                        <input type="text" value="<?php echo $user_id; ?>" class="form-control" id="ten_khachhang"
                            name="ten_khachhang">
                    </div>
                    <div class="mb-3">
                        <label for="DiaChi" class="form-label">Địa chỉ:</label>
                        <input type="text" value="<?php echo $dia_chi; ?>" class="form-control" id="DiaChi" name="DiaChi">
                    </div>
                    <div class="mb-3">
                        <label for="SoDienThoai" class="form-label">Số điện thoại:</label>
                        <input type="text" value="<?php echo $so_dien_thoai; ?>" class="form-control" id="SoDienThoai"
                            name="SoDienThoai">
                    </div>
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email:</label>
                        <input type="text" value="<?php echo $email; ?>" class="form-control" id="Email" name="Email">
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        
                    </tbody>
                </table>
                <div class="card">
                    <div class="card-body">
                        <div class="cart">
                            <h5 class="card-title">Tổng cộng</h5>
                            <p class="card-text" id="cart-total" name="cart_total"></p>
                            <input class="card-text" type="hidden" id="cart-total-input" name="cart_total_input"
                                readonly>
                            <span id="cart-total-text"></span>
                        </div>
                        <input type="submit" name="add_to_database" class="btn btn-success" value="Đặt hàng" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
include "footer.php";
?>
<style>
    #cart-total-input {
        border: 1px solid #f8f9fa;
        border-radius: 5px;
        padding: 5px;
        font-size: 16px;
        width: 100px;
        background: #f8f9fa;
        margin-left: 50px;
    }

    #cart-total-text {
        font-size: 16px;
        font-weight: bold;
    }

    th {
        border-top: 1px solid #ccc;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }

    th:last-child {
        border-right: none;
    }

    td {
        border-top: 1px solid #ccc;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
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

    .form {
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
</style>

<script src="http://localhost/DOANPHPMYSQL_2023/admin/assets/js/cart.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
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

        // Thêm các sản phẩm vào giỏ hàng
        var j = 0;
        for (var i = 0; i < cart.length; i++) {
            var productId = cart[i].id;
            var productName = cart[i].name;
            var productPrice = cart[i].price;
            var productQuantity = cart[i].quantity;
            var productImage = cart[i].image;

            // Calculate product total
            var productTotal = productPrice * productQuantity;

            // Set the 'total' key in the cart item
            cart[i].total = productTotal;

            // Accumulate cart total
            cartTotal += productTotal;


            var tr = document.createElement("tr");
            
            // Tạo phần tử <td> cho số thứ tự
            var stt = document.createElement("td");
            stt.textContent = ++j; // Tăng giá trị của biến đếm và gán nó vào phần tử <td>
            tr.appendChild(stt);

            var tdName = document.createElement("td");
            tdName.textContent = productName;
            tr.appendChild(tdName);

            var tdPrice = document.createElement("td");
            tdPrice.textContent = productPrice + "VNĐ";
            tr.appendChild(tdPrice);

            var tdQuantity = document.createElement("td");
            tdQuantity.textContent = productQuantity;
            tr.appendChild(tdQuantity);

            var tdTotal = document.createElement("td");
            tdTotal.textContent = productTotal + "VNĐ";
            tr.appendChild(tdTotal);

            cartItems.appendChild(tr);
        }

        // Hiển thị tổng tiền
        // Định dạng giá trị 'cartTotal' theo định dạng tiền tệ Việt Nam Đồng (VNĐ)
        var formattedCartTotal = cartTotal.toLocaleString("vi-VN");

        // Gán giá trị đã định dạng vào phần tử hiển thị và phần tử input
        var cartTotalElement = document.getElementById("cart-total");
        var cartTotalInput = document.getElementById("cart-total-input");

        cartTotalElement.textContent = formattedCartTotal + " VNĐ";
        cartTotalInput.value = cartTotal; // Gửi giá trị chưa định dạng (không có dấu phân cách hàng nghìn) trong input.


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

            // cart[index].productTotal = cart[index].price * cart[index].quantity;

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