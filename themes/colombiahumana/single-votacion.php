<?php
/**
 * Template for displaying single votacion posts
 *
 * @package colombiahumana
 */

get_header();
?>

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
                            <a href="#form-section" class="inline-block mt-8 px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                                Participar ahora
                            </a>
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
                    <?php 
                    $formulario = get_field('formulario');
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

                    if ($formulario) {
                        echo do_shortcode($formulario);
                    }
                    ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
</main>

<?php
get_footer();