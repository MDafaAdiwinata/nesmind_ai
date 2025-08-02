<?php

session_start();
include '../config/koneksi.php';
if ( !isset($_SESSION['username']) )
{
    echo "
    <script>
        alert('Silahkan Login Terlebih Dahulu!');
        window.location.href = '../form-login.php';
    </script>
    ";
}

$alert = "";

$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$ambildata = mysqli_query($koneksi, $sql);
$tampildata = mysqli_fetch_assoc($ambildata);

function generateAlert($judul, $pesan)
{
  return '
  <div id="alert-5" class="flex items-center p-4 rounded-lg bg-[var(--color-bg-secondary)]" role="alert">
    <svg class="shrink-0 w-4 h-4 ms-3 me-5 dark:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
      </svg>
    <span class="sr-only">Info</span>
    <div class="text-white">
      <span class="">' . $judul . '<br/></span>' . $pesan . '
    </div>
    <button type="button" class="ms-auto mx-2.5 -my-1.5 bg-[var(--color-chat-ai)] text-[var(--color-txt-primary2)] rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:bg-[var(--color-chat-user)] cursor-pointer inline-flex items-center justify-center h-10 w-10" data-dismiss-target="#alert-5" aria-label="Close">
      <span class="sr-only">Dismiss</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
  </div>
';
}

// Proses Update Data Tentang Kami
if (isset($_POST['ubah'])) {
    $id = $_POST['id_user'];
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $gambar_lama = $_POST['profile_lama'];
    $nama_gambar_baru = $gambar_lama;

    // Cek apakah ada gambar baru yang diunggah
    if (isset($_FILES['profile_lama']) && $_FILES['profile_lama']['error'] == 0) {
        $gambar = $_FILES['profile_lama']['name'];
        $tmp = $_FILES['profile_lama']['tmp_name'];
        $ukuran_gambar = $_FILES['profile_lama']['size'];
        $ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
        $tipe_valid = ['jpg', 'jpeg', 'png'];
        $upload_dir = "../assets/img/";

        if (!in_array($ext, $tipe_valid)) {
          $alert = generateAlert("Peringatan!", "Format gambar tidak valid! (jpg/jpeg/png/webp)");
          return;
        }

        if ($ukuran_gambar > 2 * 1024 * 1024) { // Maks 2MB
          $alert = generateAlert("Peringatan!", "Ukuran gambar terlalu besar! Maks. 2MB");
          return;
        }
        
        // Buat nama unik dan pindahkan file
        $nama_gambar_baru = uniqid() . '.' . $ext;
        
        // Hapus gambar lama jika ada
        if (!empty($gambar_lama) && file_exists($upload_dir . $gambar_lama)) {
            unlink($upload_dir . $gambar_lama);
        }

        move_uploaded_file($tmp, $upload_dir . $nama_gambar_baru);
    }

    // Query untuk update data
    $query = "UPDATE user SET 
              username = '$username', 
              email = '$email', 
              profile = '$nama_gambar_baru' 
              WHERE id_user = '$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
    $alert = generateAlert("Info", "Profil berhasil diubah!") . '
    <script>
      setTimeout(function() {
        window.location.href = window.location.pathname; // refresh ke halaman yang sama, tapi bersih
      }, 3000);
    </script>';
    } else {
      $alert = generateAlert("Peringatan!", "Gagal memperbarui data!");
    }
}

