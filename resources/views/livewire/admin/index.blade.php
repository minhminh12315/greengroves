<div id="admin-container">
    <livewire:admin.sidebar />
    <main>
        <div class="admin-main-content">
            <livewire:admin.header />
            <div id="admin-content">
                @yield('content')
            </div>
            <livewire:admin.footer />
        </div>
    </main>
</div>