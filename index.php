<?php

session_start();
include 'config/koneksi.php';

?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NesMind Ai</title>

  <!-- Flowbite CSS -->
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

  <!-- Tailwind CSS -->
  <link href="./output.css" rel="stylesheet" />

  <!-- Aos -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

  <!-- Website NesMind Ai icon -->
  <link rel="shortcut icon" href="assets/img/logo-nesmind-ai.svg" type="image/x-icon" />

  <!-- Google Fonts: Geist -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="bg-[var(--color-bg-primary)] font-[geist]">

  <!-- Navbar -->

  <nav data-aos="fade-down" data-aos-duration="1000" data-aos-delay="2000"
    class="z-50 bg-[var(--color-bg-navbar)] backdrop-blur-xs border-b border-[var(--color-txt-primary2)] fixed w-full start-0 end-0 top-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <!-- Logo -->
      <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="assets/img/logo-nesmind-ai.svg" class="h-8" alt="NesMind Ai Logo" />
        <img src="assets/img/logo-nesmind-ai-text.png" class="max-[430px]:hidden h-4" alt="NesMind Ai Logo" />
      </a>

      <!-- Tombol (DESKTOP) -->
      <div class="hidden md:flex md:order-2 space-x-3 rtl:space-x-reverse">
        <a href="form-daftar.php"
          class="text-[var(--color-txt-primary)] focus:ring-4 ring ring-[var(--color-txt-secondary)] font-medium rounded-md text-sm px-4 py-2 text-center dark:bg-transparent dark:hover:text-[var(--color-bg-primary)] dark:hover:bg-[var(--color-txt-primary)] hover:cursor-pointer transition">
          Daftar
        </a>
        <a href="form-login.php"
          class="focus:ring-4 ring ring-[var(--color-txt-secondary)] font-medium rounded-md text-sm px-4 py-2 text-center dark:bg-[var(--color-txt-primary)] dark:hover:bg-[var(--color-txt-primary2)] hover:cursor-pointer">
          Masuk
        </a>
      </div>

      <!-- HAMBURGER MENU (MOBILE) -->
      <button data-collapse-toggle="navbar-cta" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
        aria-controls="navbar-cta" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>

      <!-- NAVIGATION LINKS + TOMBOL DAFTAR/MASUK (MOBILE) -->
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
        <ul
          class="text-lg flex flex-col font-light p-4 md:p-0 mt-4 md:bg-transparent border border-[var(--color-border-navbar-mobile)] bg-[var(--color-bg-secondary)] rounded-lg md:space-x-10 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
          <!-- Link Navigasi -->
          <li>
            <a href="#beranda"
              class="text-center md:text-start mb-3 md:mb-0 block py-2 px-3 md:p-0 text-[var(--color-txt-primary)] rounded-lg md:bg-transparent md:text-[var(--color-txt-primary)] md:dark:hover:text-[#A1A1A1]">
              Beranda
            </a>
          </li>
          <li>
            <a href="#tentang"
              class="text-center md:text-start mb-3 md:mb-0 block py-2 px-3 md:p-0 text-[var(--color-txt-primary)] rounded-lg md:bg-transparent md:text-[var(--color-txt-primary)] md:dark:hover:text-[#A1A1A1]">
              Tentang
            </a>
          </li>
          <li>
            <a href="#fitur"
              class="text-center md:text-start mb-3 md:mb-0 block py-2 px-3 md:p-0 text-[var(--color-txt-primary)] rounded-lg md:bg-transparent md:text-[var(--color-txt-primary)] md:dark:hover:text-[#A1A1A1]">
              Fitur
            </a>
          </li>
          <li>
            <a href="#bantuan"
              class="text-center md:text-start mb-3 md:mb-0 block py-2 px-3 md:p-0 text-[var(--color-txt-primary)] rounded-lg md:bg-transparent md:text-[var(--color-txt-primary)] md:dark:hover:text-[#A1A1A1]">
              Bantuan
            </a>
          </li>

          <!-- TOMBOL DAFTAR & MASUK (MOBILE SAJA) -->
          <li class="block md:hidden mt-4 space-y-3">
            <a href="form-daftar.php"
              class="block w-full text-[var(--color-txt-primary)] focus:ring-4 ring ring-[var(--color-txt-secondary)] font-medium rounded-md text-sm px-4 py-2 text-center dark:bg-transparent dark:hover:text-[var(--color-bg-primary)] dark:hover:bg-[var(--color-txt-primary)] hover:cursor-pointer transition">
              Daftar
            </a>
            <a href="form-login.php"
              class="block w-full focus:ring-4 ring ring-[var(--color-txt-secondary)] font-medium rounded-md text-sm px-4 py-2 text-center dark:bg-[var(--color-txt-primary)] dark:hover:bg-[var(--color-txt-primary2)] hover:cursor-pointer">
              Masuk
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Navbar End -->

  <!-- Hero Section -->

  <section class="h-screen flex items-center justify-center flex-col relative" id="beranda">
    <div class="py-8 px-4 mx-auto lg:mb-60 max-w-screen-xl text-center lg:py-16">
      <a href="#fitur" data-aos="fade-up" data-aos-duration="800" data-aos-delay="1000"
        class="inline-flex justify-between items-center py-1 px-1 pe-4 mb-7 text-md md:text-lg text-[var(--color-txt-primary)] border-2 border-gray-600 rounded-full hover:bg-gray-800">
        <span class="text-sm bg-gray-500 rounded-full text-[var(--color-txt-primary)] px-4 py-1.5 me-3">Info</span>
        <span class="text-sm font-light">🔍 Sudah coba NesMind Ai hari ini? Cek fiturnya sekarang!</span>
        <svg class="w-2.5 h-2.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 9 4-4-4-4" />
        </svg>
      </a>
      <h1
        class="mb-4 text-3xl font-extrabold tracking-tight leading-none md:text-4xl lg:text-6xl text-[var(--color-txt-primary)]" data-aos="fade-up" data-aos-duration="800">
        Selamat Datang di NesMind Ai 👋</h1>
      <p class="mb-6 text-lg font-normal lg:text-xl sm:px-16 lg:px-48 text-[var(--color-txt-secondary)]" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="800">Kecerdasan
        buatan yang siap mengubah cara Anda bekerja, berpikir, dan berkembang. Automasi, efisiensi, dan solusi pintar.
      </p>
      <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
        <a href="form-login.php"
          class="inline-flex justify-center items-center py-3 px-5 text-lg text-[var(--color-bg-primary)] font-medium text-center rounded-xl bg-[var(--color-txt-primary)] hover:bg-[var(--color-txt-primary2)] focus:ring-3 focus:ring-[var(--color-txt-secondary)]" data-aos="fade-down" data-aos-duration="800" data-aos-delay="1000">
          🔘 Coba Sekarang
        </a>
        <a href="#fitur"
          class="py-3 px-5 sm:ms-4 text-lg font-medium text-[var(--color-txt-primary)] focus:outline-none bg-transparent rounded-xl border-1 border-[var(--color-txt-secondary)] hover:bg-gray-800 focus:ring-3 focus:ring-[var(--color-txt-secondary)]" data-aos="fade-down" data-aos-duration="800" data-aos-delay="1500">
          🔍 Lihat Fitur
        </a>
      </div>
    </div>

    <div class="absolute bottom-0 hidden lg:block">
      <img src="assets/img/hero-img.png" class="" alt="Hero Image" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
    </div>

  </section>

  <!-- Hero Section End -->

  <!-- Tentang Section -->

  <section class="py-32 relative bg-[var(--color-bg-primary2)]" id="tentang">
    <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
      <div class="w-full justify-start items-center gap-12 grid lg:grid-cols-2 grid-cols-1">
        <img class="lg:mx-0 mx-auto w-120" src="assets/img/img-tentang.png" alt="about Us image" />
        <div class="w-full flex-col justify-start lg:items-start items-start gap-6 inline-flex">
          <div class="w-full flex-col justify-start lg:items-start gap-4 flex">
            <h2
              class="text-[var(--color-txt-primary)] text-2xl md:text-5xl lg:text-5xl font-bold leading-normal text-center md:text-center">
              Tentang NesMind Ai
              ✨</h2>
            <p
              class="text-[var(--color-txt-secondary)] text-lg md:text-xl font-light leading-relaxed md:text-start lg:text-start">
              NesMind Ai merupakan sebuah platform ai berbasis website yang di buat untuk menghadirkan kecerdasan buatan
              yang adaptif, relevan, dan mudah diakses oleh siapa saja. Kami percaya bahwa AI tidak sekadar alat, namun
              partner berpikir yang mampu berkembang
              bersama penggunanya.
            </p>
          </div>
          <button data-modal-target="static-modal" data-modal-toggle="static-modal"
            class="underline text-[var(--color-txt-primary)] text-start text-lg cursor-pointer" type="button">
            Baca Selengkapnya ->
          </button>
          <!-- <a href="" class="underline text-[var(--color-txt-primary)] text-start text-lg">Baca Selengkapnya →</a> -->
        </div>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-[var(--color-bg-secondary)] rounded-lg shadow-sm">
        <!-- Modal header -->
        <div
          class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-[var(--color-border-navbar-mobile)]">
          <h3 class="text-xl font-semibold text-[var(--color-txt-primary)]">
            Tentang NesMind Ai
          </h3>
          <button type="button"
            class="text-[var(--color-txt-primary)] bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="static-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 md:p-5 space-y-4">
          <img src="assets/img/logo-nesmind-ai.svg" alt="" class="mx-auto">
          <p class="text-md text-justify text-[var(--color-txt-primary2)] my-10">
            NesMind Ai adalah sebuah platform atau website Kecerdasan Buatan (Artificial Intelligence) yang bertujuan
            untuk menyediakan layanan AI yang mudah diakses, cerdas, dan relevan dengan kebutuhan zaman. Kepanjangan
            NesMind Ai sendiri adalah dari kata Nes (Indonesia), dan Mind (Berpikir) yang artinya Masyarakat Indonesia
            bisa berpikir lebih cerdas serta kreatif dengan memanfaatkan teknologi Kecerdasan Buatan ini.
          </p>
          <p class="text-md text-justify text-[var(--color-txt-primary2)]">
            Platform ini dirancang untuk membantu pengguna dalam berbagai aktivitas, seperti menjawab pertanyaan,
            menghasilkan ide kreatif, menulis konten, menganalisis data, hingga memberikan solusi cerdas melalui
            antarmuka yang sederhana dan ramah pengguna. Dengan memadukan teknologi mutakhir dan pendekatan lokal,
            NesMind Ai diharapkan menjadi mitra digital yang adaptif dan inspiratif bagi masyarakat Indonesia maupun
            global.
          </p>
        </div>
        <!-- Modal footer -->
      </div>
    </div>
  </div>

  <!-- Tentang Section End -->

  <!-- Fitur -->

  <section id="fitur" class="bg-[var(--color-bg-secondary)] py-20">
    <div class="container mx-auto">
      <h1
        class="text-center mx-4 md:mx-0 font-bold text-2xl sm:text-2xl md:text-5xl lg:text-5xl text-[var(--color-txt-primary)]">
        Keunggulan NesMind
        Ai 🔍</h1>
      <div class="mt-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 max-[1024px]:gap-8 gap-10">
        <div
          class="mx-4 md:mx-0 border border-[var(--color-border-navbar-mobile)] bg-[rgba(255,255,255,0.05)] hover:cursor-pointer hover:bg-[rgba(255,255,255,0.01)] transition p-4 md:p-10 rounded-3xl flex flex-col items-center justify-center">
          <div>
            <img src="assets/img/card-features/img-card-1.png" class="w-3/5 md:w-auto mx-auto" alt="Image Features">
          </div>
          <h1
            class="text-[var(--color-txt-primary)] text-2xl md:text-2xl lg:text-2xl xl:text-3xl font-bold my-4 md:my-8 text-center">
            Analisis Cerdas</h1>
          <p class="text-xl md:text-xl lg:text-2xl text-[var(--color-txt-secondary)] text-center">
            Mengolah informasi <br>
            dan memberikan <br>
            wawasan real-time.
          </p>
        </div>
        <div
          class="mx-4 md:mx-0 border border-[var(--color-border-navbar-mobile)] bg-[rgba(255,255,255,0.05)] hover:cursor-pointer hover:bg-[rgba(255,255,255,0.01)] transition p-4 md:p-10 rounded-3xl flex flex-col items-center justify-center">
          <div>
            <img src="assets/img/card-features/img-card-2.png" class="w-3/5 md:w-auto mx-auto" alt="Image Features">
          </div>
          <h1
            class="text-[var(--color-txt-primary)] text-2xl md:text-2xl lg:text-2xl xl:text-3xl font-bold my-4 md:my-8 text-center">
            Otomatisasi Canggih</h1>
          <p class="text-xl md:text-xl lg:text-2xl text-[var(--color-txt-secondary)] text-center">
            Kurangi beban kerja <br>
            Anda dengan sistem <br>
            otomatis berbasis AI.
          </p>
        </div>
        <div
          class="mx-4 md:mx-0 border border-[var(--color-border-navbar-mobile)] bg-[rgba(255,255,255,0.05)] hover:cursor-pointer hover:bg-[rgba(255,255,255,0.01)] transition p-4 md:p-10 rounded-3xl flex flex-col items-center justify-center">
          <div>
            <img src="assets/img/card-features/img-card-3.png" class="w-3/5 md:w-auto mx-auto" alt="Image Features">
          </div>
          <h1
            class="text-[var(--color-txt-primary)] text-2xl md:text-2xl lg:text-2xl xl:text-3xl font-bold my-4 md:my-8 text-center">
            Aman & Terpercaya</h1>
          <p class="text-xl md:text-xl lg:text-2xl text-[var(--color-txt-secondary)] text-center">
            Didukung oleh sistem <br>
            keamanan mutakhir untuk <br>
            melindungi data Anda
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Fitur End -->

  <!-- Bantuan -->

  <section id="bantuan" class="bg-[var(--color-bg-primary)] py-20">
    <div class="container mx-auto">
      <h1
        class="text-center mx-4 md:mx-0 mb-8 font-bold text-2xl sm:text-2xl md:text-5xl lg:text-5xl text-[var(--color-txt-primary)]">
        Apa yang bisa kami bantu?
      </h1>
      <div class="mt-14 grid grid-cols-1 lg:grid-cols-2 items-center justify-center">

        <!-- Form -->
        <form class="order-2 lg:order-1 mx-5 lg:mx-10">
          <div class="mb-5">
            <label for="text" class="block mb-2 text-md sm:text-lg font-regular text-[var(--color-txt-primary)]">Nama
              Lengkap:</label>
            <input type="text" id="text"
              class="bg-transparent border-2 border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary)] text-md sm:text-lg rounded-lg focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)] block w-full p-2.5"
              placeholder="masukkan nama lengkap anda" required />
          </div>
          <div class="mb-5">
            <label for="no_telp"
              class="block mb-2 text-md sm:text-lg font-regular text-[var(--color-txt-primary)]">Nomor
              Telepon:</label>
            <input type="tel" id="no_telp"
              class="bg-transparent border-2 border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary)] text-md sm:text-lg rounded-lg focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)] block w-full p-2.5"
              placeholder="nomor telepon anda" required />
          </div>
          <div class="mb-5">
            <label for="email"
              class="block mb-2 text-md sm:text-lg font-regular text-[var(--color-txt-primary)]">Email:</label>
            <input type="email" id="email"
              class="bg-transparent border-2 border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary)] text-md sm:text-lg rounded-lg focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)] block w-full p-2.5"
              placeholder="masukkan email anda" required />
          </div>
          <div class="mb-5">
            <label for="message"
              class="block mb-2 text-md sm:text-lg font-regular text-[var(--color-txt-primary)]">Ajukan
              Pertanyaan/saran/kritik:</label>
            <textarea id="message" rows="4"
              class="bg-transparent border-2 border-[var(--color-border-navbar-mobile)] text-[var(--color-txt-primary)] text-md sm:text-lg rounded-lg focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)] block w-full p-2.5"
              placeholder="Tuliskan disini..."></textarea>
          </div>
          <button type="submit"
            class="transition duration-800 ease-in-out mt-2 text-[var(--color-bg-primary)] bg-[var(--color-txt-primary)] hover:bg-[var(--color-txt-secondary)] hover:cursor-pointer focus:ring-3 focus:outline-none focus:ring-[var(--color-txt-primary)] font-bold rounded-lg text-xl w-full px-5 py-2.5 text-center">Submit</button>
        </form>

        <!-- Img -->
        <div class="order-1 lg:order-2 mb-10 lg:mb-0 flex justify-center mx-5 lg:mx-10">
          <img src="assets/img/img-help.png" class="w-full lg:w-5/6" alt="Image Help">
        </div>

      </div>
    </div>
  </section>

  <!-- Bantuan End -->

  <!-- Footer -->

  <footer class="bg-[var(--color-bg-secondary)] rounded-lg shadow-sm m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
      <div class="sm:flex sm:items-center sm:justify-between">
        <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
          <img src="assets/img/logo-nesmind-ai-name.png" class="" alt="Flowbite Logo" />
        </a>
        <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-[var(--color-txt-secondary)] sm:mb-0">
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

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
    });
  </script>

</body>

</html>