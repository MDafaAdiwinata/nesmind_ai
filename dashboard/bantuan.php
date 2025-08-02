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

$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$ambildata = mysqli_query($koneksi, $sql);
$tampildata = mysqli_fetch_assoc($ambildata);

?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NesMind Ai - Bantuan</title>

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
                <img class="w-8 h-8 rounded-full" src="../assets/img/<?= $tampildata['profile']; ?>" alt="user photo">
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
                  <a href="profile.php" class="block px-4 py-2 text-sm text-[var(--color-txt-primary2)] hover:bg-gray-800"
                    role="menuitem">Edit Profil</a>
                </li>
                <li>
                  <a href="bantuan.php" class="block px-4 py-2 text-sm text-[var(--color-txt-primary2)] hover:bg-gray-800"
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
            Keluar dari NesMind Ai sebagai <span class="font-bold"><?= $tampildata['username']; ?>?</span>
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
            class="flex items-center py-2 px-4 text-[var(--color-txt-primary2)] rounded-lg bg-[var(--color-sidebar-hover)] group">
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

  <div class="p-4 sm:ml-64 ">
    <div class="mt-15 rounded-lg bg-[var(--color-bg-primary)]  px-5 py-8 md:px-10 md:py-10">
      <h1 class="text-xl md:text-3xl lg:text-5xl text-center font-bold text-[var(--color-txt-primary)]">Butuh Bantuan?
      </h1>
      <p
        class="font-light text-center text-[var(--color-txt-secondary)] my-3 text-md md:text-xl w-full xl:w-1/3 mx-auto">
        Kami siap mendampingi agar kamu bisa menggunakan layanan ini dengan maksimal.
      </p>

      <div class="mt-14 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 max-[1024px]:gap-8 gap-10">
        <div
          class="mx-0 border border-[var(--color-border-navbar-mobile)] bg-[rgba(255,255,255,0.06)] hover:cursor-pointer hover:bg-[rgba(255,255,255,0.01)] transition p-4 md:px-8 md:py-6 rounded-3xl flex flex-col items-start justify-center">
          <div>
            <img src="../assets/img/get-started.svg" class="ms-0 w-3/5 md:w-auto mx-auto" alt="Image Features">
          </div>
          <h1 class="text-[var(--color-txt-primary)] text-md md:text-xl xl:text-2xl font-bold my-3 md:my-5 text-center">
            Mulai Bersama NesMind
          </h1>
          <p class="text-md md:text-xl text-[var(--color-txt-secondary)]">
            Panduan cepat untuk mulai dan pakai fitur utama.
          </p>
          <a href="#"
            class="text-md text-[var(--color-txt-primary)] font-light hover:cursor-pointer hover:underline mt-4">Baca
            Selengkapnya -></a>
        </div>
        <div
          class="mx-0 border border-[var(--color-border-navbar-mobile)] bg-[rgba(255,255,255,0.06)] hover:cursor-pointer hover:bg-[rgba(255,255,255,0.01)] transition p-4 md:px-8 md:py-6 rounded-3xl flex flex-col items-start justify-center">
          <div>
            <img src="../assets/img/security.svg" class="ms-0 w-3/5 md:w-auto mx-auto" alt="Image Features">
          </div>
          <h1 class="text-[var(--color-txt-primary)] text-md md:text-xl xl:text-2xl font-bold my-3 md:my-5 text-center">
            Privasi & Keamanan Data
          </h1>
          <p class="text-md md:text-xl text-[var(--color-txt-secondary)]">
            Cara NesMind lindungi datamu secara aman.
          </p>
          <a href="#"
            class="text-md text-[var(--color-txt-primary)] font-light hover:cursor-pointer hover:underline mt-4">Baca
            Selengkapnya -></a>
        </div>
        <div
          class="mx-0 border border-[var(--color-border-navbar-mobile)] bg-[rgba(255,255,255,0.06)] hover:cursor-pointer hover:bg-[rgba(255,255,255,0.01)] transition p-4 md:px-8 md:py-6 rounded-3xl flex flex-col items-start justify-center">
          <div>
            <img src="../assets/img/account.svg" class="ms-0 w-3/5 md:w-auto mx-auto" alt="Image Features">
          </div>
          <h1 class="text-[var(--color-txt-primary)] text-md md:text-xl xl:text-2xl font-bold my-3 md:my-5 text-center">
            Akun & Langganan
          </h1>
          <p class="text-md md:text-xl text-[var(--color-txt-secondary)]">
            Kelola akun dan atur langganan dengan mudah.
          </p>
          <a href="#"
            class="text-md text-[var(--color-txt-primary)] font-light hover:cursor-pointer hover:underline mt-4">Baca
            Selengkapnya -></a>
        </div>
      </div>

      <h1 class="text-[var(--color-txt-primary)] font-semibold text-lg md:text-2xl lg:text-3xl mt-12">
        FAQ's
      </h1>

      <div id="accordion-flush" data-accordion="collapse"
        data-active-classes="bg-[var(--color-bg-primary)] text-[var(--color-txt-primary)]"
        data-inactive-classes="text-gray-500 dark:text-gray-400">
        <h2 id="accordion-flush-heading-1">
          <button type="button"
            class="flex items-center justify-between w-full py-5 font-medium rtl:text-right border-b border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary2)] hover:cursor-pointer gap-3"
            data-accordion-target="#accordion-flush-body-1" aria-expanded="false"
            aria-controls="accordion-flush-body-1">
            <span>Apa itu NesMind Ai?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
          <div class="py-5 border-b border-[var(--color-border-navbar-mobile)]">
            <p class="mb-2 text-[var(--color-txt-secondary)]">NesMind Ai adalah platform kecerdasan buatan yang
              dirancang untuk membantu pengguna menjawab pertanyaan, menyelesaikan tugas, dan memberikan ide kreatif
              secara cepat dan akurat. Nama “NesMind” berasal dari kata “Nes” (berpikir) dan “Mind” (pikiran),
              mencerminkan teknologi yang berpikir dan berkembang seperti manusia.
            </p>
          </div>
        </div>
        <h2 id="accordion-flush-heading-2">
          <button type="button"
            class="flex items-center justify-between w-full py-5 font-medium rtl:text-right border-b border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary2)] hover:cursor-pointer gap-3"
            data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
            aria-controls="accordion-flush-body-2">
            <span>Mengapa respon NesMind Ai terkadang lama?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
          <div class="py-5 border-b border-[var(--color-border-navbar-mobile)]">
            <p class="mb-2 text-[var(--color-txt-secondary)]">Waktu respon yang lambat bisa terjadi karena beberapa
              alasan, seperti koneksi internet yang tidak stabil, antrean server pada penyedia API, atau permintaan yang
              kompleks. Kami terus berupaya meningkatkan kecepatan dan performa agar pengalaman kamu makin nyaman.
            </p>
          </div>
        </div>
        <h2 id="accordion-flush-heading-3">
          <button type="button"
            class="flex items-center justify-between w-full py-5 font-medium rtl:text-right border-b border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary2)] hover:cursor-pointer gap-3"
            data-accordion-target="#accordion-flush-body-3" aria-expanded="false"
            aria-controls="accordion-flush-body-3">
            <span>Apakah NesMind Ai bisa menggantikan manusia?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
          <div class="py-5 border-b border-[var(--color-border-navbar-mobile)]">
            <p class="mb-2 text-[var(--color-txt-secondary)]">NesMind Ai bukan untuk menggantikan manusia, melainkan
              untuk mendukung dan mempercepat pekerjaan kamu. AI ini bekerja berdasarkan data dan algoritma, jadi tetap
              diperlukan sentuhan manusia untuk memahami konteks dan emosi dalam banyak situasi.
            </p>
          </div>
        </div>
      </div>

      <h1 class="text-[var(--color-txt-primary)] font-semibold text-lg md:text-xl lg:text-2xl mt-12">
        Apa yang bikin kamu bingung? <br> Yuk, jelasin!
      </h1>
      <div class="mt-6 grid grid-cols-1 xl:grid-cols-2 items-center justify-center">
        <!-- Form -->
        <form class="order-2 xl:order-1">
          <div class="mb-5">
            <label for="text" class="block mb-2 text-md font-regular text-[var(--color-txt-primary)]">Nama
              Lengkap:</label>
            <input type="text" id="text"
              class="border-2 border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary)] text-md sm:text-lg rounded-lg focus:ring-[var(--color-txt-secondary)] bg-transparent focus:border-[var(--color-txt-secondary)] block w-full p-2.5"
              placeholder="masukkan nama lengkap anda" required />
          </div>
          <div class="mb-5">
            <label for="no_telp" class="block mb-2 text-md font-regular text-[var(--color-txt-primary)]">Nomor
              Telepon:</label>
            <input type="tel" id="no_telp"
              class="border-2 bg-transparent border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary)] text-md sm:text-lg rounded-lg focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)] block w-full p-2.5"
              placeholder="nomor telepon anda" required />
          </div>
          <div class="mb-5">
            <label for="email"
              class="block mb-2 text-md font-regular text-[var(--color-txt-primary)]">Email:</label>
            <input type="email" id="email"
              class="border-2 bg-transparent border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary)] text-md sm:text-lg rounded-lg focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)] block w-full p-2.5"
              placeholder="masukkan email anda" required />
          </div>
          <div class="mb-5">
            <label for="message" class="block mb-2 text-md font-regular text-[var(--color-txt-primary)]">Ajukan
              Pertanyaan/saran/kritik:</label>
            <textarea id="message" rows="4"
              class="border-2 border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary)] text-md sm:text-lg rounded-lg focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)] block w-full p-2.5"
              placeholder="Tuliskan disini..."></textarea>
          </div>
          <button type="submit"
            class="mt-2 text-[var(--color-bg-primary)] bg-[var(--color-txt-primary)] hover:bg-[var(--color-txt-secondary)] hover:cursor-pointer transition focus:ring-3 focus:outline-none focus:ring-[var(--color-txt-primary)] font-bold rounded-lg text-xl w-full px-5 py-2.5 text-center">Kirim!</button>
        </form>
        <!-- Img -->
        <div class="order-1 xl:order-2 mb-12 flex justify-center">
          <img src="../assets/img/img-help.svg" class="w-full lg:w-5/6" alt="Image Help">
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content End -->

  <!-- Flowbite Script -->
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>

</html>