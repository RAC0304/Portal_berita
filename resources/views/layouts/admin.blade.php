<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-[#2c3e50] text-white">
    <div class="flex min-h-screen">
      <!-- Sidebar -->
      <aside class="w-64 bg-[#1a252f] p-5">
        <h2 class="text-xl font-bold text-center text-[#e74c3c]">
          Admin Panel
        </h2>
        <ul class="mt-5">
          <li class="mb-3">
            <a
              href="{{route('berita.index-admin')}}"
              class="block py-2 px-3 bg-[#e74c3c] rounded text-white text-center"
              >Dashboard</a
            >
          </li>
          <li class="mb-3">
            <a
              href="#"
              class="block py-2 px-3 hover:bg-gray-700 rounded text-center"
              >Users</a
            >
          </li>
          <li>
            <a
              href="#"
              class="block py-2 px-3 hover:bg-gray-700 rounded text-center"
              >Settings</a
            >
          </li>
        </ul>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-10">
        <h1 class="text-3xl font-bold">Welcome to Admin Dashboard</h1>
        <div class="grid grid-cols-3 gap-6 mt-6">
            <div class="bg-[#34495e] p-5 rounded-lg shadow-lg">
              <h2 class="text-lg font-semibold">Users</h2>
              <p class="text-4xl font-bold text-[#e74c3c]">120</p>
            </div>
            <div class="bg-[#34495e] p-5 rounded-lg shadow-lg">
              <h2 class="text-lg font-semibold">Jumlah Berita</h2>
              <p class="text-4xl font-bold text-[#e74c3c]">{{$jumlahBerita}}</p>
            </div>
            <div class="bg-[#34495e] p-5 rounded-lg shadow-lg">
              <h2 class="text-lg font-semibold">Orders</h2>
              <p class="text-4xl font-bold text-[#e74c3c]">300</p>
            </div>
          </div>
        <div>
            @yield('content')
        </div>
      </main>
    </div>
  </body>
</html>
