<div id="sidebar" class="w-64 relative h-screen bg-[#2d2d2d] shadow-2xl transition-all duration-300 p-6">
    <div class="text-white font-semibold    ">
        <!-- Sidebar Header -->
        <div class="flex font-bold items-center text-3xl gap-1 justify-center my-10">
            <box-icon class="mt-1" size="md" color="#ffffff" name='command'></box-icon>
            <h1 class="sidebar-text overflow-hidden whitespace-nowrap transition-opacity duration-300">AbsenSys</h1>
        </div>

        <ul class="flex flex-col gap-4">
            <a href="./dashboard.php">
                <li
                    class="flex hover:bg-violet-700 transition-all items-center rounded-lg gap-2 px-4 py-2 dashboard-item ">
                    <box-icon color="#ffffff" name='home'></box-icon> <span
                        class="sidebar-text overflow-hidden whitespace-nowrap transition-opacity duration-300">Dashboard</span>
                </li>
            </a>
            <a href="./absensi.php">
                <li
                    class="flex hover:bg-violet-700 transition-all items-center rounded-lg gap-2 px-4 py-2 absensi-item">
                    <box-icon color="#ffffff" name='user'></box-icon>
                    <span class="sidebar-text overflow-hidden whitespace-nowrap transition-opacity duration-300">Add
                        Absensi</span>
                </li>
            </a>
        </ul>
    </div>

    <button id="toggle-btn" onclick="toggleSidebar()"
        class=" flex justify-center items-center -right-6 rounded-full absolute top-[45vh] aspect-square w-14 h-14 bg-violet-600 hover:bg-violet-800">
        <box-icon color="#ffffff" type="solid" name="left-arrow"></box-icon>
    </button>
</div>