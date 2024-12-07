<?php

/**
 * Template part for displaying breadcrumbs
 *
 * @package VotreTheme
 */

// Vérifiez si nous ne sommes pas sur la page d'accueil
if (!is_front_page()) :
?>
	<nav class="border-b mb-8" aria-label="Breadcrumb">
		<div class="container-large py-4">
			<ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse [&>li]:shrink-0">
				<li class="inline-flex items-center">
					<a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary dark:text-gray-400 dark:hover:text-white">
						<i class="fa-solid fa-house mr-2"></i>
						Accueil
					</a>
				</li>

				<?php
				if (is_singular('estates')) {
					echo '<li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="' . esc_url(get_post_type_archive_link('estates')) . '" class="ms-1 text-sm font-medium text-gray-700 hover:text-primary dark:text-gray-400 dark:hover:text-white">Biens</a>
                    </div>
                  </li>';
					// Ajoutez ensuite le titre du bien
					echo '<li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">' . get_the_title() . '</span>
                    </div>
                  </li>';
				} elseif (is_category() || is_single()) {
					// Pour les articles dans une catégorie
					$category = get_the_category();
					if ($category) {
						echo '<li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="' . esc_url(get_category_link($category[0]->term_id)) . '" class="ms-1 text-sm font-medium text-gray-700 hover:text-primary dark:text-gray-400 dark:hover:text-white">' . esc_html($category[0]->name) . '</a>
                    </div>
                  </li>';
					}
					if (is_single()) {
						echo '<li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">' . get_the_title() . '</span>
                    </div>
                  </li>';
					}
				} elseif (is_page()) {
					// Pour les pages
					if ($post->post_parent) {
						$parent_id  = $post->post_parent;
						$breadcrumbs = [];
						while ($parent_id) {
							$page = get_page($parent_id);
							$breadcrumbs[] = '<li>
                                        <div class="flex items-center">
                                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                            </svg>
                                            <a href="' . esc_url(get_permalink($page->ID)) . '" class="ms-1 text-sm font-medium text-gray-700 hover:text-primary dark:text-gray-400 dark:hover:text-white">' . get_the_title($page->ID) . '</a>
                                        </div>
                                      </li>';
							$parent_id = $page->post_parent;
						}
						$breadcrumbs = array_reverse($breadcrumbs);
						echo implode('', $breadcrumbs);
					}
					echo '<li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">' . get_the_title() . '</span>
                </div>
              </li>';
				}

				// Gérer les archives
				if (is_archive()) {
					echo '<li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">';

					// Titre de l'archive
					if (is_category()) {
						single_cat_title(); // Titre de la catégorie
					} elseif (is_tag()) {
						single_tag_title(); // Titre de l'étiquette
					} elseif (is_author()) {
						the_author(); // Nom de l'auteur
					} elseif (is_year()) {
						echo get_the_date('Y'); // Année
					} elseif (is_month()) {
						echo get_the_date('F Y'); // Mois
					} elseif (is_day()) {
						echo get_the_date('F j, Y'); // Jour
					} else {
						post_type_archive_title(); // Titre de l'archive pour les types de contenu personnalisé
					}

					echo '</span>
                    </div>
                  </li>';
				}
				?>
			</ol>
		</div>
	</nav>
<?php endif; ?>