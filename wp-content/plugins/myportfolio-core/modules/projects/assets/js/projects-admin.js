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
     * Activate one workspace tab.
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
            // Storage may be unavailable. Tab switching still works.
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
            activateTab(tabs[nextIndex].dataset.mpcTab);
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
        // Use Overview when storage is unavailable.
    }

    activateTab(initialTab);

    document.documentElement.classList.add(
        'myportfolio-core-projects-ready'
    );
});