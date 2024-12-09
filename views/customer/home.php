<?php
session_start();

if (!isset($_SESSION['user'])) {
  header("Location: ../../index.php");
  exit();
}

$user = $_SESSION['user'];

require_once __DIR__ . '/../../controllers/MenuController.php';
$menuController = new MenuController();
$menus = $menuController->getMenus();
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible=" IE="edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <title>Indonesian Charcoal</title>
</head>

<body class="bg-gray-200 text-white font-poppins">
  <nav class="fixed top-0 left-0 right-0 z-50 bg-white py-4 px-6 flex justify-between items-center border-b border-gray-700">
    <a href="../../controllers/LogoutController.php" class="text-2xl font-bold italic text-black">Indonesian<span class="text-cyan-500"> Charcoal</span></a>
    <div class="flex space-x-4 items-center">
      <span class="text-black hidden md:block"><?= htmlspecialchars($user['name']); ?></span>
      <a href="#" id="modal-button" class="text-black hover:text-cyan-500"><i data-feather="user"></i></a>
      <a href="#" id="menu-button" class="md:hidden hover:text-cyan-500"><i data-feather="menu"></i></a>
      <a href="#" id="close-button" class="hidden md:hidden hover:text-cyan-500"><i data-feather="x"></i></a>
    </div>
  </nav>

  <div id="menu-modal" class="bg-black bg-opacity-50 absolute top-14 right-4 z-50 hidden">
    <div class="bg-white/60 backdrop-blur-lg py-4 rounded-lg shadow-lg w-48">
      <ul>
        <a href="../profile.php" class="text-gray-700 hover:bg-gray-100 py-2 px-4 block w-full">Profile</a>
        <a href="../settings.php" class="text-gray-700 hover:bg-gray-100 py-2 px-4 block w-full">Settings</a>
        <a href="../../controllers/LogoutController.php" class="text-gray-700 hover:bg-gray-100 py-2 px-4 block w-full">Logout</a>
      </ul>
    </div>
  </div>

  <?php include __DIR__ . '/../partials/aside.php'; ?>

  <aside class="fixed top-0 h-full w-64 bg-white text-black shadow-lg z-50 md:hidden sidebar" id="sidenav">
    <nav class="flex flex-col h-full py-8">
      <a href="home.php" class="hover:bg-cyan-100 py-2 px-8">Menu</a>
      <a href="orders.php" class="hover:bg-cyan-100 py-2 px-8">Pesanan</a>
      <a href="transactions.php" class="hover:bg-cyan-100 py-2 px-8">Transaksi</a>
    </nav>
  </aside>

  <div class="absolute right-10 top-20 cursor-pointer">
    <button id="modal-button" class="flex items-center gap-2 py-2 px-4 bg-cyan-500 hover:bg-cyan-400 text-white text-sm font-medium shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-300">
      <i data-feather="shopping-cart" class="w-4 h-4"></i>
      Keranjang
    </button>
  </div>

  <?php if (isset($_SESSION['message'])): ?>
    <div class="fixed top-24 left-1/2 transform -translate-x-1/2 p-4 w-64 rounded-lg shadow-lg text-center <?= $_SESSION['message']['type'] === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
      <?= $_SESSION['message']['text']; ?>
      <?php unset($_SESSION['message']); ?>
    </div>
  <?php endif; ?>

  <section class="absolute left-8 md:left-72 top-32">
    <h3 class="text-black text-2xl font-bold mb-4">Menu</h3>
    <p class="text-black mb-6">Menu yang tersedia</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <?php foreach ($menus as $menu): ?>
        <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
          <div class="flex justify-center gap-4 mb-4">
            <a href="#" class="text-cyan-500 bg-gray-100 p-3 rounded-full hover:bg-cyan-500 hover:text-gray-100 transition duration-300 ease-in-out">
              <i data-feather="shopping-cart"></i>
            </a>
            <button id="order-button" class="bg-cyan-500 p-3 hover:bg-cyan-400 transition duration-300 ease-in-out flex items-center justify-center">Pesan Sekarang</button>
          </div>
          <img src="../../storage/images/<?= $menu['menu_image']; ?>" alt="<?= $menu['menu_name']; ?>" class="rounded-lg mb-4 w-full h-48 object-cover">
          <h3 class="text-xl font-semibold text-white"><?= $menu['menu_name']; ?></h3>
          <p class="text-black mt-2">IDR <?= $menu['price']; ?></p>
          <p class="text-gray-400 mt-2"><?= $menu['description']; ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <div id="order-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center px-12 z-50 opacity-0 pointer-events-none transition-opacity duration-500 ease-in-out">
    <form action="../../controllers/OrderController.php" method="POST" enctype="multipart/form-data" class="relative bg-white/60 backdrop-blur-lg p-6 rounded-lg shadow-lg w-full max-w-md">
      <button id="order-close" type="button" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">
        <i data-feather="x"></i>
      </button>

      <input type="hidden" value="<?= $menu['id']; ?>" name="menu_id">

      <input type="hidden" value="<?= $user['id']; ?>" name="orderer_id">

      <label for="orderer_name" class="block mt-2">Nama Kamu</label>
      <input type="text" id="orderer_name" value="<?= htmlspecialchars($user['name']); ?>" name="orderer_name" class="w-full p-2 mt-1 focus:outline-none text-gray-900" required>

      <label for="quantity" class="block mt-4">Jumlah Pesanan</label>
      <input type="text" id="quantity" name="quantity" class="w-full p-2 mt-1 focus:outline-none text-gray-900" required>

      <label for="table_number" class="block mt-4">Address</label>
      <input type="text" id="table_number" name="table_number" class="w-full p-2 mt-1 focus:outline-none text-gray-900" required>

      <button type="submit" class="mt-4 w-full py-2 bg-cyan-500 hover:bg-cyan-400 text-white font-semibold rounded-lg transition duration-300 ease-in-out">BUAT PESANAN</button>
    </form>
  </div>

  <script>
    feather.replace();

    const toggleButton = document.getElementById('menu-button');
    const sideNav = document.getElementById('sidenav');
    const closeMenu = document.getElementById("close-button");

    toggleButton.addEventListener('click', () => {
      sideNav.classList.toggle('visible');
      toggleButton.classList.toggle('hidden');
      closeMenu.classList.toggle('hidden');
    });

    closeMenu.addEventListener('click', () => {
      sideNav.classList.toggle('visible');
      toggleButton.classList.toggle('hidden');
      closeMenu.classList.toggle('hidden');
    });

    const modalButton = document.getElementById('modal-button');
    const menuModal = document.getElementById('menu-modal');

    modalButton.addEventListener('click', () => {
      menuModal.classList.toggle('hidden');
    });

    const orderButton = document.getElementById('order-button');
    const modalOrder = document.getElementById('order-modal');
    const orderClose = document.getElementById('order-close');

    orderButton.addEventListener('click', function() {
      modalOrder.classList.remove('opacity-0', 'pointer-events-none');
      modalOrder.classList.add('opacity-100', 'pointer-events-auto');
    });

    orderClose.addEventListener('click', function() {
      modalOrder.classList.remove('opacity-100', 'pointer-events-auto');
      modalOrder.classList.add('opacity-0', 'pointer-events-none');
    });
  </script>
</body>

</html>