<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>@yield('title', 'AirWorld')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>
<body data-bs-theme="">
    <div class="position-fixed bottom-0 end-0 mb-3 me-3 p-2" style="width: 50px; height: 50px; z-index: 1080;">
        <button id="themeToggle" class="btn btn-primary w-100 h-100 d-flex justify-content-center align-items-center shadow p-0">
            <span id="themeIcon"></span>
        </button>
    </div>
    @yield('content')
    <script>
        const buttonTheme = document.getElementById('themeToggle');
        const iconTheme = document.getElementById('themeIcon');
        const storageTheme = localStorage.getItem('theme');
    
        const sun = '<i class="fas fa-sun"></i>';
        const moon = '<i class="fas fa-moon"></i>';
    
        function changeIcon(theme) { iconTheme.innerHTML = (theme === 'dark') ? moon : sun; }
    
        // Initialisation
        if (storageTheme) {
            document.documentElement.setAttribute('data-bs-theme', storageTheme);
            iconTheme.innerHTML = (storageTheme === 'dark') ? moon : sun;
        } else {
            iconTheme.innerHTML = sun;
        }
    
        buttonTheme.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    
            document.documentElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            changeIcon(newTheme);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>