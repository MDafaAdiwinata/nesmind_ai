<?php
session_start();
include 'config/koneksi.php';

$alert = "";

if (isset($_POST['daftar'])) {
    // Ambil dan sanitasi input
    $username = trim(htmlspecialchars($_POST['username']));
    $email    = trim(htmlspecialchars($_POST['email']));
    $password = trim($_POST['password']);

    // Validasi input kosong
    if ($username == "" || $email == "" || $password == "") {
        $alert = generateAlert("Peringatan!", "Username, Email, Password, dan Profile tidak boleh kosong!");
    } else if (strlen($username) > 20) {
        $alert = generateAlert("Peringatan!", "Username maksimal 20 karakter!");
    } else if (strlen($email) > 100) {
        $alert = generateAlert("Peringatan!", "Email maksimal 100 karakter!");
    } else if (strlen($password) > 8) {
        $alert = generateAlert("Peringatan!", "Password maksimal 8 karakter!");
    } else {
        // Cek apakah username sudah digunakan
        $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
        if (mysqli_num_rows($cek) > 0) {
            $alert = generateAlert("Peringatan!", "Username sudah ada, silakan gunakan yang lain!");
        } else {
            // Validasi dan upload gambar
            $gambar         = $_FILES['profile']['name'];
            $tmp            = $_FILES['profile']['tmp_name'];
            $ukuran_gambar  = $_FILES['profile']['size'];
            $ext            = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
            $tipe_valid     = ['jpg', 'jpeg', 'png'];

            if (!in_array($ext, $tipe_valid)) {
                echo "<script>alert('File harus berupa JPG, JPEG, atau PNG');</script>";
                exit;
            }

            if ($ukuran_gambar > 2 * 1024 * 1024) {
                echo "<script>alert('Ukuran file maks 2MB');</script>";
                exit;
            }

            $nama_gambar_baru = uniqid() . '.' . $ext;
            move_uploaded_file($tmp, "assets/img/" . $nama_gambar_baru);

            // Simpan ke database
            $enkripPassword = password_hash($password, PASSWORD_DEFAULT);
            $insert = mysqli_query($koneksi, "INSERT INTO user (username, email, password, profile) VALUES ('$username', '$email', '$enkripPassword', '$nama_gambar_baru')");

            if ($insert) {
                echo '<script>alert("Daftar berhasil, silakan login!"); window.location.href = "form-login.php";</script>';
                exit;
            } else {
                $alert = generateAlert("Peringatan!", "Terjadi kesalahan saat mendaftar, silakan coba lagi.");
            }
        }
    }
}

