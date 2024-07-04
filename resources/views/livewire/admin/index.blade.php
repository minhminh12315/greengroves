
<div id="admin-container">
    <livewire:admin.sidebar />
    <main>
        <div class="admin-main-content">
            <livewire:admin.header />
            @yield('content')
            <livewire:admin.footer />
        </div>
    </main>
    
</div>
