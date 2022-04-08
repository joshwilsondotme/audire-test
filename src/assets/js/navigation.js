// (function() {
//   var navBreakpoint = '(min-width: 64rem)';
//   var body = document.body;
//   var siteHeader = document.querySelector('.site-header');
//   var siteHeaderSticky = document.querySelector('.site-header--sticky');
//   var siteMainContent = document.querySelector('.site-content');
//   var mainNavUl = document.querySelector('.site-menu--main');
//   var utilNavUl = document.querySelector('.site-menu--main-util');
//   var socialList = document.querySelector('.site-header__social-list');
//   var menuToggle = document.querySelector('.nav-toggle');
//   var topbarLeft = document.querySelectorAll('.site-header__left .wpsl-locations-details');
//   var topLevelParentListItems = mainNavUl.querySelectorAll('.site-menu__item.site-menu__item--parent, .site-menu__sub-menu--1__item--has-children, .site-menu__sub-menu--2__item--has-children');

//   var latestKnownScrollY = -Infinity;
//   var currentScrollTop = 0;
//   var lastInitialized;

//   var DeviceTypes = {
//     MOBILE: 'mobile',
//     DESKTOP: 'desktop'
//   };




//   // setup event listeners
//   handleMenuToggleClick();

//   //add clickable carets to parent items
//   //and add overview links to submenu
//   createSubmenuToggles();

//   window.addEventListener('resize', debounce(toggleMobileOrDesktop.bind(this), 1000));
//   // Adds special classes for non-stacked navigation
  
//   window.addEventListener('scroll', debounce(toggleHeaderVisibility.bind(this), 25, true));
  
//   window.addEventListener('scroll', debounce(toggleHeaderVisibility.bind(this), 250, false)); 

//   toggleMobileOrDesktop();
  
//   function toggleMobileOrDesktop() {
//     if (window.innerWidth >= 1024) {
//       // if(window.matchMedia('screen and (min-width:64rem)').matches) {
//       initHeaderDesktopNav();
//       // initFooterDesktopNav();
//     } else {
//       initHeaderMobileNav();
//       // initFooterMobileNav();
//     }
//     addSpaceForFixedHeader();
//   }


//   function initHeaderMobileNav() {
//     if (lastInitialized !== DeviceTypes.MOBILE) {
//       moveUtilItemsToMainNav();

//       // menu is off-screen
//       hideElementFromScreenreaders(mainNavUl);

//       showSubmenuToggles();

//       if (mainNavUl.classList.contains('text-white')) {
//         mainNavUl.classList.remove('text-white')
//       }

//       lastInitialized = DeviceTypes.MOBILE;
//     }
//   }

//   function initHeaderDesktopNav() {
//     if (lastInitialized !== DeviceTypes.DESKTOP) {
//       // menu is on-screen
//       showElementToScreenReaders(mainNavUl);

//       hideSubmenuToggles();

//       if (lastInitialized === DeviceTypes.MOBILE) {
//         //if util items are in main nav move them back to util nav
//         moveUtilItemsToUtilNav();

//         closeMenu(menuToggle, mainNavUl);
//       }

//       lastInitialized = DeviceTypes.DESKTOP;
//     }
//   }

//   function createSubmenuToggles() {
//     for (var x = 0; x < topLevelParentListItems.length; x++) {
//       var subMenuToggle = document.createElement('span');
//       var i = document.createElement('i');

//       subMenuToggle.classList.add('site-menu__sub-menu-toggle');
//       i.classList.add('far');
//       i.classList.add('fa-angle-right');

//       subMenuToggle.appendChild(i);

//       topLevelParentListItems[x].appendChild(subMenuToggle);

//       subMenuToggle.addEventListener('click', function () {
//         showMobileSubMenu(this.parentElement);
//       });
//     }
//   }

//   function applyToSubmenuToggles(fn) {
//     if (document.querySelectorAll('site-menu__sub-menu-toggle').length > 1) {
//       document.querySelectorAll('site-menu__sub-menu-toggle').forEach(function () {
//         fn.call(this);
//       });
//     }
//   }

//   function hideSubmenuToggles() {
//     applyToSubmenuToggles(function () { this.classList.add('is-hidden'); })
//   }

//   function showSubmenuToggles() {
//     applyToSubmenuToggles(function () { this.classList.remove('is-hidden'); })
//   }

//   function handleMenuToggleClick() {
//     menuToggle.addEventListener('click', function () {
//       if (this.classList.contains('nav-toggle--nav-is-closed')) {
//         openMenu.call(self, this, mainNavUl);
//       } else {
//         closeMenu.call(self, this, mainNavUl);
//       }
//     });
//   }

