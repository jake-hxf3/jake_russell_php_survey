(() => {
    console.log("js file connected");
    
    gsap.registerPlugin(ScrollTrigger);
    gsap.registerPlugin(ScrollToPlugin);

    const burger = document.querySelector("#burger");
    const errorInp = document.querySelector("#error-input");
    const notif = document.querySelector("#notification");

    let errorReceived = false;

    function toggleMobileMenu() {
        burger.classList.toggle("clicked");

        gsap.from("#burger-menu", {
            duration: 0.5,
            autoAlpha: 0,
            ease: "power4.out",
            y: "-3vh",
        })
    }

    let errorMsg = errorInp.textContent;
    let notifMsg = notif.textContent;

    function change_dialog() {
        notif.setAttribute("open", "true");
        notif.ariaHidden = "false";
        errorReceived = true;
    }

    // prints out an alert window if there's a not so innocent error
    // meaning errors that may involve hacking or editing in the dev tools
    if(errorMsg) {
        console.log("Form error!");
        if(notifMsg) {
            change_dialog();
            return;
        }
        window.alert(errorMsg);
    }

    burger.addEventListener("click", toggleMobileMenu);

})();