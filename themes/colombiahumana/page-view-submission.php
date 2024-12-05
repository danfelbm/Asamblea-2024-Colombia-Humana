<?php
/**
 * Template Name: View Submission
 */

get_header();

// Check if user is logged in
if (!is_user_logged_in()) {
    ?>
    <div class="container mx-auto px-4 py-8 text-center">
        <p class="text-gray-500">Debes iniciar sesión para ver esta página.</p>
        <a href="<?php echo wp_login_url(get_permalink()); ?>" class="inline-block mt-4 px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
            Iniciar sesión
        </a>
    </div>
    <?php
    get_footer();
    return;
}

// Get entry ID from URL
$entry_id = isset($_GET['entry']) ? intval($_GET['entry']) : 0;

if (!$entry_id) {
    ?>
    <div class="container mx-auto px-4 py-8 text-center">
        <p class="text-gray-500">No se especificó ninguna entrada para ver.</p>
    </div>
    <?php
    get_footer();
    return;
}

// Check if the entry belongs to the current user
$entry = FrmEntry::getOne($entry_id);
if (!$entry || $entry->user_id != get_current_user_id()) {
    ?>
    <div class="container mx-auto px-4 py-8 text-center">
        <p class="text-gray-500">No tienes permiso para ver esta entrada.</p>
    </div>
    <?php
    get_footer();
    return;
}

// Get the form
$form = FrmForm::getOne($entry->form_id);
?>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="px-4 sm:px-0">
            <h3 class="text-base/7 font-semibold text-gray-900">Detalles de la Votación</h3>
            <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">Información de tu participación en la votación.</p>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm/6 font-medium text-gray-900">Token único</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo esc_html($entry->item_key); ?></dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm/6 font-medium text-gray-900">Votación</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo esc_html($form->name); ?></dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm/6 font-medium text-gray-900">Fecha de participación</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo esc_html(date_i18n('d/m/Y H:i:s', strtotime($entry->created_at))); ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm/6 font-medium text-gray-900">Respuestas</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo FrmEntriesController::show_entry_shortcode(array('id' => $entry_id, 'plain_text' => 0)); ?>
                    </dd>
                </div>
            </dl>
        </div>
        <div class="mt-6 flex justify-end">
            <a href="<?php echo esc_url(home_url('/votaciones/')); ?>" 
               class="text-sm font-semibold leading-6 text-primary-600 hover:text-primary-500">
                &larr; Volver a votaciones
            </a>
        </div>
    </div>
</div>
<?php
get_footer();
?>
