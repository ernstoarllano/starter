import { isExternal, isEmpty, observeBackgrounds, dropdownState } from '../util/helpers'
import * as Cookies from 'js-cookie'

export default {
  init() {
    // JavaScript to be fired on all pages
    const body = document.querySelector('body')
    const navToggle = document.querySelector('.js-toggle-nav')
    const anchors = document.querySelectorAll('a')
    const paragraphs = document.querySelectorAll('p')
    const dropdowns = document.querySelectorAll('.menu-item-has-children')
    const jsHero = document.querySelector('.js-hero')
    const jsBackgrounds = document.querySelectorAll('.js-background')
    const jsPopup = document.querySelector('.js-popup')
    const galleryThumbs = document.querySelectorAll('.gallery-icon')

    // Handle external urls
    anchors.forEach(anchor => {
      if (isExternal(anchor)) {
        // Define attributes to set
        const attributes = {
          target: '__blank',
          rel: 'noopener',
        }

        // Set attributes
        Object.keys(attributes).forEach(attribute => {
          anchor.setAttribute(attribute, attributes[attribute])
        })
      }
    })

    // Handle empty p tags
    paragraphs.forEach(isEmpty)

    // Handle toggling mobile navigation
    if (window.matchMedia('(max-width: 1023px)').matches) {
      if (navToggle) {
        navToggle.addEventListener('click', () => {
          body.classList.toggle('nav-is-open')
        })
      }
    }

    // Handle dropdowns visibility state
    if (window.matchMedia('(max-width: 1199px)').matches) {
      dropdowns.forEach(dropdown => {
        dropdown.setAttribute('data-state', 'closed')

        dropdown.addEventListener('click', dropdownState)
      })
    }

    // Handle hero background
    if (jsHero) {
      const mobileHero = jsHero.dataset.mobile
      const desktopHero = jsHero.dataset.desktop

      if (mobileHero && desktopHero) {
        jsHero.classList.add('has-bg')

        if (window.matchMedia('(min-width: 1024px)').matches) {
          jsHero.style.backgroundImage = `url(${desktopHero})`
        } else {
          jsHero.style.backgroundImage = `url(${mobileHero})`
        }
      }
    }

    // Handle js backgrounds
    if (jsBackgrounds) {
      if (('IntersectionObserver' in window)) {
        let observer = new IntersectionObserver(observeBackgrounds);

        jsBackgrounds.forEach(jsBackground => {
          observer.observe(jsBackground)
        })
      }
    }

    // Handle gallery lightbox
    if (galleryThumbs) {
      galleryThumbs.forEach(galleryThumb => {
        const galleryAnchor = galleryThumb.children[0]

        galleryAnchor.setAttribute('data-fancybox', 'gallery')
      })

      $('[data-fancybox]').fancybox()
    }

    // Handle js popup
    if (jsPopup && !Cookies.get('popup')) {
      setTimeout(() => {
        $.fancybox.open({
          autoFocus: false,
          src: '.js-popup',
          type: 'inline',
        })

        Cookies.set('popup', 'true', { expires: 7 })
      }, 5000)
    }

    if ($('.js-carousel-hero').length) {
      $('.js-carousel-hero').slick({
        accessibility: true,
        adaptiveHeight: false,
        autoplay: true,
        autoplaySpeed: 15000,
        arrows: false,
        fade: true,
        pauseOnFocus: false,
        pauseOnHover: false,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
      });
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
