'use strict';

/**
 * MyPortfolio Core
 * Projects admin interactions.
 */

document.addEventListener('DOMContentLoaded', () => {
    const workspace = document.querySelector('.mpc-project-workspace');

    if (!workspace) {
        return;
    }

    /* ======================================================
       Helpers
    ====================================================== */

    /**
     * Safely escape a value before inserting it into HTML.
     *
     * @param {string} value
     * @returns {string}
     */
    const escapeHtml = (value) => {
        const element = document.createElement('div');

        element.textContent = String(value ?? '');

        return element.innerHTML;
    };

    /* ======================================================
       Editor tabs
    ====================================================== */

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
                && event.key !== 'Home'
                && event.key !== 'End'
            ) {
                return;
            }

            event.preventDefault();

            let nextIndex = index;

            if (event.key === 'ArrowRight') {
                nextIndex = (index + 1) % tabs.length;
            }

            if (event.key === 'ArrowLeft') {
                nextIndex = (
                    index - 1 + tabs.length
                ) % tabs.length;
            }

            if (event.key === 'Home') {
                nextIndex = 0;
            }

            if (event.key === 'End') {
                nextIndex = tabs.length - 1;
            }

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

        const storedTabExists = tabs.some(
            (tab) => tab.dataset.mpcTab === storedTab
        );

        if (storedTab && storedTabExists) {
            initialTab = storedTab;
        }
    } catch (error) {
        // Overview remains the fallback.
    }

    activateTab(initialTab);

    /* ======================================================
       Project gallery
    ====================================================== */

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

    let galleryMediaFrame = null;

    /**
     * Return saved gallery attachment IDs.
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
            .filter(
                (value) => Number.isInteger(value) && value > 0
            );
    };

    /**
     * Update gallery empty-state visibility.
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
     * Update hidden gallery value using current DOM order.
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

        const labels = window.myportfolioCoreProjects || {};

        const dragText = labels.dragText || 'Drag to reorder';
        const removeText = labels.removeText || 'Remove image';

        item.innerHTML = `
            <div class="mpc-project-gallery__image">
                <img
                    src="${escapeHtml(thumbnailUrl)}"
                    alt=""
                >
            </div>

            <div class="mpc-project-gallery__toolbar">
                <span
                    class="mpc-project-gallery__handle"
                    title="${escapeHtml(dragText)}"
                    aria-hidden="true"
                >
                    <span
                        class="dashicons dashicons-move"
                    ></span>
                </span>

                <button
                    class="mpc-project-gallery__remove"
                    type="button"
                    aria-label="${escapeHtml(removeText)}"
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
     * Open the WordPress Media Library for gallery images.
     */
    const openGalleryMediaFrame = () => {
        if (
            typeof window.wp === 'undefined'
            || !window.wp.media
        ) {
            return;
        }

        const labels = window.myportfolioCoreProjects || {};

        if (!galleryMediaFrame) {
            galleryMediaFrame = window.wp.media({
                title:
                    labels.mediaTitle
                    || 'Select Project Gallery Images',

                button: {
                    text:
                        labels.mediaButton
                        || 'Use Selected Images',
                },

                library: {
                    type: 'image',
                },

                multiple: true,
            });

            galleryMediaFrame.on('select', () => {
                if (!gallery) {
                    return;
                }

                const existingIds = getGalleryIds();

                const selection = galleryMediaFrame
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

        galleryMediaFrame.open();
    };

    galleryButtons.forEach((button) => {
        button.addEventListener(
            'click',
            openGalleryMediaFrame
        );
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
            placeholder:
                'mpc-project-gallery__placeholder',
            update: updateGalleryValue,
        });
    }

    updateGalleryState();

    /* ======================================================
       SEO character counters and preview
    ====================================================== */

    const seoTitle = workspace.querySelector(
        '#mpc-project-seo-title'
    );

    const seoDescription = workspace.querySelector(
        '#mpc-project-seo-description'
    );

    const seoTitlePreview = workspace.querySelector(
        '[data-mpc-seo-preview-title]'
    );

    const seoDescriptionPreview = workspace.querySelector(
        '[data-mpc-seo-preview-description]'
    );

    /**
     * Update one character counter.
     *
     * @param {HTMLInputElement|HTMLTextAreaElement|null} field
     */
    const updateCharacterCount = (field) => {
        if (!field) {
            return;
        }

        const counter = workspace.querySelector(
            `[data-mpc-count-for="${field.id}"]`
        );

        if (counter) {
            counter.textContent = String(
                field.value.length
            );
        }
    };

    if (seoTitle) {
        seoTitle.addEventListener('input', () => {
            updateCharacterCount(seoTitle);

            if (seoTitlePreview) {
                seoTitlePreview.textContent = (
                    seoTitle.value.trim()
                    || 'Project SEO title preview'
                );
            }
        });

        updateCharacterCount(seoTitle);
    }

    if (seoDescription) {
        seoDescription.addEventListener('input', () => {
            updateCharacterCount(seoDescription);

            if (seoDescriptionPreview) {
                seoDescriptionPreview.textContent = (
                    seoDescription.value.trim()
                    || 'Your project meta description will appear here.'
                );
            }
        });

        updateCharacterCount(seoDescription);
    }

    /* ======================================================
       Open Graph image
    ====================================================== */

    const ogImageField = workspace.querySelector(
        '.mpc-project-og-image-value'
    );

    const ogImageContainer = workspace.querySelector(
        '.mpc-project-og-image'
    );

    const ogImagePreview = workspace.querySelector(
        '.mpc-project-og-image__preview'
    );

    const ogImageSelectButton = workspace.querySelector(
        '.mpc-project-og-image-select'
    );

    const ogImageRemoveButton = workspace.querySelector(
        '.mpc-project-og-image-remove'
    );

    let ogImageFrame = null;

    if (ogImageSelectButton) {
        ogImageSelectButton.addEventListener(
            'click',
            () => {
                if (
                    typeof window.wp === 'undefined'
                    || !window.wp.media
                ) {
                    return;
                }

                const labels =
                    window.myportfolioCoreProjects || {};

                if (!ogImageFrame) {
                    ogImageFrame = window.wp.media({
                        title:
                            labels.ogMediaTitle
                            || 'Select Social Preview Image',

                        button: {
                            text:
                                labels.ogMediaButton
                                || 'Use This Image',
                        },

                        library: {
                            type: 'image',
                        },

                        multiple: false,
                    });

                    ogImageFrame.on('select', () => {
                        const attachment = ogImageFrame
                            .state()
                            .get('selection')
                            .first()
                            .toJSON();

                        const previewUrl = (
                            attachment.sizes
                            && attachment.sizes.medium
                        )
                            ? attachment.sizes.medium.url
                            : attachment.url;

                        if (ogImageField) {
                            ogImageField.value = String(
                                attachment.id
                            );
                        }

                        if (ogImagePreview) {
                            ogImagePreview.innerHTML = `
                                <img
                                    src="${escapeHtml(previewUrl)}"
                                    alt=""
                                >
                            `;
                        }

                        if (ogImageContainer) {
                            ogImageContainer.classList.remove(
                                'is-empty'
                            );

                            ogImageContainer.classList.add(
                                'has-image'
                            );
                        }

                        if (ogImageRemoveButton) {
                            ogImageRemoveButton.hidden = false;
                        }
                    });
                }

                ogImageFrame.open();
            }
        );
    }

    if (ogImageRemoveButton) {
        ogImageRemoveButton.addEventListener(
            'click',
            () => {
                if (ogImageField) {
                    ogImageField.value = '';
                }

                if (ogImagePreview) {
                    ogImagePreview.innerHTML = '';
                }

                if (ogImageContainer) {
                    ogImageContainer.classList.remove(
                        'has-image'
                    );

                    ogImageContainer.classList.add(
                        'is-empty'
                    );
                }

                ogImageRemoveButton.hidden = true;
            }
        );
    }

    /* ======================================================
       Content repeaters
    ====================================================== */

    const featuresContainer = workspace.querySelector(
        '[data-mpc-features]'
    );

    const featuresEmpty = workspace.querySelector(
        '[data-mpc-features-empty]'
    );

    const addFeatureButton = workspace.querySelector(
        '[data-mpc-add-feature]'
    );

    const statisticsContainer = workspace.querySelector(
        '[data-mpc-statistics]'
    );

    const statisticsEmpty = workspace.querySelector(
        '[data-mpc-statistics-empty]'
    );

    const addStatisticButton = workspace.querySelector(
        '[data-mpc-add-statistic]'
    );

    /**
     * Reindex repeater field names.
     *
     * @param {HTMLElement|null} container
     * @param {string} fieldName
     */
    const reindexRepeater = (
        container,
        fieldName
    ) => {
        if (!container) {
            return;
        }

        const items = Array.from(
            container.querySelectorAll(
                '.mpc-project-repeater__item'
            )
        );

        items.forEach((item, index) => {
            const inputs = item.querySelectorAll(
                'input, textarea, select'
            );

            inputs.forEach((input) => {
                if (!input.name) {
                    return;
                }

                const pattern = new RegExp(
                    `${fieldName}\\[\\d+\\]`
                );

                input.name = input.name.replace(
                    pattern,
                    `${fieldName}[${index}]`
                );
            });
        });
    };

    /**
     * Toggle one repeater empty state.
     *
     * @param {HTMLElement|null} container
     * @param {HTMLElement|null} emptyState
     */
    const updateRepeaterEmptyState = (
        container,
        emptyState
    ) => {
        if (!container || !emptyState) {
            return;
        }

        const hasItems = Boolean(
            container.querySelector(
                '.mpc-project-repeater__item'
            )
        );

        emptyState.hidden = hasItems;
    };

    /**
     * Create one feature row.
     *
     * @returns {HTMLElement}
     */
    const createFeatureItem = () => {
        const index = featuresContainer
            ? featuresContainer.querySelectorAll(
                '[data-mpc-feature-item]'
            ).length
            : 0;

        const item = document.createElement('div');

        item.className =
            'mpc-project-repeater__item';

        item.dataset.mpcFeatureItem = '';

        item.innerHTML = `
            <span
                class="mpc-project-repeater__handle"
                aria-hidden="true"
            >
                <span
                    class="dashicons dashicons-move"
                ></span>
            </span>

            <div
                class="mpc-project-repeater__fields"
            >
                <div class="mpc-form-field">
                    <label class="mpc-form-label">
                        Icon
                    </label>

                    <input
                        class="mpc-input"
                        type="text"
                        name="mpc_project_features[${index}][icon]"
                        value="yes-alt"
                        placeholder="yes-alt"
                    >
                </div>

                <div class="mpc-form-field">
                    <label class="mpc-form-label">
                        Feature
                    </label>

                    <input
                        class="mpc-input"
                        type="text"
                        name="mpc_project_features[${index}][title]"
                        value=""
                        placeholder="Appointment booking"
                    >
                </div>
            </div>

            <button
                class="mpc-project-repeater__remove"
                type="button"
                data-mpc-remove-item
                aria-label="Remove feature"
            >
                <span
                    class="dashicons dashicons-trash"
                    aria-hidden="true"
                ></span>
            </button>
        `;

        return item;
    };

    /**
     * Create one statistic row.
     *
     * @returns {HTMLElement}
     */
    const createStatisticItem = () => {
        const index = statisticsContainer
            ? statisticsContainer.querySelectorAll(
                '[data-mpc-statistic-item]'
            ).length
            : 0;

        const item = document.createElement('div');

        item.className =
            'mpc-project-repeater__item';

        item.dataset.mpcStatisticItem = '';

        item.innerHTML = `
            <span
                class="mpc-project-repeater__handle"
                aria-hidden="true"
            >
                <span
                    class="dashicons dashicons-move"
                ></span>
            </span>

            <div
                class="
                    mpc-project-repeater__fields
                    mpc-project-repeater__fields--3
                "
            >
                <div class="mpc-form-field">
                    <label class="mpc-form-label">
                        Icon
                    </label>

                    <input
                        class="mpc-input"
                        type="text"
                        name="mpc_project_statistics[${index}][icon]"
                        value="chart-bar"
                        placeholder="chart-bar"
                    >
                </div>

                <div class="mpc-form-field">
                    <label class="mpc-form-label">
                        Value
                    </label>

                    <input
                        class="mpc-input"
                        type="text"
                        name="mpc_project_statistics[${index}][value]"
                        value=""
                        placeholder="+60%"
                    >
                </div>

                <div class="mpc-form-field">
                    <label class="mpc-form-label">
                        Label
                    </label>

                    <input
                        class="mpc-input"
                        type="text"
                        name="mpc_project_statistics[${index}][label]"
                        value=""
                        placeholder="Online enquiries"
                    >
                </div>
            </div>

            <button
                class="mpc-project-repeater__remove"
                type="button"
                data-mpc-remove-item
                aria-label="Remove statistic"
            >
                <span
                    class="dashicons dashicons-trash"
                    aria-hidden="true"
                ></span>
            </button>
        `;

        return item;
    };

    if (addFeatureButton && featuresContainer) {
        addFeatureButton.addEventListener(
            'click',
            () => {
                const item = createFeatureItem();

                featuresContainer.appendChild(item);

                reindexRepeater(
                    featuresContainer,
                    'mpc_project_features'
                );

                updateRepeaterEmptyState(
                    featuresContainer,
                    featuresEmpty
                );

                const featureInput = item.querySelector(
                    'input[name$="[title]"]'
                );

                if (featureInput) {
                    featureInput.focus();
                }
            }
        );
    }

    if (
        addStatisticButton
        && statisticsContainer
    ) {
        addStatisticButton.addEventListener(
            'click',
            () => {
                const item = createStatisticItem();

                statisticsContainer.appendChild(item);

                reindexRepeater(
                    statisticsContainer,
                    'mpc_project_statistics'
                );

                updateRepeaterEmptyState(
                    statisticsContainer,
                    statisticsEmpty
                );

                const valueInput = item.querySelector(
                    'input[name$="[value]"]'
                );

                if (valueInput) {
                    valueInput.focus();
                }
            }
        );
    }

    workspace.addEventListener('click', (event) => {
        const removeButton = event.target.closest(
            '[data-mpc-remove-item]'
        );

        if (!removeButton) {
            return;
        }

        event.preventDefault();

        const item = removeButton.closest(
            '.mpc-project-repeater__item'
        );

        if (!item) {
            return;
        }

        const parent = item.parentElement;

        item.remove();

        if (parent === featuresContainer) {
            reindexRepeater(
                featuresContainer,
                'mpc_project_features'
            );

            updateRepeaterEmptyState(
                featuresContainer,
                featuresEmpty
            );
        }

        if (parent === statisticsContainer) {
            reindexRepeater(
                statisticsContainer,
                'mpc_project_statistics'
            );

            updateRepeaterEmptyState(
                statisticsContainer,
                statisticsEmpty
            );
        }
    });

    if (
        featuresContainer
        && window.jQuery
        && window.jQuery.fn.sortable
    ) {
        window.jQuery(featuresContainer).sortable({
            items: '[data-mpc-feature-item]',
            handle: '.mpc-project-repeater__handle',
            tolerance: 'pointer',

            update: () => {
                reindexRepeater(
                    featuresContainer,
                    'mpc_project_features'
                );
            },
        });
    }

    if (
        statisticsContainer
        && window.jQuery
        && window.jQuery.fn.sortable
    ) {
        window.jQuery(statisticsContainer).sortable({
            items: '[data-mpc-statistic-item]',
            handle: '.mpc-project-repeater__handle',
            tolerance: 'pointer',

            update: () => {
                reindexRepeater(
                    statisticsContainer,
                    'mpc_project_statistics'
                );
            },
        });
    }

    updateRepeaterEmptyState(
        featuresContainer,
        featuresEmpty
    );

    updateRepeaterEmptyState(
        statisticsContainer,
        statisticsEmpty
    );

    /* ======================================================
       Testimonial client photo
    ====================================================== */

    const testimonialPhotoField = workspace.querySelector(
        '.mpc-project-testimonial-photo-value'
    );

    const testimonialPhotoPreview = workspace.querySelector(
        '[data-mpc-testimonial-photo-preview]'
    );

    const testimonialPhotoSelectButton = workspace.querySelector(
        '[data-mpc-select-testimonial-photo]'
    );

    const testimonialPhotoRemoveButton = workspace.querySelector(
        '[data-mpc-remove-testimonial-photo]'
    );

    let testimonialPhotoFrame = null;

    if (testimonialPhotoSelectButton) {
        testimonialPhotoSelectButton.addEventListener(
            'click',
            () => {
                if (
                    typeof window.wp === 'undefined'
                    || !window.wp.media
                ) {
                    return;
                }

                if (!testimonialPhotoFrame) {
                    testimonialPhotoFrame = window.wp.media({
                        title: 'Select Client Photo',

                        button: {
                            text: 'Use Client Photo',
                        },

                        library: {
                            type: 'image',
                        },

                        multiple: false,
                    });

                    testimonialPhotoFrame.on(
                        'select',
                        () => {
                            const attachment = testimonialPhotoFrame
                                .state()
                                .get('selection')
                                .first()
                                .toJSON();

                            const imageUrl = (
                                attachment.sizes
                                && attachment.sizes.thumbnail
                            )
                                ? attachment.sizes.thumbnail.url
                                : attachment.url;

                            if (testimonialPhotoField) {
                                testimonialPhotoField.value = String(
                                    attachment.id
                                );
                            }

                            if (testimonialPhotoPreview) {
                                testimonialPhotoPreview.innerHTML = `
                                    <img
                                        src="${escapeHtml(imageUrl)}"
                                        alt=""
                                    >
                                `;
                            }

                            if (testimonialPhotoRemoveButton) {
                                testimonialPhotoRemoveButton.hidden = false;
                            }
                        }
                    );
                }

                testimonialPhotoFrame.open();
            }
        );
    }

    if (testimonialPhotoRemoveButton) {
        testimonialPhotoRemoveButton.addEventListener(
            'click',
            () => {
                if (testimonialPhotoField) {
                    testimonialPhotoField.value = '';
                }

                if (testimonialPhotoPreview) {
                    testimonialPhotoPreview.innerHTML = `
                        <span
                            class="dashicons dashicons-admin-users"
                            aria-hidden="true"
                        ></span>
                    `;
                }

                testimonialPhotoRemoveButton.hidden = true;
            }
        );
    }

    /* ======================================================
       Case-study PDF
    ====================================================== */

    const projectPdfField = workspace.querySelector(
        '.mpc-project-pdf-value'
    );

    const projectPdfPreview = workspace.querySelector(
        '[data-mpc-pdf-preview]'
    );

    const projectPdfSelectButton = workspace.querySelector(
        '[data-mpc-select-pdf]'
    );

    const projectPdfRemoveButton = workspace.querySelector(
        '[data-mpc-remove-pdf]'
    );

    let projectPdfFrame = null;

    if (projectPdfSelectButton) {
        projectPdfSelectButton.addEventListener(
            'click',
            () => {
                if (
                    typeof window.wp === 'undefined'
                    || !window.wp.media
                ) {
                    return;
                }

                if (!projectPdfFrame) {
                    projectPdfFrame = window.wp.media({
                        title: 'Select Case Study PDF',

                        button: {
                            text: 'Use This PDF',
                        },

                        library: {
                            type: 'application/pdf',
                        },

                        multiple: false,
                    });

                    projectPdfFrame.on(
                        'select',
                        () => {
                            const attachment = projectPdfFrame
                                .state()
                                .get('selection')
                                .first()
                                .toJSON();

                            if (projectPdfField) {
                                projectPdfField.value = String(
                                    attachment.id
                                );
                            }

                            if (projectPdfPreview) {
                                const filename = (
                                    attachment.filename
                                    || attachment.title
                                    || 'Selected PDF'
                                );

                                projectPdfPreview.innerHTML = `
                                    <span
                                        class="dashicons dashicons-media-document"
                                        aria-hidden="true"
                                    ></span>

                                    <span>
                                        ${escapeHtml(filename)}
                                    </span>
                                `;
                            }

                            if (projectPdfRemoveButton) {
                                projectPdfRemoveButton.hidden = false;
                            }
                        }
                    );
                }

                projectPdfFrame.open();
            }
        );
    }

    if (projectPdfRemoveButton) {
        projectPdfRemoveButton.addEventListener(
            'click',
            () => {
                if (projectPdfField) {
                    projectPdfField.value = '';
                }

                if (projectPdfPreview) {
                    projectPdfPreview.innerHTML = `
                        <span
                            class="dashicons dashicons-media-document"
                            aria-hidden="true"
                        ></span>

                        <span>
                            No PDF selected
                        </span>
                    `;
                }

                projectPdfRemoveButton.hidden = true;
            }
        );
    }

    document.documentElement.classList.add(
        'myportfolio-core-projects-ready'
    );
});