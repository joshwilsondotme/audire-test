(function () {

  var body = document.body;
  var mainNavUl = document.querySelector('.site-menu--main');
  var menuToggle = document.querySelector('.nav-toggle');
  var topLevelParentListItems = mainNavUl.querySelectorAll('.site-menu__item.site-menu__item--parent');
  var siteOverlay = document.querySelector('#js-site-overlay');

  // var connectNav = document.querySelector('.site-header__connect-wrapper .site-menu--main .site-menu__item .site-menu__link');

  // connectNav.insertAdjacentHTML('afterend', '<span class=site-menu__sub-menu-toggle></span>');

  var lastInitialized;

  var DeviceTypes = {
    MOBILE: 'mobile',
    DESKTOP: 'desktop',
  };

  // setup event listeners
  handleMenuToggleClick();

  //add clickable carets to parent items
  //and add overview links to submenu
  createSubmenuToggles();

  window.addEventListener('resize', debounce(toggleMobileOrDesktop.bind(this), 1000));

  toggleMobileOrDesktop();

  function toggleMobileOrDesktop() {
    if (window.innerWidth >= 1080) {
      // if(window.matchMedia('screen and (min-width:64rem)').matches) {
      initHeaderDesktopNav();
    } else {
      initHeaderMobileNav();
    }
    // addSpaceForFixedHeader();
  }

  function initHeaderMobileNav() {
    if (lastInitialized !== DeviceTypes.MOBILE) {
      // moveSearchFormToMainNav();

      // menu is off-screen
      hideElementFromScreenReaders(mainNavUl);

      showSubmenuToggles();

      lastInitialized = DeviceTypes.MOBILE;
    }
  }

  function initHeaderDesktopNav() {
    if (lastInitialized !== DeviceTypes.DESKTOP) {
      // moveSearchFormToSearchFormWrapper();

      // menu is on-screen
      showElementToScreenReaders(mainNavUl);

      hideSubmenuToggles();

      if (lastInitialized === DeviceTypes.MOBILE) {
        closeMenu(menuToggle, mainNavUl);
        removeOpenedMenuStates();
      }

      lastInitialized = DeviceTypes.DESKTOP;
    }
  }

  function createSubmenuToggles() {
    for (var x = 0; x < topLevelParentListItems.length; x++) {
      insertSubmenuToggles(topLevelParentListItems[x]);

      topLevelParentListItems.forEach(function (element) {
        element.addEventListener('mouseover', function () {
          siteOverlay.classList.add('visible');
        });
        element.addEventListener('mouseout', function () {
          siteOverlay.classList.remove('visible');
        });
      });

    }
  }

  function insertSubmenuToggles(parent) {
    var subMenuToggle = document.createElement('span');

    subMenuToggle.classList.add('site-menu__sub-menu-toggle');

    parent.insertBefore(subMenuToggle, parent.querySelector('.site-menu__sub-menu'));

    subMenuToggle.addEventListener('click', function () {
      toggleMobileSubMenuTopLevel(this.parentElement);
    });
  }

  function applyToSubmenuToggles(fn) {
    if (document.querySelectorAll('site-menu__sub-menu-toggle').length > 1) {
      document.querySelectorAll('site-menu__sub-menu-toggle').forEach(function () {
        fn.call(this);
      });
    }
  }

  function hideSubmenuToggles() {
    applyToSubmenuToggles(function () {
      this.classList.add('hidden');
    });
  }

  function showSubmenuToggles() {
    applyToSubmenuToggles(function () {
      this.classList.remove('hidden');
    });
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
    menuButton.classList.remove('nav-toggle--nav-is-open');
    menuButton.classList.add('nav-toggle--nav-is-closed');
    body.classList.remove('no-scroll');
    hideExpandedFromScreenreaders(menuButton);
    hideElementFromScreenReaders(mainNavigationList);
  }

  function openMenu(menuButton, mainNavigationList) {
    menuButton.classList.remove('nav-toggle--nav-is-closed');
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

  // function moveElementToMainNav(element) {
  //   var fn = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  //   moveElementToNav(mainNavUl, element, fn);
  // }

  // function wrapElement(element, wrapper) {
  //   element.parentNode.insertBefore(wrapper, element);
  //   wrapper.appendChild(element);
  // }

  // function moveSearchFormToMainNav() {
  //   if (!document.querySelector('.site-menu__item--search-form-wrapper')) {
  //     var listSearchWrapper = document.createElement('li');

  //     listSearchWrapper.classList.add('site-menu__item');
  //     listSearchWrapper.classList.add('site-menu__item--search-form-wrapper');
  //     listSearchWrapper.appendChild(searchForm);

  //     moveElementToNav(mainNavUl, listSearchWrapper);
  //   }
  // }

  // function moveSearchFormToSearchFormWrapper() {
  //   searchFormWrapper.appendChild(searchForm);
  //   var listSearchWrapper = mainNavUl.querySelector('.site-menu__item--search-form-wrapper');
  //   if (listSearchWrapper) {
  //     listSearchWrapper.remove();
  //   }
  // }

  function hideElementFromScreenReaders(element) {
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

  // function showCollapsedToScreenReaders(element) {
  //   element.setAttribute('aria-expanded', false);
  // }

  function removeOpenedMenuStates() {
    // var backItem = mainNavUl.querySelector('.site-menu__link--back');
    // if (backItem) {
    //   backItem.classList.remove('site-menu__link--back');
    // }

    var subMenus = mainNavUl.querySelectorAll('.site-menu__sub-menu');
    subMenus.forEach(function (menu) {
      if (menu.classList.contains('site-menu__sub-menu--active')) {
        menu.classList.remove('site-menu__sub-menu--active');
      }
      showElementToScreenReaders(menu);

      var toggle = menu.parentNode.querySelector('.site-menu__sub-menu-toggle--active');
      if (toggle) {
        toggle.classList.remove('site-menu__sub-menu-toggle--active');
      }
    });
  }

  function toggleMobileSubMenuTopLevel(listItem) {

    var link = listItem.querySelector('.site-menu__link');
    var subnav = listItem.querySelector('.site-menu__sub-menu');
    
    if (link.classList.contains('site-menu__link--opened')) {
      link.classList.remove('site-menu__link--opened');
      subnav.classList.remove('site-menu__sub-menu--active');
      hideElementFromScreenReaders(subnav);
    } else {
      link.classList.add('site-menu__link--opened');
      subnav.classList.add('site-menu__sub-menu--active');
      showElementToScreenReaders(subnav);
    }

  }

  // function showMobileSubMenuSecondLevel(listItem) {
  //   var subnav = listItem.querySelector('.site-menu__sub-menu');
  //   var toggle = listItem.querySelector('.site-menu__sub-menu-toggle');

  //   if (subnav.classList.contains('site-menu__sub-menu--active')) {
  //     subnav.classList.remove('site-menu__sub-menu--active');
  //     hideElementFromScreenReaders(subnav);
  //     toggle.classList.remove('site-menu__sub-menu-toggle--active');
  //   } else {
  //     subnav.classList.add('site-menu__sub-menu--active');
  //     showElementToScreenReaders(subnav);
  //     toggle.classList.add('site-menu__sub-menu-toggle--active');
  //   }
  // }

  // function hideMobileSubMenu(link) {
  //   link.classList.remove('site-menu__link--opened');

  //   //hide
  //   var subnav = link.parentNode.querySelector('.site-menu__sub-menu');
  //   subnav.classList.remove('site-menu__sub-menu--active');
  //   hideElementFromScreenReaders(subnav);
  // }

  // function addSpaceForFixedHeader() {
  //   siteMainContent.style.paddingTop = siteHeader.clientHeight + 'px';
  // }

  // function createMobileUtility() {
    // Adds the "Search Inventory" button
    // $(mainNavUl).append(`
    //   <li class="site-menu__item" role="menuitem" tabindex="-1">
    //     <button class="site-menu__link site-menu__link--btn btn-link btn-link--arrow">Search Inventory</button>
    //   </li>
    // `);

    // Adds navItems
    // var secondaryNavItems = $(secondaryNavUl)
    //   .find('li')
    //   .clone();
    // var utilNavItems = $(utilNavUl)
    //   .find('li')
    //   .clone();

    // updateMobileUtilityClasses(secondaryNavItems);
    // updateMobileUtilityClasses(utilNavItems);

    // var accountLink = $(myAccountLink)
    //   .clone()
    //   .addClass('hide@md site-menu__link site-menu__sub-menu--2__link');
    // $(mainNavUl).append(accountLink);

    // $(mainNavUl)
    //   .find('.my-account')
    //   .wrap('<li class="site-menu__sub-menu--2__item hide@md"></li>');
  // }

  // function updateMobileUtilityClasses(items) {
  //   items.each(function () {
  //     $(this)
  //       .removeClass('site-menu__item')
  //       .addClass('site-menu__sub-menu--2__item hide@md');
  //     $(this)
  //       .find('a')
  //       .addClass('site-menu__sub-menu--2__link');
  //     $(mainNavUl).append($(this));
  //   });
  // }

  function debounce(func, wait, immediate) {
    var timeout;
    return function () {
      var context = this,
        args = arguments;
      var later = function () {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  }
})();


(function () {

  var body = document.body;
  var mainNavUl = document.querySelector('.connect-menu--main');
  var menuToggle = document.querySelector('.nav-toggle');
  var topLevelParentListItems = mainNavUl.querySelectorAll('.connect-menu__item.connect-menu__item--parent');
  var siteOverlay = document.querySelector('#js-site-overlay');

  // var connectLink = document.querySelector('.connect-menu__link');
  // connectLink.setAttribute("href", "#");

  // var connectNav = document.querySelector('.site-header__connect-wrapper .site-menu--main .site-menu__item .site-menu__link');

  // connectNav.insertAdjacentHTML('afterend', '<span class=site-menu__sub-menu-toggle></span>');

  var lastInitialized;

  var DeviceTypes = {
    MOBILE: 'mobile',
    DESKTOP: 'desktop',
  };

  // // setup event listeners
  // handleMenuToggleClick();

  //add clickable carets to parent items
  //and add overview links to submenu
  createSubmenuToggles();

  window.addEventListener('resize', debounce(toggleMobileOrDesktop.bind(this), 1000));

  toggleMobileOrDesktop();

  function toggleMobileOrDesktop() {
    if (window.innerWidth >= 1080) {
      // if(window.matchMedia('screen and (min-width:64rem)').matches) {
      initHeaderDesktopNav();
    } else {
      initHeaderMobileNav();
    }
    // addSpaceForFixedHeader();
  }

  function initHeaderMobileNav() {
    if (lastInitialized !== DeviceTypes.MOBILE) {
      // moveSearchFormToMainNav();

      // menu is off-screen
      hideElementFromScreenReaders(mainNavUl);

      showSubmenuToggles();

      lastInitialized = DeviceTypes.MOBILE;
    }
  }

  function initHeaderDesktopNav() {
    if (lastInitialized !== DeviceTypes.DESKTOP) {
      // moveSearchFormToSearchFormWrapper();

      // menu is on-screen
      showElementToScreenReaders(mainNavUl);

      hideSubmenuToggles();

      if (lastInitialized === DeviceTypes.MOBILE) {
        closeMenu(menuToggle, mainNavUl);
        removeOpenedMenuStates();
      }

      lastInitialized = DeviceTypes.DESKTOP;
    }
  }

  function createSubmenuToggles() {
    for (var x = 0; x < topLevelParentListItems.length; x++) {
      insertSubmenuToggles(topLevelParentListItems[x]);

      topLevelParentListItems.forEach(function (element) {
        element.addEventListener('mouseover', function () {
          siteOverlay.classList.add('visible');
        });
        element.addEventListener('mouseout', function () {
          siteOverlay.classList.remove('visible');
        });
      });

    }
  }

  function insertSubmenuToggles(parent) {
    var subMenuToggle = document.createElement('span');

    subMenuToggle.classList.add('connect-menu__sub-menu-toggle');

    parent.insertBefore(subMenuToggle, parent.querySelector('.connect-menu__sub-menu'));

    subMenuToggle.addEventListener('click', function () {
      toggleMobileSubMenuTopLevel(this.parentElement);
    });
  }

  function applyToSubmenuToggles(fn) {
    if (document.querySelectorAll('connect-menu__sub-menu-toggle').length > 1) {
      document.querySelectorAll('connect-menu__sub-menu-toggle').forEach(function () {
        fn.call(this);
      });
    }
  }

  function hideSubmenuToggles() {
    applyToSubmenuToggles(function () {
      this.classList.add('hidden');
    });
  }

  function showSubmenuToggles() {
    applyToSubmenuToggles(function () {
      this.classList.remove('hidden');
    });
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
    menuButton.classList.remove('nav-toggle--nav-is-open');
    menuButton.classList.add('nav-toggle--nav-is-closed');
    body.classList.remove('no-scroll');
    hideExpandedFromScreenreaders(menuButton);
    hideElementFromScreenReaders(mainNavigationList);
  }

  function openMenu(menuButton, mainNavigationList) {
    menuButton.classList.remove('nav-toggle--nav-is-closed');
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

  // function moveElementToMainNav(element) {
  //   var fn = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  //   moveElementToNav(mainNavUl, element, fn);
  // }

  // function wrapElement(element, wrapper) {
  //   element.parentNode.insertBefore(wrapper, element);
  //   wrapper.appendChild(element);
  // }

  // function moveSearchFormToMainNav() {
  //   if (!document.querySelector('.connect-menu__item--search-form-wrapper')) {
  //     var listSearchWrapper = document.createElement('li');

  //     listSearchWrapper.classList.add('connect-menu__item');
  //     listSearchWrapper.classList.add('connect-menu__item--search-form-wrapper');
  //     listSearchWrapper.appendChild(searchForm);

  //     moveElementToNav(mainNavUl, listSearchWrapper);
  //   }
  // }

  // function moveSearchFormToSearchFormWrapper() {
  //   searchFormWrapper.appendChild(searchForm);
  //   var listSearchWrapper = mainNavUl.querySelector('.connect-menu__item--search-form-wrapper');
  //   if (listSearchWrapper) {
  //     listSearchWrapper.remove();
  //   }
  // }

  function hideElementFromScreenReaders(element) {
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

  // function showCollapsedToScreenReaders(element) {
  //   element.setAttribute('aria-expanded', false);
  // }

  function removeOpenedMenuStates() {
    // var backItem = mainNavUl.querySelector('.connect-menu__link--back');
    // if (backItem) {
    //   backItem.classList.remove('connect-menu__link--back');
    // }

    var subMenus = mainNavUl.querySelectorAll('.connect-menu__sub-menu');
    subMenus.forEach(function (menu) {
      if (menu.classList.contains('connect-menu__sub-menu--active')) {
        menu.classList.remove('connect-menu__sub-menu--active');
      }
      showElementToScreenReaders(menu);

      var toggle = menu.parentNode.querySelector('.connect-menu__sub-menu-toggle--active');
      if (toggle) {
        toggle.classList.remove('connect-menu__sub-menu-toggle--active');
      }
    });
  }

  function toggleMobileSubMenuTopLevel(listItem) {

    var link = listItem.querySelector('.connect-menu__link');
    var subnav = listItem.querySelector('.connect-menu__sub-menu');

    if (link.classList.contains('connect-menu__link--opened')) {
      link.classList.remove('connect-menu__link--opened');
      subnav.classList.remove('connect-menu__sub-menu--active');
      hideElementFromScreenReaders(subnav);
    } else {
      link.classList.add('connect-menu__link--opened');
      subnav.classList.add('connect-menu__sub-menu--active');
      showElementToScreenReaders(subnav);
    }

  }

  // function showMobileSubMenuSecondLevel(listItem) {
  //   var subnav = listItem.querySelector('.connect-menu__sub-menu');
  //   var toggle = listItem.querySelector('.connect-menu__sub-menu-toggle');

  //   if (subnav.classList.contains('connect-menu__sub-menu--active')) {
  //     subnav.classList.remove('connect-menu__sub-menu--active');
  //     hideElementFromScreenReaders(subnav);
  //     toggle.classList.remove('connect-menu__sub-menu-toggle--active');
  //   } else {
  //     subnav.classList.add('connect-menu__sub-menu--active');
  //     showElementToScreenReaders(subnav);
  //     toggle.classList.add('connect-menu__sub-menu-toggle--active');
  //   }
  // }

  // function hideMobileSubMenu(link) {
  //   link.classList.remove('connect-menu__link--opened');

  //   //hide
  //   var subnav = link.parentNode.querySelector('.connect-menu__sub-menu');
  //   subnav.classList.remove('connect-menu__sub-menu--active');
  //   hideElementFromScreenReaders(subnav);
  // }

  // function addSpaceForFixedHeader() {
  //   siteMainContent.style.paddingTop = siteHeader.clientHeight + 'px';
  // }

  // function createMobileUtility() {
  // Adds the "Search Inventory" button
  // $(mainNavUl).append(`
  //   <li class="connect-menu__item" role="menuitem" tabindex="-1">
  //     <button class="connect-menu__link connect-menu__link--btn btn-link btn-link--arrow">Search Inventory</button>
  //   </li>
  // `);

  // Adds navItems
  // var secondaryNavItems = $(secondaryNavUl)
  //   .find('li')
  //   .clone();
  // var utilNavItems = $(utilNavUl)
  //   .find('li')
  //   .clone();

  // updateMobileUtilityClasses(secondaryNavItems);
  // updateMobileUtilityClasses(utilNavItems);

  // var accountLink = $(myAccountLink)
  //   .clone()
  //   .addClass('hide@md connect-menu__link connect-menu__sub-menu--2__link');
  // $(mainNavUl).append(accountLink);

  // $(mainNavUl)
  //   .find('.my-account')
  //   .wrap('<li class="connect-menu__sub-menu--2__item hide@md"></li>');
  // }

  // function updateMobileUtilityClasses(items) {
  //   items.each(function () {
  //     $(this)
  //       .removeClass('connect-menu__item')
  //       .addClass('connect-menu__sub-menu--2__item hide@md');
  //     $(this)
  //       .find('a')
  //       .addClass('connect-menu__sub-menu--2__link');
  //     $(mainNavUl).append($(this));
  //   });
  // }

  function debounce(func, wait, immediate) {
    var timeout;
    return function () {
      var context = this,
        args = arguments;
      var later = function () {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  }
})();

$(".connect-menu__link").attr("href", "javasript:void();");