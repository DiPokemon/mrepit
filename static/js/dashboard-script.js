document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.dashboard-tab');
    const sections = document.querySelectorAll('.dashboard-section');

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('data-target');

            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            sections.forEach(section => {
                if (section.id === 'section-' + target) {
                    section.classList.add('active');
                } else {
                    section.classList.remove('active');
                }
            });
        });
    });
});
