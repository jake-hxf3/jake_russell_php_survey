(() => {
    console.log("js file connected");
    
    gsap.registerPlugin(ScrollTrigger);
    gsap.registerPlugin(ScrollToPlugin);

    const burger = document.querySelector("#burger");
    const errorInp = document.querySelector("#error-input");
    const notif = document.querySelector("#notification");
    const inputs = document.querySelectorAll("input");


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
    }

    function turnErrorsOff(e) {
        let input = e.target;
        console.log(input.id);
        // when focus on an input, its associated fieldset or label should remove the error styling class
        let parent = input.closest(".error"); // fieldsets
        if(parent) {
            parent.classList.remove("error");
        }
        let sibling = input.previousElementSibling; // labels
        if(sibling) {
            sibling.classList.remove("error");
        }    
    }

    // prints out an alert window if there's a not so innocent error
    // meaning errors that may involve hacking or editing in the dev tools
    if(errorMsg) {
        console.log("Form error!");
        if(notifMsg) {
            change_dialog();
        } else {
            window.alert(errorMsg);
        }
        
    }

    burger.addEventListener("click", toggleMobileMenu);
    inputs.forEach((elem) => {
        elem.addEventListener("focus", turnErrorsOff);
        elem.addEventListener("input", turnErrorsOff);
    })
})();