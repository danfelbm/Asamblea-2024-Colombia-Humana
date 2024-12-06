<div class="container mx-auto px-4 py-8">
    <div class="mb-8 md:mb-10 lg:mb-12">
        <!-- Mobile Filters Toggle Button -->
        <button type="button" 
                class="md:hidden w-full mb-4 inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"
                onclick="toggleMobileFilters()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter mr-2 h-4 w-4"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
            <span id="filterButtonText">Mostrar filtros</span>
        </button>

        <!-- Filters Section -->
        <div class="mb-10 flex flex-wrap items-center gap-x-4 gap-y-3 lg:gap-x-3 hidden md:flex" id="filtersContainer">
            <!-- Order Filter -->
            <div class="shrink-0 md:w-52 lg:w-56" id="orderFilter">
                <button type="button" class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background">
                    <span>Ordenar por</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down h-4 w-4 opacity-50"><path d="m6 9 6 6 6-6"></path></svg>
                </button>
                <div class="absolute z-50 mt-2 w-full rounded-md border bg-popover shadow-lg max-w-64" style="display: none;">
                    <div class="relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-8 pr-2 text-sm outline-none hover:bg-accent hover:text-accent-foreground data-[selected=true]:bg-accent"
                         onclick="toggleOrder('desc', this)"
                         data-type="order"
                         data-id="desc">
                        <span>Más recientes primero</span>
                    </div>
                    <div class="relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-8 pr-2 text-sm outline-none hover:bg-accent hover:text-accent-foreground data-[selected=true]:bg-accent"
                         onclick="toggleOrder('asc', this)"
                         data-type="order"
                         data-id="asc">
                        <span>Más antiguos primero</span>
                    </div>
                </div>
            </div>

            <!-- Categories Filter -->
            <div class="shrink-0 md:w-52 lg:w-56" id="categoryFilters">
                <button type="button" class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background">
                    <span>Categorías</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down h-4 w-4 opacity-50"><path d="m6 9 6 6 6-6"></path></svg>
                </button>
                <div class="absolute z-50 mt-2 w-full rounded-md border bg-popover shadow-lg max-w-64" style="display: none;">
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'category',
                        'hide_empty' => true,
                    ));

                    foreach ($categories as $category) :
                    ?>
                        <div class="relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-8 pr-2 text-sm outline-none hover:bg-accent hover:text-accent-foreground data-[selected=true]:bg-accent"
                             onclick="toggleFilter('categories', '<?php echo $category->term_id; ?>', this)"
                             data-type="categories"
                             data-id="<?php echo $category->term_id; ?>">
                            <span><?php echo $category->name; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Tags Filter -->
            <div class="shrink-0 md:w-52 lg:w-56" id="tagFilters">
                <button type="button" class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background">
                    <span>Etiquetas</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down h-4 w-4 opacity-50"><path d="m6 9 6 6 6-6"></path></svg>
                </button>
                <div class="absolute z-50 mt-2 w-full rounded-md border bg-popover shadow-lg max-w-64" style="display: none;">
                    <?php
                    $tags = get_terms(array(
                        'taxonomy' => 'post_tag',
                        'hide_empty' => true,
                    ));

                    foreach ($tags as $tag) :
                    ?>
                        <div class="relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-8 pr-2 text-sm outline-none hover:bg-accent hover:text-accent-foreground data-[selected=true]:bg-accent"
                             onclick="toggleFilter('tags', '<?php echo $tag->term_id; ?>', this)"
                             data-type="tags"
                             data-id="<?php echo $tag->term_id; ?>">
                            <span><?php echo $tag->name; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Authors Filter -->
            <div class="shrink-0 md:w-52 lg:w-56" id="authorFilters">
                <button type="button" class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background">
                    <span>Autores</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down h-4 w-4 opacity-50"><path d="m6 9 6 6 6-6"></path></svg>
                </button>
                <div class="absolute z-50 mt-2 w-full rounded-md border bg-popover shadow-lg max-w-64" style="display: none;">
                    <?php
                    $authors = get_users(array(
                        'who' => 'authors',
                        'has_published_posts' => array('votacion'),
                    ));

                    foreach ($authors as $author) :
                    ?>
                        <div class="relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-8 pr-2 text-sm outline-none hover:bg-accent hover:text-accent-foreground data-[selected=true]:bg-accent"
                             onclick="toggleFilter('authors', '<?php echo $author->ID; ?>', this)"
                             data-type="authors"
                             data-id="<?php echo $author->ID; ?>">
                            <span><?php echo $author->display_name; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Reset Filters Button -->
            <button onclick="resetFilters()" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
                Limpiar filtros
            </button>
        </div>
    </div>

    <!-- Grid Section -->
    <div id="votaciones-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                $author_id = get_the_author_meta('ID');
                $votacion_habilitada = get_field('votacion_habilitada');
                $card_classes = "group relative overflow-hidden rounded-lg border p-6 transition-all duration-150 ease-in-out " . 
                               ($votacion_habilitada ? "bg-background hover:bg-gray-50" : "bg-gray-100 opacity-75 cursor-not-allowed");
        ?>
            <?php if ($votacion_habilitada) : ?>
                <a href="<?php the_permalink(); ?>" class="block">
            <?php endif; ?>
                <article class="<?php echo esc_attr($card_classes); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="mb-4 aspect-video overflow-hidden rounded-md">
                            <?php the_post_thumbnail('medium', array(
                                'class' => 'h-full w-full object-cover transition-all duration-300 ' . 
                                         ($votacion_habilitada ? 'group-hover:scale-105' : 'grayscale')
                            )); ?>
                        </div>
                    <?php endif; ?>

                    <div class="flex flex-col space-y-1.5">
                        <h3 class="text-2xl font-semibold leading-none tracking-tight <?php echo $votacion_habilitada ? 'group-hover:text-primary-600' : 'text-gray-600'; ?> transition-colors duration-150">
                            <?php the_title(); ?>
                            <?php if (!$votacion_habilitada) : ?>
                                <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 ml-2">
                                    Deshabilitada
                                </span>
                            <?php endif; ?>
                        </h3>
                        
                        <div class="flex items-center text-sm <?php echo $votacion_habilitada ? 'text-slate-500' : 'text-gray-500'; ?> space-x-2">
                            <div class="flex items-center space-x-2">
                                <?php echo get_avatar($author_id, 24, '', '', array('class' => 'rounded-full')); ?>
                                <span><?php the_author(); ?></span>
                            </div>
                            <span>•</span>
                            <time datetime="<?php echo get_the_date('c'); ?>" class="text-xs"><?php echo get_the_date(); ?></time>
                        </div>

                        <div class="text-sm <?php echo $votacion_habilitada ? 'text-slate-600' : 'text-gray-500'; ?> mb-4">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </div>
                        
                        <button class="w-full px-4 py-2 text-sm font-medium rounded-md transition-colors <?php 
                            echo $votacion_habilitada 
                                ? 'text-white bg-slate-900 hover:bg-slate-800' 
                                : 'text-gray-500 bg-gray-200 cursor-not-allowed'; ?>">
                            <?php echo $votacion_habilitada ? 'Ver más' : 'No disponible'; ?>
                        </button>
                    </div>
                </article>
            <?php if ($votacion_habilitada) : ?>
                </a>
            <?php endif; ?>
        <?php
            endwhile;
        else :
        ?>
            <div class="col-span-full text-center py-8 text-slate-600">
                No se encontraron votaciones.
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle dropdowns
    document.querySelectorAll('[id$="Filters"] button, #orderFilter button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdown = this.nextElementSibling;
            const isHidden = dropdown.style.display === 'none';
            
            // Hide all dropdowns first
            document.querySelectorAll('[id$="Filters"] .absolute, #orderFilter .absolute').forEach(d => {
                d.style.display = 'none';
            });
            
            // Show/hide clicked dropdown
            dropdown.style.display = isHidden ? 'block' : 'none';
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('[id$="Filters"], #orderFilter')) {
            document.querySelectorAll('[id$="Filters"] .absolute, #orderFilter .absolute').forEach(d => {
                d.style.display = 'none';
            });
        }
    });

    // Initialize filters from URL
    initializeFiltersFromUrl();
});

