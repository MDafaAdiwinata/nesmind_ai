<?php

include '../config/koneksi.php';
session_start();
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
  <title>NesMind Ai - Dashboard Chat</title>

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
                <img class="w-8 h-8 rounded-full" src="../assets/img/<?= $tampildata['profile'] ?>" alt="user photo">
              </button>
            </div>
            <div
              class="z-50 hidden my-4 text-base list-none divide-y rounded-lg shadow-sm bg-[var(--color-bg-secondary)] divide-[var(--color-txt-secondary)]"
              id="dropdown-user">
              <div class="px-4 py-3" role="none">
                <p class="text-md text-[var(--color-txt-primary2)]" role="none">
                  <?= $tampildata['username']; ?>
                </p>
                <p class="text-md font-medium text-[var(--color-txt-primary2)]" role="none">
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
            Keluar dari NesMind Ai sebagai <span class="font-bold"><?= $tampildata['username']; ?></span>?
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
            class="flex items-center py-2 px-4 text-[var(--color-txt-primary2)] rounded-lg bg-[var(--color-chat-user)]">
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

  <div class="h-screen overflow-hidden p-4 sm:ml-64">
    <div class="h-screen rounded-lg bg-[var(--color-bg-primary)]">
      <div
        class="flex flex-col h-full items-center justify-between rounded-sm bg-[var(--color-bg-primary)]">

        <div id="container-all-chat" class="pt-10 mt-14 sm:mt-12 mb-10 flex flex-col h-full w-full xl:w-2/4">

          <!-- CHAT DISPLAY AREA -->
          <div id="chat-container"
            class=" flex-1 w-full overflow-y-auto px-0 md:px-4 py-4 space-y-4 hide-scrollbar">
            <!-- Di sini chat dynamic akan muncul -->
          </div>

          <!-- INPUT AREA -->
          <form id="chat-form" class="mx-auto w-full p-4">
            <label for="user-input" class="sr-only">Kirim</label>
            <div class="relative">
              <textarea id="user-input"
                class="block w-full px-4 py-3 pe-20 text-md text-[var(--color-txt-primary)] bg-[var(--color-chat-user)] rounded-xl resize-none h-25 focus:ring-[var(--color-txt-secondary)] focus:border-[var(--color-txt-secondary)] placeholder-[var(--color-txt-secondary)] hide-scrollbar"
                placeholder="Apa yang bisa NesMind Ai bantu?" required></textarea>
              <button type="submit"
                class="text-[var(--color-txt-primary)] absolute end-3 bottom-3.5 hover:bg-[var(--color-txt-secondary)] bg-[#535353] transition duration-300 hover:cursor-pointer focus:ring-4 focus:outline-none focus:ring-[var(--color-txt-secondary)] rounded-lg text-sm px-4 py-3 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-send"
                  viewBox="0 0 16 16">
                  <path
                    d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z" />
                </svg>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Main Content End -->

  <!-- Flowbite Script -->
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>


  <script>
    const form = document.getElementById("chat-form");
    const input = document.getElementById("user-input");

    // Tangani Enter dan Shift+Enter
    input.addEventListener("keydown", function (e) {
      if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault(); // Cegah newline
        form.dispatchEvent(new Event("submit")); // Trigger submit
      }
    });

    const container = document.querySelector("#container-all-chat > .flex-1");

    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      const userText = input.value.trim();
      if (!userText) return;

      // Tampilkan pesan user
      const userMsg = document.createElement("div");
      userMsg.className = "mb-6 mt-4 self-end bg-[var(--color-chat-user)] text-[var(--color-txt-primary)] px-4 py-2 rounded-lg rounded-tr-none max-w-xl";
      userMsg.innerText = userText;

      // Tampilkan placeholder AI
      const botWrapper = document.createElement("div");
      botWrapper.className = "flex items-start gap-3";
      botWrapper.innerHTML = `
      <img class="hidden sm:block w-8 h-6 rounded-full" src="../assets/img/logo-nesmind-ai.svg" alt="NesMind Ai">
      <div class="flex flex-col max-w-md leading-1.5 p-4 bg-[var(--color-chat-ai)] rounded-e-xl rounded-es-xl">
        <div class="flex items-center space-x-2 rtl:space-x-reverse">
          <span class="text-sm font-semibold text-[var(--color-txt-primary)]">NesMind Ai</span>
        </div>
        <p class="text-sm font-normal mt-2 text-[var(--color-txt-primary)]" id="ai-response">Sedang mengetik...</p>
      </div>
    `;

      // Bungkus semuanya
      const wrapper = document.createElement("div");
      wrapper.className = "flex flex-col space-y-2";
      wrapper.appendChild(userMsg);
      wrapper.appendChild(botWrapper);

      container.appendChild(wrapper);
      container.scrollTop = container.scrollHeight;

      input.value = "";

      // Kirim ke OpenRouter
      try {
        const response = await fetch("https://openrouter.ai/api/v1/chat/completions", {
          method: "POST",
          headers: {
            Authorization: "Bearer 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", // Ganti dengan API key kamu
            "HTTP-Referer": "https://www.nesmind.ai", // Ganti sesuai domain kamu
            "X-Title": "NesMind AI",
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            model: "deepseek/deepseek-chat", // atau deepseek-r1:free
            messages: [{ role: "user", content: userText }],
          }),
        });

        const data = await response.json();
        const aiText = data.choices?.[0]?.message?.content || "Maaf, tidak ada jawaban.";
        botWrapper.querySelector("#ai-response").innerText = aiText;

        container.scrollTop = container.scrollHeight;
      } catch (error) {
        botWrapper.querySelector("#ai-response").innerText = "Error: " + error.message;
      }
    });
  </script>

</body>

</html>