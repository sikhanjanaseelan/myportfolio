'use strict';

/**
 * MyPortfolio Core
 * Single Project image slider.
 */

document.addEventListener('DOMContentLoaded', () => {
    const sliders = document.querySelectorAll(
        '[data-mpc-project-slider]'
    );

    sliders.forEach((slider) => {
        const mainImage = slider.querySelector(
            '[data-mpc-slider-image]'
        );

        const thumbnails = Array.from(
            slider.querySelectorAll(
                '[data-mpc-slider-thumb]'
            )
        );

        const previousButton = slider.querySelector(
            '[data-mpc-slider-prev]'
        );

        const nextButton = slider.querySelector(
            '[data-mpc-slider-next]'
        );

        const counter = slider.querySelector(
            '[data-mpc-slider-counter]'
        );

        if (!mainImage || thumbnails.length < 2) {
            return;
        }

        let activeIndex = 0;

        /**
         * Display one slider image.
         *
         * @param {number} requestedIndex
         */
        const showImage = (requestedIndex) => {
            const total = thumbnails.length;

            activeIndex = (
                requestedIndex + total
            ) % total;

            const activeThumbnail = thumbnails[
                activeIndex
            ];

            const imageSource = activeThumbnail.dataset
                .fullSrc;

            const imageAlt = activeThumbnail.dataset
                .alt || '';

            if (!imageSource) {
                return;
            }

            mainImage.classList.add(
                'is-changing'
            );

            const preloadImage = new Image();

            preloadImage.onload = () => {
                mainImage.src = imageSource;
                mainImage.alt = imageAlt;

                window.requestAnimationFrame(() => {
                    mainImage.classList.remove(
                        'is-changing'
                    );
                });
            };

            preloadImage.onerror = () => {
                mainImage.classList.remove(
                    'is-changing'
                );
            };

            preloadImage.src = imageSource;

            thumbnails.forEach(
                (thumbnail, index) => {
                    const isActive = index
                        === activeIndex;

                    thumbnail.classList.toggle(
                        'is-active',
                        isActive
                    );

                    thumbnail.setAttribute(
                        'aria-selected',
                        isActive
                            ? 'true'
                            : 'false'
                    );
                }
            );

            if (counter) {
                counter.textContent = `${
                    activeIndex + 1
                } / ${total}`;
            }

            activeThumbnail.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'nearest',
            });
        };

        thumbnails.forEach(
            (thumbnail, index) => {
                thumbnail.addEventListener(
                    'click',
                    () => {
                        showImage(index);
                    }
                );
            }
        );

        if (previousButton) {
            previousButton.addEventListener(
                'click',
                () => {
                    showImage(
                        activeIndex - 1
                    );
                }
            );
        }

        if (nextButton) {
            nextButton.addEventListener(
                'click',
                () => {
                    showImage(
                        activeIndex + 1
                    );
                }
            );
        }

        slider.addEventListener(
            'keydown',
            (event) => {
                if (event.key === 'ArrowLeft') {
                    event.preventDefault();

                    showImage(
                        activeIndex - 1
                    );
                }

                if (event.key === 'ArrowRight') {
                    event.preventDefault();

                    showImage(
                        activeIndex + 1
                    );
                }
            }
        );
    });
});