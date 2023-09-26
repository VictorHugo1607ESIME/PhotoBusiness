<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium my-4">
            <li>
                <a href="">
                    <img src="/images/logo-entrefam.jpeg" alt="logo">
                </a>
            </li>
        </ul>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ url('/admin/dashboard') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/users') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fa-solid fa-users"></i>
                    <span class="ml-3">Usuarios</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/images') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fa-solid fa-file-image"></i>
                    <span class="ml-3">Imagenes</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/albums') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fa-solid fa-images"></i>
                    <span class="ml-3">Albums</span>
                </a>
            </li>

            <li>
                <a href="{{ URL('/admin/logout') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Cerrar sesión</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