// Store active filters
const activeFilters = {
    categories: new Set(),
    tags: new Set(),
    authors: new Set(),
    order: 'desc' // default order
};

function initializeFiltersFromUrl() {
    const params = new URLSearchParams(window.location.search);
    
    // Reset all filters
    activeFilters.categories.clear();
    activeFilters.tags.clear();
    activeFilters.authors.clear();
    
    // Initialize categories
    if (params.has('categories')) {
        params.get('categories').split(',').forEach(id => {
            activeFilters.categories.add(id);
            document.querySelector(`[data-type="categories"][data-id="${id}"]`)?.setAttribute('data-selected', 'true');
        });
    }
    
    // Initialize tags
    if (params.has('tags')) {
        params.get('tags').split(',').forEach(id => {
            activeFilters.tags.add(id);
            document.querySelector(`[data-type="tags"][data-id="${id}"]`)?.setAttribute('data-selected', 'true');
        });
    }
    
    // Initialize authors
    if (params.has('authors')) {
        params.get('authors').split(',').forEach(id => {
            activeFilters.authors.add(id);
            document.querySelector(`[data-type="authors"][data-id="${id}"]`)?.setAttribute('data-selected', 'true');
        });
    }
    
    // Initialize order
    if (params.has('order')) {
        activeFilters.order = params.get('order');
        document.querySelector(`[data-type="order"][data-id="${activeFilters.order}"]`)?.setAttribute('data-selected', 'true');
    }
}