//   function closeMenu(menuButton, mainNavigationList) {
//     menuButton.classList.remove('nav-toggle--nav-is-open')
//     menuButton.classList.add('nav-toggle--nav-is-closed');
//     body.classList.remove('no-scroll');
//     hideExpandedFromScreenreaders(menuButton);
//     hideElementFromScreenreaders(mainNavigationList);
//   }

//   function openMenu(menuButton, mainNavigationList) {
//     menuButton.classList.remove('nav-toggle--nav-is-closed')
//     menuButton.classList.add('nav-toggle--nav-is-open');
//     body.classList.add('no-scroll');
//     showExpandedToScreenreaders(menuButton);
//     showElementToScreenReaders(mainNavigationList);
//   }

//   function moveElementToNav(nav, element) {
//     var fn = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
//     nav.appendChild(element);

//     if (fn !== null) {
//       fn();
//     }
//   }

//   function moveElementToMainNav(element) {
//     var fn = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
//     moveElementToNav(mainNavUl, element, fn);
    
//   }

//   function moveElementToUtilNav(element) {
//     var fn = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
//     moveElementToNav(utilNavUl, element, fn);
//   }

//   function moveUtilItemsToMainNav() {
//     while (utilNavUl.firstChild) {
//       moveElementToMainNav(utilNavUl.firstChild, function () { this.classList && this.classList.add('site-menu__item--util-duplicate'); }.bind(utilNavUl.firstChild));

//       moveElementToMainNav(socialList, function () { this.classList && this.classList.add('site-menu__item--util-duplicate'); }.bind(utilNavUl.firstChild));
//     }
//   }

//   function moveUtilItemsToUtilNav() {
//     mainNavUl.querySelectorAll('.site-menu__item--util-duplicate').forEach(function (item) {
//       moveElementToUtilNav(item, function () { this.classList.remove('site-menu__item--util-duplicate') }.bind(item))
//     }.bind(this));

//     mainNavUl.querySelectorAll('.site-header__social-list').forEach(function (item) {
//       moveElementToUtilNav(item, function () { this.classList.remove('site-menu__item--util-duplicate') }.bind(item))
//     }.bind(this));
//   }

//   function hideElementFromScreenreaders(element) {
//     element.setAttribute('aria-hidden', true);
//   }

//   function showElementToScreenReaders(element) {
//     element.setAttribute('aria-hidden', false);
//   }

//   function hideExpandedFromScreenreaders(element) {
//     element.setAttribute('aria-expanded', false);
//   }

//   function showExpandedToScreenreaders(element) {
//     element.setAttribute('aria-expanded', true);
//   }

//   function showCollapsedToScreenReaders(element) {
//     element.setAttribute('aria-expanded', false);
//   }

//   function showMobileSubMenu(listItem) {

//     // add class to link to position it
//     var link = listItem.querySelector('.site-menu__link, .site-menu__sub-menu__link');
//     link.classList.add('site-menu__link--back');

//     link.addEventListener('click', function (e) {
//       if (e.target.classList.contains('site-menu__link--back')) {
//         e.preventDefault();
//         hideMobileSubMenu(this);
//       }
//     });

//     //show submenu
//     var subnav = listItem.querySelector('.site-menu__sub-menu, .site-menu__sub-menu--2, .site-menu__sub-menu--3');
//     subnav.classList.add('site-menu__sub-menu--active');
//     subnav.setAttribute('aria-hidden', false);

//   }

//   function hideMobileSubMenu(link) {
//     link.classList.remove('site-menu__link--back');

//     //hide
//     var subnav = link.parentNode.querySelector('.site-menu__sub-menu');
//     subnav.classList.remove('site-menu__sub-menu--active');
//     subnav.setAttribute('aria-hidden', true);
//   }

//   /*
//     * adds toggles to parent list items
//     */
//   // function initFooterMobileNav() {

//   //   var topLevelItems = document.querySelectorAll('.site-footer__nav .site-menu__item--parent');
//   //   topLevelItems.forEach(function (item) {
//   //     //create subnav toggle
//   //     var toggle = document.createElement('span');
//   //     toggle.classList.add('site-menu__toggle');
//   //     toggle.innerHTML = '<svg class="c-icon color--white" pointer-events="none"><use class="plus" xlink:href="#plus"></use><use class="minus" xlink:href="#minus"></use></svg>';

//   //     //make sure toggle doesn't already exist.
//   //     if (!item.querySelector('.site-menu__toggle')) {
//   //       //find link element within item and append toggle after link
//   //       var itemLink = item.querySelector('.site-menu__link');
//   //       itemLink.parentNode.insertBefore(toggle, itemLink.nextSibling);

