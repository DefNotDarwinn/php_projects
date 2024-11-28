<?php
session_start();

// Initialize the cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Products list
$products = [
     ['id' => 1, 'name' => 'Spider-Man (Venom Suit)', 'price' => 20, 'image' => ['images/spiderman1.jpg', 'images/spiderman2.jpg', 'images/spiderman3.jpg'], 'details' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur auctor auctor enim, ac faucibus lorem feugiat sit amet. Cras et sollicitudin nibh. Donec vel nisl mollis, aliquam metus et, scelerisque erat. Etiam eget molestie quam. Integer felis purus, fermentum et laoreet ut, sollicitudin sit amet nibh. Nam sagittis, tellus semper commodo finibus, odio nisl imperdiet tellus, sed tempor lectus dui nec turpis. Vestibulum condimentum et sem sed facilisis. Nam ornare mi mauris, eu lacinia velit consectetur lobortis. Nullam dapibus ornare risus, sit amet eleifend tortor maximus nec. Fusce non purus aliquam nisi gravida mattis. Ut placerat eu risus vitae consectetur. Nam malesuada ipsum a augue vulputate, ut laoreet libero condimentum. Fusce felis dui, elementum at accumsan pellentesque, molestie sed nibh.'],
    ['id' => 2, 'name' => 'Monkey D. Luffy (Gear 5th)', 'price' => 25, 'image' => ['images/gear5.jpg', 'images/gear52.jpg', 'images/gear53.jpg'], 'details' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur auctor auctor enim, ac faucibus lorem feugiat sit amet. Cras et sollicitudin nibh. Donec vel nisl mollis, aliquam metus et, scelerisque erat. Etiam eget molestie quam. Integer felis purus, fermentum et laoreet ut, sollicitudin sit amet nibh. Nam sagittis, tellus semper commodo finibus, odio nisl imperdiet tellus, sed tempor lectus dui nec turpis. Vestibulum condimentum et sem sed facilisis. Nam ornare mi mauris, eu lacinia velit consectetur lobortis. Nullam dapibus ornare risus, sit amet eleifend tortor maximus nec. Fusce non purus aliquam nisi gravida mattis. Ut placerat eu risus vitae consectetur. Nam malesuada ipsum a augue vulputate, ut laoreet libero condimentum. Fusce felis dui, elementum at accumsan pellentesque, molestie sed nibh.'],
    ['id' => 3, 'name' => 'Tekken 8 Kazuya Mishima Action Figure', 'price' => 30, 'image' => ['images/jin1.jpg', 'images/jin2.jpg', 'images/jin3.jpg'], 'details' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur auctor auctor enim, ac faucibus lorem feugiat sit amet. Cras et sollicitudin nibh. Donec vel nisl mollis, aliquam metus et, scelerisque erat. Etiam eget molestie quam. Integer felis purus, fermentum et laoreet ut, sollicitudin sit amet nibh. Nam sagittis, tellus semper commodo finibus, odio nisl imperdiet tellus, sed tempor lectus dui nec turpis. Vestibulum condimentum et sem sed facilisis. Nam ornare mi mauris, eu lacinia velit consectetur lobortis. Nullam dapibus ornare risus, sit amet eleifend tortor maximus nec. Fusce non purus aliquam nisi gravida mattis. Ut placerat eu risus vitae consectetur. Nam malesuada ipsum a augue vulputate, ut laoreet libero condimentum. Fusce felis dui, elementum at accumsan pellentesque, molestie sed nibh'],
    ['id' => 4, 'name' => 'Naruto Uzumaki (Sage Mode)', 'price' => 35, 'image' => ['images/naruto1.jpg', 'images/naruto2.jpg', 'images/naruto3.jpg'], 'details' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur auctor auctor enim, ac faucibus lorem feugiat sit amet. Cras et sollicitudin nibh. Donec vel nisl mollis, aliquam metus et, scelerisque erat. Etiam eget molestie quam. Integer felis purus, fermentum et laoreet ut, sollicitudin sit amet nibh. Nam sagittis, tellus semper commodo finibus, odio nisl imperdiet tellus, sed tempor lectus dui nec turpis. Vestibulum condimentum et sem sed facilisis. Nam ornare mi mauris, eu lacinia velit consectetur lobortis. Nullam dapibus ornare risus, sit amet eleifend tortor maximus nec. Fusce non purus aliquam nisi gravida mattis. Ut placerat eu risus vitae consectetur. Nam malesuada ipsum a augue vulputate, ut laoreet libero condimentum. Fusce felis dui, elementum at accumsan pellentesque, molestie sed nibh'],
    ['id' => 5, 'name' => 'Kratos (God of War) Action Figure', 'price' => 22, 'image' => ['images/kratos1.jpg', 'images/kratos2.jpg', 'images/kratos3.jpg'], 'details' => 'A detailed action figure of Spider-Man.'],
];

// Handle adding to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $product_id) {
            $item['quantity'] += 1; // Increment quantity if product already in cart
            $found = true;
            break;
        }
    }
    if (!$found) {
        // Add new product to cart
        foreach ($products as $product) {
            if ($product['id'] === $product_id) {
                $product['quantity'] = 1; // Set initial quantity
                $_SESSION['cart'][] = $product;
                break;
            }
        }
    }
}

// Handle increment and decrement quantity
if (isset($_POST['increment'])) {
    $product_id = intval($_POST['increment']);
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $product_id) {
            $item['quantity'] += 1;
            break;
        }
    }
}