function toggleFilter(type, id, element) {
    const isSelected = element.getAttribute('data-selected') === 'true';
    
    if (isSelected) {
        activeFilters[type].delete(id);
        element.setAttribute('data-selected', 'false');
    } else {
        activeFilters[type].add(id);
        element.setAttribute('data-selected', 'true');
    }

    applyFilters();
}

function toggleOrder(order, element) {
    // Deselect all order options
    document.querySelectorAll('[data-type="order"]').forEach(el => {
        el.setAttribute('data-selected', 'false');
    });
    
    activeFilters.order = order;
    element.setAttribute('data-selected', 'true');
    
    applyFilters();
}

function resetFilters() {
    // Clear active filters
    activeFilters.categories.clear();
    activeFilters.tags.clear();
    activeFilters.authors.clear();
    activeFilters.order = 'desc';

    // Reset UI
    document.querySelectorAll('[data-selected="true"]').forEach(el => {
        el.setAttribute('data-selected', 'false');
    });

    applyFilters();
}

function applyFilters() {
    const params = new URLSearchParams();
    
    // Add filter parameters
    for (const [type, values] of Object.entries(activeFilters)) {
        if (type === 'order') {
            if (values !== 'desc') { // Only add if not default
                params.set(type, values);
            }
        } else if (values.size > 0) {
            params.set(type, Array.from(values).join(','));
        }
    }

    // Update URL without reload
    const newUrl = `${window.location.pathname}${params.toString() ? '?' + params.toString() : ''}`;
    window.history.pushState({}, '', newUrl);

    // Fetch filtered results via AJAX
    fetchFilteredResults(params);
}

function fetchFilteredResults(params) {
    const grid = document.getElementById('votaciones-grid');
    grid.style.opacity = '0.5';

    fetch(`<?php echo admin_url('admin-ajax.php'); ?>?action=filter_votaciones&${params.toString()}`)
        .then(response => response.text())
        .then(html => {
            grid.innerHTML = html;
            grid.style.opacity = '1';
        })
        .catch(error => {
            console.error('Error:', error);
            grid.style.opacity = '1';
        });
}

function toggleMobileFilters() {
    const container = document.getElementById('filtersContainer');
    const buttonText = document.getElementById('filterButtonText');
    
    if (container.classList.contains('hidden')) {
        container.classList.remove('hidden');
        buttonText.textContent = 'Ocultar filtros';
    } else {
        container.classList.add('hidden');
        buttonText.textContent = 'Mostrar filtros';
    }
}
</script>