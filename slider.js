document.addEventListener("DOMContentLoaded", function () {
    const images = ["img/22.jpg", "img/3.jpg"];
    let index = 0;

    function changeBackground() {
        document.body.style.backgroundImage = `url('${images[index]}')`;
        index = (index + 1) % images.length;
    }

    setInterval(changeBackground, 3000); // ndrron mas 3 sekondave
    changeBackground(); 
});
