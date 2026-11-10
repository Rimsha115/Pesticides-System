
<?php

require_once __DIR__ . "/../config/database.php";


// =====================================
// 1. DATABASE SCHEMA
// =====================================

$schema = [

    // USERS
    "users" => [
        "columns" => [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "name" => "VARCHAR(100) NOT NULL",
            "email" => "VARCHAR(150) NOT NULL",
            "phone" => "VARCHAR(20) NULL",
            "password" => "VARCHAR(255) NOT NULL",
            "role" => "ENUM('admin', 'customer') DEFAULT 'customer'",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        "indexes" => [
            "UNIQUE KEY uq_users_email (email)"
        ],
        "foreign_keys" => []
    ],

    // CATEGORIES
    "categories" => [
        "columns" => [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "name" => "VARCHAR(100) NOT NULL",
            "description" => "TEXT NULL",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        "indexes" => [],
        "foreign_keys" => []
    ],

    // PRODUCTS
    "products" => [
        "columns" => [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "category_id" => "INT NOT NULL",
            "name" => "VARCHAR(150) NOT NULL",
            "slug" => "VARCHAR(180) NULL",
            "description" => "TEXT NULL",
            "price" => "DECIMAL(10,2) NOT NULL",
            "stock_quantity" => "INT DEFAULT 0",
            "batch_number" => "VARCHAR(100) NULL",
            "expiry_date" => "DATE NULL",
            "usage_instructions" => "TEXT NULL",
            "safety_warnings" => "TEXT NULL",
            "image" => "VARCHAR(255) NULL",
            "status" => "ENUM('active', 'inactive') DEFAULT 'active'",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            "updated_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"
        ],
        "indexes" => [
            "UNIQUE KEY uq_products_slug (slug)"
        ],
        "foreign_keys" => [
            "CONSTRAINT fk_products_category FOREIGN KEY (category_id) REFERENCES categories(id)"
        ]
    ],

    // CARTS
    "carts" => [
        "columns" => [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "user_id" => "INT NOT NULL",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        "indexes" => [
            "UNIQUE KEY uq_carts_user (user_id)"
        ],
        "foreign_keys" => [
            "CONSTRAINT fk_carts_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE"
        ]
    ],

    // CART ITEMS
    "cart_items" => [
        "columns" => [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "cart_id" => "INT NOT NULL",
            "product_id" => "INT NOT NULL",
            "quantity" => "INT NOT NULL DEFAULT 1",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        "indexes" => [
            "UNIQUE KEY uq_cart_product (cart_id, product_id)"
        ],
        "foreign_keys" => [
            "CONSTRAINT fk_cart_items_cart FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE",
            "CONSTRAINT fk_cart_items_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE"
        ]
    ],

    // ORDERS
    "orders" => [
        "columns" => [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "user_id" => "INT NOT NULL",
            "total_amount" => "DECIMAL(10,2) NOT NULL",
            "shipping_name" => "VARCHAR(100) NOT NULL",
            "shipping_phone" => "VARCHAR(20) NOT NULL",
            "shipping_address" => "TEXT NOT NULL",
            "shipping_city" => "VARCHAR(100) NOT NULL",
            "status" => "ENUM('pending','confirmed','processing','shipped','delivered','cancelled') DEFAULT 'pending'",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            "updated_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"
        ],
        "indexes" => [],
        "foreign_keys" => [
            "CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES users(id)"
        ]
    ],

    // ORDER ITEMS
    "order_items" => [
        "columns" => [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "order_id" => "INT NOT NULL",
            "product_id" => "INT NULL",
            "product_name" => "VARCHAR(150) NOT NULL",
            "unit_price" => "DECIMAL(10,2) NOT NULL",
            "quantity" => "INT NOT NULL",
            "subtotal" => "DECIMAL(10,2) NOT NULL"
        ],
        "indexes" => [],
        "foreign_keys" => [
            "CONSTRAINT fk_order_items_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE",
            "CONSTRAINT fk_order_items_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL"
        ]
    ],

    // PAYMENTS
    "payments" => [
        "columns" => [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "order_id" => "INT NOT NULL",
            "amount" => "DECIMAL(10,2) NOT NULL",
            "payment_method" => "VARCHAR(50) NOT NULL",
            "transaction_reference" => "VARCHAR(150) NULL",
            "payment_status" => "ENUM('pending','completed','failed','refunded') DEFAULT 'pending'",
            "paid_at" => "TIMESTAMP NULL",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        "indexes" => [],
        "foreign_keys" => [
            "CONSTRAINT fk_payments_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE"
        ]
    ],

    // PRODUCT RETURNS
    "product_returns" => [
        "columns" => [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "order_id" => "INT NOT NULL",
            "order_item_id" => "INT NOT NULL",
            "quantity" => "INT NOT NULL",
            "reason" => "TEXT NOT NULL",
            "status" => "ENUM('requested','approved','rejected','completed') DEFAULT 'requested'",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        "indexes" => [],
        "foreign_keys" => [
            "CONSTRAINT fk_returns_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE",
            "CONSTRAINT fk_returns_order_item FOREIGN KEY (order_item_id) REFERENCES order_items(id)"
        ]
    ],

    // STOCK MOVEMENTS
    "stock_movements" => [
        "columns" => [
            "id" => "INT AUTO_INCREMENT PRIMARY KEY",
            "product_id" => "INT NOT NULL",
            "user_id" => "INT NULL",
            "movement_type" => "ENUM('purchase','sale','return','adjustment') NOT NULL",
            "quantity" => "INT NOT NULL",
            "reference_note" => "VARCHAR(255) NULL",
            "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ],
        "indexes" => [],
        "foreign_keys" => [
            "CONSTRAINT fk_stock_product FOREIGN KEY (product_id) REFERENCES products(id)",
            "CONSTRAINT fk_stock_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL"
        ]
    ]

];


// =====================================
// 2. REUSABLE COLUMN CHECK FUNCTION
// =====================================

function columnExists($conn, $table, $column) {

    $result = mysqli_query(
        $conn,
        "SHOW COLUMNS FROM `$table` LIKE '$column'"
    );

    if (!$result) {
        die("Column Check Error: " . mysqli_error($conn));
    }

    return mysqli_num_rows($result) > 0;
}


// =====================================
// 3. REUSABLE TABLE SYNC FUNCTION
// =====================================

function syncTable($conn, $table, $definition) {

    // Create table if it does not exist

    $check = mysqli_query(
        $conn,
        "SHOW TABLES LIKE '$table'"
    );

    if (!$check) {
        die("Table Check Error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($check) == 0) {

        $parts = [];

        foreach ($definition["columns"] as $column => $type) {
            $parts[] = "`$column` $type";
        }

        foreach ($definition["indexes"] as $index) {
            $parts[] = $index;
        }

        foreach ($definition["foreign_keys"] as $foreignKey) {
            $parts[] = $foreignKey;
        }

        $sql = "CREATE TABLE `$table` (
            " . implode(", ", $parts) . "
        ) ENGINE=InnoDB";

        if (!mysqli_query($conn, $sql)) {
            die("Table Creation Error ($table): " . mysqli_error($conn));
        }

        echo "$table table created!<br>";

    } else {

        echo "$table table already exists!<br>";
    }


    // Check and add missing columns

    foreach ($definition["columns"] as $column => $type) {

        if (!columnExists($conn, $table, $column)) {

            $sql = "ALTER TABLE `$table`
                    ADD COLUMN `$column` $type";

            if (!mysqli_query($conn, $sql)) {
                die("Column Error ($table.$column): " . mysqli_error($conn));
            }

            echo "$table.$column column added!<br>";
        }
    }


    // Check and add missing indexes

    foreach ($definition["indexes"] as $index) {

        preg_match('/(?:KEY|INDEX)\s+`?(\w+)`?/i', $index, $matches);

        $indexName = $matches[1];

        $indexCheck = mysqli_query(
            $conn,
            "SHOW INDEX FROM `$table` WHERE Key_name = '$indexName'"
        );

        if (!$indexCheck) {
            die("Index Check Error: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($indexCheck) == 0) {

            if (!mysqli_query(
                $conn,
                "ALTER TABLE `$table` ADD $index"
            )) {
                die("Index Error ($table): " . mysqli_error($conn));
            }

            echo "$table.$indexName index added!<br>";
        }
    }


    // Check and add missing foreign keys

    foreach ($definition["foreign_keys"] as $foreignKey) {

        preg_match(
            '/CONSTRAINT\s+`?(\w+)`?/i',
            $foreignKey,
            $matches
        );

        $constraintName = $matches[1];

        $fkCheck = mysqli_query(
            $conn,
            "SELECT CONSTRAINT_NAME
             FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
             WHERE TABLE_SCHEMA = DATABASE()
             AND TABLE_NAME = '$table'
             AND CONSTRAINT_NAME = '$constraintName'
             AND CONSTRAINT_TYPE = 'FOREIGN KEY'"
        );

        if (!$fkCheck) {
            die("Foreign Key Check Error: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($fkCheck) == 0) {

            if (!mysqli_query(
                $conn,
                "ALTER TABLE `$table` ADD $foreignKey"
            )) {
                die("Foreign Key Error ($table): " . mysqli_error($conn));
            }

            echo "$table.$constraintName foreign key added!<br>";
        }
    }

    echo "<hr>";
}


// =====================================
// 4. RUN DATABASE SYNCHRONIZATION
// =====================================

foreach ($schema as $table => $definition) {

    syncTable($conn, $table, $definition);

}

echo "<h3>All 10 tables checked successfully!</h3>";

?>
