<?php
/**
 * The front page template file
 *
 * @package colombiahumana
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="py-32 relative">
        <!-- Background color layer -->
        <div class="absolute inset-0 bg-gray-200"></div>
        <!-- Grid overlay with mask -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,hsl(var(--muted))_1px,transparent_1px),linear-gradient(to_bottom,hsl(var(--muted))_1px,transparent_1px)] bg-[size:64px_64px] [mask-image:radial-gradient(ellipse_50%_100%_at_50%_50%,#000_60%,transparent_100%)]"></div>
        
        <div class="container relative">
            <div class="relative max-w-5xl">
                <h1 class="text-4xl font-extrabold leading-tight lg:text-6xl lg:leading-snug">
                    <span class="relative inline-block before:absolute before:-bottom-2 before:-left-4 before:-right-2 before:top-0 before:-z-10 before:rounded-lg before:bg-muted-foreground/15">
                        Asambleas Colombia Humana
                    </span>
                </h1>

                <p class="mt-7 text-xl font-light lg:text-2xl">
                    Un espacio democrático y participativo donde tu voz cuenta. Participa en las decisiones que darán forma al futuro de nuestra comunidad.
                </p>

                <div class="mt-8">
                    <a href="<?php echo esc_url(home_url('/votaciones')); ?>" 
                       class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white bg-black rounded-lg hover:bg-gray-800 transition duration-300">
                        Participar en Votaciones
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-black rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Voto Seguro</h3>
                    <p class="text-gray-600">Sistema de votación transparente y seguro para garantizar la integridad de cada decisión.</p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-black rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Participación Activa</h3>
                    <p class="text-gray-600">Forma parte de las decisiones importantes que afectan a nuestra comunidad.</p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-black rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Resultados en Tiempo Real</h3>
                    <p class="text-gray-600">Accede a los resultados de las votaciones de manera inmediata y transparente.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();