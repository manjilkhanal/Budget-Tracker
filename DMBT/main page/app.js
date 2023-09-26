function hasNetwork(online){
    const element = document.querySelector(".status");

    if(online){
        element.classList.remove("offline");
        element.classList.add("online");
    }else{
        element.classList.remove("online");
        element.classList.add("offline");
    }
}

window.addEventListener("load",()=>{
    hasNetwork(navigator.online);
    
    window.addEventListener("online",()=>{
        hasNetwork(true);
    });

    window.addEventListener("offline",() => {
        hasNetwork(false);
    });
});