//   //       //listen for click on toggle
//   //       toggle.addEventListener('click', toggleFooterLinksMobile);
//   //     }
//   //   });
//   // }

//   // function toggleFooterLinksMobile(e) {
//   //   var submenu = e.target.nextElementSibling;

//   //   if (e.target.classList.contains('is-open')) {
//   //     e.target.classList.remove('is-open');
//   //     submenu.setAttribute('aria-hidden', true);

//   //   } else {
//   //     e.target.classList.add('is-open');
//   //     submenu.setAttribute('aria-hidden', false);
//   //   }
//   // }

//   /* 
//     * removes toggles from mobile nav
//     */
//   // function initFooterDesktopNav() {
//   //   var footerToggles = document.querySelectorAll('.site-footer__nav--main .site-menu__toggle');
//   //   footerToggles.forEach(function (item) {
//   //     item.remove();
//   //   });
//   // }

  
//   function addSpaceForFixedHeader() {
//     if ( siteHeaderSticky != null) {
//       if (lastInitialized !== DeviceTypes.MOBILE) {
//         siteMainContent.style.marginTop = '0px';
//         siteMainContent.firstElementChild.style.marginTop = siteHeader.clientHeight + 'px';
//       } else {
//         siteMainContent.style.marginTop = siteHeader.clientHeight + 'px';
//         siteMainContent.firstElementChild.style.marginTop = '0px';
//       }
//     }
//   }
  

//   function toggleHeaderVisibility() {
//     //get current position
//     currentScrollTop = window.scrollY;

//     //check if scrolled up or down
//     if (currentScrollTop > latestKnownScrollY) {
//       //scrolling down
//       siteHeader.classList.add('site-header--offscreen');
//     } else {
//       //scrolling up
//       siteHeader.classList.remove('site-header--offscreen');
//     }

//     //set new position
//     latestKnownScrollY = currentScrollTop <= 0 ? 0 : currentScrollTop;

//     if (latestKnownScrollY === 0) {
//       siteHeader.classList.add('site-header--at-top');
//     } else {
//       siteHeader.classList.remove('site-header--at-top');
//     }
//   }




//   function debounce(func, wait, immediate) {
//     var timeout;
//     return function () {
//       var context = this, args = arguments;
//       var later = function () {
//         timeout = null;
//         if (!immediate) func.apply(context, args);
//       };
//       var callNow = immediate && !timeout;
//       clearTimeout(timeout);
//       timeout = setTimeout(later, wait);
//       if (callNow) func.apply(context, args);
//     };
//   };

// }());

// // if (siteHeader.classList.contains('site-header--stacked')) {
// //   siteHeader.classList.remove('site-header--at-top');
// // }

