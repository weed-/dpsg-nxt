function toggleMobileSubmenu(menuitemClassName, imageCollapse, imageExpand) {

    console.log("imageCollapse");
    console.log(imageCollapse);

    console.log("imageExpand");
    console.log(imageExpand);


    mobileMenu = document.getElementById("nav-mobile-ul-menu");
    menuItemLiElement = mobileMenu.getElementsByClassName(menuitemClassName)[0];
    menuItemUlElement = menuItemLiElement.getElementsByTagName("ul")[0];
    menuItemSpanElement = menuItemLiElement.getElementsByTagName("span")[0];

    if (menuItemUlElement.style.display == "none" || menuItemUlElement.style.display.length == 0) {
        menuItemUlElement.style.display = "block";
        menuItemSpanElement.style.backgroundImage = imageCollapse;
    } else {
        menuItemUlElement.style.display = "none";
        menuItemSpanElement.style.backgroundImage = imageExpand;
    }
}