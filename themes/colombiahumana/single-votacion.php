<?php
/**
 * Template for displaying single votacion posts
 *
 * @package colombiahumana
 */

get_header();
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<main id="primary" class="site-main">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('relative'); ?>>
            <!-- Background color layer -->
            <div class="absolute inset-0 bg-gray-200"></div>
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-[linear-gradient(to_right,hsl(var(--muted))_1px,transparent_1px),linear-gradient(to_bottom,hsl(var(--muted))_1px,transparent_1px)] bg-[size:64px_64px] [mask-image:radial-gradient(ellipse_50%_100%_at_50%_50%,#000_60%,transparent_100%)]"></div>

            <div class="container mx-auto px-4 py-32 relative">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Main Content Column -->
                    <div class="md:col-span-2">
                        <header class="entry-header mb-12 relative max-w-5xl">
                            <h1 class="text-4xl font-extrabold leading-tight lg:text-6xl lg:leading-snug relative inline-block before:absolute before:-bottom-2 before:-left-4 before:-right-2 before:top-0 before:-z-10 before:rounded-lg before:bg-muted-foreground/15">
                                <?php the_title(); ?>
                            </h1>
                            <?php 
                            $excerpt = get_the_excerpt();
                            if (!empty($excerpt)) : ?>
                                <p class="mt-7 text-xl font-light lg:text-2xl"><?php echo esc_html($excerpt); ?></p>
                            <?php endif; ?>
                            <div class="flex gap-4">
                                <a href="#form-section" class="inline-block mt-8 px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors" data-tab="participar">
                                    Participar ahora
                                </a>
                                <a href="#form-section" class="inline-block mt-8 px-6 py-3 border-2 border-black text-black rounded-lg hover:bg-gray-100 transition-colors" data-tab="resultados">
                                    Resultados
                                </a>
                            </div>
                        </header>
                    </div>

                    <!-- Sidebar Column -->
                    <div class="md:col-span-1">
                        <!-- Author Box -->
                        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                            <?php
                            $author_id = get_the_author_meta('ID');
                            $author_url = get_author_posts_url($author_id);
                            ?>
                            <a href="<?php echo esc_url($author_url); ?>" class="flex items-center space-x-4 no-underline">
                                <?php echo get_avatar($author_id, 60, '', '', array('class' => 'rounded-full')); ?>
                                <div>
                                    <p class="font-semibold text-gray-900"><?php the_author(); ?></p>
                                    <p class="text-sm text-gray-600"><?php echo get_the_date(); ?></p>
                                </div>
                            </a>
                        </div>

                        <!-- Taxonomies -->
                        <div class="bg-white rounded-lg shadow-sm p-4">
                            <?php
                            $taxonomies = get_object_taxonomies('votacion');
                            foreach ($taxonomies as $taxonomy) {
                                $terms = get_the_terms(get_the_ID(), $taxonomy);
                                if ($terms && !is_wp_error($terms)) {
                                    $tax_obj = get_taxonomy($taxonomy);
                                    echo '<h3 class="font-semibold mb-2">' . esc_html($tax_obj->labels->name) . '</h3>';
                                    echo '<div class="flex flex-wrap gap-2 mb-4">';
                                    foreach ($terms as $term) {
                                        echo '<span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">';
                                        echo esc_html($term->name);
                                        echo '</span>';
                                    }
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <!-- Form Section -->
        <section id="form-section" class="py-16 bg-white relative">
            <div class="container mx-auto px-4">
                <div class="max-w-7xl mx-auto">

                    <!-- counter -->
                    <?php 
                    $fecha_cierre = get_field('fecha_cierre', false, false); // Get raw value
                    
                    // Debug output
                    echo "<!-- Debug: fecha_cierre raw value: " . esc_html($fecha_cierre) . " -->";
                    
                    if ($fecha_cierre) {
                        // Convert the date from Y-m-d H:i:s format for JavaScript
                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $fecha_cierre);
                        
                        // More debug output
                        echo "<!-- Debug: parsed date: " . ($date ? $date->format('Y-m-d H:i:s') : 'Failed to parse') . " -->";
                        
                        if ($date) {
                            $close_date = $date->getTimestamp();
                            if ($close_date > time()) {
                                ?>
                                <div class="mb-8 text-center">
                                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-50 text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="font-medium">Esta votación cierra en: </span>
                                        <span id="countdown" class="ml-2 font-semibold" data-close="<?php echo esc_attr($date->format('Y-m-d H:i:s')); ?>">
                                            Calculando...
                                        </span>
                                    </div>
                                </div>
                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const countdownElement = document.getElementById('countdown');
                                    const closeDate = new Date(countdownElement.dataset.close).getTime();

                                    function updateCountdown() {
                                        const now = new Date().getTime();
                                        const distance = closeDate - now;

                                        if (distance < 0) {
                                            countdownElement.parentElement.innerHTML = 'Esta votación ha finalizado';
                                            return;
                                        }

                                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                        let countdownText = '';
                                        if (days > 0) countdownText += `${days}d `;
                                        if (hours > 0 || days > 0) countdownText += `${hours}h `;
                                        if (minutes > 0 || hours > 0 || days > 0) countdownText += `${minutes}m `;
                                        countdownText += `${seconds}s`;

                                        countdownElement.textContent = countdownText;
                                    }

                                    updateCountdown();
                                    setInterval(updateCountdown, 1000);
                                });
                                </script>
                                <?php
                            }
                        }
                    }
                    ?>
                    
                    <!-- Tab buttons -->
                    <div class="border-b border-gray-200 mb-8">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button class="border-primary-500 text-primary-600 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium" aria-current="page" id="tab-participar">
                                Participar
                            </button>
                            <button class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium" id="tab-resultados">
                                Resultados
                            </button>
                        </nav>
                    </div>

                    <!-- Tab content -->
                    <div class="tab-content" id="content-participar">
                        <?php 
                        $formulario = get_field('formulario');
                        if ($formulario) {
                            echo do_shortcode($formulario);
                        }
                        ?>
                    </div>
                    <div class="tab-content hidden" id="content-resultados">
                        <?php
                        // Get form ID from shortcode
                        $form_id = null;
                        if ($formulario) {
                            // Extract form ID from shortcode like [formidable id=2]
                            preg_match('/id=(\d+)/', $formulario, $matches);
                            if (isset($matches[1])) {
                                $form_id = (int)$matches[1];
                            }
                        }

                        if ($form_id && class_exists('FrmForm')) {
                            global $wpdb;
                            $form = FrmForm::getOne($form_id);
                            
                            if ($form) {
                                // Debug: Output form ID
                                echo "<script>console.log('Form ID:', " . json_encode($form_id) . ");</script>";
                                
                                // Get all entries for this form
                                $entries_table = $wpdb->prefix . 'frm_items';
                                $total_responses = $wpdb->get_var($wpdb->prepare(
                                    "SELECT COUNT(*) FROM {$entries_table} WHERE form_id = %d",
                                    $form_id
                                ));

                                // Get all radio fields in the form
                                $radio_fields = FrmField::get_all_types_in_form($form_id, 'radio');
                                
                                // Debug: Output radio fields info
                                echo "<script>console.log('Number of radio fields found:', " . count($radio_fields) . ");</script>";
                                $fields_debug = array_map(function($field) {
                                    return array(
                                        'id' => $field->id,
                                        'name' => $field->name,
                                        'type' => $field->type
                                    );
                                }, $radio_fields);
                                echo "<script>console.log('Radio fields:', " . json_encode($fields_debug) . ");</script>";

                                if (!empty($radio_fields) && $total_responses > 0) {
                                    // Fetch all entries for all fields at once
                                    $meta_table = $wpdb->prefix . 'frm_item_metas';
                                    $field_ids = array_map(function($field) { return $field->id; }, $radio_fields);
                                    $field_ids_string = implode(',', $field_ids);
                                    
                                    // Debug: Output field IDs being queried
                                    echo "<script>console.log('Querying field IDs:', " . json_encode($field_ids) . ");</script>";
                                    
                                    $all_entries = $wpdb->get_results($wpdb->prepare(
                                        "SELECT field_id, meta_value FROM {$meta_table} WHERE field_id IN (" . $field_ids_string . ")"
                                    ));
                                    
                                    // Debug: Output entries count per field
                                    $entries_count_by_field = array();
                                    foreach ($all_entries as $entry) {
                                        if (!isset($entries_count_by_field[$entry->field_id])) {
                                            $entries_count_by_field[$entry->field_id] = 0;
                                        }
                                        $entries_count_by_field[$entry->field_id]++;
                                    }
                                    echo "<script>console.log('Entries count per field:', " . json_encode($entries_count_by_field) . ");</script>";
                                    
                                    // Organize entries by field_id
                                    $entries_by_field = array();
                                    foreach ($all_entries as $entry) {
                                        if (!isset($entries_by_field[$entry->field_id])) {
                                            $entries_by_field[$entry->field_id] = array();
                                        }
                                        $entries_by_field[$entry->field_id][] = $entry->meta_value;
                                    }
                                    ?>
                                    <div class="max-w-4xl mx-auto">
                                        <p class="text-lg font-semibold mb-6 text-center">Total de respuestas: <?php echo $total_responses; ?></p>
                                        
                                        <?php foreach ($radio_fields as $index => $radio_field): ?>
                                            <div class="mb-12 p-6 bg-white rounded-lg shadow-sm">
                                                <h3 class="text-xl font-semibold mb-6"><?php echo esc_html($radio_field->name); ?></h3>
                                                
                                                <?php
                                                // Get field options and initialize counts
                                                $field_counts = array();
                                                $field_options = maybe_unserialize($radio_field->options);
                                                $field_labels = array();
                                                
                                                // Process options to get labels
                                                foreach ($field_options as $key => $option) {
                                                    if (is_array($option)) {
                                                        $label = isset($option['label']) ? $option['label'] : $option['value'];
                                                        $value = isset($option['value']) ? $option['value'] : $key;
                                                    } else {
                                                        $label = $option;
                                                        $value = $key;
                                                    }
                                                    $field_labels[$value] = $label;
                                                    $field_counts[$label] = 0;
                                                }

                                                // Count responses using pre-fetched entries
                                                if (isset($entries_by_field[$radio_field->id])) {
                                                    foreach ($entries_by_field[$radio_field->id] as $value) {
                                                        if (isset($field_labels[$value])) {
                                                            $label = $field_labels[$value];
                                                            $field_counts[$label]++;
                                                        }
                                                    }
                                                }

                                                // Prepare data for Chart.js
                                                $labels = array_keys($field_counts);
                                                $data = array_values($field_counts);
                                                
                                                // Add debug output
                                                error_log('Processing field ' . $radio_field->id . ': ' . json_encode($field_counts));
                                                ?>
                                                
                                                <canvas id="resultsChart<?php echo $index; ?>" class="mb-8"></canvas>
                                                
                                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                                                    <?php foreach ($field_counts as $label => $count): ?>
                                                    <div class="bg-gray-50 p-4 rounded-lg">
                                                        <h4 class="font-medium text-gray-900"><?php echo esc_html($label); ?></h4>
                                                        <p class="text-2xl font-bold text-primary-600"><?php echo $count; ?></p>
                                                        <p class="text-sm text-gray-500"><?php echo round(($count / $total_responses) * 100, 1); ?>%</p>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>

                                                <script>
                                                (function() {
                                                    // Store chart configuration
                                                    const chartConfig<?php echo $index; ?> = {
                                                        type: 'bar',
                                                        data: {
                                                            labels: <?php echo json_encode($labels); ?>,
                                                            datasets: [{
                                                                label: 'Número de respuestas',
                                                                data: <?php echo json_encode($data); ?>,
                                                                backgroundColor: 'rgba(79, 70, 229, 0.8)',
                                                                borderColor: 'rgba(79, 70, 229, 1)',
                                                                borderWidth: 1
                                                            }]
                                                        },
                                                        options: {
                                                            responsive: true,
                                                            maintainAspectRatio: true,
                                                            scales: {
                                                                y: {
                                                                    beginAtZero: true,
                                                                    ticks: {
                                                                        stepSize: 1
                                                                    }
                                                                }
                                                            },
                                                            plugins: {
                                                                legend: {
                                                                    display: false
                                                                }
                                                            }
                                                        }
                                                    };

                                                    let chart<?php echo $index; ?> = null;

                                                    // Function to initialize or update chart
                                                    function initializeChart() {
                                                        const canvas = document.getElementById('resultsChart<?php echo $index; ?>');
                                                        if (!canvas) return;
                                                        
                                                        const ctx = canvas.getContext('2d');
                                                        if (!ctx) return;

                                                        // If chart exists, destroy it first
                                                        if (chart<?php echo $index; ?>) {
                                                            chart<?php echo $index; ?>.destroy();
                                                        }

                                                        // Create new chart instance
                                                        chart<?php echo $index; ?> = new Chart(ctx, chartConfig<?php echo $index; ?>);
                                                    }

                                                    // Initialize chart when DOM is ready
                                                    if (document.readyState === 'loading') {
                                                        document.addEventListener('DOMContentLoaded', initializeChart);
                                                    } else {
                                                        initializeChart();
                                                    }

                                                    // Update chart when switching tabs
                                                    const tabResultados = document.getElementById('tab-resultados');
                                                    if (tabResultados) {
                                                        tabResultados.addEventListener('click', function() {
                                                            // Small delay to ensure the canvas is visible
                                                            setTimeout(() => {
                                                                if (!chart<?php echo $index; ?>) {
                                                                    initializeChart();
                                                                } else {
                                                                    chart<?php echo $index; ?>.update();
                                                                }
                                                            }, 100);
                                                        });
                                                    }
                                                })();
                                                </script>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="text-center py-12">
                                        <p class="text-gray-500">No hay respuestas disponibles todavía.</p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="text-center py-12">
                                    <p class="text-gray-500">No se encontró el formulario.</p>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="text-center py-12">
                                <p class="text-gray-500">Formidable Forms no está instalado o activado.</p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
</main>

<?php
get_footer();
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = {
        'tab-participar': 'content-participar',
        'tab-resultados': 'content-resultados'
    };

    // Handle tab button clicks
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

    // Handle CTA buttons with data-tab attribute
    document.querySelectorAll('a[data-tab]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const formSection = document.querySelector('#form-section');
            formSection.scrollIntoView({ behavior: 'smooth' });
            document.getElementById(`tab-${this.dataset.tab}`).click();
        });
    });
});
</script>