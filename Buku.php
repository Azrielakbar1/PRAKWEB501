<?php 
require 'Model.php';

// DELETE BUKU
if (isset($_GET['hapus'])) {
    deleteBuku($_GET['hapus']);
    header("Location: /PRAK501/Buku.php");
}

$data_buku = getAllDatafromBuku();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Inventory - Mas Azriel Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-slate-200/60 flex flex-col fixed h-full z-10">
            <div class="h-16 flex items-center px-6 border-b border-slate-100 space-x-2">
                <i data-lucide="library" class="w-6 h-6 text-blue-600"></i>
                <span class="text-md font-extrabold text-slate-900 tracking-tight">Azriel Library</span>
            </div>

            <div class="flex-1 p-4 space-y-1.5">
                <a href="Member.php" class="flex items-center px-4 py-3 text-slate-600 hover:bg-slate-50 hover:text-blue-600 font-medium rounded-xl transition duration-200">
                    <i data-lucide="users" class="w-5 h-5 mr-3"></i> Member Directory
                </a>
                <a href="Buku.php" class="flex items-center px-4 py-3 bg-blue-50 text-blue-600 font-semibold rounded-xl transition duration-200">
                    <i data-lucide="book-open" class="w-5 h-5 mr-3"></i> Book Inventory
                </a>
                <a href="Peminjaman.php" class="flex items-center px-4 py-3 text-slate-600 hover:bg-slate-50 hover:text-blue-600 font-medium rounded-xl transition duration-200">
                    <i data-lucide="arrow-left-right" class="w-5 h-5 mr-3"></i> Loan Transactions
                </a>
            </div>

            <div class="p-4 border-t border-slate-100 text-center text-xs text-slate-400 font-medium">v1.0 • Dashboard System</div>
        </aside>

        <div class="flex-1 flex flex-col pl-64">
            <header class="h-16 bg-white border-b border-slate-200/60 flex items-center justify-between px-8 sticky top-0 z-10">
                <h1 class="text-sm font-semibold text-slate-500">Dashboard / <span class="text-slate-800 font-bold">Books</span></h1>
                <div class="flex items-center space-x-3">
                    <div class="text-right">
                        <div class="text-sm font-bold text-slate-800">Mas Azriel</div>
                        <div class="text-xs text-slate-400 font-medium">Administrator</div>
                    </div>
                    <div class="w-9 h-9 bg-blue-600 text-white font-bold rounded-full flex items-center justify-center">MA</div>
                </div>
            </header>

            <main class="p-8 flex-1">
                <div class="bg-white p-6 rounded-2xl border border-slate-200/50 shadow-sm hover:shadow-md hover:scale-[1.005] transition-all duration-300 ease-in-out">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Book Stock List</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Keep track of library catalog and publication details.</p>
                        </div>
                        <a href="FormBuku.php" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-xl shadow-sm active:scale-95 transition-all duration-200 flex items-center text-sm">
                            <i data-lucide="list-plus" class="w-4 h-4 mr-2"></i> Add New Book
                        </a>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-slate-100">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/70 text-slate-600 text-sm font-semibold border-b border-slate-100">
                                    <th class="p-4 w-16">ID</th>
                                    <th class="p-4">Book Title</th>
                                    <th class="p-4">Author</th>
                                    <th class="p-4">Publisher</th>
                                    <th class="p-4">Publication Year</th>
                                    <th class="p-4 text-center w-40">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-slate-600">
                                <?php while ($row = mysqli_fetch_assoc($data_buku)) : ?>
                                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                                        <td class="p-4 font-medium text-slate-400">#<?php echo $row['id_buku']; ?></td>
                                        <td class="p-4 font-bold text-slate-800"><?php echo $row['judul_buku']; ?></td>
                                        <td class="p-4 text-slate-600 font-medium"><?php echo $row['penulis']; ?></td>
                                        <td class="p-4 text-slate-400"><?php echo $row['penerbit']; ?></td>
                                        <td class="p-4 font-semibold text-slate-500"><?php echo $row['tahun_terbit']; ?></td>
                                        <td class="p-4 text-center font-medium space-x-3">
                                            <a href="FormBuku.php?id=<?php echo $row['id_buku']; ?>" class="text-blue-600 hover:text-blue-800 inline-flex items-center group transition">
                                                <i data-lucide="pencil" class="w-3.5 h-3.5 mr-1 group-hover:scale-110 transition"></i> Edit
                                            </a>
                                            <a href="Buku.php?hapus=<?php echo $row['id_buku']; ?>" onclick="return confirm('Are you sure?')" class="text-red-500 hover:text-red-700 inline-flex items-center group transition">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5 mr-1 group-hover:scale-110 transition"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>