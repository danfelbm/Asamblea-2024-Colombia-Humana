<?php
get_header();
?>

<div class="container mx-auto px-4 py-8">
    <!-- Tab buttons -->
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <button class="border-primary-500 text-primary-600 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium" aria-current="page" id="tab-disponibles">
                Votaciones disponibles
            </button>
            <button class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium" id="tab-mis-votaciones">
                Mis votaciones
            </button>
        </nav>
    </div>

    <!-- Tab content -->
    <div>
        <!-- Votaciones disponibles tab -->
        <div id="content-disponibles" class="tab-content">
            <?php include('template-parts/votaciones-grid.php'); ?>
        </div>

        <!-- Mis votaciones tab -->
        <div id="content-mis-votaciones" class="tab-content hidden">
            <?php include('template-parts/mis-votaciones-table.php'); ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = {
        'tab-disponibles': 'content-disponibles',
        'tab-mis-votaciones': 'content-mis-votaciones'
    };

    Object.keys(tabs).forEach(tabId => {
        document.getElementById(tabId).addEventListener('click', function() {
            // Update tab buttons
            document.querySelectorAll('button[id^="tab-"]').forEach(btn => {
                btn.classList.remove('border-primary-500', 'text-primary-600');
                btn.classList.add('border-transparent', 'text-gray-500', 'hover:border-gray-300', 'hover:text-gray-700');
            });
            this.classList.remove('border-transparent', 'text-gray-500', 'hover:border-gray-300', 'hover:text-gray-700');
            this.classList.add('border-primary-500', 'text-primary-600');

            // Update tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            document.getElementById(tabs[tabId]).classList.remove('hidden');
        });
    });
});
</script>

<?php get_footer(); ?>