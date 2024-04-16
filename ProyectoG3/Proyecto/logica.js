const btnLeft = document.querySelector(".btn-left"),
btnRight = document.querySelector(".btn-right"),
slider = document.querySelector("#slider"),
sliderSection = document.querySelectorAll(".slider-section");

btnLeft.addEventListener("click", e => moveToLeft())
btnRight.addEventListener("click", e => moveToRight())

setInterval(() => {
    moveToRight()
}, 4000);

let operacion = 0;
    counter=0;

function moveToRight() {
    
    if (sliderSection.length == 1) {
        widthImg = 100 / 1;
    } else if (sliderSection.length == 2) {
        widthImg = 100 / 3;
    } else {
        widthImg = 100 / sliderSection.length;
    }
    if(counter>= sliderSection.length-1){
        counter=0;
        operacion = 0;
        slider.style.transform = `translate(-${operacion}% )`
        slider.style.transition = "all ease .9s"
        slider.style.transition = "none"; 
    }else{
        counter++;
        operacion = operacion + widthImg;
        slider.style.transform = `translate(-${operacion}% )`
        slider.style.transition = "all ease .9s"
    }

}

function moveToLeft(){
    counter--;
    if(counter < 0){
        counter = sliderSection.length-1;
        operacion = widthImg * (sliderSection.length-1)
        slider.style.transform = `translate(-${operacion}% )`
    }else{
        operacion = operacion - widthImg
    slider.style.transform = `translate(-${operacion}% )`;
    slider.style.transition = "all ease .9s"
    }
    
}
