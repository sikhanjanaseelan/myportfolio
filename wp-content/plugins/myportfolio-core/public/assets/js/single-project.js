'use strict';

/**
 * MyPortfolio Core
 * Single Project frontend interactions.
 */

document.addEventListener('DOMContentLoaded', () => {

    /* ======================================================
       Project image slider
    ====================================================== */

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
                    const isActive = (
                        index === activeIndex
                    );

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

    /* ======================================================
       Case study sidebar navigation
    ====================================================== */

    const sectionLinks = Array.from(
        document.querySelectorAll(
            '.mpc-project-detail__story-nav a[href^="#"]'
        )
    );

    if (!sectionLinks.length) {
        return;
    }

    const sectionMap = sectionLinks
        .map((link) => {
            const targetSelector = link.getAttribute(
                'href'
            );

            if (!targetSelector) {
                return null;
            }

            const section = document.querySelector(
                targetSelector
            );

            if (!section) {
                return null;
            }

            return {
                link,
                section,
            };
        })
        .filter(Boolean);

    if (!sectionMap.length) {
        return;
    }

    let currentSectionId = '';
    let focusTimer = null;

    /**
     * Set active sidebar navigation item.
     *
     * @param {string} sectionId
     */
    const setActiveSection = (sectionId) => {
        sectionLinks.forEach((link) => {
            const target = link.getAttribute(
                'href'
            );

            const isActive = (
                target === `#${sectionId}`
            );

            link.classList.toggle(
                'is-active',
                isActive
            );

            if (isActive) {
                link.setAttribute(
                    'aria-current',
                    'location'
                );
            } else {
                link.removeAttribute(
                    'aria-current'
                );
            }
        });
    };

    /**
     * Remove all temporary section focus states.
     */
    const clearSectionFocus = () => {
        document
            .querySelectorAll(
                '.mpc-project-detail__section-focus'
            )
            .forEach((section) => {
                section.classList.remove(
                    'mpc-project-detail__section-focus'
                );
            });
    };

    /**
     * Highlight one destination section briefly.
     *
     * @param {HTMLElement} targetSection
     */
    const focusSection = (targetSection) => {
        clearSectionFocus();

        if (focusTimer) {
            window.clearTimeout(
                focusTimer
            );
        }

        /*
         * Restart animation even if the same
         * section is clicked repeatedly.
         */
        void targetSection.offsetWidth;

        targetSection.classList.add(
            'mpc-project-detail__section-focus'
        );

        focusTimer = window.setTimeout(
            () => {
                targetSection.classList.remove(
                    'mpc-project-detail__section-focus'
                );
            },
            1800
        );
    };

    /**
     * Get suitable scroll offset below
     * the website header.
     *
     * @returns {number}
     */
    const getHeaderOffset = () => {
        const headerCandidates = [
            document.querySelector(
                '.site-header'
            ),
            document.querySelector(
                '#masthead'
            ),
            document.querySelector(
                'header[role="banner"]'
            ),
        ];

        const header = headerCandidates.find(
            (item) => item
        );

        if (!header) {
            return 110;
        }

        return Math.max(
            header.getBoundingClientRect().height
                + 24,
            90
        );
    };

    /**
     * Scroll clearly to a selected section.
     *
     * @param {HTMLElement} targetSection
     */
    const scrollToSection = (targetSection) => {
        const offset = getHeaderOffset();

        const targetPosition = (
            targetSection
                .getBoundingClientRect()
                .top
            + window.pageYOffset
            - offset
        );

        window.scrollTo({
            top: Math.max(
                targetPosition,
                0
            ),
            behavior: 'smooth',
        });
    };

    /* ======================================================
       Sidebar click handling
    ====================================================== */

    sectionLinks.forEach((link) => {
        link.addEventListener(
            'click',
            (event) => {
                const selector = link.getAttribute(
                    'href'
                );

                if (!selector) {
                    return;
                }

                const targetSection = document.querySelector(
                    selector
                );

                if (!targetSection) {
                    return;
                }

                event.preventDefault();

                const sectionId = selector.replace(
                    '#',
                    ''
                );

                currentSectionId = sectionId;

                setActiveSection(
                    sectionId
                );

                scrollToSection(
                    targetSection
                );

                /*
                 * Delay the focus slightly so the
                 * visitor sees it after scrolling
                 * begins.
                 */
                window.setTimeout(
                    () => {
                        focusSection(
                            targetSection
                        );
                    },
                    250
                );

                if (
                    window.history
                    && window.history.replaceState
                ) {
                    window.history.replaceState(
                        null,
                        '',
                        selector
                    );
                }
            }
        );
    });

    /* ======================================================
       Scroll spy
    ====================================================== */

    /**
     * Update active sidebar item while user scrolls.
     */
    const updateActiveFromScroll = () => {
        const readingLine = Math.max(
            getHeaderOffset() + 40,
            window.innerHeight * 0.22
        );

        let activeSection = null;

        /*
         * Prefer the last section whose top
         * has passed the reading line.
         */
        sectionMap.forEach(({ section }) => {
            const rectangle = section
                .getBoundingClientRect();

            if (
                rectangle.top
                <= readingLine
            ) {
                activeSection = section;
            }
        });

        /*
         * If none has passed the reading line,
         * use the first visible section.
         */
        if (!activeSection) {
            activeSection = sectionMap
                .map(({ section }) => section)
                .find((section) => {
                    const rectangle = section
                        .getBoundingClientRect();

                    return (
                        rectangle.bottom > 0
                        && rectangle.top
                        < window.innerHeight
                    );
                });
        }

        if (
            !activeSection
            || !activeSection.id
            || activeSection.id
                === currentSectionId
        ) {
            return;
        }

        currentSectionId = activeSection.id;

        setActiveSection(
            currentSectionId
        );
    };

    let scrollFrame = null;

    const requestScrollUpdate = () => {
        if (scrollFrame) {
            return;
        }

        scrollFrame = window.requestAnimationFrame(
            () => {
                updateActiveFromScroll();

                scrollFrame = null;
            }
        );
    };

    window.addEventListener(
        'scroll',
        requestScrollUpdate,
        {
            passive: true,
        }
    );

    window.addEventListener(
        'resize',
        requestScrollUpdate
    );

    /* ======================================================
       Initial state
    ====================================================== */

    const initialHash = window.location.hash;

    const initialMatch = sectionMap.find(
        ({ section }) => (
            `#${section.id}`
            === initialHash
        )
    );

    if (initialMatch) {
        currentSectionId = initialMatch
            .section
            .id;

        setActiveSection(
            currentSectionId
        );

        /*
         * Browser may perform its own hash scroll.
         * Correct the offset after layout settles.
         */
        window.setTimeout(
            () => {
                scrollToSection(
                    initialMatch.section
                );

                focusSection(
                    initialMatch.section
                );
            },
            150
        );
    } else {
        currentSectionId = sectionMap[0]
            .section
            .id;

        setActiveSection(
            currentSectionId
        );

        updateActiveFromScroll();
    }
});