?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NesMind Ai - Profile</title>

  <!-- Flowbite CSS -->
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

  <!-- Tailwind CSS -->
  <link href="../output.css" rel="stylesheet" />

  <!-- Website NesMind Ai icon -->
  <link rel="shortcut icon" href="../assets/img/logo-nesmind-ai.svg" type="image/x-icon" />

  <!-- Google Fonts: Geist -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="bg-[var(--color-bg-primary)] font-[geist]">

  <!-- Navbar -->

  <nav
    class="fixed top-0 z-50 w-full bg-[var(--color-bg-secondary)] border-b border-[var(--color-border-navbar-mobile)]">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
          <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
            type="button"
            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
              </path>
            </svg>
          </button>
          <a href="#" class="flex ms-4 md:me-24">
            <img src="../assets/img/logo-nesmind-ai.svg" class="h-8 me-3" alt="NesMind AI Logo" />
            <span
              class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-[var(--color-txt-primary)]">NesMind
              Ai</span>
          </a>
        </div>
        <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button"
                class="flex text-sm rounded-full focus:ring-3 focus:ring-[var(--color-txt-secondary)] hover:cursor-pointer"
                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="../assets/img/<?= $tampildata['profile']; ?>"
                  alt="user photo">
              </button>
            </div>
            <div
              class="z-50 hidden my-4 text-base list-none divide-y rounded-sm shadow-sm bg-[var(--color-bg-secondary)] divide-[var(--color-txt-secondary)]"
              id="dropdown-user">
              <div class="px-4 py-3" role="none">
                <p class="text-sm text-[var(--color-txt-primary2)]" role="none">
                  <?= $tampildata['username']; ?>
                </p>
                <p class="text-sm font-medium text-[var(--color-txt-primary2)]" role="none">
                  <?= $tampildata['email']; ?>
                </p>
              </div>
              <ul class="py-1" role="none">
                <li>
                  <a href="bantuan.php"
                    class="block px-4 py-2 text-sm text-[var(--color-txt-primary2)] hover:bg-gray-800"
                    role="menuitem">Edit Profil</a>
                </li>
                <li>
                  <a href="bantuan.php"
                    class="block px-4 py-2 text-sm text-[var(--color-txt-primary2)] hover:bg-gray-800"
                    role="menuitem">Bantuan</a>
                </li>
                <li>
                  <button data-modal-target="logout-modal" data-modal-toggle="logout-modal"
                    class="w-full text-start block px-4 py-2 text-sm text-[var(--color-txt-primary2)] hover:bg-gray-800 hover:cursor-pointer"
                    type="button">
                    Keluar
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main modal -->
  <div id="logout-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-[var(--color-chat-ai)] rounded-lg shadow-sm">
        <!-- Modal header -->
        <div
          class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-[var(--border-navbar-mobile)]">
          <h3 class="text-xl font-semibold text-[var(--color-txt-primary)]">
            Peringatan
          </h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-700 hover:cursor-pointer rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
            data-modal-hide="logout-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 md:p-5 space-y-2">
          <p
            class="font-bold text-center text-md sm:text-xl md:text-2xl leading-relaxed text-[var(--color-txt-primary)]">
            Anda Yakin Ingin Keluar?
          </p>
          <p class="text-lg leading-relaxed text-[var(--color-txt-primary2)] text-center">
            Keluar dari NesMind Ai sebagai <span class="font  -bold">
              <?= $tampildata['username']; ?>?
            </span>
          </p>
        </div>
        <!-- Modal footer -->
        <div
          class="flex justify-center items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
          <button data-modal-hide="logout-modal" type="button"
            class="py-2.5 px-5 me-3 text-sm font-light text-[var(--color-txt-primary2)] focus:outline-none bg-[var(--color-chat-ai)] rounded-lg border border-gray-700 hover:bg-[var(--color-sidebar-hover)] focus:z-10 focus:ring-3 focus:ring-gray-100 hover:cursor-pointer">
            Batal
          </button>
          <a href="logout.php"
            class="text-[var(--color-txt-primary)] bg-red-700 hover:bg-red-900 focus:ring-3 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center">
            Keluar
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Navbar End -->

  <!-- Sidebar -->

  <aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-[var(--color-bg-secondary)] border-[var(--color-border-navbar-mobile)] sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-5 pb-4 overflow-y-auto bg-[var(--color-bg-secondary)]">
      <ul class="space-y-3 font-normal">
        <li>
          <a href="index.php"
            class="flex items-center py-2 px-4 text-[var(--color-txt-primary2)] rounded-lg hover:bg-[var(--color-sidebar-hover)] group">
            <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
              <path
                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Mulai Chat!</span>
            <span
              class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Free!</span>
          </a>
        </li>
        <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
        <li>
          <button type="button" disabled
            class="flex items-center w-full py-2 px-4 text-base text-[var(--color-txt-secondary)] transition duration-75 rounded-lg group hover:bg-[var(--color-sidebar-hover)] cursor-not-allowed"
            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
            <svg
              class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
              <path
                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
            </svg>
            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Riwayat Chat</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
            </svg>
          </button>
          <ul id="dropdown-example" class="hidden py-2 space-y-2">
            <li>
              <a href="#"
                class="flex items-center w-full py-2 px-4 text-base text-[var(--color-txt-primary2)] transition duration-75 rounded-lg pl-11 group hover:bg-[var(--color-sidebar-hover)] hover:cursor-pointer">Chat Histori</a>
            </li>
          </ul>
        </li>
        <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
        <li>
          <a href="bantuan.php"
            class="flex items-center py-2 px-4 text-[var(--color-txt-primary2)] rounded-lg hover:bg-[var(--color-sidebar-hover)] group">
            <svg
              class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Bantuan</span>
          </a>
        </li>
        <li>
          <a href="#"
            class="flex items-center py-2 px-4 text-[var(--color-txt-primary2)] rounded-lg hover:bg-[var(--color-sidebar-hover)] group">
            <svg
              class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
            </svg>
            <span data-modal-target="logout-modal" data-modal-toggle="logout-modal"
              class="flex-1 ms-3 whitespace-nowrap">Keluar</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <!-- Sidebar End -->

  <!-- Main Content -->

  <div class="sm:ml-64 ">
    <div class="mt-15 rounded-lg bg-[var(--color-bg-primary)] px-5 py-8 md:px-10 md:py-10">
      <h1 class="text-xl md:text-xl lg:text-3xl text-center font-bold text-[var(--color-txt-primary)]">Profil
      </h1>
      <p
        class="font-light text-center text-[var(--color-txt-secondary)] mt-1 mb-5 text-md md:text-xl w-full xl:w-1/3 mx-auto">
        Buat profilmu tampil <br>lebih keren dan personal!
      </p>
      <?php if ($alert != "") echo $alert; ?>
      <div
        class="grid grid-cols-1 lg:grid-cols-2 gap-6 mx-0 border border-[var(--color-border-navbar-mobile)] bg-[rgba(255,255,255,0.06)] hover:cursor-pointer hover:bg-[rgba(255,255,255,0.01)] transition p-4 md:px-8 md:py-10 mt-5 rounded-3xl">
        <div class="mx-auto">
            <img src="../assets/img/<?= $tampildata['profile']; ?>"
              class="ms-0 h-30 sm:h-35 lg:h-60 xl:h-80 rounded-full md:w-auto" alt="Image Features">
          </div>
        <div class="text-center lg:text-start">
          <h1 class="text-[var(--color-txt-primary)] text-md md:text-xl xl:text-3xl font-bold">Bio saya</h1>
          <h2 class="text-[var(--color-txt-primary)] text-md md:text-lg xl:text-xl mt-8 mb-2">
            Nama: <span class="font-bold">
              <?= $tampildata['username']; ?>
            </span>
          </h2>
          <p class="text-md md:text-lg xl:text-xl text-[var(--color-txt-primary2)]">
            Email: <span class="font-bold">
              <?= $tampildata['email']; ?>
            </span>
          </p>
        </div>
        <button data-modal-target="gambar-modal" data-modal-toggle="gambar-modal"
          class="text-md lg:text-lg text-[var(--color-txt-primary)] font-light hover:cursor-pointer hover:underline mt-8"
          type="button">
          Ubah Profile
        </button>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="gambar-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-[var(--color-bg-secondary)] rounded-lg shadow-sm">
        <!-- Modal header -->
        <div
          class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-[var(--color-border-navbar-mobile)]">
          <h3 class="text-xl font-semibold text-[var(--color-txt-primary)]">
            Ubah Profil
          </h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 cursor-pointer hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="gambar-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <form class="w-full px-2 md:px-8 mb-5 flex flex-col items-center justify-center" action="" method="POST"
          enctype="multipart/form-data">
          <input type="hidden" name="id_user" value="<?= $tampildata['id_user']; ?>">
          <input type="hidden" name="profile_lama" value="<?= $tampildata['profile']; ?>">
          <div class="my-5 w-full">
            <input type="file" id="profile" name="profile_lama"
              class="block w-full text-md text-[var(--color-txt-secondary)] border border-[var(--color-border-navbar-mobile)] rounded-lg cursor-pointer bg-transparent" />
            <small class="text-[var(--color-txt-secondary)]">Gambar saat ini:
              <?= $tampildata['profile']; ?>
            </small>
            <?php if (!empty($tampildata['profile']) && file_exists("../assets/img/".$tampildata['profile'])): ?>
            <img src="../assets/img/<?=$tampildata['profile']; ?>" alt="Preview Gambar" width="300" class="mt-2 block">
            <?php endif; ?>
          </div>
            <div class="mb-5 w-full">
              <label for="username" class="block mb-2 text-md font-medium text-[var(--color-txt-primary)]">
                Username:
              </label>
              <input type="text" id="username" name="username" value="<?= $tampildata['username']; ?>"
                class="bg-transparent w-full p-2.5 text-md rounded-lg border border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary2)] focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)]" />
            </div>
            <div class="mb-5 w-full">
              <label for="email" class="block mb-2 text-md font-medium text-[var(--color-txt-primary)]">
                email:
              </label>
              <input type="email" id="email" name="email" value="<?= $tampildata['email']; ?>"
                class="bg-transparent w-full p-2.5 text-md rounded-lg border border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary2)] focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)]" />
            </div>
          </div>
          <!-- Modal footer -->
          <div
            class="flex items-center justify-center p-4 md:p-5 border-t border-[var(--color-border-navbar-mobile)] rounded-b">
            <button data-modal-hide="gambar-modal" type="button"
              class="py-2.5 px-5 cursor-pointer me-3 text-sm font-medium text-[var(--color-txt-primary)] focus:outline-none bg-transparent rounded-lg border border-gray-600 hover:bg-gray-800 focus:z-10 focus:ring-3 focus:ring-[var(--color-txt-secondary)]">Batal</button>
            <button data-modal-hide="gambar-modal" type="submit" name="ubah"
              class="py-2.5 px-5 cursor-pointer me-3 text-sm font-medium text-[var(--color-txt-primary)] focus:outline-none bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:z-10 focus:ring-3 focus:ring-[var(--color-txt-secondary)]">
              Ubah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Main Content End -->

  <!-- Flowbite Script -->
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>

</html>