(function() {
  var navBreakpoint = '(min-width: 64rem)';
  var body = document.body;
  var siteHeader = document.querySelector('.site-header');
  var siteHeaderSticky = document.querySelector('.site-header--sticky');
  var siteMainContent = document.querySelector('.site-content');
  var mainNavUl = document.querySelector('.site-menu--main');
  var utilNavUl = document.querySelector('.site-menu--main-util');
  var socialList = document.querySelector('.site-header__social-list');
  var topbarInfo = document.querySelector('.site-header__left .wpsl-locations-details');
  var menuToggle = document.querySelector('.nav-toggle');
  var topLevelParentListItems = mainNavUl.querySelectorAll('.site-menu__item.site-menu__item--parent, .site-menu__sub-menu--1__item--has-children, .site-menu__sub-menu--2__item--has-children');

  var latestKnownScrollY = -Infinity;
  var currentScrollTop = 0;
  var lastInitialized;

  var DeviceTypes = {
    MOBILE: 'mobile',
    DESKTOP: 'desktop'
  };




  // setup event listeners
  handleMenuToggleClick();

  //add clickable carets to parent items
  //and add overview links to submenu
  createSubmenuToggles();

  window.addEventListener('resize', debounce(toggleMobileOrDesktop.bind(this), 1000));
  // Adds special classes for non-stacked navigation
  
    window.addEventListener('scroll', debounce(toggleHeaderVisibility.bind(this), 25, true));
    window.addEventListener('scroll', debounce(toggleHeaderVisibility.bind(this), 250, false)); 


  toggleMobileOrDesktop();
  



  function toggleMobileOrDesktop() {
    if (window.innerWidth >= 1024) {
      // if(window.matchMedia('screen and (min-width:64rem)').matches) {
      initHeaderDesktopNav();
      // initFooterDesktopNav();
    } else {
      initHeaderMobileNav();
      // initFooterMobileNav();
    }
    addSpaceForFixedHeader();
  }


  function initHeaderMobileNav() {
    if (lastInitialized !== DeviceTypes.MOBILE) {
      moveUtilItemsToMainNav();

      // menu is off-screen
      hideElementFromScreenreaders(mainNavUl);

      showSubmenuToggles();

      if (mainNavUl.classList.contains('text-white')) {
        mainNavUl.classList.remove('text-white')
      }

      lastInitialized = DeviceTypes.MOBILE;
    }
  }

  function initHeaderDesktopNav() {
    if (lastInitialized !== DeviceTypes.DESKTOP) {
      // menu is on-screen
      showElementToScreenReaders(mainNavUl);

      hideSubmenuToggles();

      if (lastInitialized === DeviceTypes.MOBILE) {
        //if util items are in main nav move them back to util nav
        moveUtilItemsToUtilNav();

        closeMenu(menuToggle, mainNavUl);
      }

      lastInitialized = DeviceTypes.DESKTOP;
    }
  }

  function createSubmenuToggles() {
    for (var x = 0; x < topLevelParentListItems.length; x++) {
      var subMenuToggle = document.createElement('span');
      var i = document.createElement('i');

      subMenuToggle.classList.add('site-menu__sub-menu-toggle');
      i.classList.add('far');
      i.classList.add('fa-angle-right');

      subMenuToggle.appendChild(i);

      topLevelParentListItems[x].appendChild(subMenuToggle);

      subMenuToggle.addEventListener('click', function () {
        showMobileSubMenu(this.parentElement);
      });
    }
  }


  function applyToSubmenuToggles(fn) {
    if (document.querySelectorAll('site-menu__sub-menu-toggle').length > 1) {
      document.querySelectorAll('site-menu__sub-menu-toggle').forEach(function () {
        fn.call(this);
      });
    }
  }

  function hideSubmenuToggles() {
    applyToSubmenuToggles(function () { this.classList.add('is-hidden'); })
  }

  function showSubmenuToggles() {
    applyToSubmenuToggles(function () { this.classList.remove('is-hidden'); })
  }

  function handleMenuToggleClick() {
    menuToggle.addEventListener('click', function () {
      if (this.classList.contains('nav-toggle--nav-is-closed')) {
        openMenu.call(self, this, mainNavUl);
      } else {
        closeMenu.call(self, this, mainNavUl);
      }
    });
  }


  function closeMenu(menuButton, mainNavigationList) {
    menuButton.classList.remove('nav-toggle--nav-is-open')
    menuButton.classList.add('nav-toggle--nav-is-closed');
    body.classList.remove('no-scroll');
    hideExpandedFromScreenreaders(menuButton);
    hideElementFromScreenreaders(mainNavigationList);
  }

  function openMenu(menuButton, mainNavigationList) {
    menuButton.classList.remove('nav-toggle--nav-is-closed')
    menuButton.classList.add('nav-toggle--nav-is-open');
    body.classList.add('no-scroll');
    showExpandedToScreenreaders(menuButton);
    showElementToScreenReaders(mainNavigationList);
  }

  function moveElementToNav(nav, element) {
    var fn = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
    nav.appendChild(element);

    if (fn !== null) {
      fn();
    }
  }
  



  function moveElementToMainNav(element) {
    var fn = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    moveElementToNav(mainNavUl, element, fn);
    
  }


  function moveElementToUtilNav(element) {
    var fn = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    moveElementToNav(utilNavUl, element, fn);
  }

  function moveUtilItemsToMainNav() {
    while (utilNavUl.firstChild) {

      moveElementToMainNav(utilNavUl.firstChild, function () { this.classList && this.classList.add('site-menu__item--util-duplicate'); }.bind(utilNavUl.firstChild));
      
      moveElementToMainNav(socialList, function () { this.classList && this.classList.add('site-menu__item--util-duplicate'); }.bind(utilNavUl.firstChild));

    }
    // moveElementToMainNav(topbarInfo, function () { this.classList && this.classList.add('site-menu__item--util-duplicate'); }.bind(utilNavUl.firstChild));
  }

  function moveUtilItemsToUtilNav() {
    mainNavUl.querySelectorAll('.site-menu__item--util-duplicate').forEach(function (item) {
      moveElementToUtilNav(item, function () { this.classList.remove('site-menu__item--util-duplicate') }.bind(item))
    }.bind(this));

    mainNavUl.querySelectorAll('.site-header__social-list').forEach(function (item) {
      moveElementToUtilNav(item, function () { this.classList.remove('site-menu__item--util-duplicate') }.bind(item))
    }.bind(this));
  }

  function hideElementFromScreenreaders(element) {
    element.setAttribute('aria-hidden', true);
  }

  function showElementToScreenReaders(element) {
    element.setAttribute('aria-hidden', false);
  }

  function hideExpandedFromScreenreaders(element) {
    element.setAttribute('aria-expanded', false);
  }

  function showExpandedToScreenreaders(element) {
    element.setAttribute('aria-expanded', true);
  }

  function showCollapsedToScreenReaders(element) {
    element.setAttribute('aria-expanded', false);
  }

  function showMobileSubMenu(listItem) {

    // add class to link to position it
    var link = listItem.querySelector('.site-menu__link, .site-menu__sub-menu__link');
    link.classList.add('site-menu__link--back');

    link.addEventListener('click', function (e) {
      if (e.target.classList.contains('site-menu__link--back')) {
        e.preventDefault();
        hideMobileSubMenu(this);
      }
    });

    //show submenu
    var subnav = listItem.querySelector('.site-menu__sub-menu, .site-menu__sub-menu--2, .site-menu__sub-menu--3');
    subnav.classList.add('site-menu__sub-menu--active');
    subnav.setAttribute('aria-hidden', false);

  }

  function hideMobileSubMenu(link) {
    link.classList.remove('site-menu__link--back');

    //hide
    var subnav = link.parentNode.querySelector('.site-menu__sub-menu');
    subnav.classList.remove('site-menu__sub-menu--active');
    subnav.setAttribute('aria-hidden', true);
  }

  /*
    * adds toggles to parent list items
    */
  // function initFooterMobileNav() {

  //   var topLevelItems = document.querySelectorAll('.site-footer__nav .site-menu__item--parent');
  //   topLevelItems.forEach(function (item) {
  //     //create subnav toggle
  //     var toggle = document.createElement('span');
  //     toggle.classList.add('site-menu__toggle');
  //     toggle.innerHTML = '<svg class="c-icon color--white" pointer-events="none"><use class="plus" xlink:href="#plus"></use><use class="minus" xlink:href="#minus"></use></svg>';

  //     //make sure toggle doesn't already exist.
  //     if (!item.querySelector('.site-menu__toggle')) {
  //       //find link element within item and append toggle after link
  //       var itemLink = item.querySelector('.site-menu__link');
  //       itemLink.parentNode.insertBefore(toggle, itemLink.nextSibling);

  //       //listen for click on toggle
  //       toggle.addEventListener('click', toggleFooterLinksMobile);
  //     }
  //   });
  // }

  // function toggleFooterLinksMobile(e) {
  //   var submenu = e.target.nextElementSibling;

  //   if (e.target.classList.contains('is-open')) {
  //     e.target.classList.remove('is-open');
  //     submenu.setAttribute('aria-hidden', true);

  //   } else {
  //     e.target.classList.add('is-open');
  //     submenu.setAttribute('aria-hidden', false);
  //   }
  // }

  /* 
    * removes toggles from mobile nav
    */
  // function initFooterDesktopNav() {
  //   var footerToggles = document.querySelectorAll('.site-footer__nav--main .site-menu__toggle');
  //   footerToggles.forEach(function (item) {
  //     item.remove();
  //   });
  // }

  
  function addSpaceForFixedHeader() {
    if ( siteHeaderSticky != null) {
      if (lastInitialized !== DeviceTypes.MOBILE) {
        siteMainContent.style.marginTop = '0px';
        siteMainContent.firstElementChild.style.marginTop = siteHeader.clientHeight + 'px';
      } else {
        siteMainContent.style.marginTop = siteHeader.clientHeight + 'px';
        siteMainContent.firstElementChild.style.marginTop = '0px';
      }
    }
  }
  

  function toggleHeaderVisibility() {
    //get current position
    currentScrollTop = window.scrollY;

    //check if scrolled up or down
    if (currentScrollTop > latestKnownScrollY) {
      //scrolling down
      siteHeader.classList.add('site-header--offscreen');
    } else {
      //scrolling up
      siteHeader.classList.remove('site-header--offscreen');
    }

    //set new position
    latestKnownScrollY = currentScrollTop <= 0 ? 0 : currentScrollTop;

    if (latestKnownScrollY === 0) {
      siteHeader.classList.add('site-header--at-top');
    } else {
      siteHeader.classList.remove('site-header--at-top');
    }
  }




  function debounce(func, wait, immediate) {
    var timeout;
    return function () {
      var context = this, args = arguments;
      var later = function () {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  };

}());

// if (siteHeader.classList.contains('site-header--stacked')) {
//   siteHeader.classList.remove('site-header--at-top');
// }