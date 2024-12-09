<?php
require_once __DIR__ . '/controllers/OrderController.php';

$orderController = new OrderController();

$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$orders = $orderController->getOrders($searchTerm);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Daftar Pesanan</title>
</head>

<body class="bg-white p-6 text-gray-200">
    <div class="container mx-auto mt-8 p-6 bg-gray-100 rounded-xl shadow-lg">
        <h1 class="text-3xl font-semibold mb-6 text-cyan-400">Daftar Pesanan</h1>

        <form method="GET" action="orders.php" class="mb-6 flex">
            <input type="text" name="search" placeholder="Cari berdasarkan nama..."
                value="<?= htmlspecialchars($searchTerm); ?>"
                class="border border-cyan-500 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-white text-gray-300 placeholder-gray-400">
            <button type="submit" class="ml-2 bg-cyan-400 text-white px-4 py-2 rounded-lg hover:bg-cyan-500 transition duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">Cari</button>
        </form>

        <table class="min-w-full bg-white border-collapse rounded-lg overflow-hidden shadow-md">
            <thead>
                <tr class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white">
                    <th class="px-6 py-3 text-left">Nama Pemesan</th>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-left">Jumlah</th>
                    <th class="px-6 py-3 text-left">Address</th>
                    <th class="px-6 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr class="border-b hover:bg-gray-700 transition-all duration-200">
                            <td class="px-6 py-4 text-gray-300"><?= htmlspecialchars($order['orderer_name']); ?></td>
                            <td class="px-6 py-4 text-gray-300"><?= htmlspecialchars($order['menu_name']); ?></td>
                            <td class="px-6 py-4 text-gray-300"><?= htmlspecialchars($order['quantity']); ?></td>
                            <td class="px-6 py-4 text-gray-300"><?= htmlspecialchars($order['table_number']); ?></td>
                            <td class="px-6 py-4 text-yellow-500 font-semibold"><?= htmlspecialchars($order['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center px-6 py-4 text-gray-500">Belum ada pesanan lain</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>