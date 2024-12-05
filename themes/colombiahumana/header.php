<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package colombiahumana
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://www.shadcnblocks.com/_astro/index.By6RUMn0.css">
	<script>
		tailwind.config = {
		theme: {
			extend: {
			colors: {
				clifford: '#da373d',
			}
			}
		}
		}
	</script>
	<?php wp_head(); ?>
	<script src="https://unpkg.com/htmx.org"></script>
  	<script src="https://unpkg.com/htmx.org@1.9.12/dist/ext/client-side-templates.js"></script>
  	<script src="https://unpkg.com/mustache@latest"></script>
	<script>
		// Mobile menu functionality
		document.addEventListener('DOMContentLoaded', function() {
			const burger = document.querySelectorAll('.burger-menu');
			const nav = document.querySelector('#mobile-menu');
			const header = document.querySelector('header');

			burger.forEach(btn => {
				btn.addEventListener('click', (e) => {
					e.stopPropagation();
					nav.classList.toggle('hidden');
					document.body.classList.toggle('overflow-hidden');
					// Toggle aria-expanded
					const isExpanded = nav.classList.contains('hidden') ? 'false' : 'true';
					burger.forEach(b => b.setAttribute('aria-expanded', isExpanded));
				});
			});

			// Close menu when clicking outside
			document.addEventListener('click', (e) => {
				if (!header.contains(e.target) && !e.target.closest('.mobile-footer-nav')) {
					nav.classList.add('hidden');
					document.body.classList.remove('overflow-hidden');
					burger.forEach(b => b.setAttribute('aria-expanded', 'false'));
				}
			});
		});
	</script>
</head>

<body <?php body_class('bg-gray-100 pb-16 md:pb-0'); ?>>
<?php wp_body_open(); ?>
<div id="page" class="min-h-screen">
	<header class="sticky top-0 z-40 w-full bg-black">
		<div class="container flex h-16 items-center justify-center px-4">
			<div class="flex items-center">
				<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="flex items-center space-x-2">
					<img src="<?php echo esc_url('/wp-content/uploads/2024/12/logoch-blanco.png'); ?>" alt="Logo" class="h-8 w-auto">
				</a>
			</div>
			<!-- Desktop Navigation -->
			<nav class="hidden md:flex items-center space-x-6 ml-6">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="text-sm font-medium text-white transition-colors hover:text-gray-300">Inicio</a>
				<a href="<?php echo esc_url(home_url('/votaciones')); ?>" class="text-sm font-medium text-white transition-colors hover:text-gray-300">Votaciones</a>
				<a href="<?php echo esc_url(home_url('/ayuda')); ?>" class="text-sm font-medium text-white transition-colors hover:text-gray-300">Ayuda</a>
				<a href="<?php echo esc_url(home_url('/plataforma')); ?>" class="text-sm font-medium text-white transition-colors hover:text-gray-300">Plataforma</a>
			</nav>
			<div class="hidden md:flex items-center space-x-4 ml-auto">
				<?php if (is_user_logged_in()): ?>
					<div class="flex items-center space-x-2">
						<span class="text-sm text-white"><?php echo wp_get_current_user()->display_name; ?></span>
						<a href="<?php echo wp_logout_url(home_url()); ?>" class="text-sm text-white hover:text-gray-300">Salir</a>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<!-- Mobile Navigation Menu -->
		<div id="mobile-menu" class="hidden md:hidden fixed inset-0 bg-black bg-opacity-95 z-50">
			<div class="container px-4 py-6">
				<button class="burger-menu absolute top-5 right-4 p-2 text-white hover:text-gray-300" aria-expanded="false" aria-label="Toggle menu">
					<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
				</button>
				<nav class="flex flex-col space-y-4 mt-12">
					<a href="<?php echo esc_url(home_url('/')); ?>" class="text-lg font-medium text-white transition-colors hover:text-gray-300">Inicio</a>
					<a href="<?php echo esc_url(home_url('/votaciones')); ?>" class="text-lg font-medium text-white transition-colors hover:text-gray-300">Votaciones</a>
					<a href="<?php echo esc_url(home_url('/ayuda')); ?>" class="text-lg font-medium text-white transition-colors hover:text-gray-300">Ayuda</a>
					<a href="<?php echo esc_url(home_url('/plataforma')); ?>" class="text-lg font-medium text-white transition-colors hover:text-gray-300">Plataforma</a>
					<?php if (is_user_logged_in()): ?>
						<div class="pt-4 border-t border-gray-700">
							<span class="block text-sm text-white mb-2"><?php echo wp_get_current_user()->display_name; ?></span>
							<a href="<?php echo wp_logout_url(home_url()); ?>" class="text-sm text-white hover:text-gray-300">Salir</a>
						</div>
					<?php endif; ?>
				</nav>
			</div>
		</div>
	</header>

	<!-- Mobile Footer Navigation -->
	<nav class="md:hidden fixed bottom-0 left-0 right-0 bg-black z-40 mobile-footer-nav">
		<div class="grid grid-cols-4 h-16">
			<a href="<?php echo esc_url(home_url('/votaciones')); ?>" class="flex flex-col items-center justify-center text-white hover:text-gray-300">
				<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
				</svg>
				<span class="text-xs mt-1">Votaciones</span>
			</a>
			<a href="<?php echo esc_url(home_url('/ayuda')); ?>" class="flex flex-col items-center justify-center text-white hover:text-gray-300">
				<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
				</svg>
				<span class="text-xs mt-1">Ayuda</span>
			</a>
			<a href="<?php echo esc_url(home_url('/plataforma')); ?>" class="flex flex-col items-center justify-center text-white hover:text-gray-300">
				<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
				</svg>
				<span class="text-xs mt-1">Plataforma</span>
			</a>
			<button class="burger-menu flex flex-col items-center justify-center text-white hover:text-gray-300" aria-expanded="false" aria-label="Toggle menu">
				<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
				</svg>
				<span class="text-xs mt-1">Menú</span>
			</button>
		</div>
	</nav>

	<div id="content">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'colombiahumana' ); ?></a>
