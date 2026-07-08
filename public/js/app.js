document.addEventListener('DOMContentLoaded', function () {
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const pageContent = document.getElementById('page-content-wrapper');

    if (toggleSidebar) {
        toggleSidebar.addEventListener('click', function () {
            if (window.innerWidth <= 991) {
                sidebar.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
                pageContent.classList.toggle('expanded');
            }
        });
    }

    document.addEventListener('click', function (e) {
        if (window.innerWidth <= 991 && sidebar.classList.contains('show')) {
            if (!sidebar.contains(e.target) && !toggleSidebar.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        }
    });
});