// Fungsi reusable untuk membuat alert
function generateAlert($judul, $pesan)
{
    return '
    <div class="flex items-center p-4 mb-4 text-sm text-[var(--color-txt-primary)] rounded-lg bg-[var(--color-bg-secondary)]" role="alert">
        <svg class="shrink-0 inline w-4 h-4 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <div>
            <span class="font-medium">' . $judul . '<br/></span>' . $pesan . '
        </div>
    </div>';
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NesMind Ai - Daftar Form</title>

    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <link href="./output.css" rel="stylesheet" />

    <!-- Website NesMind Ai icon -->
    <link rel="shortcut icon" href="assets/img/logo-nesmind-ai.svg" type="image/x-icon" />

    <!-- Google Fonts: Geist -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="bg-[var(--color-bg-primary)] font-[geist]">

    <!-- Navbar -->

    <nav
        class="z-50 bg-[var(--color-bg-navbar)] backdrop-blur-xs border-b border-[var(--color-txt-primary2)] fixed w-full start-0 end-0 top-0">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <!-- Logo -->
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="assets/img/logo-nesmind-ai.svg" class="h-8" alt="NesMind Ai Logo" />
                <img src="assets/img/logo-nesmind-ai-text.png" class="max-[430px]:hidden h-4"
                    alt="NesMind Ai Logo" />
            </a>

            <!-- Tombol DAFTAR & MASUK (DESKTOP) -->
            <div class="hidden md:flex md:order-2 space-x-3 rtl:space-x-reverse">
                <a href="index.php"
                    class="text-[var(--color-txt-primary)] focus:ring-4 ring ring-[var(--color-txt-secondary)] font-medium rounded-md text-sm px-4 py-2 text-center dark:bg-transparent dark:hover:text-[var(--color-bg-primary)] dark:hover:bg-[var(--color-txt-primary)] hover:cursor-pointer transition">
                    Kembali
                </a>
            </div>

            <!-- HAMBURGER MENU (MOBILE) -->
            <button data-collapse-toggle="navbar-cta" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-cta" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>

            <!-- NAVIGATION LINKS + TOMBOL DAFTAR/MASUK (MOBILE) -->
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
                <ul
                    class="text-lg flex flex-col font-light p-4 md:p-0 mt-4 md:bg-transparent border border-[var(--color-border-navbar-mobile)] bg-[var(--color-bg-secondary)] rounded-lg md:space-x-10 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                    <!-- TOMBOL DAFTAR & MASUK (MOBILE SAJA) -->
                    <li class="block md:hidden space-y-3">
                        <a href="index.php"
                            class="block w-full text-[var(--color-txt-primary)] focus:ring-4 ring ring-[var(--color-txt-secondary)] font-medium rounded-md text-sm px-4 py-2 text-center dark:bg-transparent dark:hover:text-[var(--color-bg-primary)] dark:hover:bg-[var(--color-txt-primary)] hover:cursor-pointer transition">
                            Kembali
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Navbar End -->

    <!-- Form Section -->

    <section class="h-screen flex items-center justify-center flex-col" id="form-login">
        <div class="container mx-auto px-4">
            <h1 class="text-center mt-12 mb-8 text-4xl font-extrabold lg:text-5xl text-[var(--color-txt-primary)]">
                Buat Akun Baru
            </h1>
            <form class="max-w-md mx-auto" action="" method="POST" enctype="multipart/form-data">
                <?php if ($alert != "") echo $alert; ?>
                <div class="mb-5">
                    <label for="username"
                        class="block mb-2 text-md md:text-lg font-medium text-[var(--color-txt-primary)]">Username:</label>
                    <input type="username" id="username" name="username"
                        class="border border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary2)] text-md rounded-lg focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)] block w-full p-2.5" />
                </div>
                <div class="mb-5">
                    <label for="email"
                        class="block mb-2 text-md md:text-lg font-medium text-[var(--color-txt-primary)]">Email:</label>
                    <input type="email" id="email" name="email"
                        class="bg-transparent border border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary2)] text-md rounded-lg focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)] block w-full p-2.5" />
                </div>
                <div class="mb-5">
                    <label for="password"
                        class="block mb-2 text-md md:text-lg font-medium text-[var(--color-txt-primary)]">Password:</label>
                    <input type="password" id="password" name="password"
                        class="bg-transparent border border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary2)] text-md rounded-lg focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)] block w-full p-2.5" />
                </div>
                <div class="mb-5">
                    <label for="profile"
                        class="block mb-2 text-md md:text-lg font-medium text-[var(--color-txt-primary)]">Profile:</label>
                    <input type="file" id="profile" name="profile"
                        class="block w-full text-md text-[var(--color-txt-secondary)] border border-[var(--color-border-navbar-mobile)] rounded-lg cursor-pointer bg-transparent" />
                </div>
                <button type="submit" name="daftar"
                    class="mt-5 text-[var(--color-bg-primary)] bg-[var(--color-txt-primary)] hover:bg-[var(--color-txt-primary2)] hover:cursor-pointer focus:ring-4 focus:outline-none focus:ring-[var(--color-txt-secondary)] font-bold rounded-lg text-2xl w-full px-5 py-2.5 text-center">Daftar</button>
            </form>
            <div class="my-6 text-center">
                <span class="text-[var(--color-txt-primary)] text-md md:text-xl font-light">Sudah Punya Akun?</span> <a
                    class="text-[var(--color-txt-primary)] underline text-xl" href="form-login.php">Masuk</a>
            </div>
            
            <!-- Masuk dengan account Google - Button -->
            <!-- <hr class="border-[var(--color-txt-secondary)] max-w-md mx-auto" />
            <div class="mt-5 max-w-md mx-auto">
                <button type="button"
                    class="w-full text-[var(--color-txt-primary)] hover:bg-[var(--color-border-navbar-mobile)]/30 hover:cursor-pointer focus:ring-3 focus:outline-none focus:ring-[var(--color-txt-secondary)] border border-[var(--color-border-navbar-mobile)] font-medium rounded-xl text-md md:text-xl px-6  md:px-8 py-3.5 text-center inline-flex items-center justify-center gap-3">
                    <img src="assets/img/google-icon.png" class="me-1 md:me-2 h-5 md:h-8" alt="Google Icon">
                    Masuk dengan Google
                </button>
            </div> -->

        </div>
    </section>

    <!-- Hero Section End -->

    <!-- Footer -->

    <footer class="bg-[var(--color-bg-secondary)] rounded-lg shadow-sm m-4">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="assets/img/logo-nesmind-ai-name.png" class="" alt="Flowbite Logo" />
                </a>
                <ul
                    class="flex flex-wrap items-center mb-6 text-sm font-medium text-[var(--color-txt-secondary)] sm:mb-0">
                    <li>
                        <a href="#beranda" class="hover:underline me-4 md:me-6">Beranda</a>
                    </li>
                    <li>
                        <a href="#tentang" class="hover:underline me-4 md:me-6">Tentang</a>
                    </li>
                    <li>
                        <a href="#fitur" class="hover:underline me-4 md:me-6">Fitur</a>
                    </li>
                    <li>
                        <a href="#bantuan" class="hover:underline">Bantuan</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-[var(--color-txt-secondary)] sm:mx-auto lg:my-8" />
            <span class="block text-sm sm:text-center text-[var(--color-txt-secondary)]">© 2025 <a href="#"
                    class="hover:underline">NesMind Ai™</a>. Semua Hak Dilindungi Undang-undang.</span>
        </div>
    </footer>

    <!-- Footer End -->

    <!-- Flowbite Script -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>


</body>

</html>