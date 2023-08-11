function addProductToCart(productId) {
    // Retrieve product information
    var productName = document.getElementsByName("hidden_name")[productId - 1].value;
    var productPrice = parseFloat(document.getElementsByName("hidden_price")[productId - 1].value);
    var productQuantity = parseInt(document.getElementsByName("quantity")[productId - 1].value);
    var productImageBase64 = document.getElementsByName("hidden_image")[productId - 1].value;

    // Convert base64 image to Blob object
    var byteCharacters = atob(productImageBase64);
    var byteArrays = [];
    for (var i = 0; i < byteCharacters.length; i++) {
        byteArrays.push(byteCharacters.charCodeAt(i));
    }
    var productImage = new Blob([new Uint8Array(byteArrays)], { type: 'image/jpeg' });

    // Get cart from cookie or create a new one if it doesn't exist
    var cart = getCartFromCookie();

    // Check if the product is already in the cart
    var productIndex = findProductInCart(productId, cart);

    if (productIndex === -1) {
        // Product not found in the cart, add it as a new item
        var productTotal = productPrice * productQuantity;
        var product = {
            id: productId,
            name: productName,
            price: productPrice,
            quantity: productQuantity,
            image: productImage,
            total: productTotal
        };
        cart.push(product);
    } else {
        // Product already exists in the cart, increase the quantity
        cart[productIndex].quantity += productQuantity;
        cart[productIndex].total = cart[productIndex].price * cart[productIndex].quantity;
    }

    // Save the updated cart to the cookie
    setCartToCookie(cart);

    // Show success message and prevent form submission
    alert("Product added to cart successfully!");
    return false;
}

function getCartFromCookie() {
    var cart = [];
    var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)cart\s*\=\s*([^;]*).*$)|^.*$/, "$1");
    if (cookieValue) {
        cart = JSON.parse(decodeURIComponent(cookieValue));
    }
    return cart;
}

// function setCartToCookie(cart) {
//     var cookieValue = encodeURIComponent(JSON.stringify(cart));
//     // var expiryDate = new Date(Date.now() + 30 * 24 * 60 * 60 * 1000); // 30 days from now
//     var expiryDate = new Date(Date.now() + 3 * 60 * 1000); // 3 phút từ thời điểm hiện tại
//     document.cookie = "cart=" + cookieValue + "; expires=" + expiryDate.toUTCString() + "; path=/";
// }

function setCartToCookie(cart) {
    var cookieValue = encodeURIComponent(JSON.stringify(cart));
    var expiryDate = new Date(Date.now() + 3 * 60 * 1000); // 3 phút từ thời điểm hiện tại
    var expires = "; expires=" + expiryDate.getTime() / 1000; // Chuyển đổi thời gian hết hạn sang đơn vị giây
    document.cookie = "cart=" + cookieValue + expires + "; path=/";
}

function findProductInCart(productId, cart) {
    for (var i = 0; i < cart.length; i++) {
        if (cart[i].id === productId) {
            return i;
        }
    }
    return -1;
}
