'use strict';

/**
 * MyPortfolio Core Projects admin interactions.
 */
document.addEventListener('DOMContentLoaded', () => {
    const workspace = document.querySelector('.mpc-project-workspace');

    if (!workspace) {
        return;
    }

    const tabs = Array.from(
        workspace.querySelectorAll('[data-mpc-tab]')
    );

    const panels = Array.from(
        workspace.querySelectorAll('[data-mpc-panel]')
    );

    /**
     * Activate one editor tab.
     *
     * @param {string} tabName
     */
    const activateTab = (tabName) => {
        tabs.forEach((tab) => {
            const isActive = tab.dataset.mpcTab === tabName;

            tab.classList.toggle('is-active', isActive);
            tab.setAttribute(
                'aria-selected',
                isActive ? 'true' : 'false'
            );
            tab.setAttribute(
                'tabindex',
                isActive ? '0' : '-1'
            );
        });

        panels.forEach((panel) => {
            const isActive = panel.dataset.mpcPanel === tabName;

            panel.classList.toggle('is-active', isActive);
            panel.hidden = !isActive;
        });

        try {
            window.sessionStorage.setItem(
                'mpcProjectActiveTab',
                tabName
            );
        } catch (error) {
            // Tab switching works without storage.
        }
    };

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => {
            activateTab(tab.dataset.mpcTab);
        });

        tab.addEventListener('keydown', (event) => {
            if (
                event.key !== 'ArrowRight'
                && event.key !== 'ArrowLeft'
            ) {
                return;
            }

            event.preventDefault();

            const direction = event.key === 'ArrowRight' ? 1 : -1;

            const nextIndex = (
                index + direction + tabs.length
            ) % tabs.length;

            tabs[nextIndex].focus();

            activateTab(
                tabs[nextIndex].dataset.mpcTab
            );
        });
    });

    let initialTab = 'overview';

    try {
        const storedTab = window.sessionStorage.getItem(
            'mpcProjectActiveTab'
        );

        if (
            storedTab
            && tabs.some(
                (tab) => tab.dataset.mpcTab === storedTab
            )
        ) {
            initialTab = storedTab;
        }
    } catch (error) {
        // Overview remains the fallback.
    }

    activateTab(initialTab);

    /**
     * Gallery manager.
     */
    const gallery = workspace.querySelector(
        '.mpc-project-gallery'
    );

    const galleryValue = workspace.querySelector(
        '.mpc-project-gallery-value'
    );

    const galleryButtons = Array.from(
        workspace.querySelectorAll(
            '.mpc-project-gallery-add'
        )
    );

    const galleryEmptyState = workspace.querySelector(
        '.mpc-project-gallery-empty'
    );

    let mediaFrame = null;

    /**
     * Return the gallery attachment IDs.
     *
     * @returns {number[]}
     */
    const getGalleryIds = () => {
        if (!galleryValue || !galleryValue.value) {
            return [];
        }

        return galleryValue.value
            .split(',')
            .map((value) => Number.parseInt(value, 10))
            .filter((value) => Number.isInteger(value) && value > 0);
    };

    /**
     * Update hidden gallery value from DOM order.
     */
    const updateGalleryValue = () => {
        if (!gallery || !galleryValue) {
            return;
        }

        const ids = Array.from(
            gallery.querySelectorAll(
                '.mpc-project-gallery__item'
            )
        )
            .map((item) => item.dataset.attachmentId)
            .filter(Boolean);

        galleryValue.value = ids.join(',');

        updateGalleryState();
    };

    /**
     * Toggle empty-state visibility.
     */
    const updateGalleryState = () => {
        if (!gallery || !galleryEmptyState) {
            return;
        }

        const hasImages = Boolean(
            gallery.querySelector(
                '.mpc-project-gallery__item'
            )
        );

        gallery.classList.toggle('is-empty', !hasImages);
        galleryEmptyState.hidden = hasImages;
    };

    /**
     * Create one gallery item.
     *
     * @param {Object} attachment
     * @returns {HTMLElement}
     */
    const createGalleryItem = (attachment) => {
        const item = document.createElement('article');

        item.className = 'mpc-project-gallery__item';
        item.dataset.attachmentId = String(attachment.id);

        const thumbnailUrl = (
            attachment.sizes
            && attachment.sizes.medium
            && attachment.sizes.medium.url
        )
            ? attachment.sizes.medium.url
            : attachment.url;

        item.innerHTML = `
            <div class="mpc-project-gallery__image">
                <img src="${thumbnailUrl}" alt="">
            </div>

            <div class="mpc-project-gallery__toolbar">
                <span
                    class="mpc-project-gallery__handle"
                    title="${myportfolioCoreProjects.dragText}"
                    aria-hidden="true"
                >
                    <span class="dashicons dashicons-move"></span>
                </span>

                <button
                    class="mpc-project-gallery__remove"
                    type="button"
                    aria-label="${myportfolioCoreProjects.removeText}"
                >
                    <span
                        class="dashicons dashicons-no-alt"
                        aria-hidden="true"
                    ></span>
                </button>
            </div>
        `;

        return item;
    };

    /**
     * Open the WordPress Media Library.
     */
    const openMediaFrame = () => {
        if (
            typeof window.wp === 'undefined'
            || !window.wp.media
        ) {
            return;
        }

        if (!mediaFrame) {
            mediaFrame = window.wp.media({
                title: myportfolioCoreProjects.mediaTitle,
                button: {
                    text: myportfolioCoreProjects.mediaButton,
                },
                library: {
                    type: 'image',
                },
                multiple: true,
            });

            mediaFrame.on('select', () => {
                if (!gallery) {
                    return;
                }

                const existingIds = getGalleryIds();

                const selection = mediaFrame
                    .state()
                    .get('selection')
                    .toJSON();

                selection.forEach((attachment) => {
                    if (existingIds.includes(attachment.id)) {
                        return;
                    }

                    gallery.appendChild(
                        createGalleryItem(attachment)
                    );

                    existingIds.push(attachment.id);
                });

                updateGalleryValue();
            });
        }

        mediaFrame.open();
    };

    galleryButtons.forEach((button) => {
        button.addEventListener('click', openMediaFrame);
    });

    if (gallery) {
        gallery.addEventListener('click', (event) => {
            const removeButton = event.target.closest(
                '.mpc-project-gallery__remove'
            );

            if (!removeButton) {
                return;
            }

            event.preventDefault();

            const item = removeButton.closest(
                '.mpc-project-gallery__item'
            );

            if (item) {
                item.remove();
                updateGalleryValue();
            }
        });
    }

    if (
        gallery
        && window.jQuery
        && window.jQuery.fn.sortable
    ) {
        window.jQuery(gallery).sortable({
            items: '.mpc-project-gallery__item',
            handle: '.mpc-project-gallery__handle',
            tolerance: 'pointer',
            placeholder: 'mpc-project-gallery__placeholder',
            update: updateGalleryValue,
        });
    }

    updateGalleryState();

    document.documentElement.classList.add(
        'myportfolio-core-projects-ready'
    );
});