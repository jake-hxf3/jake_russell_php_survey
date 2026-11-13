(() => {
    console.log("js file connected");
    
    gsap.registerPlugin(ScrollTrigger);
    gsap.registerPlugin(ScrollToPlugin);

    burger = document.querySelector("#burger");

    function toggleMobileMenu() {
        burger.classList.toggle("clicked");
    }

    burger.addEventListener("click", toggleMobileMenu);

})();