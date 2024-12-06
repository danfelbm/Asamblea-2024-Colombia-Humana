<?php
get_header();

$current_user = get_queried_object();
$user_meta = get_user_meta($current_user->ID);
?>

<main class="container mx-auto px-4 py-8">
  <div class="max-w-4xl mx-auto">
    <!-- Profile -->
    <div class="flex items-center gap-x-3">
      <div class="shrink-0">
        <?php echo get_avatar($current_user->ID, 64, '', '', array('class' => 'shrink-0 size-16 rounded-full')); ?>
      </div>

      <div class="grow">
        <h1 class="text-lg font-medium text-black">
          <?php echo esc_html($current_user->display_name); ?>
        </h1>
        <p class="text-sm text-black">
          <?php echo esc_html($user_meta['occupation'][0] ?? ''); ?>
        </p>
      </div>
    </div>
    <!-- End Profile -->

    <!-- About -->
    <div class="mt-8">
      <p class="text-sm text-black">
        <?php echo esc_html($user_meta['description'][0] ?? ''); ?>
      </p>

      <ul class="mt-5 flex flex-col gap-y-3">
        <?php if (!empty($user_meta['email'][0])): ?>
        <li class="flex items-center gap-x-2.5">
          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
          <a class="text-[13px] text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" href="mailto:<?php echo esc_attr($user_meta['email'][0]); ?>">
            <?php echo esc_html($user_meta['email'][0]); ?>
          </a>
        </li>
        <?php endif; ?>

        <?php if (!empty($user_meta['twitter'][0])): ?>
        <li class="flex items-center gap-x-2.5">
          <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.1881 10.1624L22.7504 0H20.7214L13.2868 8.82385L7.34878 0H0.5L9.47944 13.3432L0.5 24H2.5291L10.3802 14.6817L16.6512 24H23.5L14.1881 10.1624ZM11.409 13.4608L3.26021 1.55962H6.37679L20.7224 22.5113H17.6058L11.409 13.4613V13.4608Z" fill="currentColor"/></svg>
          <a class="text-[13px] text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" href="https://twitter.com/<?php echo esc_attr($user_meta['twitter'][0]); ?>">
            @<?php echo esc_html($user_meta['twitter'][0]); ?>
          </a>
        </li>
        <?php endif; ?>

        <?php if (!empty($user_meta['website'][0])): ?>
        <li class="flex items-center gap-x-2.5">
          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M19.13 5.09C15.22 9.14 10 10.44 2.25 10.94"/><path d="M21.75 12.84c-6.62-1.41-12.14 1-16.38 6.32"/><path d="M8.56 2.75c4.37 6 6 9.42 8 17.72"/></svg>
          <a class="text-[13px] text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" href="<?php echo esc_url($user_meta['website'][0]); ?>">
            <?php echo esc_html($user_meta['website'][0]); ?>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
    <!-- End About -->
  </div>
</main>

<?php get_footer(); ?>