if (isset($_POST['decrement'])) {
    $product_id = intval($_POST['decrement']);
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $product_id) {
            if ($item['quantity'] > 1) {
                $item['quantity'] -= 1;
            }
            break;
        }
    }
}

// Handle removing an item
if (isset($_POST['remove_item'])) {
    $product_id = intval($_POST['remove_item']);
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] === $product_id) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the cart
            break;
        }
    }
}

// Handle clearing the cart
if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
}

// Handle checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $name = $_POST['name'] ?? '';
    $address = $_POST['address'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    if (!empty($name) && !empty($address) && !empty($mobile)) {
        $_SESSION['cart'] = []; // Clear cart after checkout
        $order_completed = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action Figure Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cart-icon {
            cursor: pointer;
        }

        .title-image {
            max-width: 300px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .cart-item img {
            width: 50px;
            margin-right: 15px;
        }

        .cart-buttons button {
            margin: 0 5px;
        }

        .product-detail img {
            max-width: 300px;
        }
    </style>
</head>
<body>
    <!-- Cart Icon -->
    <div class="cart-wrapper">
        <a href="?page=cart" class="cart-icon">
            <img src="images/cart.png" alt="Cart Icon" style="width: 40px;">
        </a>
    </div>

    <div class="container my-5">
        <?php $page = $_GET['page'] ?? 'home'; ?>
        <?php if ($page === 'home'): ?>
            <!-- Home Page -->
            <div>
                <img src="images/brand.jpg" alt="Shop Banner" class="title-image">
                <h1 class="text-center">Welcome to the Black Box</h1>
            </div>
            <div class="row mt-4">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                <p class="card-text">$<?php echo number_format($product['price'], 2); ?></p>
                                <a href="?page=product&id=<?php echo $product['id']; ?>" class="btn btn-secondary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif ($page === 'cart'): ?>
            <!-- Cart Page -->
            <h2>Your Shopping Cart</h2>
            <ul class="list-group">
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <li class="list-group-item d-flex align-items-center cart-item">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                            <div>
                                <strong><?php echo $item['name']; ?></strong>
                                <p>Price: $<?php echo number_format($item['price'], 2); ?></p>
                                <p>Quantity: <?php echo $item['quantity']; ?></p>
                            </div>
                            <div class="ms-auto cart-buttons">
                                <form method="post" class="d-inline">
                                    <button type="submit" name="increment" value="<?php echo $item['id']; ?>" class="btn btn-sm btn-success">+</button>
                                </form>
                                <form method="post" class="d-inline">
                                    <button type="submit" name="decrement" value="<?php echo $item['id']; ?>" class="btn btn-sm btn-warning">-</button>
                                </form>
                                <form method="post" class="d-inline">
                                    <button type="submit" name="remove_item" value="<?php echo $item['id']; ?>" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    <li class="list-group-item"><strong>Total:</strong> $<?php echo number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $_SESSION['cart'])), 2); ?></li>
                <?php else: ?>
                    <li class="list-group-item">Your cart is empty.</li>
                <?php endif; ?>
            </ul>
            <a href="?page=checkout" class="btn btn-success mt-3">Checkout</a>
            <a href="?page=home" class="btn btn-secondary mt-3">Back to Shop</a>
        <?php elseif ($page === 'checkout'): ?>
            <!-- Checkout Page -->
            <?php if (isset($order_completed)): ?>
                <h3>Order Completed</h3>
                <a href="?page=home" class="btn btn-primary mt-3">Back to Shop</a>
            <?php else: ?>
                <h2>Checkout</h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Detailed Address</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" required>
                    </div>
                    <button type="submit" name="checkout" class="btn btn-success">Complete Order</button>
                </form>
            <?php endif; ?>
        <?php elseif ($page === 'product' && isset($_GET['id'])): ?>
            <!-- Product Details Page -->
            <?php 
            $product_id = intval($_GET['id']);
            $product = array_filter($products, fn($p) => $p['id'] === $product_id)[0] ?? null;
            ?>
            <?php if ($product): ?>
                <div class="product-detail">
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h2><?php echo $product['name']; ?></h2>
                    <p><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
                    <p><?php echo $product['details']; ?></p>
                    <form method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button class="btn btn-primary">Add to Cart</button>
                    </form>
                    <a href="?page=home" class="btn btn-secondary mt-3">Back to Shop</a>
                </div>
            <?php else: ?>
                <p>Product not found.</p>
                <a href="?page=home" class="btn btn-secondary">Back to Shop</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
