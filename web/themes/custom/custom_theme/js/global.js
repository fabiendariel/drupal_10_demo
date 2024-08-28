/**
 * @file
 * Global utilities.
 *
 */
(function (Drupal) {

  'use strict';

  Drupal.behaviors.custom_theme = {
    attach: function (context, settings) {
      window.addEventListener('DOMContentLoaded', event => {

        // Navbar shrink function
        var navbarShrink = function () {
          const navbarCollapsible = document.body.querySelector('#navbar-main');
          if (!navbarCollapsible) {
            return;
          }
          if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
          } else {
            navbarCollapsible.classList.add('navbar-shrink')
          }

        };

        // Shrink the navbar 
        navbarShrink();

        // Shrink the navbar when page is scrolled
        document.addEventListener('scroll', navbarShrink);

        //  Activate Bootstrap scrollspy on the main nav element
        const mainNav = document.body.querySelector('#navbar-main');
        if (mainNav) {
          new bootstrap.ScrollSpy(document.body, {
            target: '#navbar-main',
            rootMargin: '0px 0px -40%',
          });
        };

        // Collapse responsive navbar when toggler is visible
        const navbarToggler = document.body.querySelector('.navbar-toggler');
        const responsiveNavItems = [].slice.call(
          document.querySelectorAll('#navbarResponsive .nav-link')
        );
        responsiveNavItems.map(function (responsiveNavItem) {
          responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
              navbarToggler.click();
            }
          });
        });

      });

    }
  };

})(Drupal);
