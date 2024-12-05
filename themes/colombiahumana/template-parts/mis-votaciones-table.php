<?php
// Get current user ID
$current_user_id = get_current_user_id();

if (!$current_user_id) {
    ?>
    <div class="text-center py-8">
        <p class="text-gray-500">Debes iniciar sesión para ver tus votaciones.</p>
        <a href="<?php echo wp_login_url(get_permalink()); ?>" class="inline-block mt-4 px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
            Iniciar sesión
        </a>
    </div>
    <?php
    return;
}

// Get form entries for the current user
$entries = FrmEntry::getAll(
    array(
        'it.user_id' => $current_user_id,
        'it.is_draft' => 0
    ),
    ' ORDER BY it.created_at DESC'
);

if (empty($entries)) {
    ?>
    <div class="text-center py-8">
        <p class="text-gray-500">Aún no has participado en ninguna votación.</p>
    </div>
    <?php
    return;
}
?>

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Fecha
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Votación
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Estado
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($entries as $entry) : 
                $form = FrmForm::getOne($entry->form_id);
                $created_at = new DateTime($entry->created_at);
                $entry_url = add_query_arg('entry', $entry->id, home_url('/ver-votacion/'));
                ?>
                <tr class="hover:bg-gray-50 cursor-pointer transition-colors duration-150" onclick="window.location='<?php echo esc_url($entry_url); ?>'">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?php echo $created_at->format('d/m/Y H:i'); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            <?php echo esc_html($form->name); ?>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Completada
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <a href="<?php echo esc_url($entry_url); ?>" 
                           class="text-primary-600 hover:text-primary-900"
                           onclick="event.stopPropagation();">
                            Ver detalles
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
