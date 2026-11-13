(() => {
    console.log("js file connected");
    
    gsap.registerPlugin(ScrollTrigger);
    gsap.registerPlugin(ScrollToPlugin);

    burger = document.querySelector("#burger");

    function toggleMobileMenu() {
        burger.classList.toggle("clicked");

        gsap.from("#burger-menu", {
            duration: 0.5,
            autoAlpha: 0,
            ease: "power4.out",
            y: "-3vh",
        })
    }

    burger.addEventListener("click", toggleMobileMenu);

})();