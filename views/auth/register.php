<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Indonesian Charcoal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <?php session_start(); ?>
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-black">Indonesian <span class="text-cyan-400">Charcoal</span></h2>
            <p class="text-center text-sm text-amber-600">Daftar Buat Dapetin Promo</p>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert bg-red-500 text-white p-4 rounded mb-4">
                    <?= $_SESSION['message']['text']; ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <form action="../../controllers/RegisterController.php" method="POST" class="mt-6 space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-black-800">Nama:</label>
                    <input type="text" name="name" id="name" required
                        class="w-full px-4 py-2 mt-1 text-sm text-black bg-cyan-50 border border-cyan-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-black-800">Email:</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-4 py-2 mt-1 text-sm text-black bg-cyan-50 border border-cyan-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-black-800">Password:</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 mt-1 text-sm text-black bg-cyan-50 border border-cyan-300 rounded-md focus:ring-black-500 focus:border-black-500">
                </div>
                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-black-800">Konfirmasi Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" required
                        class="w-full px-4 py-2 mt-1 text-sm text-black bg-cyan-50 border border-cyan-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                </div>
                <button type="submit"
                    class="w-full px-4 py-2 text-sm font-semibold text-white  rounded-md bg-cyan-500 shadow-lg shadow-cyan-500/50 hover:bg-cyan-400">
                    Daftar
                </button>
            </form>
        </div>
    </div>
</body>

</html>