<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package colombiahumana
 */

?>

	</div><!-- #content -->

	<footer class="border-t bg-white">
		<div class="container mx-auto px-4 py-6">
			<div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
				<div class="flex items-center space-x-4">
					<img src="<?php echo esc_url('/wp-content/uploads/2024/12/logoch-blanco.png'); ?>" alt="Logo" class="h-6 w-auto invert">
					<p class="text-sm text-gray-500"> Colombia Humana. Todos los derechos reservados.</p>
				</div>
				<div class="flex items-center space-x-6">
					<a href="<?php echo esc_url(home_url('/privacidad')); ?>" class="text-sm text-gray-500 hover:text-gray-900">Política de Privacidad</a>
					<a href="<?php echo esc_url(home_url('/terminos')); ?>" class="text-sm text-gray-500 hover:text-gray-900">Términos de Uso</a>
					<a href="<?php echo esc_url(home_url('/contacto')); ?>" class="text-sm text-gray-500 hover:text-gray-900">Contacto</a>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
